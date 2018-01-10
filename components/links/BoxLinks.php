<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2018-01-10
 * Time: 3:23 PM
 */
class BoxLinks implements Component
{

	static function render($param = []): string
	{
		$subDir = SUB_DIR;
		$box = $param['box'];
		return <<<HTML
                <a href="javascript:setPage(['id', '{$box->getID()}'], '{$subDir}/admin/updateBox.php')">edit</a>
                <a href="javascript:setPage(['boxID', '{$box->getID()}'], '{$subDir}/admin/createBoxPlantEntry.php')">add plant entry</a>
                <a href="javascript:setPage(['id', '{$box->getID()}'], '{$subDir}/admin/deleteBoxConfirm.php')">delete</a>
HTML;
	}
}