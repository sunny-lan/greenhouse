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
            $box->setName($_POST['name']);
        } else {
            $mgr = new BoxMgr();
            $box = $mgr->createBox($_POST['description'], $_POST['name']);
        }
        $box->setRect($_POST);
    }
    Util::returnPrevPage();
})();