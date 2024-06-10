<?php
include_once('init.php');

function getForecastWeather(string $apiKey)
{
    $city = "Chernihiv";
    $googleApiUrl = "http://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$city&days=5&aqi=no&alerts=no";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    return getFormatedDate($data);
}
function getFormatedDate($weatherData)
{
    foreach ($weatherData->forecast->forecastday as $day) {
        $date = new DateTime($day->date);
        $day->day_of_week = $date->format('D');
        $day->day_of_month = $date->format('d');
        $day->month = $date->format('M');
    }
    return $weatherData;
}
function getTodaysSunData($weatherData)
{
    $currentDate = date("Y-m-d");
    foreach ($weatherData->forecast->forecastday as $day) {
        if ($day->date === $currentDate) {
            return $day->astro;
        }
    }
}
function getTodaysPerHourWeather($weatherData)
{
    $currentDate = date("Y-m-d");
    foreach ($weatherData->forecast->forecastday as $day) {
        if ($day->date === $currentDate) {
            foreach ($day->hour as $hour) {
                $hour->time = str_replace($currentDate, "", $hour->time);
            }
            return $day->hour;
        }
    }
}
