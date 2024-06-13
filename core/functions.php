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
