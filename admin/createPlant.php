<?php require_once '../include.php';
(function() {
    $pictureSelect = PageSelector::render([
        'name' => 'picture_id'
    ]);

    $page = <<<HTML
    <div class="input-row">Name: <input name="name"></div>
    <div class="input-row">Plant picture: {$pictureSelect}</div>
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