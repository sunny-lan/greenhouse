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

    echo PageWrapper::render([
        "title" => "Create user",
        "content" => $page
    ]);
})();