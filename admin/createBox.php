<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-13
 * Time: 1:50 PM
 */
require_once '../include.php';

(function () {
    $fields = BoxFormFields::render();

    $page = <<<HTML
    {$fields}
    <input type="submit" value="Create">
HTML;

    $page = Form::render([
        'action' => "handlers/createUpdateBox.php",
        'content' => $page
    ]);

    echo PageWrapper::render([
        'title' => 'Create box',
        'content' => $page
    ]);
})();