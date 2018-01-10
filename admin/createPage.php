<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 3:19 PM
 */
require_once '../include.php';

(function () {
    $fields = PageFormFields::render();
    $page = <<<HTML
    {$fields}
    <input value="Upload" type="submit">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdatePage.php',
        'content' => $page,
        'extendAttr' => 'enctype="multipart/form-data"'
    ]);

    echo PageWrapper::render([
        "title" => "Create Page",
        "content" => $page
    ]);
})();