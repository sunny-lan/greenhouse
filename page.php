<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 3:16 PM
 */
require_once 'include.php';
(function () {
    $mgr = new PageMgr();

    if (array_key_exists('name', $_GET))
        $id = $mgr->findPageByName($_GET['name']);
    else
        $id = $_GET['id'];

    $page = new Page($id);

    if (array_key_exists('raw', $_GET)) {
        header('Content-Type: ' . $page->getContentType());
        $page = $page->getContent();
    } else
        $page = PageWrapper::render([
            "title" => $page->getName(),
            "content" => $page->getContent()
        ]);

    echo $page;
})();