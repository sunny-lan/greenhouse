<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-21
 * Time: 1:55 PM
 */
class ShiftMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('shifts');
    }

    function createShift(User $student, string $activity, int $duration, DateTime $dateCompleted)
    {
        $studentID = $student->getID();
        $status = Constants::STATUS_UNSIGNED;
        $dateCompleted = $dateCompleted->format('Y-m-d');
        Util::queryW($this->db,
            "INSERT INTO shifts (student, activity, duration, date_completed, status) VALUES ('$studentID', '$activity', '$duration', '$dateCompleted', '$status')");
        return new Shift(Util::getLastID($this->db));
    }

    function listShifts()
    {
        $sqlRes = Util::queryW($this->db, "SELECT id FROM shifts");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new Shift($row['id']);
        return $res;
    }
}