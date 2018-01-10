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
        $name = Util::guardA($param, 'name');

        $selectedID = Util::guardA($param,'value');
        if ($selectedID != null)
            $selectedID = $selectedID->getID();

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