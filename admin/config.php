<?php
require_once '../include.php';
(function () {
    $mgr = new ConfigMgr();

    $configList = "";
    foreach ($mgr->listNames() as $name) {
        $configList .= <<<HTML
        <div class="input-row">
            <label>{$name}:</label>
            <input name="{$name}" value="{$mgr->getValue($name)}"/>
        </div>
HTML;
    }

    $page = <<<HTML
    {$configList}
    <input type="submit" value="Save"/>
HTML;

    $page = Form::render([
        'action' => 'handlers/updateConfig.php',
        'content' => $page,
        'keepSrc' => true
    ]);

    $page = <<<HTML
	<h1 id="title">Site configuration</h1>
	{$page}
HTML;


    echo PageWrapper::render([
        'title' => 'Configuration',
        'content' => $page
    ]);
})();