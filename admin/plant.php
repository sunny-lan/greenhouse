<?php
require_once '../include.php';
(function () {
    $plant = new Plant($_GET['id']);

    $pictureSelect = PageSelector::render([
        'name' => 'picture_id',
        'value' => $plant->getPicture(),
		'filter'=>"'image/png', 'image/jpg', 'image/svg+xml'"
    ]);

    $page = <<<HTML
    <input type="hidden" name="id" value="{$plant->getID()}">
        <div class="input-row">
            Fix typo in name: <input name="name" value="{$plant->getPlantName()}">
        </div>
        <div class="input-row">
            Plant picture: {$pictureSelect}
        </div>
    <input type="submit" value="submit">
HTML;

    $page = Form::render([
        'action' => 'handlers/plant.php',
        'content' => $page
    ]);

	$page = <<<HTML
	<h1 id="title">Edit Plant</h1>
    {$page}
HTML;

    echo PageWrapper::render([
        'title' => $plant->getPlantName(),
        'content' => $page
    ]);
})();