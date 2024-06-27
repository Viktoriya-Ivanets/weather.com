<?php

//Template function: $path - path to view file, $vars -  variables for pages like: title, items etc.
function template(string $path, array $vars = []): string
{
    //Full path to view file
    $systemTemplateFullPath = "views/$path.php";

    //Extracting variables
    extract($vars);

    //Start buffering
    ob_start();
    //Include file with needed variables
    include($systemTemplateFullPath);

    //Return fully formed html page (Get the contents of the buffer)
    return ob_get_clean();
}

//Get forecast days for URLs
function getForecastDaysFromUri($uri)
{
    $forecastDays = null;

    // Check if 'forecast_days' is present in the URI
    if (preg_match('/forecast_days=([0-9]+)/', $uri, $matches)) {
        // Extract the number following 'forecast_days='
        $forecastDays = (int)$matches[1];
    }

    return $forecastDays;
}
function validateForecastDays(int $days)
{
    $availableDays = [5, 7, 10];
    return in_array($days, $availableDays);
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function validateCity($city)
{
    return !preg_match('~[0-9]+~', $city);
}

function validateURL(string $url)
{
    $query_str = parse_url($url, PHP_URL_QUERY);
    parse_str($query_str, $query_params);

    if (isset($query_params['search']) && $query_params['search'] == 'false') {
        return false;
    }
    if (isset($query_params['city']) && !validateCity($query_params['city'])) {
        return false;
    }
    if (isset($query_params['forecast_days']) && !validateForecastDays($query_params['forecast_days'])) {
        return false;
    }

    if (isset($query_params['date'])) {
        if (
            !validateDate($query_params['date']) ||
            $query_params['date'] > date('Y-m-d', strtotime("+300 days")) ||
            $query_params['date'] < date('Y-m-d', strtotime("-365 days"))
        ) {
            return false;
        }
    }

    return true;
}
