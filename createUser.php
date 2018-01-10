<?php
require_once 'include.php';
(function() {
    $fields = UserFormFields::render();

    $page = <<<HTML
    {$fields}
    <input type="submit" value="Create">
HTML;

    $page=Form::render([
        'action'=>'handlers/createUpdateUser.php',
        'content'=>$page
    ]);

	$page = <<<HTML
	<h1 id="title">Create account</h1>
	{$page}
HTML;

	echo PageWrapper::render([
        "title" => "Create user",
        "content" => $page
    ]);
})();