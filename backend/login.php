<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-21
 * Time: 2:25 PM
 */

session_start();

$GLOBALS['db'] = Util::db_connect();

if (array_key_exists('uid', $_SESSION))
{
    $GLOBALS['user'] = new User($_SESSION['uid']);
}