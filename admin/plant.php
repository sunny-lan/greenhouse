<?php
require_once '../include.php';
(function () {
    $plant = new Plant($_GET['id']);

    $page = <<<HTML
    <input type="hidden" name="id" value="{$plant->getID()}">
    Fix typo in name: <input name="name" value="{$plant->getPlantName()}">
    <input type="submit" value="submit">
HTML;

    $page = Form::render([
        'action' => 'handlers/plant.php',
        'content' => $page
    ]);

    echo PageWrapper::render([
        'title' => $plant->getPlantName(),
        'content' => $page
    ]);
})();