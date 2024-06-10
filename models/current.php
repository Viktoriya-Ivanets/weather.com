<?php
include_once('init.php');

function getCurrentWeather(string $apiKey)
{
    $city = "Chernihiv";
    $googleApiUrl = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city&aqi=no&alerts=no";

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
    return $data;
}
