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
        return new Plant( $this->selectF('plant_id'));
    }

    function setPlant(Plant $plant)
    {
        $this->updateF('plant_id', $plant->getID());
    }

    //start date

    function getStartDate(){
        return Util::dateSQL2PHP($this->selectF('start_date'));
    }

    function setStartDate($startDate){
        $this->updateF('start_date', Util::datePHP2SQL($startDate));
    }

    //end date

    function getEndDate(){
        return Util::dateSQL2PHP($this->selectF('end_date'));
    }

    function setEndDate($endDate){
        $this->updateF('end_date', Util::datePHP2SQL($endDate));
    }
}