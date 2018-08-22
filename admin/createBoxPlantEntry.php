<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 3:27 PM
 */
require_once '../include.php';
(function () {
    $box = new Box($_GET['boxID']);

    $fields = BoxPlantEntryFormFields::render(['box' => $box]);

    $page = <<<HTML
    <input type="hidden" name="boxID" value="{$box->getID()}">
    {$fields}
    <input type="submit" value="Add">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdateBoxPlantEntry.php',
        'content' => $page
    ]);

	$page = <<<HTML
	<h1 id="title">Add entry</h1>
    {$page}
HTML;

    echo PageWrapper::render([
        "title" => "Add entry",
        "content" => $page
    ]);
})();