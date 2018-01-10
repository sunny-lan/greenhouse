<?php
require_once 'include.php';
(function () {

    $error = "";
    if (array_key_exists('error', $_GET))
        $error = 'Invalid login';

    $page = <<<HTML
    <div class="input-row">username/student id: <input name="username" title="Username"/></div>
    <div class="input-row">password: <input name="password" title="Password" type="password"/></div>
    <div class="input-row"><span class="error-msg">{$error}</span></div>
    <input type="submit" value="Login">
HTML;

    $page = Form::render([
        'action' => 'handlers/login.php',
        'content' => $page
    ]);

	$page = <<<HTML
	<h1 id="title">Login</h1>
	{$page}
HTML;

	echo PageWrapper::render([
        "title" => "Login",
        "content" => $page
    ]);
})();