<?php
require_once '../include.php';
(function () {
    $param = [];
    if (array_key_exists('startDate', $_GET) and $_GET['startDate'] !== '')
        $param['startDate'] = DateTime::createFromFormat('Y-m-d', $_GET['startDate']);

    if (array_key_exists('endDate', $_GET) and $_GET['endDate'] !== '')
        $param['endDate'] = DateTime::createFromFormat('Y-m-d', $_GET['endDate']);

    $map = Map::render($param);
    $harvest = Harvests::render($param);

    $mgr = new BoxPlantEntryMgr();
    $param['earliestDate'] = $mgr->getEarliestDate();
    $param['latestDate'] = $mgr->getLatestDate();

    $filter = TimeFilter::render($param);

    $page = <<<HTML
    {$filter}
    {$map}
    {$harvest}
HTML;


    echo PageWrapper::render([
        'title' => 'Interactive map',
        'content' => $page
    ]);
})();