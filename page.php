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

    header('Content-Type: ' . $page->getContentType());
    $page = $page->getContent();

    echo $page;
})();