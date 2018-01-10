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

    function createPage($name, $contentFile, $contentType)
    {
        $stmt = $this->db->prepare('INSERT INTO pages (name, content_type, content) VALUES (?, ?, ?)');
        $null = null;
        $stmt->bind_param('ssb', $name, $contentType, $null);
        if ($contentFile !== null) {
            $fp = fopen($contentFile, "r");
            while (!feof($fp)) {
                $stmt->send_long_data(2, fread($fp, 16776192));
            }
            fclose($fp);
        }
        $stmt->execute();
        $stmt->close();
        return new Page(Util::getLastID($this->db));
    }

    function findPageByName($name)
    {
        $res = Util::guardA(Util::queryW($this->db,
            "SELECT id FROM pages WHERE name='$name'")->fetch_assoc(), 'id');
        if ($res === null) return $res;
        return new Page($res);
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