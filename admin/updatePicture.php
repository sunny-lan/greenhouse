<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-13
 * Time: 1:50 PM
 */
require_once '../include.php';

(function () {
	$pic = new Picture($_GET['id']);
	$fields = PictureFormFields::render(['picture' => $pic]);

	$page = <<<HTML
    <input name="id" value="{$_GET['id']}" type="hidden">
    {$fields}
    <input type="submit" value="Save">
HTML;

	$page = Form::render([
		'action' => 'handlers/addUpdatePicture.php',
		'content' => $page
	]);

	$page = <<<HTML
	<h1 id="title">Edit description for '{$pic->getFile()->getName()}'</h1>
    {$page}
HTML;

	echo PageWrapper::render([
		'title' => 'Edit picture',
		'content' => $page
	]);
})();