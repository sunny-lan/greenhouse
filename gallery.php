<?php
require_once 'include.php';

(function () {
	JSRequire::req('https://code.jquery.com/jquery-3.2.1.min.js');
	JSRequire::req('js/overlay.js');
	JSRequire::req('js/gallery.js');

	$mgr = new PictureMgr();

	$page = '';
	foreach ($mgr->listPictures() as $picture/* @var $picture Picture */) {
		$page .= <<<HTML
		<div class="picture-tile" id="picture-{$picture->getID()}">
			<div class="loading">
				<span>Loading...</span>
			</div>
			<div
				class="picture" 
				style="background: url('{$picture->getFile()->getLink()}') no-repeat center; background-size: cover;">
			</div>
			<div class="description-block">
				<span>{$picture->getDescription()}</span>
			</div>
			<img class="popup-content" src="{$picture->getFile()->getLink()}">
		</div>
HTML;
	}

	$page = <<<HTML
	<h1 id="title">Gallery</h1>
	<div id="pictures">
		{$page}
	</div>
	<div class="overlay">
		<div class="overlay-background"></div>
		<div class="overlay-content"></div>
	</div>
HTML;

	echo PageWrapper::render([
		"title" => "Home",
		"content" => $page
	]);
})();