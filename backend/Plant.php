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


    //picture

    function getPicture()
    {
        $res = $this->selectF('picture_id');
        if ($res === null) return $res;
        return new Page($res);
    }

    function setPicture($p/* @var $p Page */)
    {
        if ($p === null)
            $this->updateF('picture_id', null);
        else
            $this->updateF('picture_id', $p->getID());
    }
}