<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-12-15
 * Time: 1:32 PM
 */

require_once "../include.php";
(function (){
    $formFields = HarvestFormFields::render();

    $page=<<<HTML
    {$formFields}
    <input type="submit" value="Create">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdateHarvest.php',
        'content' => $page
    ]);

    echo PageWrapper::render([
        "title" => "Create harvest",
        "content" => $page
    ]);
})();
