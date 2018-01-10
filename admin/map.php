<?php
require_once '../include.php';
(function () {
	$param = [];
	if (array_key_exists('startDate', $_GET) and $_GET['startDate'] !== '')
		$param['startDate'] = DateTime::createFromFormat('Y-m-d', $_GET['startDate']);

	if (array_key_exists('endDate', $_GET) and $_GET['endDate'] !== '')
		$param['endDate'] = DateTime::createFromFormat('Y-m-d', $_GET['endDate']);

	$map = Map::render($param);
	$harvest = HarvestDisplay::render($param);

	$mgr = new BoxPlantEntryMgr();
	$param['earliestDate'] = $mgr->getEarliestDate();
	$param['latestDate'] = $mgr->getLatestDate();

	$filter = TimeFilter::render($param);


	$page = <<<HTML
	<h1 id="title">Garden - Admin</h1>
    <div id="map-page">
		<div id="sidebar">
			{$filter}
			<h2>Harvests</h2>
			{$harvest}
        </div>
        {$map}
    </div>
HTML;


	echo PageWrapper::render([
		'title' => 'Edit garden',
		'content' => $page
	]);
})();