<?php
require_once 'include.php';
(function() {

    $page = <<<HTML
<form method="post" action="handlers/login.php">
    username/student id: <input name="username" title="Username"/>
    password: <input name="password" title="Password" type="password"/>
    <input type="submit" value="login">
</form>
HTML;


    echo PageWrapper::render([
        "title" => "Login",
        "content" => $page
    ]);
})();