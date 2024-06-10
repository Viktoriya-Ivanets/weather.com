<div class="row forecast-info d-flex">
    <?php foreach ($forecast_items as $forecast_item) : ?>
        <div class="col">
            <div class="row justify-content-center"><img src="https:<?= $forecast_item->day->condition->icon ?>" alt="<?= $forecast_item->day->condition->text ?>"></div>
            <div class="row justify-content-center">Max: <?= $forecast_item->day->maxtemp_c; ?>/Min: <?= $forecast_item->day->mintemp_c; ?></div>
            <div class="row justify-content-center"><?= $forecast_item->day->condition->text ?></div>
        </div>
    <?php endforeach; ?>
</div>
