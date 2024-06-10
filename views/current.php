<div class="row current-info d-block p-3">
    <div class="location">Weather in <?= $weather->location->name; ?>, <?= $weather->location->region; ?>, <?= $weather->location->country; ?></div>
    <div class="temperature">Temperature now: <?= $weather->current->temp_c; ?></div>
    <div class="local-time">Local Time: <?= $weather->location->localtime; ?></div>
    <div class="last-updated">Last Info updated at: <?= $weather->current->last_updated; ?></div>
</div>
<?= $content; ?>
<div class="row detailed-current-info d-block p-3">
    <div><img src="https:<?= $weather->current->condition->icon ?>" alt="<?= $weather->current->condition->text ?>"><?= $weather->current->condition->text ?>, <?= $weather->current->temp_c; ?> (Feels like: <?= $weather->current->feelslike_c; ?>)</div>
    <div>Wind, k/h: <?= $weather->current->wind_kph; ?></div>
    <div>Pressure, mb: <?= $weather->current->pressure_mb; ?></div>
    <div>Humidity, %: <?= $weather->current->humidity; ?></div>
    <div>Cloud, %: <?= $weather->current->cloud; ?></div>
</div>
