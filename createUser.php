<?php
require_once 'include.php';
(function() {
    $fields = UserFormFields::render();

    $page = <<<HTML
<form method="post" action="handlers/createUpdateUser.php">
    {$fields}
    <input type="submit" value="Create">
</form>
HTML;


    echo PageWrapper::render([
        "title" => "Create user",
        "content" => $page
    ]);
})();