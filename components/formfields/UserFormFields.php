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

        $user = Util::guardA($param, 'user');
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
            <div class="input-row">
                Type: <select name="type">
                    <option value="4" {$tmp[4]}>Admin</option>
                    <option value="3" {$tmp[3]}>Supervisor</option>
                    <option value="1" {$tmp[1]}>Student</option>
                </select>
            </div>
HTML;
        } else if ($GLOBALS['userLvl'] === Constants::LVL_SUPERVISOR)
            $usernameLbl = "Username";
        else
            $usernameLbl = "Student ID";

        $page = <<<HTML
        <div class="input-row">{$usernameLbl}: <input name="username" value="{$util::guard($user, "getUsername")}"></div>
        <div class="input-row">Password: <input name="password" type="password"></div>
        {$extraHTML}
        <div class="input-row">Telephone: <input name="telephone" value="{$util::guard($user, "getTelephone")}"></div>
        <div class="input-row">School year: <input name="schoolYear" value="{$util::guard($user, "getSchoolYear")}"></div>
        <div class="input-row">Name: <input name="name" value="{$util::guard($user, "getName")}"></div>
HTML;
        return $page;
    }
}