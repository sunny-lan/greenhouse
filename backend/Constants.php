<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-05-08
 * Time: 6:26 PM
 */
class Constants
{
    const SUCCESS = 1;
    const ERR_DB = 2;
    const ERR_LOGIN = 3;
    const ERR_PERMS = 4;
    const ERR_NULL = 5;
    const ERR_REQ = 6;

    const PASS_HASH = PASSWORD_DEFAULT;

    const LVL_ADMIN = 4;
    const LVL_SUPERVISOR = 3;
    const LVL_STUDENT = 1;
    const LVL_NONE = 0;

    const STATUS_UNSIGNED = "unsigned";
    const STATUS_SIGNED = "signed";
}