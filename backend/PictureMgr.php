<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-20
 * Time: 2:26 PM
 */
class PictureMgr extends DBMgr
{
	function __construct()
	{
		parent::__construct('pictures');
	}

	function addPicture(Page $page)
	{
		$pageID = $page->getID();
		Util::queryW($this->db, "INSERT INTO pictures (description, id) VALUES ('', '$pageID')");
		return new Picture($pageID);
	}

	function listPictures()
	{
		$sqlRes = Util::queryW($this->db, "SELECT id FROM pictures");
		$res = [];
		while ($row = $sqlRes->fetch_assoc())
			$res[] = new Picture($row['id']);
		return $res;
	}
}