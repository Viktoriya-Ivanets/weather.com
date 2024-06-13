<!-- Default content -->
<!-- location row -->
<div class="row d-flex justify-content-center mt-2 mb-5">
    <h4>Weather in <?= $weather->location->name; ?>, <?= $weather->location->region; ?>, <?= $weather->location->country; ?></h4>
</div>
<!-- /.row -->
<!-- container -->
<div class="container">
    <!-- forecast Info row -->
    <div class="row justify-content-center">
        <?php foreach ($weather->forecast->forecastday as $forecast_item) : ?>
            <!-- link for a full day -->
            <a href="index.php?date=<?= $forecast_item->date; ?><?= $forecast_days_param; ?>" class="col-12 col-md-2 border border-primary rounded mb-2 d-flex flex-column align-items-center text-decoration-none text-dark">
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
                <div class="row justify-content-center align-items-center d-none d-sm-flex"><?= $forecast_item->day->condition->text ?></div>
                <!-- weather description -->
            </a>
            <!-- /.col -->
        <?php endforeach; ?>
    </div>

    <!-- /.row -->
</div>
<!-- /.container -->
<!-- row of current info -->
<div class="row m-3 justify-content-center">
    <!-- col of current info -->
    <div class="col-5 d-block mr-5">
        <!-- header row-->
        <div class="row d-flex justify-content-center mt-3">
            <h4>Current weather</h4>
        </div>
        <!-- /.row -->
        <!-- weather icon and description row -->
        <div class="row justify-content-center align-items-center"><img src="https:<?= $weather->current->condition->icon ?>" alt="<?= $weather->current->condition->text ?>" style="width: 80px; height: 80px;">
            <?= $weather->current->condition->text ?>, <?= $weather->current->temp_c; ?>C
            (Feels like: <?= $weather->current->feelslike_c; ?> C)</div>
        <!-- row -->
        <!-- weather params row -->
        <div class="row d-flex justify-content-between">
            <!-- weather params col -->
            <div class="col">
                <div class="row justify-content-start align-items-center pt-2"> <i class="fas fa-wind mr-1"></i> Wind, k/h: <?= $weather->current->wind_kph; ?></div>
                <div class="row justify-content-start align-items-center pt-2"><i class="fas fa-compass mr-1"></i>Wind direction: <?= $weather->current->wind_dir; ?></div>
                <div class="row justify-content-start align-items-center pt-2"><i class="fas fa-stopwatch mr-1"></i>Pressure, mb: <?= $weather->current->pressure_mb; ?></div>
                <div class="row justify-content-start align-items-center pt-2"><i class="fas fa-tint mr-1"></i>Humidity, %: <?= $weather->current->humidity; ?></div>
            </div>
            <!-- /.col -->
            <!-- weather params col -->
            <div class="col">
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-cloud mr-1"></i>Cloud, %: <?= $weather->current->cloud; ?></div>
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-cloud-rain mr-1"></i>Chance of rain, %: <?= $chanceOfRain; ?></div>
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-sun mr-1"></i>Sunrise: <?= $astro->sunrise; ?></div>
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-moon mr-1"></i>Sunset: <?= $astro->sunset; ?></div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col -->
    <!-- next hours info col -->
    <div class="col-6">
        <!-- header row -->
        <div class="row d-flex justify-content-center mt-3 mb-3">
            <h4>The next 5 hour weather</h4>
        </div>
        <!-- /.row -->
        <!-- next hours info row -->
        <div class="row">
            <?php foreach ($perHour as $forecast_item) : ?>
                <!-- next hours info columns -->
                <div class="col border">
                    <div class="row justify-content-center align-items-center"><?= $forecast_item->time ?></div>
                    <!-- hour row -->
                    <div class="row justify-content-center align-items-center"><img src="https:<?= $forecast_item->condition->icon ?>" alt="<?= $forecast_item->condition->text ?>"></div>
                    <!-- icon row -->
                    <div class="row justify-content-center align-items-center"><i class="fas fa-thermometer-three-quarters mr-1"></i><?= $forecast_item->temp_c ?>C</div>
                    <!-- temperature row -->
                    <div class="row justify-content-center align-items-center"><small><?= $forecast_item->feelslike_c ?>C</small></div>
                    <!-- feelslike temperature row -->
                    <div class="row justify-content-center align-items-center"><?= $forecast_item->pressure_mb; ?>, mb</div>
                    <!-- pressure row -->
                    <div class="row justify-content-center align-items-center"><i class="fas fa-wind mr-1"></i><?= $forecast_item->wind_kph; ?>, kph</div>
                    <!-- wind row -->
                    <div class="row justify-content-center align-items-center"><i class="fas fa-cloud-rain mr-1"></i><?= $forecast_item->chance_of_rain ?>%</div>
                    <!-- rain row -->
                </div>
                <!-- /.col -->
            <?php endforeach; ?>
        </div>
        <!-- /.cor -->
    </div>
    <!-- /.col -->
    <!-- last updated row -->
    <div class="row justify-content-center align-items-center mt-3"><small> Info updated at: <?= $weather->current->last_updated; ?></small></div>
    <!-- /.row -->
</div>
<!-- /.row -->
