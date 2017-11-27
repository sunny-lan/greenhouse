<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 2:04 PM
 */
class Navbar implements Component
{
    //TODO remove this custiness
    static function e($url)
    {
        return Util::linkStr($url);
    }

    static function render($param = []): string
    {
        $k = new Navbar();

        JSRequire::req('js/util.js');
        $SUB_DIR = SUB_DIR;

        if (isLoggedIn()) {
            $user = $GLOBALS['user'];
            /* @var $user User */
            $specificOptions = "";
            if ($user->getType() === Constants::LVL_ADMIN) {
                $specificOptions = <<<HTML
                <a href="{$k->e("/admin/config.php")}">config</a>
                <a href="{$k->e("/admin/plants.php")}">plants</a>
HTML;
            }
            $displayName = $user->getName();
            if ($displayName === null)
                $displayName = "User id " . $user->getID();
            $loggedInOptions = <<<HTML
             - welcome, {$displayName}
            {$specificOptions}
            <a href="{$k->e("/handlers/logout.php")}">logout</a>
HTML;
        } else {
            $lnk = $k->e("/login.php");
            $loggedInOptions = '<a href="'.$lnk.'">login</a>';
        }


        return <<<HTML
        <div id="navbar">
            <a href="{$k->e("/map.php")}">interactive map</a>
            {$loggedInOptions}
        </div>
HTML;
    }
}