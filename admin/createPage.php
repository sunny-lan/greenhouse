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

	$page = <<<HTML
	<h1 id="title">Upload file</h1>
	{$page}
HTML;

    echo PageWrapper::render([
        "title" => "Create Page",
        "content" => $page
    ]);
})();