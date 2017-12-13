<?php require_once '../include.php';
(function() {
    $page = <<<HTML
<form method="post" action="handlers/createPlant.php">
    Name: <input name="name">
    <input type="submit" value="submit">
</form>
HTML;

    echo PageWrapper::render([
        'title' => 'Create Plant',
        'content' => $page
    ]);
})();