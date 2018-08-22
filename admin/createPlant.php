<?php require_once '../include.php';
(function () {
	$pictureSelect = PageSelector::render([
		'name' => 'picture_id',
		'filter'=>"'image/png', 'image/jpg'"
	]);

	$page = <<<HTML
    <div class="input-row">Name: <input name="name"></div>
    <div class="input-row">Plant picture: {$pictureSelect}</div>
    <input type="submit" value="submit">
HTML;

	$page = Form::render([
		'action' => 'handlers/createPlant.php',
		'content' => $page
	]);

	$page = <<<HTML
	<h1 id="title">Create Plant</h1>
    {$page}
HTML;


	echo PageWrapper::render([
		'title' => 'Create Plant',
		'content' => $page
	]);
})();