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
    <form method="post" action="handlers/createUpdatePage.php" enctype="multipart/form-data">
        {$fields}
        <input value="Create" type="submit">
    </form>
HTML;
    echo PageWrapper::render([
        "title" => "Create Page",
        "content" => $page
    ]);
})();