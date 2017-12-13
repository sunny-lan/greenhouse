<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-29
 * Time: 2:39 PM
 */
require_once "../include.php";
(function () {
    if (array_key_exists('type', $_POST) && $GLOBALS['userLvl'] === Constants::LVL_ADMIN)
        $type = $_POST['type'];
    else
        $type = Constants::LVL_STUDENT;

    if (array_key_exists('id', $_POST))
        $user = new User($_POST['id']);
    else {
        $mgr = new UserMgr();
        $user = $mgr->createUser($_POST['username'], $_POST['password'], $type);
    }

    if (array_key_exists('telephone', $_POST) && !empty($_POST['telephone']))
        $user->setTelephone($_POST['telephone']);

    if (array_key_exists('schoolYear', $_POST) && !empty($_POST['schoolYear']))
        $user->setSchoolYear($_POST['schoolYear']);

    if (array_key_exists('name', $_POST) && !empty($_POST['name']))
        $user->setName($_POST['name']);

    if (array_key_exists('password', $_POST) && !empty($_POST['password']))
        $user->setPassword($_POST['password']);

    Util::returnPrevPage();
})();