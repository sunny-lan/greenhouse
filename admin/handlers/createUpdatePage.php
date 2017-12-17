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
        $content = null;
        if (is_uploaded_file($_FILES['content']['tmp_name'])) {
            $file = fopen($_FILES['content']['tmp_name'], 'r');
            $content = fread($file, $_FILES['content']['size']);
            fclose($file);
        }
        if (array_key_exists('id', $_POST)) {
            $page = new Page($_POST['id']);
            $page->setName($_POST['name']);
            $page->setContentType($_POST['contentType']);
            if ($content != null)
                $page->setContent($content);
        } else {
            $mgr = new PageMgr();
            $mgr->createPage($_POST['name'], $content, $_POST['contentType']);
        }
    }
    Util::returnPrevPage();
})();