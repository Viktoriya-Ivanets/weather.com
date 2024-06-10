<div class="row forecast-info d-flex m-3">
    <?php foreach ($forecast_items->forecast->forecastday as $forecast_item) : ?>
        <div class="col border border-primary rounded">
            <div class="row justify-content-center align-items-center"><?= $forecast_item->day_of_week ?></div>
            <div class="row justify-content-center align-items-center"><?= $forecast_item->day_of_month ?></div>
            <div class="row justify-content-center align-items-center"><?= $forecast_item->month ?></div>
            <div class="row justify-content-center align-items-center"><img src="https:<?= $forecast_item->day->condition->icon ?>" alt="<?= $forecast_item->day->condition->text ?>"></div>
            <div class="row justify-content-center align-items-center">Max: <?= $forecast_item->day->maxtemp_c; ?></div>
            <div class="row justify-content-center align-items-center">Min: <?= $forecast_item->day->mintemp_c; ?></div>
            <div class="row justify-content-center align-items-center d-none d-sm-flex"><?= $forecast_item->day->condition->text ?></div>
        </div>
    <?php endforeach; ?>
</div>
