<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-22
 * Time: 3:35 PM
 */
require_once '../../include.php';
(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
        $plant = new Plant($_POST['id']);
        $plant->setPlantName($_POST['name']);
    }
    Util::returnPrevPage();
})();