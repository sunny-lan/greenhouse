<?php
require_once 'include.php';

$page = <<<HTML
<form method="post" action="handlers/login.php">
    username: <input name="username" title="Username"/>
    password: <input name="password" title="Password"/>
    <input type="submit" value="login">
</form>
HTML;


echo PageWrapper::render([
    "title" => "Login",
    "content" => $page
]);