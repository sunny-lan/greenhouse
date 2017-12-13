<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-22
 * Time: 1:55 PM
 */

require_once '../../include.php';
(function ()
{
    $mgr = new ConfigMgr();

    foreach ($_POST as $name => $value) {
        $mgr->setValue($name, $value);
    }
    Util::returnPrevPage();
})();