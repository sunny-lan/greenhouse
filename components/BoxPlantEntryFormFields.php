<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-04
 * Time: 3:40 PM
 */
class BoxPlantEntryFormFields implements Component
{

    static function render($param = []): string
    {
        $util = new Util();

        $selectedBox = null;
        if (array_key_exists('box', $param))
            $selectedBox = $param['box'];

        $entry = null;
        if (array_key_exists('entry', $param)) {
            $entry = $param['entry'];
            /* @var $entry BoxPlantEntry */
            $selectedBox = $entry->getBox();
        }

        $mgr = new PlantMgr();

        $plantOptions = "";
        foreach ($mgr->listPlants() as $plant/* @var $plant Plant */) {
            $selected = "";
            if ($entry !== null && $entry->getPlant()->getID() === $plant->getID())
                $selected = "selected='selected'";
            $plantOptions .= <<<HTML
            <option value="{$plant->getID()}" {$selected}>{$plant->getPlantName()}</option>
HTML;
        }

        $mgr = new BoxMgr();
        $boxOptions = "";
        foreach ($mgr->listBoxes() as $box/* @var $box Box */) {
            $selected = "";
            if ($selectedBox->getID() === $box->getID())
                $selected = "selected='selected'";
            $boxOptions .= <<<HTML
            <option value="{$box->getID()}" {$selected}>{$box->getID()}</option>
HTML;
        }

        $page = <<<HTML
        Box: <select name="boxID">{$boxOptions}</select>
        Plant: <select name="plantID">{$plantOptions}</select>
        Start date: <input name="startDate" value="{$util::guard($entry, 'getStartDate', null, new DateTime())->format('Y-m-d')}">
        End date: <input name="endDate" value="{$util::guard($util::guard($entry, 'getEndDate'), 'format', 'Y-m-d')}">
HTML;

        return $page;
    }
}