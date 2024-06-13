<!-- Daily content -->
<!-- location row -->
<div class="row d-flex justify-content-center mt-2 mb-1">
    <h4>Weather in <?= $weather->location->name; ?>, <?= $weather->location->region; ?>, <?= $weather->location->country; ?></h4>
</div>
<!-- /.row -->
<!-- date and avg temp row -->
<div class="row d-flex justify-content-center mt-2 mb-5">
    <h5><?= $dateTime; ?>, Max <i class="fas fa-temperature-high"></i> this day: <?= $avgParamsForDay->maxtemp_c; ?>, Min <i class="fas fa-temperature-low"></i> this day: <?= $avgParamsForDay->mintemp_c; ?></h5>
</div>
<!-- /.row -->
<!-- per hour row -->
<div class="row">
    <table class="table table-hover table-striped border border-primary rounded ml-4 mr-4">
        <!-- table headers -->
        <thead class="thead-light">
            <tr>
                <th scope="col" class="text-center">Time</th>
                <th scope="col" class="text-center">Temperature, C</th>
                <th scope="col" class="text-center">Pressure, mb</th>
                <th scope="col" class="text-center">Wind direction</th>
                <th scope="col" class="text-center">Wind, kph</th>
                <th scope="col" class="text-center">Humidity, %</th>
                <th scope="col" class="text-center">Cloud, %</th>
                <th scope="col" class="text-center">Rain, %</th>
            </tr>
        </thead>
        <!-- /.thead -->
        <!-- table content -->
        <tbody>
            <?php foreach ($perHour as $forecast_item) : ?>
                <tr>
                    <!-- next hours info rows -->
                    <th class="text-center"><?= $forecast_item->time ?></th>
                    <th class="text-center"><img src="https:<?= $forecast_item->condition->icon ?>" alt="<?= $forecast_item->condition->text ?>" style="width: 34px; height: 34px;">
                        <?= $forecast_item->temp_c ?> <?= $forecast_item->condition->text ?></th>
                    <th class="text-center"><?= $forecast_item->pressure_mb; ?></th>
                    <th class="text-center"><?= $forecast_item->wind_dir; ?></th>
                    <th class="text-center"><?= $forecast_item->wind_kph; ?></th>
                    <th class="text-center"><?= $forecast_item->humidity; ?></th>
                    <th class="text-center"><?= $forecast_item->cloud; ?></th>
                    <th class="text-center"><?= $forecast_item->chance_of_rain ?></th>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <!-- /.tbody -->
    </table>
    <!-- /.table -->
</div>
<!-- last updated row -->
<div class="row justify-content-center align-items-center"><small> Info updated at: <?= $weather->current->last_updated; ?></small></div>
<!-- /.row -->
