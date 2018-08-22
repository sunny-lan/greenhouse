<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-13
 * Time: 1:50 PM
 */
require_once '../include.php';

(function () {
    $fields = PictureFormFields::render();

    $page = <<<HTML
    {$fields}
    <input type="submit" value="Add">
HTML;

    $page = Form::render([
        'action' => 'handlers/addUpdatePicture.php',
        'content' => $page
    ]);

	$page = <<<HTML
	<h1 id="title">Add picture to gallery</h1>
    {$page}
HTML;

    echo PageWrapper::render([
        'title' => 'Add picture',
        'content' => $page
    ]);
})();