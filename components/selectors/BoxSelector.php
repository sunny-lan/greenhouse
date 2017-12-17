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
        $name = null;
        if (array_key_exists('name', $param))
            $name = $param['name'];

        $selectedID = null;
        if (array_key_exists('value', $param) && $param['value'] != null)
            $selectedID = $param['value']->getID();

        $mgr = new BoxMgr();
        $boxOptions = "";
        foreach ($mgr->listBoxes() as $box/* @var $box Box */) {
            $selected = "";
            if ($selectedID === $box->getID())
                $selected = "selected='selected'";
            $boxOptions .= <<<HTML
            <option value="{$box->getID()}" {$selected}>{$box->getID()} - {$box->getDescription()}</option>
HTML;
        }

        return <<<HTML
        <select name="{$name}">{$boxOptions}</select>
HTML;
    }
}