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

		$entriesHTML = '';
		foreach ($box->listPlantEntries($startDate, $endDate) as $entry/* @var $entry BoxPlantEntry */) {
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
				Notes:
				<pre>{$entry->getDescription()}</pre>
HTML;


			$entriesHTML .= <<<HTML
                <li>
                    {$entry->getPlant()->getPlantName()} 
                    starting {$entry->getStartDate()->format('Y-m-d')}
                    {$endStr}
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

		return <<<HTML
		<h1>{$box->getName()}</h1>
		{$adminHTML}
		<pre>{$box->getDescription()}</pre>
		<h2>Plant entries</h2>
		<ul>{$entriesHTML}</ul>
		<h2>Harvests</h2>
		{$harvestHTML}
HTML;
	}
}