<?php
require_once '../include.php';
(function() {
    JSRequire::req('js/util.js');

    $mgr = new PlantMgr();
    $plants = $mgr->listPlants();

    $plantsList = "";
    foreach ($plants as $plant/* @var $plant Plant */) {
        $plantsList .= <<<HTML
		<tr>
			<td>{$plant->getPlantName()}</td>
			<td><a href="javascript:setPage(['id', '{$plant->getID()}'], 'plant.php')">edit</a></td>
		</tr>
HTML;
    }

    $page = <<<HTML
    <h1 id="title">Plants</h1>
	<div id="actions"><button onclick="setPage([], 'createPlant.php')">Create</button></div>
    <div id="data-table">
		<table>
			<tr>
				<th>Name</th>
				<th>Actions</th>
			</tr>
			{$plantsList}
		</table>
	</div>
HTML;

    echo PageWrapper::render([
        'title' => 'Plants',
        'content' => $page
    ]);
})();