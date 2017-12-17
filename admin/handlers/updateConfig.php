<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-22
 * Time: 1:55 PM
 */

require_once '../../include.php';
(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
        $mgr = new ConfigMgr();
        foreach ($_POST as $name => $value) {
            $name = str_replace('_', ' ', $name);
            $mgr->setValue($name, $value);
        }
    }
    Util::returnPrevPage();
})();