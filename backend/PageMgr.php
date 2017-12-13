<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 2:41 PM
 */
class PageMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('pages');
    }

    function createPage($name, $content, $contentType)
    {
        $stmt = $this->db->prepare('INSERT INTO pages (name, content_type, content) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $name, $contentType, $content);
        $stmt->execute();
        $stmt->close();
        return new Page(Util::getLastID($this->db));
    }

    function findPageByName($name)
    {
        return new Page(Util::queryW($this->db,
            "SELECT id FROM pages WHERE name='$name'")->fetch_assoc()['id']);
    }

    function listPages()
    {
        $sqlRes = Util::queryW($this->db, "SELECT id FROM pages");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new Page($row['id']);
        return $res;
    }
}