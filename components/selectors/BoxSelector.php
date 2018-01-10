<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-15
 * Time: 1:37 PM
 */
class BoxSelector implements Component
{

    static function render($param = []): string
    {
        $name =Util::guardA($param, 'name');

        $selectedID = Util::guardA($param,'value');
        if ($selectedID != null)
            $selectedID = $selectedID->getID();

        $mgr = new BoxMgr();
        $boxOptions = "";
        foreach ($mgr->listBoxes() as $box/* @var $box Box */) {
            $selected = "";
            if ($selectedID === $box->getID())
                $selected = "selected='selected'";
            $boxOptions .= <<<HTML
            <option value="{$box->getID()}" {$selected}>{$box->getID()} - {$box->getName()}</option>
HTML;
        }

        return <<<HTML
        <select name="{$name}">{$boxOptions}</select>
HTML;
    }
}