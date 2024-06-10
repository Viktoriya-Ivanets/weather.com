<?php
include_once('init.php');
$currentWeather = getCurrentWeather(API_KEY);
$forecastWeather = getForecastWeather(API_KEY);
$pageTitle = 'Weather';
$forecastContent = template('forecast', [
	'forecast_items' => $forecastWeather
]);

$currentContent = template('current', ['content' => $forecastContent, 'weather' => $currentWeather]);

$html = template('main', [
	'title' => $pageTitle,
	'content' => $currentContent
]);

echo $html;
