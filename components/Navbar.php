<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 2:04 PM
 */
class Navbar implements Component
{
    static function render($param = []): string
    {
        $util = new Util();

        JSRequire::req('js/util.js');

        $SUB_DIR = SUB_DIR;

        if (isLoggedIn()) {
            $user = $GLOBALS['user'];
            /* @var $user User */
            $specificOptions = "";
            if ($user->getType() === Constants::LVL_ADMIN) {
                //these options are shown only if current user is admin
                $specificOptions .= <<<HTML
                <a href="{$util::linkStr("/admin/config.php")}">config</a>
                <a href="{$util::linkStr("/admin/plants.php")}">plants</a>
                <a href="{$util::linkStr("/admin/boxes.php")}">boxes</a>
                <a href="{$util::linkStr("/admin/users.php")}">users</a>
                <a href="{$util::linkStr("/admin/pages.php")}">pages</a>
HTML;
            }
            if ($user->getType() === Constants::LVL_SUPERVISOR) {
                $specificOptions .= <<<HTML
                <a href="{$util::linkStr("/volunteer/shifts.php")}">shifts</a>
HTML;
            }
            if ($user->getType() === Constants::LVL_STUDENT) {
                $specificOptions .= <<<HTML
                <a href="{$util::linkStr("/volunteer/shifts.php")}">shifts</a>
HTML;
            }
            $displayName = $user->getName();
            if ($displayName === null)
                $displayName = "User id " . $user->getID();
            //these options are shown only when logged in
            $loggedInOptions = <<<HTML
             - welcome, {$displayName}
            {$specificOptions}
            <a href="javascript: setPage(['id', '{$user->getID()}'], '{$SUB_DIR}/updateUser.php');">profile</a>
            <a href="{$util::linkStr("/handlers/logout.php")}">logout</a>
HTML;
        } else {
            //these options are shown only when logged out
            $loggedInOptions = <<<HTML
            <a href="{$util::linkStr("/login.php")}">login</a>
            <a href="{$util::linkStr("/createUser.php")}">create user</a>
HTML;
        }

        //these options are always shown
        return <<<HTML
        <div id="navbar">
            <a href="{$util::linkStr("/garden/map.php")}">garden</a>
            {$loggedInOptions}
        </div>
HTML;
    }
}