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
    $data = $data->forecast->forecastday;
    return $data;
}
