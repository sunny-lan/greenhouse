<?php

require_once 'include.php';

(function () {
	$mgr = new PageMgr();
	$page = Util::guard($mgr->findPageByName('home_page'), 'getContent');

	if ($page === null)
		$page = <<<HTML
        <h1 style="text-align: center">Hello! This is the home page</h1>
        <div style="max-width: 640px">
        If you are seeing this message, that means you have not uploaded a custom home page.
        Upload a HTML file and name it "home_page".
        Once you have done that, the newly uploaded file will be displayed on this page.
        </div>
HTML;

	echo PageWrapper::render([
		"title" => "Home",
		"content" => $page
	]);
})();