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
    <input name="id" value="{$_GET['id']}" type="hidden">
    {$fields}
    <input type="submit" value="Save">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdateBox.php',
        'content' => $page
    ]);

	$page = <<<HTML
	<h1 id="title">Edit box</h1>
    {$page}
HTML;

    echo PageWrapper::render([
        'title' => 'Edit box',
        'content' => $page
    ]);
})();