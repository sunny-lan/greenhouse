<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-05
 * Time: 12:55 PM
 */
class Map implements Component
{
	static function render($param = []): string
	{
		$mgr = new BoxMgr();
		$boxes = $mgr->listBoxes();

		$startDate = null;
		if (array_key_exists('startDate', $param) and $param['startDate'] !== '')
			$startDate = $param['startDate'];

		$endDate = null;
		if (array_key_exists('endDate', $param) and $param['endDate'] !== '')
			$endDate = $param['endDate'];

		$subDir = SUB_DIR;

		$boxHTML = "";
		foreach ($boxes as $box/* @var $box Box */) {
			$plantHTML = "";
			$boxPlants = $box->listPlantEntries($startDate, $endDate);
			usort($boxPlants, BoxPlantEntryMgr::getComp());
			foreach ($boxPlants as $entry/* @var $entry BoxPlantEntry */) {
				$plantEndDate = $entry->getEndDate();

				$endStr = '';
				if ($plantEndDate !== null)
					$endStr = 'ending ' . $plantEndDate->format('Y-m-d');

				$adminHTML = '';
				if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN)
					$adminHTML = BoxPlantEntryLinks::render(['entry' => $entry]);
				$plantHTML .= <<<HTML
                <li>
                    {$entry->getPlant()->getPlantName()} 
                    starting {$entry->getStartDate()->format('Y-m-d')}
                    {$endStr}
                    {$adminHTML}
                </li>
HTML;
			}
			$adminHTML = '';
			if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN)
				$adminHTML = BoxLinks::render(['box' => $box]);

			$boxHTML .= <<<HTML
            <li>
                {$box->getName()}
                {$adminHTML}
                <ul>{$plantHTML}</ul>
            </li>
HTML;
		}

		if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN)
			$adminHTML = <<<HTML
            <a href="javascript:setPage([], '{$subDir}/admin/createBox.php')">add box</a>
HTML;
		else $adminHTML = "";

		return "<div><ul>$boxHTML</ul>$adminHTML</div>";
	}
}