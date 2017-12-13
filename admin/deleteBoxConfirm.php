<?php
require_once '../include.php';
(function() {
    $page = <<<HTML
    Are you sure you want to delete the box? This will delete all plant entries for that box too.
    <a href="javascript:setPage([], 'handlers/deleteBox.php')">delete</a>
HTML;

    echo PageWrapper::render([
        'title' => 'Warning',
        'content' => $page
    ]);
})();