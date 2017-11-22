<?php
require_once 'include.php';
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Garden map</title>
    <script src="js/util.js"></script>
    <script>
        function handleFilter(year) {
            setPage([['startDate', year + '-01-01'], ['endDate', year + '-12-31']]);
        }
    </script>
</head>
<body>
<h1>Boxes</h1>
Filter:
<?php
$interval = DateInterval::createFromDateString('1 year');
$period = new DatePeriod($earliestDate, $interval, $latestDate);
foreach ($period as $dt):
    /* @var $dt DateTime */
    $year = $dt->format('Y'); ?>
    <a href="javascript: handleFilter(<?= $year ?>)"><?= $year ?></a>
<?php endforeach; ?>
<ul>
    <?php foreach ($boxes as $box):
        /* @var $box Box */ ?>
        <li><h2><?= $box->getBoxDescription(); ?></h2><br>
            <ul>
                <?php foreach ($box->listPlantEntries($startDate, $endDate) as $entry):
                    /* @var $entry BoxPlantEntry */ ?>
                    <li>
                        <?= $entry->getPlant()->getPlantName() ?>
                        starting <?= $entry->getStartDate()->format('Y-m-d') ?>
                        <?php
                        $endDate = $entry->getEndDate();
                        if ($endDate !== null)
                            echo 'ending ' . $endDate->format('Y-m-d');
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>