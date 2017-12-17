<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 3:19 PM
 */
require_once '../include.php';

(function () {
    $page = new Page($_GET['id']);
    $fields = PageFormFields::render(['page' => $page]);
    
    $page = <<<HTML
    {$fields}
    <input type="hidden" name="id" value="{$page->getID()}">
    <input value="Update" type="submit">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdatePage.php',
        'content' => $page,
        'extendAttr' => 'enctype="multipart/form-data"'
    ]);

    echo PageWrapper::render([
        "title" => "Edit Page",
        "content" => $page
    ]);
})();