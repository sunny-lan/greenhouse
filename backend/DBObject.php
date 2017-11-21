<?php

class DBObject extends DBMgr
{
    protected $id;

    function __construct(string $tableName,int $id)
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
        return Util::selectF($this->db, $this->tableName, $this->id, $fieldName);
    }

    function updateF(string $fieldName, $value)
    {
        Util::updateF($this->db, $this->tableName, $this->id, $fieldName, $value);
    }
}