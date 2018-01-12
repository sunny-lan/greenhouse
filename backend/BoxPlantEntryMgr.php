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

    function createBoxPlantEntry(Box $box, Plant $plant, DateTime $startDate)
    {
        $boxID = $box->getID();
        $plantID = $plant->getID();
        $startDate = Util::datePHP2SQL($startDate);

        Util::queryW($this->db, "INSERT INTO box_plants (box_id, plant_id, start_date) VALUES ('$boxID', '$plantID', '$startDate')");
        return new BoxPlantEntry(Util::getLastID($this->db));
    }

    function listBoxPlantEntries()
    {
        $sqlRes = Util::queryW($this->db, "SELECT id FROM box_plants");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new BoxPlantEntry($row['id']);
        return $res;
    }


    //util functions

    function getEarliestDate()
    {
        return Util::dateSQL2PHP(Util::queryW($this->db,
            "SELECT min(start_date) AS earliest FROM box_plants"
        )->fetch_assoc()['earliest']);
    }

    function getLatestDate()
    {
        $d1 = Util::dateSQL2PHP(Util::queryW($this->db,
            "SELECT max(end_date) AS latest FROM box_plants"
        )->fetch_assoc()['latest']);
        $d2 = Util::dateSQL2PHP(Util::queryW($this->db,
            "SELECT max(start_date) AS latest FROM box_plants"
        )->fetch_assoc()['latest']);
        return max($d1,$d2);
    }

	static function getComp()
	{
		return (function (BoxPlantEntry $a, BoxPlantEntry $b) {
			if ($a->getStartDate() == $b->getStartDate()) {
				if ($a->getPlant()->getID() == $b->getPlant()->getID()) {
					return 0;
				} else if ($a->getPlant()->getID() > $b->getPlant()->getID()) {
					return 1;
				} else {
					return -1;
				}
			} else if ($a->getStartDate() < $b->getStartDate()) {
				return 1;
			} else {
				return -1;
			}
		});
	}
}