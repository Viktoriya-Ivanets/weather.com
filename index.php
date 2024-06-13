<?php

include_once('init.php');

//Days for forecast request - default 5
$forecast_days = isset($_GET['forecast_days']) ? $_GET['forecast_days'] : 5;

//City for weather request - default Chernihiv
$city = isset($_GET['city']) ? $_GET['city'] : 'Chernihiv';

//Get full weather info
$forecastWeather = getForecastAndCurrentWeather(API_KEY, $forecast_days, $city);

//If date mode
if (isset($_GET['date'])) {

	//Define a page titile
	$pageTitle = 'Weather on ' . $_GET['date'];

	//Get per hour weather for a full day
	$perHourWeather = getPerHourWeather($forecastWeather, $_GET['date']);

	//Get avg params 
	$avgParamsForDay = getAverageWeatherParamsForDay($forecastWeather, $_GET['date']);

	//Template for full day page
	$content = template('full_day', [
		'weather' => $forecastWeather,
		'perHour' => $perHourWeather,
		'dateTime' => formatDate($_GET['date']),
		'avgParamsForDay' => $avgParamsForDay
	]);

	//Main template
	$html = template('main', [
		'title' => $pageTitle,
		'content' => $content
	]);
}

//Else default mode
else {

	//Forecast days param for full day url
	$forecast_days_param = '';
	if (str_contains($_SERVER['REQUEST_URI'], 'forecast_days')) {
		$forecast_days_param = str_replace('/index.php?', '&', $_SERVER['REQUEST_URI']);
	}
	//Get astro info for current day
	$sunInfo = getTodaysSunData($forecastWeather);

	//Get weather info for next 5 hours from full hours array
	$next5Hour = getTodaysNext5HoursWeather(getPerHourWeather($forecastWeather, date("Y-m-d")));

	//Get chance of rain for current hour
	$chanceOfRain = getChanceOfRainForCurrentHour(getPerHourWeather($forecastWeather, date("Y-m-d")));

	//Define page title
	$pageTitle = 'Weather';

	//Template for default page
	$content = template('default', [
		'weather' => $forecastWeather,
		'astro' => $sunInfo,
		'perHour' => $next5Hour,
		'chanceOfRain' => $chanceOfRain,
		'forecast_days_param' => $forecast_days_param
	]);

	//Main template
	$html = template('main', [
		'title' => $pageTitle,
		'content' => $content
	]);
}
echo $html;
