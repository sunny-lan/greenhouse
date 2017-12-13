<?php

class PageWrapper implements Component
{
    static function render($param = []): string
    {
        JSRequire::req('js/util.js');

        if (array_key_exists('title', $param))
            $title = $param['title'];
        else $title = "Greenhouse Project";

        $requireHTML = JSRequire::html();

        $navbar = Navbar::render();

        $SUB_DIR = SUB_DIR;

        return <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>{$title}</title>
            <link rel="stylesheet" href="{$SUB_DIR}/css/main.css">
            {$requireHTML}
        </head>
        <body>
        {$navbar}
        <div id="content">
        {$param['content']}
        </div>
        </body>
        </html>
HTML;
    }
}