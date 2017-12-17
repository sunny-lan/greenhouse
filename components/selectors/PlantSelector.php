<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-15
 * Time: 1:43 PM
 */
class PlantSelector implements Component
{

    static function render($param = []): string
    {
        $name = null;
        if (array_key_exists('name', $param))
            $name = $param['name'];

        $selectedID = null;
        if (array_key_exists('value', $param) && $param['value'] != null)
            $selectedID = $param['value']->getID();

        $mgr = new PlantMgr();

        $plantOptions = "";
        foreach ($mgr->listPlants() as $plant/* @var $plant Plant */) {
            $selected = "";
            if ($selectedID === $plant->getID())
                $selected = "selected='selected'";
            $plantOptions .= <<<HTML
            <option value="{$plant->getID()}" {$selected}>{$plant->getPlantName()}</option>
HTML;
        }

        return <<<HTML
        <select name="{$name}">{$plantOptions}</select>
HTML;
    }
}