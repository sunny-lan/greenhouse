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
		$startDate = null;
		if (array_key_exists('startDate', $param) and $param['startDate'] !== '')
			$startDate = $param['startDate'];

		$endDate = null;
		if (array_key_exists('endDate', $param) and $param['endDate'] !== '')
			$endDate = $param['endDate'];

		if (array_key_exists('harvests', $param)) {
			$harvests = $param['harvests'];
		} else {
			$mgr = new HarvestMgr();
			$harvests = $mgr->listHarvests($startDate, $endDate);
		}

		if(empty($harvests)){
			$page='No harvests';
		}else {

			$pageHTML = '';

			$comp = (function (Harvest $a, Harvest $b) {
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
			});

			usort($harvests, $comp);

			foreach ($harvests as $harvest/* @var $harvest Harvest */) {
				if ($startDate !== null)
					if ($harvest->getDateHarvested() < $startDate) continue;
				if ($endDate !== null)
					if ($harvest->getDateHarvested() > $endDate)
						continue;
				$harvestHTML = <<<HTML
				<td>{$harvest->getBox()->getName()}</td>
				<td>{$harvest->getAmount()}</td>
				<td>{$harvest->getDateHarvested()->format('Y-m-d')}</td>
HTML;
				if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
					$harvestHTML .= <<<HTML
                	<td><a href="javascript:setPage(['id', '{$harvest->getID()}'], '../admin/updateHarvest.php')">edit</a></td>
HTML;
				}

				$pageHTML .= <<<HTML
            	<tr>{$harvestHTML}<td class="hover-info">{$harvest->getDescription()}</td></tr>
HTML;
			}

			$page = <<<HTML
			<table class="harvest-display">
				<tr>
					<th>Box</th>
					<th>Kg</th>
					<th>Date</th>
HTML;
			if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN)
				$page .= "<th>Actions</th>";

				$page .= <<<HTML
				</tr>
				{$pageHTML}
			</table>
HTML;
		}

		if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
			$page .= <<<HTML
			<a href="javascript:setPage([], '../admin/createHarvest.php')">add harvest</a>
HTML;
		}

		return $page;
	}
}