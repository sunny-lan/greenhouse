<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-20
 * Time: 2:16 PM
 */
class Box extends DBObject
{
    function __construct(int $id)
    {
        parent::__construct('boxes', $id);
    }


    //description

    function getBoxDescription()
    {
        return $this->selectF('description');
    }

    function setBoxDescription(string $description)
    {
        $this->updateF('description', $description);
    }


    //plants

    function addPlantEntry(array $param)
    {
        $plant = $param['plant'];
        $startDate = $param['startDate'];

        $mgr = new BoxPlantEntryMgr();
        return $mgr->createBoxPlantEntry($this, $plant, $startDate);
    }

    function listPlantEntries($date)
    {
        $query = "SELECT id FROM box_plants";
        if (isset($date)) {
            $date = Util::datePHP2SQL($date);
            $query .= " WHERE start_date<='$date' AND '$date'<=coalesce(end_date, DATE 9999-12-31)";
        }
        $sqlRes = Util::queryW($this->db, $query);

        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new BoxPlantEntry($row['id']);
        return $res;
    }
}