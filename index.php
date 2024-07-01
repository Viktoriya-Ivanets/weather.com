<?php

include_once('init.php');

// Initial default values
$pageTitle = 'Weather';
$content = '';

//Validate request URL
if (!validateURL($_SERVER['REQUEST_URI'])) {
	header('HTTP/1.1 400 Bad Request');
	$pageTitle = 'Bad request';
	$content = template('400');
} else {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		//Request with search
		handlePostRequest();
	} else {
		//Other requests
		handleGetRequest();
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

function handlePostRequest()
{
	$city = htmlspecialchars($_POST['city']);
	//If city field not null and info about this city exist
	if (!empty($city) && !empty(getSearchInfo(API_KEY, $city))) {
		//Redirect to search with results
		redirectToSearch($city);
	} else {
		//Redirect to search with no results
		redirectToSearch();
	}
	exit(); // Ensure script stops after redirection
}

function handleGetRequest()
{
	global $pageTitle, $content, $city;

	// Days for forecast request - default 5
	$forecast_days = getForecastDays();
	// City for weather request - default Chernihiv
	$city = getCity();
	// Get full weather info
	$forecastWeather = getForecastAndCurrentWeather(API_KEY, $forecast_days, $city);

	if (isSearchRequest()) {
		//Get search results
		handleSearchRequest($city);
	} elseif (isDateRequest()) {
		//Get full per hour content
		handleDateRequest($city, $forecastWeather);
	} else {
		//Get default content
		handleDefaultRequest($city, $forecastWeather, $forecast_days);
	}
}

//Form correct url for search results
function redirectToSearch($city = '')
{
	$location = 'index.php?search=true';
	if (!empty($city)) {
		$location .= '&city=' . urlencode($city);
	}
	header('Location: ' . $location);
}

//Get number of days for forecast info
function getForecastDays()
{
	return isset($_GET['forecast_days']) ? $_GET['forecast_days'] : 5;
}

//Get city from url
function getCity()
{
	return isset($_GET['city']) && !empty($_GET['city']) ? $_GET['city'] : 'Chernihiv';
}

//Check if request is search
function isSearchRequest()
{
	return isset($_GET['search']) && $_GET['search'] == 'true';
}

//Form content parts for search results
function handleSearchRequest($city)
{
	global $pageTitle, $content;

	if (!isset($_GET['city'])) {
		$searchInfo = []; // Empty search results
	} else {
		$searchInfo = getSearchInfo(API_KEY, $_GET['city']);
	}

	// Define page title
	$pageTitle = 'Search for ' . htmlspecialchars($_GET['city']);

	// Template for search results page
	$content = template('search', [
		'search_items' => $searchInfo
	]);
}

function isDateRequest()
{
	return isset($_GET['date']);
}

//Form content parts for different dates - past, future, current
function handleDateRequest($city, $forecastWeather)
{
	global $pageTitle, $content;

	$date = $_GET['date'];
	//Get forecast weather for the past day
	if ($date < date("Y-m-d")) {
		$forecastWeather = getHistoryInfo(API_KEY, $city, $date);
	} elseif ($date > date("Y-m-d", strtotime("+2 weeks"))) {
		//Get forecast weather for the future day
		$forecastWeather = getFutureInfo(API_KEY, $city, $date);
	}

	// Define a page title
	$pageTitle = 'Weather on ' . htmlspecialchars($date);

	// Get per hour weather for a full day
	$perHourWeather = getPerHourWeather($forecastWeather, $date);

	// Get avg params
	$avgParamsForDay = getAverageWeatherParamsForDay($forecastWeather, $date);

	// Template for full day page
	$content = template('full_day', [
		'weather' => $forecastWeather,
		'perHour' => $perHourWeather,
		'dateTime' => formatDate($date),
		'avgParamsForDay' => $avgParamsForDay
	]);
}

//Form content parts for default weather page
function handleDefaultRequest($city, $forecastWeather, $forecast_days)
{
	global $pageTitle, $content;

	$pageTitle = 'Weather';
	//Get forecast days to form correct url for date mode
	$forecast_days_param = str_contains($_SERVER['REQUEST_URI'], 'forecast_days') ? getForecastDaysFromUri($_SERVER['REQUEST_URI']) : $forecast_days;

	// Get astro info for current day
	$sunInfo = getTodaysSunData($forecastWeather);

	// Get weather info for next 5 hours from full hours array
	$nextHours = getNext5HoursWeather(
		getPerHourWeather($forecastWeather, date("Y-m-d")),
		getPerHourWeather($forecastWeather, date("Y-m-d", strtotime("+1 day")))
	);

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
