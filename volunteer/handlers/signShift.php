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
        if($shift->getStatus() == Constants::STATUS_UNSIGNED) {
            $shift->setStatus(Constants::STATUS_SIGNED);
        }
        else{
            $shift->setStatus(Constants::STATUS_UNSIGNED);
        }
    }
    Util::returnPrevPage();
})();