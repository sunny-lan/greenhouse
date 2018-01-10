<?php
require_once 'include.php';

(function () {
    $user = new User($_GET['id']);

    $fields = UserFormFields::render(['user' => $user]);

    $page = <<<HTML
    {$fields}
    <input type="submit" value="Save">
HTML;

    $page = Form::render([
        'action' => 'handlers/createUpdateUser.php',
        'content' => $page
    ]);

	$page = <<<HTML
	<h1 id="title">Edit profile</h1>
	{$page}
HTML;

	echo PageWrapper::render([
        "title" => "Edit user",
        "content" => $page
    ]);
})();