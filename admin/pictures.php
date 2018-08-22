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
	$mgr = new PictureMgr();
	$pictures = $mgr->listPictures();

	$listHTML = "";
	foreach ($pictures as $picture/* @var $picture Picture */)
		$listHTML .= <<<HTML
        <tr>
            <td>{$picture->getFile()->getName()}</td>
           	<td>{$picture->getDescription()}</td>
            <td><a href="{$picture->getFile()->getLink()}">view</a></td>
            <td>
				<a href="javascript: setPage(['id', '{$picture->getID()}'], 'updatePicture.php');">edit</a>
				<a href="javascript: setPage(['id', '{$picture->getID()}'], 'handlers/removePicture.php');">remove</a>
            </td>
        </tr>
HTML;

	$page = <<<HTML
    <h1 id="title">Gallery</h1>
    <div id="actions">
    	<button onclick="{$util::linkStr('/admin/addPicture.php')}">Add</button>
	</div>
	<div id="data-table">
		<table>
			<tr>
				<th>File</th>
				<th>Description</th>
				<th>Link</th>
				<th>Actions</th>
			</tr>
			{$listHTML}
		</table>
	</div>	
HTML;

	echo PageWrapper::render([
		"title" => "Gallery",
		"content" => $page
	]);
})();