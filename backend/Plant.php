<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-20
 * Time: 1:57 PM
 */
class Plant extends DBObject
{
    function __construct(int $id)
    {
        parent::__construct('plants', $id);
    }


    //name

    function getPlantName()
    {
        return $this->selectF('name');
    }

    function setPlantName(string $name)
    {
        $this->updateF('name', $name);
    }


    //delete

    function delete()
    {
        $id = $this->id;
        Util::queryW($this->db, "DELETE FROM plants WHERE id='$id'");
        $this->id = -1;
    }
}