<?php
include_once('init.php');

//Get history info
function getHistoryInfo(string $apiKey, string $city, string $date)
{
    //URL for request
    $googleApiUrl = "http://api.weatherapi.com/v1/history.json?key=$apiKey&q=$city&dt=$date";

    //Initialize CURL
    $ch = curl_init();

    //CURL options setup
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //Get response
    $response = curl_exec($ch);

    //Close CURL
    curl_close($ch);

    //Decode a JSON stringinto object
    $data = json_decode($response);

    //Return data
    return $data;
}
