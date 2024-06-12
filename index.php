<?php

include_once('init.php');

//Days for forecast request - default 5
$forecast_days = isset($_GET['forecast_days']) ? $_GET['forecast_days'] : 5;

//City for weather request - default Chernihiv
$city = isset($_GET['city']) ? $_GET['city'] : 'Chernihiv';

//Get full weather info
$forecastWeather = getForecastAndCurrentWeather(API_KEY, $forecast_days, $city);

//Get astro info for current day
$sunInfo = getTodaysSunData($forecastWeather);

//Get weather info for next 5 hours from full hours array
$next5Hour = getTodaysNext5HoursWeather(getPerHourWeather($forecastWeather, date("Y-m-d")));

//Get chance of rain for current hour
$chanceOfRain = getChanceOfRainForCurrentHour(getPerHourWeather($forecastWeather, date("Y-m-d")));

$pageTitle = 'Weather';

//Template for default page
$content = template('default', [
	'weather' => $forecastWeather,
	'astro' => $sunInfo,
	'perHour' => $next5Hour,
	'chanceOfRain' => $chanceOfRain
]);

//Main template
$html = template('main', [
	'title' => $pageTitle,
	'content' => $content
]);

echo $html;
