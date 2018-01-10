<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-17
 * Time: 4:10 PM
 */
class User extends DBObject
{
    function __construct(int $id)
    {
        parent::__construct('users', $id);
    }


    //username

    function getUsername()
    {
        return $this->selectF('username');
    }

    function setUsername(string $username)
    {
        $this->updateF('username', $username);
    }

    //password

    function getPasswordHash()
    {
        return $this->selectF('password');
    }

    function checkPassword(string $password)
    {
        return password_verify($password, $this->getPasswordHash());
    }

    function setPassword(string $password)
    {
        $this->updateF('password', password_hash($password, Constants::PASS_HASH));
    }


    //type

    function getType()
    {
        return (int)$this->selectF('type');
    }

    function setType(string $type)
    {
//        $myType = $GLOBALS['userLvl'];
//        if ($myType != Constants::LVL_ADMIN)
//            throw new Exception('Not enough perms', Constants::ERR_PERMS);

        $this->updateF('type', $type);
    }


    //telephone

    function getTelephone()
    {
        return $this->selectF('telephone');
    }

    function setTelephone(string $telephone)
    {
        $this->updateF('telephone', $telephone);
    }


    //school year

    function getSchoolYear()
    {
        return $this->selectF('school_year');
    }

    function setSchoolYear(string $schoolYear)
    {
        $this->updateF('school_year', $schoolYear);
    }


    //name

    function getName()
    {
        return $this->selectF('name');
    }

    function setName(string $name)
    {
        $this->updateF('name', $name);
    }


    //shifts

    function createShift(array $param)
    {
        $activity = $param['activity'];
        $duration = $param['duration'];
        $timeCompleted = $param['timeCompleted'];

        $mgr = new ShiftMgr();

        if ($this->getType() === Constants::LVL_SUPERVISOR) {
            $shf = $mgr->createShift($param['student'], $activity, $duration, $timeCompleted);
            $shf->setSupervisor($this);
            return $shf;
        } else if ($this->getType() === Constants::LVL_STUDENT) {
            return $mgr->createShift($this, $activity, $duration, $timeCompleted);
        } else
            throw new Exception('Only supervisors and students can create shifts', Constants::ERR_PERMS);
    }

    function listShifts(User $otherUser=null)
    {
        $myID = $this->getID();
        $myType = $this->getType();
        if ($otherUser!==null)
        $otherId = $otherUser->getID();
        if ($myType === Constants::LVL_STUDENT){
            $condition = "student = '$myID'";
            if($otherUser !== null){
                $condition.= " and supervisor = '$otherId'";
            }
        }
        else if ($myType === Constants::LVL_SUPERVISOR){
            $condition = "(supervisor = '$myID' or supervisor IS NULL)";
            if($otherUser !== null){
                $condition .= " and student = '$otherId'";
            }
        }
        else
            throw new Exception('Only supervisors and students can list shifts', Constants::ERR_PERMS);
        $sqlRes = Util::queryW($this->db, "SELECT id FROM shifts WHERE $condition");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new Shift($row['id']);
        return $res;
    }


    //actions

    function delete()
    {
        if ($GLOBALS['user']->getID() === $this->id) {
			parent::delete();
			logout();
		  }
    }
}