<?php
require_once '../include.php';

$plant = new Plant($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit plant</title>
</head>
<body>
<h1>Edit plant</h1>
<form method="post" action="handlers/plant.php">
    <input type="hidden" name="id" value="<?= $plant->getID() ?>">
    Fix typo in name: <input name="name" value="<?= $plant->getPlantName() ?>">
    <input type="submit" value="submit">
</form>
</body>
</html>