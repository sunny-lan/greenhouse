<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-20
 * Time: 2:26 PM
 */
class BoxMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('boxes');
    }

    function createBox(string $description)
    {
        Util::queryW($this->db, "INSERT INTO boxes (description) VALUES ('$description')");
        return new Box(Util::getLastID($this->db));
    }

    function listBoxes()
    {
        $sqlRes = Util::queryW($this->db, "SELECT id FROM boxes");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new Box($row['id']);
        return $res;
    }
}