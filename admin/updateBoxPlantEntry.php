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
    <form method="post" action="handlers/createUpdateBoxPlantEntry.php">
        <input type="hidden" name='id' value="{$entry->getID()}">
        {$fields}
        <input type="submit" value="Save">
    </form>
HTML;


    echo PageWrapper::render([
        "title" => "Edit entry",
        "content" => $page
    ]);
})();