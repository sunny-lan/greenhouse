<?php
require_once '../include.php';
$mgr = new ConfigMgr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Configuration</title>
</head>
<body>
<h1>Edit configuration</h1>
<form method="post" action="handlers/config.php">
    <?php foreach ($mgr->listNames() as $name): ?>
        <?= $name ?>: <input name="<?= $name ?>" value="<?= $mgr->getValue($name) ?>"/>
        <br>
    <?php endforeach; ?>
    <input type="submit" value="save"/>
</form>
</body>
</html>