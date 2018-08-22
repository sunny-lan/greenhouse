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

        $currDateStr=(new DateTime())->format('Y-m-d');

        if (isLoggedIn()) {
            $user = $GLOBALS['user'];
            /* @var $user User */
            $specificOptions = "";
            if ($user->getType() === Constants::LVL_ADMIN) {
                //these options are shown only if current user is admin
                $specificOptions .= <<<HTML
                <a href="{$util::linkStr("/admin/plants.php", true)}">plants</a>
                <a href="{$util::linkStr("/admin/map.php", true)}">garden</a>
                <a href="{$util::linkStr("/admin/pictures.php", true)}">gallery</a>
                <a href="{$util::linkStr("/admin/config.php", true)}">config</a>
                <a href="{$util::linkStr("/admin/users.php", true)}">users</a>
                <a href="{$util::linkStr("/admin/pages.php", true)}">files</a>
HTML;
            }
            if ($user->getType() === Constants::LVL_SUPERVISOR) {
                $specificOptions .= <<<HTML
                <a href="{$util::linkStr("/volunteer/shifts.php", true)}">shifts</a>
HTML;
            }
            if ($user->getType() === Constants::LVL_STUDENT) {
                $specificOptions .= <<<HTML
                <a href="{$util::linkStr("/volunteer/shifts.php", true)}">shifts</a>
HTML;
            }
            $displayName = $user->getName();
            if ($displayName === null)
                $displayName = "User id " . $user->getID();
            //these options are shown only when logged in
            $loggedInOptions = <<<HTML
            welcome, {$displayName}
            {$specificOptions}
            <a href="javascript: setPage(['id', '{$user->getID()}'], '{$SUB_DIR}/updateUser.php');">profile</a>
            <a href="{$util::linkStr("/handlers/logout.php", true)}">logout</a>
HTML;
        } else {
            //these options are shown only when logged out
            $loggedInOptions = <<<HTML
            <a href="{$util::linkStr("/login.php")}">login</a>
            <a href="{$util::linkStr("/createUser.php")}">create account</a>
HTML;
        }

        //these options are always shown
        return <<<HTML
        <div id="navbar">
            <span id="nav-items-always">
                <a href="{$util::linkStr("/", true)}">about</a>
                <a href="javascript: setPage([['startDate','{$currDateStr}'],['endDate','{$currDateStr}']], '{$SUB_DIR}/garden.php', true)">garden</a>
                <a href="{$util::linkStr("/gallery.php", true)}">gallery</a>
            </span>
            <span id="nav-title">
            the greenhouse project
            </span>
            <span id="nav-items-logged-in">{$loggedInOptions}</span>
        </div>
HTML;
    }
}