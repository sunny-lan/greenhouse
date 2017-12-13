<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 3:13 PM
 */
require_once '../include.php';
(function () {
    JSRequire::req('js/util.js');
    $util = new Util();
    $mgr = new PageMgr();
    $pages = $mgr->listPages();

    $listHTML = "";
    foreach ($pages as $page/* @var $page Page */)
        $listHTML .= <<<HTML
        <li>
            {$page->getID()} - {$page->getName()} - 
            <a href="javascript: setPage(['id', '{$page->getID()}'], '../page.php');">view</a> - 
            <a href="javascript: setPage(['id', '{$page->getID()}'], 'updatePage.php');">edit</a>
        </li>
HTML;

    $page = <<<HTML
<ul>{$listHTML}</ul>
<a href="{$util::linkStr('/admin/createPage.php')}">create</a>
HTML;

    echo PageWrapper::render([
        "title" => "Pages",
        "content" => $page
    ]);
})();