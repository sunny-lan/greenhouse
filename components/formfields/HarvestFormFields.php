<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-15
 * Time: 1:48 PM
 */
class HarvestFormFields implements Component
{

    static function render($param = []): string
    {
        $util = new Util();

        $harvest = null;
        if (array_key_exists('harvest', $param))
            $harvest = $param['harvest'];
        /* @var $harvest Harvest */

        $box = null;
        if ($harvest !== null)
            $box = $harvest->getBox();

        if (array_key_exists('box', $param))
            $box = $param['box'];

        $boxSelector = BoxSelector::render(['name' => 'boxID', 'value' => $box]);

        $page = <<<HTML
        Box: {$boxSelector}
        Description:<input name="description" value="{$util::guard($harvest, 'getDescription')}">
        Amount (kg):<input name="amount" value="{$util::guard($harvest, 'getAmount')}">
        Date:<input name="date" value="{$util::guard($harvest, 'getDateHarvested', null, new DateTime())->format('Y-m-d')}">
HTML;
        return $page;
    }
}