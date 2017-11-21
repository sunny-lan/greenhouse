<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-20
 * Time: 2:54 PM
 */
class BoxPlantEntryMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('box_plants');
    }

    function createBoxPlantEntry(Box $box, Plant $plant, $startDate)
    {
        $boxID = $box->getID();
        $plantID = $plant->getID();
        $startDate = Util::datePHP2SQL($startDate);

        Util::queryW($this->db, "INSERT INTO box_plants (box_id, plant_id, start_date) VALUES ('$boxID', '$plantID', '$startDate')");
        return new BoxPlantEntry(Util::getLastID($this->db));
    }

    function listBoxPlantEntries(){
        $sqlRes = Util::queryW($this->db, "SELECT id FROM box_plants");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new BoxPlantEntry($row['id']);
        return $res;
    }
}