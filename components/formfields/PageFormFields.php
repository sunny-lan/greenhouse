<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-29
 * Time: 2:24 PM
 */
class PageFormFields implements Component
{

    static function render($param = []): string
    {
        $util = new Util();
        $consts=new Constants();

        $pageObj = null;
        if (array_key_exists('page', $param))
            $pageObj = $param['page'];


        $page = <<<HTML
        Page name: 
        <input name="name" value="{$util::guard($pageObj, 'getName')}">
        Content type: 
        <select name="contentType">
            <option value="text/plain">Text file</option>
            <option value="application/pdf">PDF file</option>
            <option value="text/html">HTML file</option>
        </select>
        Select file to upload: 
        <input name="content" type="file">
HTML;
        return $page;
    }
}