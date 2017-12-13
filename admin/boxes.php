<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 3:12 PM
 */
require_once '../include.php';
(function() {
    JSRequire::req('js/util.js');

    $mgr = new BoxMgr();
    $boxes = $mgr->listBoxes();

    $boxesHTML = "";
    foreach ($boxes as $box/* @var $box Box */) {
        $boxesHTML .= <<<HTML
    <li>
        <b>{$box->getBoxDescription()}</b>
        <a href="javascript:setPage(['boxID', '{$box->getID()}'], 'createBoxPlantEntry.php')">add plant entry</a>
    </li>
HTML;
    }

    $page = "<ul>$boxesHTML</ul>";


    echo PageWrapper::render([
        "title" => "Boxes",
        "content" => $page
    ]);
})();