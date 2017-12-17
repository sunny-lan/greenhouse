<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-30
 * Time: 1:25 PM
 */
class Harvest extends DBObject
{
    function __construct(int $id)
    {
        parent::__construct('harvest', $id);
    }


    //box

    function getBox()
    {
        $boxID = $this->selectF('box_id');
        return new Box($boxID);
    }

    function setBox(Box $box)
    {
        $this->updateF('box_id', $box->getID());
    }

    //amount

    function getAmount()
    {
        return $this->selectF('amount');
    }

    function setAmount(int $amount)
    {
        $this->updateF('amount', $amount);
    }

    //date

    function getDateHarvested()
    {
        return Util::dateSQL2PHP($this->selectF('date_harvested'));
    }

    function setDateHarvested(DateTime $dateHarvested)
    {
        $this->updateF('date_harvested', Util::datePHP2SQL($dateHarvested));
    }

    //description
    function getDescription()
    {
        return $this->selectF('description');
    }

    function setDescription($description)
    {
        $this->updateF('description', $description);
    }
}