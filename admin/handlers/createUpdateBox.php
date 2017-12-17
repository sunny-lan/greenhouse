<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 3:31 PM
 */
require_once '../../include.php';

(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
        if (array_key_exists('id', $_POST)) {
            $box = new Box($_POST['id']);
            $box->setDescription($_POST['description']);
        } else {
            $mgr = new BoxMgr();
            $mgr->createBox($_POST['description']);
        }
    }
    Util::returnPrevPage();
})();