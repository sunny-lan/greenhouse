<?php
require_once 'include.php';

(function ()
{
    $user = new User($_GET['id']);

    $fields = UserFormFields::render(['user' => $user]);

    $page = <<<HTML
<form method="post" action="handlers/createUpdateUser.php">
    {$fields}
    <input type="submit" value="Save">
</form>
HTML;


    echo PageWrapper::render([
        "title" => "Edit user",
        "content" => $page
    ]);
})();