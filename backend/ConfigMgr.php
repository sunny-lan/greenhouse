<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-22
 * Time: 12:49 PM
 */
class ConfigMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('config');
    }


    //value

    function getValue($name)
    {
        return Util::queryW($this->db, "SELECT value FROM config WHERE name='$name'")->fetch_assoc()['value'];
    }

    function setValue($name, $value)
    {
        Util::queryW($this->db, "UPDATE config SET value='$value' WHERE name='$name'");
    }


    //name

    function listNames()
    {
        return Util::toArray(Util::queryW($this->db, 'SELECT name FROM config'), 'name');
    }
}