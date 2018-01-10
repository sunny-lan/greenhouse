<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 3:21 PM
 */
require_once '../../include.php';

(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
        $contentFile = null;
        if (is_uploaded_file($_FILES['content']['tmp_name'])) {
            $contentFile = $_FILES['content']['tmp_name'];
        }
        if (array_key_exists('id', $_POST)) {
            $page = new Page($_POST['id']);
            $page->setName($_POST['name']);
            $type = $_POST['contentType'];
            if (!empty($type))
                $page->setContentType($type);
            if ($contentFile !== null)
                $page->setContent($contentFile);
        } else {
            $mgr = new PageMgr();
            $mgr->createPage($_POST['name'], $contentFile, $_POST['contentType']);
        }
    }
    Util::returnPrevPage();
})();