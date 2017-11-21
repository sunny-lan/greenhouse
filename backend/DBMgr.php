<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-20
 * Time: 2:56 PM
 */
 class DBMgr
{
    /**
     * @var mysqli
     */
    protected $db;
    protected $tableName;

    function __construct(string $tableName)
    {
        $this->db = $GLOBALS['db'];
        $this->tableName = $tableName;
    }
}