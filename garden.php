<?php
require_once 'include.php';
(function () {
    $param = [];
    if (array_key_exists('startDate', $_GET) and $_GET['startDate'] !== '')
        $param['startDate'] = DateTime::createFromFormat('Y-m-d', $_GET['startDate']);

    if (array_key_exists('endDate', $_GET) and $_GET['endDate'] !== '')
        $param['endDate'] = DateTime::createFromFormat('Y-m-d', $_GET['endDate']);

    $map = InteractiveMap::render($param);
    $harvest = HarvestDisplay::render($param);

    $mgr = new BoxPlantEntryMgr();
    $param['earliestDate'] = $mgr->getEarliestDate();
    $param['latestDate'] = $mgr->getLatestDate();

    $filter = TimeFilter::render($param);

    $page = <<<HTML
    <div id="map-page">
        <div id="sidebar">
            <h1>Interactive map</h1>
            <div id="map-info">
                This is a map of our garden as of now. Hover over the plants to see when they were planted.
                You can click one of the years beside "Filter" to see how the garden was in the past
                (or how it is planned to be in the future).
            </div>
            {$filter}
            <h2>Harvests</h2>
            {$harvest}
        </div>
        {$map}
    </div>
HTML;


    echo PageWrapper::render([
        'title' => 'Interactive map',
        'content' => $page
    ]);
})();