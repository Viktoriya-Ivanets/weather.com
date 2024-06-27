<?php

include_once('init.php');

// Initial default values
$pageTitle = 'Weather';
$content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Handle form submission for search
	$city = htmlspecialchars($_POST['city']);
	if (!empty($city) && !empty(getSearchInfo(API_KEY, $city))) {
		header('Location: index.php?search=true&city=' . urlencode($city));
	} else {
		header('Location: index.php?search=true');
	}
	exit(); // Ensure script stops after redirection
} else {

	// Days for forecast request - default 5
	$forecast_days = isset($_GET['forecast_days']) ? $_GET['forecast_days'] : 5;

	// City for weather request - default Chernihiv
	$city = isset($_GET['city']) && !empty($_GET['city']) ? $_GET['city'] : 'Chernihiv';

	// Get full weather info
	$forecastWeather = getForecastAndCurrentWeather(API_KEY, $forecast_days, $city);

	if (isset($_GET['search']) && $_GET['search'] == 'true') {
		if (!isset($_GET['city'])) {
			$searchInfo = []; // Empty search results
		}
		// Get search info
		$searchInfo = getSearchInfo(API_KEY, $_GET['city']);

		// Define page title
		$pageTitle = 'Search for ' . htmlspecialchars($_GET['city']);

		// Template for search results page
		$content = template('search', [
			'search_items' => $searchInfo
		]);
	} elseif (isset($_GET['date'])) {
		// If date mode
		// Get weather info for past day
		if ($_GET['date'] < date("Y-m-d")) {
			$forecastWeather = getHistoryInfo(API_KEY, $city, $_GET['date']);
		}

		// Get weather info for future day
		if ($_GET['date'] > date("Y-m-d", strtotime("+2 weeks"))) {
			$forecastWeather = getFutureInfo(API_KEY, $city, $_GET['date']);
		}

		// Define a page title
		$pageTitle = 'Weather on ' . htmlspecialchars($_GET['date']);

		// Get per hour weather for a full day
		$perHourWeather = getPerHourWeather($forecastWeather, $_GET['date']);

		// Get avg params
		$avgParamsForDay = getAverageWeatherParamsForDay($forecastWeather, $_GET['date']);

		// Template for full day page
		$content = template('full_day', [
			'weather' => $forecastWeather,
			'perHour' => $perHourWeather,
			'dateTime' => formatDate($_GET['date']),
			'avgParamsForDay' => $avgParamsForDay
		]);
	} else {
		// Else default mode
		// Forecast days param for full day URL
		$forecast_days_param = $forecast_days;
		if (str_contains($_SERVER['REQUEST_URI'], 'forecast_days')) {
			$forecast_days_param = getForecastDaysFromUri($_SERVER['REQUEST_URI']);
		}

		// Get astro info for current day
		$sunInfo = getTodaysSunData($forecastWeather);

		// Get weather info for next 5 hours from full hours array
		$nextHours = getNext5HoursWeather(getPerHourWeather($forecastWeather, date("Y-m-d")), getPerHourWeather($forecastWeather, date("Y-m-d", strtotime("+1 day"))));

		// Get chance of rain for current hour
		$chanceOfRain = getChanceOfRainForCurrentHour(getPerHourWeather($forecastWeather, date("Y-m-d")));

		// Template for default page
		$content = template('default', [
			'weather' => $forecastWeather,
			'astro' => $sunInfo,
			'perHour' => $nextHours,
			'chanceOfRain' => $chanceOfRain,
			'forecast_days_param' => $forecast_days_param,
			'city' => $city
		]);
	}
}

// Main template
$html = template('main', [
	'title' => $pageTitle,
	'content' => $content,
	'city' => $city,
	'yesterday_date' => date("Y-m-d", strtotime("yesterday"))
]);

echo $html;
