<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-21
 * Time: 3:04 PM
 */
require_once '../include.php';

$mgr = new UserMgr();
$_SESSION['uid'] = $mgr->login($_POST['username'], $_POST['password'])->getID();