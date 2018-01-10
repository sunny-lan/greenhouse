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

        $pageObj = Util::guardA($param, 'page');

        $page = <<<HTML
        <div class="input-row">
            File name: 
            <input name="name" value="{$util::guard($pageObj, 'getName')}">
        </div>
        <div class="input-row">
            Content type: 
            <select name="contentType">
                <option value="">Select one</option>
                <option value="text/plain">Text file</option>
                <option value="application/pdf">PDF file</option>
                <option value="text/html">HTML file</option>
                <option value="image/png">PNG file</option>
                <option value="image/jpg">JPG file</option>
            </select>
        </div>
        <div class="input-row">
            Select file to upload: 
            <input name="content" type="file">
        </div>
HTML;
        return $page;
    }
}