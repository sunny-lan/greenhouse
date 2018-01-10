<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2018-01-10
 * Time: 3:31 PM
 */
class BoxPlantEntryLinks implements Component
{

	static function render($param = []): string
	{
		$subDir = SUB_DIR;
		$entry = $param['entry'];
		return <<<HTML
                    - <a href="javascript:setPage(['id', '{$entry->getID()}'], '{$subDir}/admin/updateBoxPlantEntry.php',0,1)">edit</a>
                    <a href="javascript:setPage(['id', '{$entry->getID()}'], '{$subDir}/admin/handlers/deleteBoxPlantEntry.php',0,1)">delete</a>
HTML;
	}
}