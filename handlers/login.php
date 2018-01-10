<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-21
 * Time: 3:04 PM
 */
require_once '../include.php';
(function () {
    $mgr = new UserMgr();
    try {
        $_SESSION['uid'] = $mgr->login($_POST['username'], $_POST['password'])->getID();
    } catch (Exception $e) {
        $_GET['error'] = 1;
        Util::redirect(SUB_DIR . '/login.php');
    }
    Util::returnPrevPage();
})();