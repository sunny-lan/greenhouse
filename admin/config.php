<?php
require_once '../include.php';
$mgr = new ConfigMgr();

$configList = "";
foreach ($mgr->listNames() as $name) {
    $configList .= <<<HTML
    {$name}: <input name="{$name}" value="{$mgr->getValue($name)}"/>
    <br>
HTML;
}

$page = <<<HTML
<form method="post" action="handlers/config.php">
    {$configList}
    <input type="submit" value="save"/>
</form>
HTML;

echo PageWrapper::render([
    'title' => 'Configuration',
    'content' => $page
]);