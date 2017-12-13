<?php
require_once '../include.php';
(function() {
    $plant = new Plant($_GET['id']);

    $page = <<<HTML
<form method="post" action="handlers/plant.php">
    <input type="hidden" name="id" value="{$plant->getID()}">
    Fix typo in name: <input name="name" value="{$plant->getPlantName()}">
    <input type="submit" value="submit">
</form>
HTML;

    echo PageWrapper::render([
        'title' => $plant->getPlantName(),
        'content' => $page
    ]);
})();