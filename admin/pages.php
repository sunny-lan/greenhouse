<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-01
 * Time: 3:13 PM
 */
require_once '../include.php';
(function () {
	JSRequire::req('js/util.js');
	$util = new Util();
	$mgr = new PageMgr();
	$pages = $mgr->listPages();

	$listHTML = "";
	foreach ($pages as $page/* @var $page Page */)
		$listHTML .= <<<HTML
        <tr>
            <td>{$page->getID()}</td>
           	<td>{$page->getName()}</td>
            <td><a href="{$page->getLink()}">view</a></td>
            <td>
				<a href="javascript: setPage(['id', '{$page->getID()}'], 'updatePage.php');">edit</a>
				<a href="javascript: setPage(['id', '{$page->getID()}'], 'handlers/deletePage.php');">delete</a>
            </td>
        </tr>
HTML;

	$page = <<<HTML
    <h1 id="title">Files</h1>
    <div id="actions">
    	<button onclick="{$util::linkStr('/admin/createPage.php')}">Upload</button>
	</div>
	<div id="data-table">
		<table>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Link</th>
				<th>Actions</th>
			</tr>
			{$listHTML}
		</table>
	</div>	
HTML;

	echo PageWrapper::render([
		"title" => "Files",
		"content" => $page
	]);
})();