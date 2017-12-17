<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-12-05
 * Time: 3:22 PM
 */
class HarvestDisplay implements Component
{
    static function render($param = []): string
    {
        $mgr = new HarvestMgr();
        $startDate = null;
        if (array_key_exists('startDate', $param) and $param['startDate'] !== '')
            $startDate = $param['startDate'];

        $endDate = null;
        if (array_key_exists('endDate', $param) and $param['endDate'] !== '')
            $endDate = $param['endDate'];
        $harvests = $mgr->listHarvests($startDate, $endDate);

        $pageHTML = '';

        function comp1(Harvest $a, Harvest $b)
        {
            if ($a->getDateHarvested() == $b->getDateHarvested()) {
                if ($a->getBox()->getID() == $b->getBox()->getID()) {
                    return 0;
                } else if ($a->getBox()->getID() > $b->getBox()->getID()) {
                    return 1;
                } else {
                    return -1;
                }
            } else if ($a->getDateHarvested() < $b->getDateHarvested()) {
                return 1;
            } else {
                return -1;
            }
        }

        usort($harvests, 'comp1');

        foreach ($harvests as $harvest/* @var $harvest Harvest */) {
            $harvestHTML = <<<HTML
            <td>{$harvest->getBox()->getDescription()}</td>
            <td>{$harvest->getDescription()}</td>
            <td>{$harvest->getAmount()} kg</td>
            <td>{$harvest->getDateHarvested()->format('Y-m-d')}</td>
HTML;
            if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
                $harvestHTML .= <<<HTML
                <td><a href="javascript:setPage(['id', '{$harvest->getID()}'], '../admin/updateHarvest.php')">edit</a></td>
HTML;
            }

            $pageHTML .= <<<HTML
            <tr>{$harvestHTML}</tr>
HTML;
        }

        $page = <<<HTML
        <table>
        {$pageHTML}
        </table>
HTML;

        if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
            $page .= <<<HTML
            <a href="javascript:setPage([], '../admin/createHarvest.php')">add harvest</a>
HTML;
        }

        return $page;
    }
}