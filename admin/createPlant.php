<?php require_once '../include.php';
(function() {
    $page = <<<HTML
    Name: <input name="name">
    <input type="submit" value="submit">
HTML;

    $page = Form::render([
        'action' => 'handlers/createPlant.php',
        'content' => $page
    ]);

    echo PageWrapper::render([
        'title' => 'Create Plant',
        'content' => $page
    ]);
})();