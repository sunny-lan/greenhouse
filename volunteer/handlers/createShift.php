<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-29
 * Time: 12:57 PM
 */
require_once '../../include.php';

(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_STUDENT) {
        $user = $GLOBALS['user'];
        $param = [
            'activity' => $_POST['activity'],
            'duration' => (int)$_POST['hours'] * 60 + (int)$_POST['minutes'],
            'timeCompleted' => DateTime::createFromFormat('Y-m-d', $_POST['date'])
        ];

        $shift = $user->createShift($param);
        /* @var $shift Shift */
        if ($_POST['other'] != "")
        $shift->setSupervisor(new User($_POST['other']));
    }
    if ($GLOBALS['userLvl'] == Constants::LVL_SUPERVISOR){
        $user = $GLOBALS['user'];
        $param = [
            'student'=> new User($_POST['other']),
            'activity' => $_POST['activity'],
            'duration' => (int)$_POST['hours'] * 60 + (int)$_POST['minutes'],
            'timeCompleted' => DateTime::createFromFormat('Y-m-d', $_POST['date'])
        ];

        $shift = $user->createShift($param);
    }
    Util::returnPrevPage();
})();