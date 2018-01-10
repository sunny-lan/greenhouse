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
        $plant = $mgr->createPlant($_POST['name']);
        if (!empty($_POST['picture_id']))
            $plant->setPicture(new Page($_POST['picture_id']));
    }
    Util::returnPrevPage();
})();