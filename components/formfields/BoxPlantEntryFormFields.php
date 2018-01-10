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

        $selectedBox = Util::guardA($param, 'box');

        $entry = null;
        if (array_key_exists('entry', $param)) {
            $entry = $param['entry'];
            /* @var $entry BoxPlantEntry */
            $selectedBox = $entry->getBox();
        }

        $plantSelector=PlantSelector::render(['name'=>'plantID', 'value'=>Util::guard($entry, 'getPlant')]);

        $boxSelector = BoxSelector::render(['name' => 'boxID', 'value' => $selectedBox]);

        $page = <<<HTML
        Box: {$boxSelector}
        Plant: {$plantSelector}
        <div class="input-row">
            Start date: 
            <input name="startDate" value="{$util::guard($entry, 'getStartDate', null, new DateTime())->format('Y-m-d')}">
        </div>
        <div class="input-row">
            End date: 
            <input name="endDate" value="{$util::guard($util::guard($entry, 'getEndDate'), 'format', 'Y-m-d')}">
        </div>
		<div class="input-row">
            Description: 
            <textarea name="description">{$util::guard($entry, 'getDescription')}</textarea>
        </div>
HTML;

        return $page;
    }
}