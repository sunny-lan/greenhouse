<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-22
 * Time: 3:52 PM
 */
require_once '../../include.php';
(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
        $mgr = new PlantMgr();
        $mgr->createPlant($_POST['name']);
    }
    Util::returnPrevPage();
})();