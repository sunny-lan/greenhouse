<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-29
 * Time: 1:41 PM
 */
require_once "../../include.php";
(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
        $user = new User($_GET['id']);
        $user->delete();
    }
    Util::returnPrevPage();
})();