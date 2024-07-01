<!-- Default content -->
<!-- location row -->
<div class="row justify-content-center mt-2 mb-3">
    <h4 class="col text-center">
        Weather in <?= $weather->location->name; ?>, <?= $weather->location->region; ?>, <?= $weather->location->country; ?>
    </h4>
</div>
<!-- /.row -->
<!-- container -->
<div class="container">
    <!-- forecast Info row -->
    <div class="row justify-content-center m-3">
        <?php foreach ($weather->forecast->forecastday as $forecast_item) : ?>
            <!-- link for a full day -->
            <a href="index.php?city=<?= $city; ?>&forecast_days=<?= $forecast_days_param; ?>&date=<?= $forecast_item->date; ?>" class="col-12 col-md-2 border border-primary rounded mb-2 d-flex flex-column align-items-center text-decoration-none text-dark">
                <div class="row justify-content-center align-items-center"><?= $forecast_item->day_of_week ?></div>
                <!-- day of week -->
                <div class="row justify-content-center align-items-center"><?= $forecast_item->day_of_month ?></div>
                <!-- day of month -->
                <div class="row justify-content-center align-items-center"><?= $forecast_item->month ?></div>
                <!-- month -->
                <div class="row justify-content-center align-items-center"><img src="https:<?= $forecast_item->day->condition->icon ?>" alt="<?= $forecast_item->day->condition->text ?>"></div>
                <!-- weather icon -->
                <div class="row justify-content-center align-items-center">Max: <?= $forecast_item->day->maxtemp_c; ?></div>
                <!-- max temperature -->
                <div class="row justify-content-center align-items-center">Min: <?= $forecast_item->day->mintemp_c; ?></div>
                <!-- min temperature -->
                <div class="row justify-content-center align-items-center"><?= $forecast_item->day->condition->text ?></div>
                <!-- weather description -->
            </a>
            <!-- /.col -->
        <?php endforeach; ?>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<!-- row of current info -->
<div class="row m-lg-3 justify-content-center">
    <!-- Column for current weather -->
    <div class="col-sm-5 mb-3">
        <!-- Header row for current weather -->
        <div class="row justify-content-center header mb-0 mt-3">
            <h4>Current weather</h4>
        </div>
        <!-- Weather details row for current weather -->
        <div class="row justify-content-center align-items-center">
            <div class="col text-center">
                <img src="https:<?= $weather->current->condition->icon ?>" alt="<?= $weather->current->condition->text ?>" style="width: 70px; height: 70px;">
                <?= $weather->current->condition->text ?>, <?= $weather->current->temp_c; ?>C <br><small>(Feels like: <?= $weather->current->feelslike_c; ?>C)</small>
            </div>
        </div>
        <!-- Weather params row for current weather -->
        <div class="row">
            <div class="col">
                <div class="row justify-content-start align-items-center pt-2">
                    <i class="fas fa-wind mr-1"></i> Wind, k/h: <?= $weather->current->wind_kph; ?>
                </div>
                <div class="row justify-content-start align-items-center pt-2">
                    <i class="fas fa-compass mr-1"></i> Wind direction: <?= $weather->current->wind_dir; ?>
                </div>
                <div class="row justify-content-start align-items-center pt-2">
                    <i class="fas fa-stopwatch mr-1"></i> Pressure, mb: <?= $weather->current->pressure_mb; ?>
                </div>
                <div class="row justify-content-start align-items-center pt-2">
                    <i class="fas fa-tint mr-1"></i> Humidity, %: <?= $weather->current->humidity; ?>
                </div>
            </div>
            <div class="col">
                <div class="row justify-content-end align-items-center pt-2">
                    <i class="fas fa-cloud mr-1"></i> Cloud, %: <?= $weather->current->cloud; ?>
                </div>
                <div class="row justify-content-end align-items-center pt-2">
                    <i class="fas fa-cloud-rain mr-1"></i> Chance of rain, %: <?= $chanceOfRain; ?>
                </div>
                <div class="row justify-content-end align-items-center pt-2">
                    <i class="fas fa-sun mr-1"></i> Sunrise: <?= $astro->sunrise; ?>
                </div>
                <div class="row justify-content-end align-items-center pt-2">
                    <i class="fas fa-moon mr-1"></i> Sunset: <?= $astro->sunset; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Column for next 5 hour weather -->
    <div class="col-sm-6 mb-3 ml-lg-5">
        <!-- Header row for next 5 hour weather -->
        <div class="row justify-content-center header m-3">
            <h4 class="text-center">The next 5 hour weather</h4>
        </div>
        <!-- Forecasts for next 5 hours -->
        <div class="row">
            <?php foreach ($perHour as $forecast_item) : ?>
                <div class="col border mb-3">
                    <div class="row justify-content-center align-items-center"><?= $forecast_item->time ?></div>
                    <div class="row justify-content-center align-items-center">
                        <img src="https:<?= $forecast_item->condition->icon ?>" alt="<?= $forecast_item->condition->text ?>">
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <i class="fas fa-thermometer-three-quarters mr-1"></i><?= $forecast_item->temp_c ?>C
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <small><?= $forecast_item->feelslike_c ?>C</small>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <?= $forecast_item->pressure_mb; ?>, mb
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <i class="fas fa-wind mr-1"></i><?= $forecast_item->wind_kph; ?>, kph
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <i class="fas fa-cloud-rain mr-1"></i><?= $forecast_item->chance_of_rain ?>%
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- /.col -->
<!-- last updated row -->
<div class="row justify-content-center align-items-center mt-3"><small> Info updated at: <?= $weather->current->last_updated; ?></small></div>
<!-- /.row -->
