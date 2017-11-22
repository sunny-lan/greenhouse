<?php
require_once '../include.php';

$mgr = new PlantMgr();
$plants = $mgr->listPlants();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plants</title>
    <script src="<?= SUB_DIR ?>js/util.js"></script>
</head>
<body>
<h1>Plants</h1>
<ul>
    <?php foreach ($plants as $plant):
        /* @var $plant Plant */ ?>
        <li>
            <?= $plant->getPlantName() ?>
            <a href="javascript:setPage(['id', '<?= $plant->getID() ?>'], 'plant.php')">edit</a>
        </li>
    <?php endforeach; ?>
</ul>
<a href="createPlant.php">create</a>
</body>
</html>