<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2018-01-10
 * Time: 5:23 PM
 */
class Picture extends DBObject
{
	function __construct($id)
	{
		parent::__construct('pictures', $id);
	}


	//description

	function getDescription()
	{
		return $this->selectF('description');
	}

	function setDescription(string $description)
	{
		$this->updateF('description', $description);
	}


	//picture

	function getFile()
	{
		return new Page($this->selectF('id'));
	}
}