<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-20
 * Time: 2:55 PM
 */
class BoxPlantEntry extends DBObject
{
    function __construct(int $id)
    {
        parent::__construct('box_plants', $id);
    }


    //box

    function getBox()
    {
        return new Box($this->selectF('box_id'));
    }

    function setBox(Box $box)
    {
        $this->updateF('box_id', $box->getID());
    }


    //plant

    function getPlant()
    {
        return new Plant($this->selectF('plant_id'));
    }

    function setPlant(Plant $plant)
    {
        $this->updateF('plant_id', $plant->getID());
    }


    //start date

    function getStartDate()
    {
        return Util::dateSQL2PHP($this->selectF('start_date'));
    }

    function setStartDate(DateTime $startDate)
    {
        $this->updateF('start_date', Util::datePHP2SQL($startDate));
    }


    //end date

    function getEndDate()
    {
        return Util::dateSQL2PHP($this->selectF('end_date'));
    }

    function setEndDate($endDate)
    {
        if ($endDate === null)
            $this->updateF('end_date', null);
        else
            $this->updateF('end_date', Util::datePHP2SQL($endDate));
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