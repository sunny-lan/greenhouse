<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-30
 * Time: 1:26 PM
 */
class HarvestMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('plants');
    }

    function createHarvest(Box $box, int $amount, DateTime $date)
    {
        $boxID = $box->getID();
        $date = Util::datePHP2SQL($date);
        Util::queryW($this->db, "INSERT INTO harvest (box_id, amount, date_harvested) VALUES ('$boxID','$amount','$date')");
        return new Harvest(Util::getLastID($this->db));
    }

    function listHarvests(DateTime $startDate = null, DateTime $endDate = null)
    {
        $query = "SELECT id FROM harvest WHERE 1";

        if (isset($endDate)) {
            $endDate = Util::datePHP2SQL($endDate);
            $query .= " AND date_harvested <= '$endDate'";
        }

        if (isset($startDate)) {
            $startDate = Util::datePHP2SQL($startDate);
            $query .= " AND date_harvested >= '$startDate'";
        }

        $sqlRes = Util::queryW($this->db, $query);
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new Harvest($row['id']);
        return $res;
    }
}