<?php

include_once('init.php');

//Get full weather info for several days and some city
function getForecastAndCurrentWeather(string $apiKey, int $forecast_days, string $city)
{
    //URL for request
    $googleApiUrl = "http://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$city&days=$forecast_days&aqi=no&alerts=no";

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

    //Return data with new fields (formated date)
    return getFormatedDate($data);
}

//Add to data new fields with formated date
function getFormatedDate($weatherData)
{
    foreach ($weatherData->forecast->forecastday as $day) {
        $date = new DateTime($day->date);

        //Date will looks like: Mon 10 Jun
        $day->day_of_week = $date->format('D');
        $day->day_of_month = $date->format('d');
        $day->month = $date->format('M');
    }
    return $weatherData;
}

//Get astro data for current day
function getTodaysSunData($weatherData)
{
    //Get current date
    $currentDate = date("Y-m-d");
    foreach ($weatherData->forecast->forecastday as $day) {
        if ($day->date === $currentDate) {
            return $day->astro;
        }
    }
}

//Get full per hour weather info for some day
function getPerHourWeather($weatherData, $someDate)
{
    foreach ($weatherData->forecast->forecastday as $day) {

        //If dates are equal
        if ($day->date === $someDate) {
            foreach ($day->hour as $hour) {

                //Get off y-m-d info from time field
                $hour->time = trim(str_replace($someDate, "", $hour->time));
            }
            return $day->hour;
        }
    }
}

//Get weather info for next 5 hours this day
function getNext5HoursWeather($todaysHours, $nextDayHours)
{
    $currentTime = date("H:i");

    //New array for per hour info
    $next5Hours = [];

    foreach ($todaysHours as $hour) {

        //When items of array 5 - stop collecting
        if (count($next5Hours) >= 5) {
            break;
        }

        //Collect next 5 hours info
        if ($hour->time > $currentTime) {
            $next5Hours[] = $hour;
        }
    }
    if (count($next5Hours) < 5) {
        foreach ($nextDayHours as $hour) {

            //When items of array 5 - stop collecting
            if (count($next5Hours) >= 5) {
                break;
            }
            $next5Hours[] = $hour;
        }
    }
    return $next5Hours;
}

//Get chance of rain for a current hour
function getChanceOfRainForCurrentHour($perHour)
{
    $currentHour = date("H:00");

    foreach ($perHour as $hour) {
        if ($hour->time === $currentHour) {
            return $hour->chance_of_rain;
        }
    }
}

//Get average weather params for a full day page
function getAverageWeatherParamsForDay($weatherData, $someDate)
{
    foreach ($weatherData->forecast->forecastday as $day) {

        //If dates are equal
        if ($day->date === $someDate) {
            return $day->day;
        }
    }
}

//Returns formated date like: Saturday 22nd of June 2024
function formatDate($date)
{
    return date('l jS \of F Y', strtotime($date));
}
