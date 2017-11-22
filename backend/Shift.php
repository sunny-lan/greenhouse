<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-17
 * Time: 4:31 PM
 */
class Shift extends DBObject
{
    function __construct(int $id)
    {
        parent::__construct('shifts', $id);
    }


    //student

    function getStudent()
    {
        $studentID = $this->selectF('student');
        return new User($studentID);
    }

    function setStudent(User $student)
    {
        $this->updateF('student', $student->getID());
    }


    //supervisor

    function getSupervisor()
    {
        $supervisorID = $this->selectF('supervisor');
        if ($supervisorID === null) return null;
        return new User($supervisorID);
    }

    function setSupervisor(User $supervisor)
    {
        $this->updateF('supervisor', $supervisor->getID());
    }


    //activity

    function getActivity()
    {
        return $this->selectF('activity');
    }

    function setActivity(string $activity)
    {
        $this->updateF('activity', $activity);
    }


    //duration (minutes)

    function getDuration()
    {
        return $this->selectF('duration');
    }

    function setDuration(int $duration)
    {
        $this->updateF('duration', $duration);
    }


    //time completed

    function getDateCompleted()
    {
        return Util::dateSQL2PHP($this->selectF('date_completed'));
    }

    function setDateCompleted(DateTime $dateCompleted)
    {
        $this->updateF('date_completed', $dateCompleted);
    }


    //status

    function getStatus()
    {
        return $this->selectF('status');
    }

    function setStatus(string $status)
    {
        $this->updateF('status', $status);
    }


    //actions

    function delete()
    {
        Util::queryW($this->db, "DELETE FROM shifts WHERE id='$this->id'");
        $this->id = -1;
    }
}