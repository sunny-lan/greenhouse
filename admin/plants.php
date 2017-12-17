<?php
require_once '../include.php';
(function() {
    JSRequire::req('js/util.js');

    $mgr = new PlantMgr();
    $plants = $mgr->listPlants();

    $plantsList = "";
    foreach ($plants as $plant/* @var $plant Plant */) {
        $plantsList .= <<<HTML
    <li>
        {$plant->getPlantName()}
        <a href="javascript:setPage(['id', '{$plant->getID()}'], 'plant.php')">edit</a>
    </li>
HTML;
    }

    $page = <<<HTML
    <ul>
        {$plantsList}
    </ul>
    <a href="createPlant.php">create</a>
HTML;

    echo PageWrapper::render([
        'title' => 'Plants',
        'content' => $page
    ]);
})();