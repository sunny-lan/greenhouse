<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 3:31 PM
 */
require_once '../../include.php';

(function () {
	if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
		if (array_key_exists('id', $_POST)) {
			$picture = new Picture($_POST['id']);
		} else {
			$mgr = new PictureMgr();
			$picture = $mgr->addPicture(new Page($_POST['page']));
		}
		$picture->setDescription($_POST['description']);
	}
	Util::returnPrevPage();
})();