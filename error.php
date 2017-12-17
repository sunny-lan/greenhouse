<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-12-13
 * Time: 3:06 PM
 */

include_once 'include.php';
(function () {
    $page = <<<HTML
    <h1>Permission error</h1>
HTML;

    echo PageWrapper::render([
        'title' => 'Error',
        'content' => $page
    ]);
})();