<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-15
 * Time: 1:58 PM
 */
require_once "../../include.php";
(function () {
    $box = new Box($_POST['boxID']);
    $dateHarvested=DateTime::createFromFormat('Y-m-d', $_POST['date']);
    if (array_key_exists('id', $_POST)) {
        $harvest = new Harvest($_POST['id']);
        $harvest->setAmount($_POST['amount']);
        $harvest->setBox($box);
        $harvest->setDateHarvested($dateHarvested);
    } else {
        $mgr = new HarvestMgr();
        $harvest = $mgr->createHarvest($box, $_POST['amount'], $dateHarvested);
    }
    $harvest->setDescription($_POST['description']);
    Util::returnPrevPage();
})();