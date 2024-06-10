<?php
function template(string $path, array $vars = []): string
{
    $systemTemplateFullPath = "views/$path.php";
    extract($vars);
    ob_start();
    include($systemTemplateFullPath);
    return ob_get_clean();
}
