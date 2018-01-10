<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-15
 * Time: 1:37 PM
 */
class PageSelector implements Component
{

    static function render($param = []): string
    {
        $name = Util::guardA($param, 'name');

        $selectedID = Util::guardA($param, 'value');
        if ($selectedID != null)
            $selectedID = $selectedID->getID();

        $mgr = new PageMgr();
        $pageOptions = "";
        foreach ($mgr->listPages() as $page/* @var $page Page */) {
            $selected = "";
            if ($selectedID === $page->getID())
                $selected = "selected='selected'";
            $pageOptions .= <<<HTML
            <option value="{$page->getID()}" {$selected}>{$page->getID()} - {$page->getName()}</option>
HTML;
        }

        return <<<HTML
        <select name="{$name}">
            <option value="">None</option>
            {$pageOptions}
        </select>
HTML;
    }
}