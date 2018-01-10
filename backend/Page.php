<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 2:49 PM
 */
class Page extends DBObject
{
    function __construct($id)
    {
        parent::__construct('pages', $id);
    }


    //content type

    function getContentType(): string
    {
        return $this->selectF('content_type');
    }

    function setContentType(string $type)
    {
        $this->updateF('content_type', $type);
    }


    //name

    function getName(): string
    {
        return $this->selectF('name');
    }

    function setName(string $name)
    {
        $this->updateF('name', $name);
    }


    //content

    function getContent()
    {
        return $this->selectF('content');
    }

    function setContent($contentFile)
    {
        $stmt = $this->db->prepare('UPDATE pages SET content=? WHERE id=?');
        $null = null;
        $stmt->bind_param('bs', $null, $this->id);
        $fp = fopen($contentFile, "r");
        while (!feof($fp)) {
            $stmt->send_long_data(0, fread($fp, 16776192));
        }
        fclose($fp);
        $stmt->execute();
        echo mysqli_stmt_error ($stmt);
        $stmt->close();
    }

    function getLink()
    {
        return SUB_DIR . "/page.php?id=" . $this->getID();
    }
}