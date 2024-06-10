<div class="row location d-flex justify-content-center p-3">
    <h4>Weather in <?= $weather->location->name; ?>, <?= $weather->location->region; ?>, <?= $weather->location->country; ?></h4>
</div>
<?= $content; ?>
<div class="row current-info m-3 justify-content-center">
    <div class="col-4 detailed-current-info d-block mr-5">
        <div class="row d-flex justify-content-center mt-3">
            <h4>Current weather</h4>
        </div>
        <div class="row justify-content-center align-items-center"><img src="https:<?= $weather->current->condition->icon ?>" alt="<?= $weather->current->condition->text ?>" style="width: 80px; height: 80px;">
            <?= $weather->current->condition->text ?>, <?= $weather->current->temp_c; ?>C (Feels like: <?= $weather->current->feelslike_c; ?> C)</div>
        <div class="row d-flex justify-content-between">
            <div class="col">
                <div class="row justify-content-start align-items-center pt-2"> <i class="fas fa-wind mr-1"></i> Wind, k/h: <?= $weather->current->wind_kph; ?></div>
                <div class="row justify-content-start align-items-center pt-2"><i class="fas fa-compass mr-1"></i>Wind direction: <?= $weather->current->wind_dir; ?></div>
                <div class="row justify-content-start align-items-center pt-2"><i class="fas fa-stopwatch mr-1"></i>Pressure, mb: <?= $weather->current->pressure_mb; ?></div>
                <div class="row justify-content-start align-items-center pt-2"><i class="fas fa-tint mr-1"></i>Humidity, %: <?= $weather->current->humidity; ?></div>
            </div>
            <div class="col">
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-cloud mr-1"></i>Cloud, %: <?= $weather->current->cloud; ?></div>
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-cloud-rain mr-1"></i>Precip, mm: <?= $weather->current->precip_mm; ?></div>
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-sun mr-1"></i>Sunrise: <?= $astro->sunrise; ?></div>
                <div class="row justify-content-end align-items-center pt-2"><i class="fas fa-moon mr-1"></i>Sunset: <?= $astro->sunset; ?></div>
            </div>
        </div>
    </div>
    <div class="col-7 next-hour-info">
        <div class="row d-flex justify-content-center mt-3 mb-3">
            <h4>Per hour weather</h4>
        </div>
        <div class="row">
            <?php for ($i = 0; $i < count($perHour); $i += 4) : ?>
                <?php $forecast_item = $perHour[$i]; ?>
                <div class="col border">
                    <div class="row justify-content-center align-items-center"><?= $forecast_item->time ?></div>
                    <div class="row justify-content-center align-items-center"><img src="https:<?= $forecast_item->condition->icon ?>" alt="<?= $forecast_item->condition->text ?>"></div>
                    <div class="row justify-content-center align-items-center"><i class="fas fa-thermometer-three-quarters mr-1"></i><?= $forecast_item->temp_c ?>C</div>
                    <div class="row justify-content-center align-items-center"><small><?= $forecast_item->feelslike_c ?>C</small></div>
                    <div class="row justify-content-center align-items-center"><?= $forecast_item->pressure_mb; ?>, mb</div>
                    <div class="row justify-content-center align-items-center"><i class="fas fa-wind mr-1"></i><?= $forecast_item->wind_kph; ?>, kph</div>
                    <div class="row justify-content-center align-items-center"><i class="fas fa-cloud-rain mr-1"></i><?= $forecast_item->chance_of_rain ?>%</div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-3"><small> Info updated at: <?= $weather->current->last_updated; ?></small></div>
</div>
