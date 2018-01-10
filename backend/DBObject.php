<?php

class DBObject extends DBMgr
{
    protected $id = -1;

    function __construct(string $tableName, int $id)
    {
        parent::__construct($tableName);
        $this->id = $id;
    }

    function getID()
    {
        return $this->id;
    }

    function selectF(string $fieldName)
    {
        if ($this->id === -1)
            throw new Exception("Cannot select field on null object", Constants::ERR_NULL);
        return Util::selectF($this->db, $this->tableName, $this->id, $fieldName);
    }

    function updateF(string $fieldName, $value)
    {
        if ($this->id === -1)
            throw new Exception("Cannot select field on null object", Constants::ERR_NULL);
        Util::updateF($this->db, $this->tableName, $this->id, $fieldName, $value);
    }


	//delete

	function delete()
	{
		$id = $this->id;
		$table=$this->tableName;
		Util::queryW($this->db, "DELETE FROM $table WHERE id='$id'");
		$this->id = -1;
	}
}