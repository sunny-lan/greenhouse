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

        $navbar=Navbar::render();

        return <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>{$title}</title>
            {$requireHTML}
        </head>
        <body>
        {$navbar}
        {$param['content']}
        </body>
        </html>
HTML;
    }
}