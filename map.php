<?php
require_once 'include.php';

JSRequire::req('js/util.js');
$setFilter = <<<JS
function setFilter(year){
    if(year===undefined)
        setPage([], undefined, true);
    else
        setPage([['startDate', year + '-01-01'], ['endDate', year + '-12-31']]);
}
JS;
JSRequire::script($setFilter);

$mgr = new BoxMgr();
$boxes = $mgr->listBoxes();

$mgr2 = new BoxPlantEntryMgr();

$earliestDate = $mgr2->getEarliestDate();
$latestDate = $mgr2->getLatestDate();

$startDate = null;
if (array_key_exists('startDate', $_GET))
    $startDate = DateTime::createFromFormat('Y-m-d', $_GET['startDate']);

$endDate = null;
if (array_key_exists('endDate', $_GET))
    $endDate = DateTime::createFromFormat('Y-m-d', $_GET['endDate']);

$interval = DateInterval::createFromDateString('1 year');
$period = new DatePeriod($earliestDate, $interval, $latestDate);
$filterLinks = "<a href=\"javascript: setFilter();\">all</a>";
foreach ($period as $dt/* @var $dt DateTime */) {
    $year = $dt->format('Y');
    $filterLinks .= <<<HTML
    <a href="javascript: setFilter('$year');">$year</a>
HTML;
}

$boxHTML = "";
foreach ($boxes as $box/* @var $box Box */) {
    $plantHTML = "";
    foreach ($box->listPlantEntries($startDate, $endDate) as $entry/* @var $entry BoxPlantEntry */) {
        $endDate = $entry->getEndDate();
        $endStr = "";
        if ($endDate !== null)
            $endStr = 'ending ' . $endDate->format('Y-m-d');

        $plantHTML .= <<<HTML
        <li>
            {$entry->getPlant()->getPlantName()} 
            starting {$entry->getStartDate()->format('Y-m-d')}
            {$endStr}
        </li>
HTML;
    }

    $boxHTML .= <<<HTML
    <li>
        <h2>{$box->getBoxDescription()}</h2><br>
        <ul>{$plantHTML}</ul>
    </li>
HTML;

}

$page = <<<HTML
Filter: {$filterLinks}
<ul>{$boxHTML}</ul>
HTML;

echo PageWrapper::render([
    'title' => 'Interactive map',
    'content' => $page
]);