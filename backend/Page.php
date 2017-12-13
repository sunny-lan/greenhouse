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

    function setContent($content)
    {
        $stmt = $this->db->prepare('UPDATE pages SET content=? WHERE id=?');
        $stmt->bind_param('si', $content, $this->id);
        $stmt->execute();
        $stmt->close();
    }
}