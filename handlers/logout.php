<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 2:23 PM
 */
include '../include.php';
logout();
header("Location: " . SUB_DIR . "/login.php");
die();