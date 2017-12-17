<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-29
 * Time: 2:33 PM
 */

(function () {
    require_once '../../include.php';
    if ($GLOBALS['userLvl'] == Constants::LVL_SUPERVISOR) {
        $shift = new shift($_GET['id']);
        $shift->setStatus(Constants::STATUS_SIGNED);
    }
    Util::returnPrevPage();
})();