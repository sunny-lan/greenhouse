<?php

class PageWrapper implements Component
{
	static function render($param = []): string
	{
		JSRequire::req('js/util.js');

		$title = Util::guardA($param, 'title', "Greenhouse Project");

		$requireHTML = JSRequire::html();

		$navbar = Navbar::render();

		$SUB_DIR = SUB_DIR;

		$mgr = new ConfigMgr();

		return <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>{$title}</title>
            <link href="https://fonts.googleapis.com/css?family=Raleway:400" rel="stylesheet">
            <link rel="stylesheet" href="{$SUB_DIR}/css/main.css">
            {$requireHTML}
        </head>
        <body>
        {$navbar}
        <div id="content">{$param['content']}</div>
        <div id="footer">
        <span>
			{$mgr->getValue('Organization name')} | 
			{$mgr->getValue('Address')} | 
			{$mgr->getValue('Phone')}
		</span>
        </body>
        </html>
HTML;
	}
}
