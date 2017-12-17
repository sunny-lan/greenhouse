<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-29
 * Time: 2:24 PM
 */
class UserFormFields implements Component
{

    static function render($param = []): string
    {
        $util = new Util();

        $user = null;
        if (array_key_exists('user', $param))
            $user = $param['user'];
        /* @var $user User */

        $extraHTML = "";

        if ($user !== null) {
            $uid = $user->getID();
            $extraHTML .= "<input type='hidden' name='id' value='$uid'>";
        }

        if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN) {
            $usernameLbl = "Username";
            $tmp = ["", "", "", "", ""];
            $tmp[$util::guard($user, "getType")] = "selected='selected'";
            $extraHTML .= <<<HTML
            Type <select name="type">
                <option value="4" {$tmp[4]}>Admin</option>
                <option value="3" {$tmp[3]}>Supervisor</option>
                <option value="1" {$tmp[1]}>Student</option>
            </select>
HTML;
        } else
            $usernameLbl = "Student ID";

        $page = <<<HTML
        {$usernameLbl}: <input name="username" value="{$util::guard($user, "getUsername")}">
        Password: <input name="password" type="password">
        {$extraHTML}
        Telephone: <input name="telephone" value="{$util::guard($user, "getTelephone")}">
        School year: <input name="schoolYear" value="{$util::guard($user, "getSchoolYear")}">
        Name: <input name="name" value="{$util::guard($user, "getName")}">
HTML;
        return $page;
    }
}