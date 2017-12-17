<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-12-15
 * Time: 1:32 PM
 */

require_once "../include.php";
(function () {
    $harvest=new Harvest($_GET['id']);

    $formFields = HarvestFormFields::render(['harvest' => $harvest]);

    $page=<<<HTML
    <input type="hidden" name="id" value="{$harvest->getID()}">
    {$formFields}
    <input type="submit" value="Save">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdateHarvest.php',
        'content' => $page
    ]);

    echo PageWrapper::render([
        "title" => "Edit harvest",
        "content" => $page
    ]);
})();
