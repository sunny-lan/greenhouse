<?php
echo "t1";
require_once 'include.php';
echo "t2";
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