<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-20
 * Time: 2:26 PM
 */
class PlantMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('plants');
    }

    function createPlant(string $name)
    {
        Util::queryW($this->db, "INSERT INTO plants (name) VALUES ('$name')");
        return new Plant(Util::getLastID($this->db));
    }

    function listPlants(){
        $sqlRes = Util::queryW($this->db, "SELECT id FROM plants");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new Plant($row['id']);
        return $res;
    }
}