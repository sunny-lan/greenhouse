<?php
require_once 'include.php';
(function () {

    $page = <<<HTML
    username/student id: <input name="username" title="Username"/>
    password: <input name="password" title="Password" type="password"/>
    <input type="submit" value="login">
HTML;

    $page = Form::render([
        'action' => 'handlers/login.php',
        'content' => $page
    ]);

    echo PageWrapper::render([
        "title" => "Login",
        "content" => $page
    ]);
})();