<!-- Daily content -->
<!-- location row -->
<div class="row justify-content-center mt-2 mb-3">
    <h4 class="col text-center">
        Weather in <?= $weather->location->name; ?>, <?= $weather->location->region; ?>, <?= $weather->location->country; ?>
    </h4>
</div>
<!-- /.row -->
<!-- date and avg temp row -->
<div class="row d-flex justify-content-center mt-2 mb-5">
    <h5 class="col text-center"><?= $dateTime; ?>, Max <i class="fas fa-temperature-high"></i> this day: <?= $avgParamsForDay->maxtemp_c; ?>, Min <i class="fas fa-temperature-low"></i> this day: <?= $avgParamsForDay->mintemp_c; ?></h5>
</div>
<!-- /.row -->
<!-- per hour row -->
<div class="row">
    <table class="table table-hover table-striped border border-primary rounded ml-lg-4 mr-lg-4">
        <!-- table headers -->
        <thead class="thead-light">
            <tr>
                <th scope="col" class="text-center">Time</th>
                <th scope="col" class="text-center">Temp, C</th>
                <th scope="col" class="text-center d-none d-sm-table-cell">Pressure, mb</th>
                <th scope="col" class="text-center d-none d-sm-table-cell">Wind direction</th>
                <th scope="col" class="text-center">Wind, kph</th>
                <th scope="col" class="text-center d-none d-sm-table-cell">Humidity, %</th>
                <th scope="col" class="text-center d-none d-sm-table-cell">Cloud, %</th>
                <th scope="col" class="text-center">Rain, %</th>
                <th scope="col" class="text-center">Snow, %</th>
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
                    <th class="text-center d-none d-sm-table-cell"><?= $forecast_item->pressure_mb; ?></th>
                    <th class="text-center d-none d-sm-table-cell"><?= $forecast_item->wind_dir; ?></th>
                    <th class="text-center"><i class="fas fa-wind"> </i> <?= $forecast_item->wind_kph; ?></th>
                    <th class="text-center d-none d-sm-table-cell"><?= $forecast_item->humidity; ?></th>
                    <th class="text-center d-none d-sm-table-cell"><i class="fas fa-cloud"></i> <?= $forecast_item->cloud; ?></th>
                    <th class="text-center"><i class="fas fa-cloud-rain"></i> <?= $forecast_item->chance_of_rain ?></th>
                    <th class="text-center"><i class="fas fa-snowflake"></i> <?= $forecast_item->chance_of_snow ?></th>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <!-- /.tbody -->
    </table>
    <!-- /.table -->
</div>
