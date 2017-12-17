<?php
require_once 'include.php';
echo SITE_ROOT;
(function() {
    $page = <<<HTML
<h1>Hello this is the home page
ksjgfskjdsakjshfdsjf</h1>
HTML;


    echo PageWrapper::render([
        "title" => "Home",
        "content" => $page
    ]);
})();