<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-29
 * Time: 1:41 PM
 */
include "../../include.php";
(function() {
    $user = new User($_GET['id']);
    $user->delete();
    Util::returnPrevPage();
})();