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

    function listPlantEntries(DateTime $startDate = null, DateTime $endDate = null)
    {
        $query = "SELECT id FROM box_plants";
        if ($startDate !== null) {
            if ($endDate === null) $endDate = $startDate;
            $startDate = Util::datePHP2SQL($startDate);
            $endDate = Util::datePHP2SQL($endDate);
            $query .= " WHERE start_date <= '$endDate' AND COALESCE(end_date, 9999-12-31) >= '$startDate'";
        }
        $sqlRes = Util::queryW($this->db, $query);

        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new BoxPlantEntry($row['id']);
        return $res;
    }
}