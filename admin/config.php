<?php
require_once '../include.php';
(function () {
    $mgr = new ConfigMgr();

    $configList = "";
    foreach ($mgr->listNames() as $name) {
        $configList .= <<<HTML
        {$name}: <input name="{$name}" value="{$mgr->getValue($name)}"/>
        <br>
HTML;
    }

    $page = <<<HTML
    {$configList}
    <input type="submit" value="save"/>
HTML;

    $page = Form::render([
        'action' => 'handlers/updateConfig.php',
        'content' => $page,
        'keepSrc' => true
    ]);

    echo PageWrapper::render([
        'title' => 'Configuration',
        'content' => $page
    ]);
})();