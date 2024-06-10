<?php
include_once('init.php');
$currentWeather = getCurrentWeather(API_KEY);
$forecastWeather = getForecastWeather(API_KEY);
$astroInfo = getTodaysSunData($forecastWeather);
$perHourInfo = getTodaysPerHourWeather($forecastWeather);
$pageTitle = 'Weather';
$forecastContent = template('forecast', [
	'forecast_items' => $forecastWeather
]);

$currentContent = template('current', ['content' => $forecastContent, 'weather' => $currentWeather, 'astro' => $astroInfo, 'perHour' => $perHourInfo]);

$html = template('main', [
	'title' => $pageTitle,
	'content' => $currentContent
]);

echo $html;
