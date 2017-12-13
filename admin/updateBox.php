<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-13
 * Time: 1:50 PM
 */
require_once '../include.php';

(function () {
    $fields = BoxFormFields::render(['box' => new Box($_GET['id'])]);

    $page = <<<HTML
    <form method="post" action="handlers/createUpdateBox.php">
        {$fields}
        <input type="submit" value="Save">
    </form>
HTML;
    echo PageWrapper::render([
        'title' => 'Edit box',
        'content' => $page
    ]);
})();