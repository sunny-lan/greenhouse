<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 3:27 PM
 */
require_once '../include.php';
(function () {
    $entry = new BoxPlantEntry($_GET['id']);
    $fields = BoxPlantEntryFormFields::render(['entry' => $entry]);

    $page = <<<HTML
    <input type="hidden" name='id' value="{$entry->getID()}">
    {$fields}
    <input type="submit" value="Save">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdateBoxPlantEntry.php',
        'content' => $page
    ]);

	$page = <<<HTML
	<h1 id="title">Edit entry</h1>
    {$page}
HTML;

    echo PageWrapper::render([
        "title" => "Edit entry",
        "content" => $page
    ]);
})();