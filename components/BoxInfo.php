<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2018-01-08
 * Time: 1:21 PM
 */
class BoxInfo implements Component
{

	static function render($param = []): string
	{
		$box = $param['box'];
		/* @var $box Box */

		$startDate = Util::guardA($param, 'startDate');

		$endDate = Util::guardA($param, 'endDate');

		$harvests = $box->listHarvests($startDate, $endDate);
		$harvestHTML = HarvestDisplay::render(['harvests' => $harvests]);

		$entries = $box->listPlantEntries($startDate, $endDate);
		usort($entries, BoxPlantEntryMgr::getComp());
		$entriesHTML = '';
		foreach ($entries as $entry/* @var $entry BoxPlantEntry */) {
			$plantEndDate = $entry->getEndDate();

			$endStr = '';
			if ($plantEndDate !== null)
				$endStr = 'ending ' . $plantEndDate->format('Y-m-d');

			$adminHTML = '';
			if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN)
				$adminHTML = BoxPlantEntryLinks::render(['entry' => $entry]);

			$descriptionHTML = '';
			if (!empty($entry->getDescription()))
				$descriptionHTML = <<<HTML
				<pre>{$entry->getDescription()}</pre>
HTML;


			$entriesHTML .= <<<HTML
                <li>
                    <strong>{$entry->getPlant()->getPlantName()} 
                    starting {$entry->getStartDate()->format('Y-m-d')}
                    {$endStr}</strong>
                    {$adminHTML}
                    {$descriptionHTML}
                </li>
HTML;
		}
		if (empty($entriesHTML))
			$entriesHTML = 'No entries';

		$adminHTML = '';
		if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN)
			$adminHTML = BoxLinks::render($param);

		$descriptionHTML = 'No notes';
		if (!empty($box->getDescription()))
			$descriptionHTML = <<<HTML
				<pre>{$box->getDescription()}</pre>
HTML;

		return <<<HTML
		<div class="box-info">
			<div class="title">
				<h1>{$box->getName()}</h1>
				{$adminHTML}
			</div>
			{$descriptionHTML}
			<div class="plant-entries">
				<h2>Plant entries</h2>
				<ul>{$entriesHTML}</ul>
			</div>
			<div class="harvests">
				<h2>Harvests</h2>
				{$harvestHTML}
			</div>
		</div>
HTML;
	}
}