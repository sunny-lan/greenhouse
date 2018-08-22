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
                <option value="text/plain">Text</option>
                <option value="application/pdf">PDF</option>
                <option value="text/html">HTML</option>
                <option value="image/png">PNG</option>
                <option value="image/jpg">JPG</option>
                <option value="image/svg+xml">SVG</option>
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