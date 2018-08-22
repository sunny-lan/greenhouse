<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-05
 * Time: 12:55 PM
 */
class InteractiveMap implements Component
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

		JSRequire::req('https://code.jquery.com/jquery-3.2.1.min.js');
		JSRequire::req('js/overlay.js');
		JSRequire::req('js/map.js');
		$util = new Util();

		$boxHTML = "";
		foreach ($boxes as $box/* @var $box Box */) {
			$plantHTML = "";
			$boxPlants = $box->listPlantEntries($startDate, $endDate);
			usort($boxPlants, BoxPlantEntryMgr::getComp());
			foreach ($boxPlants as $entry/* @var $entry BoxPlantEntry */) {
				$picture = $entry->getPlant()->getPicture();

				$adminHTML = '';
				if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN)
					$adminHTML = BoxPlantEntryLinks::render(['entry' => $entry]);

				$plantEndDate = $entry->getEndDate();
				if ($plantEndDate !== null)
					$plantEndDate = "<br>Ends " . $plantEndDate->format('Y-m-d');

				$plantHTML .= <<<HTML
                <img id="entry-{$entry->getID()}" class="entry" src="{$util::guard($picture, 'getLink')}" >
				<div class="hover-info">
					<strong>{$entry->getPlant()->getPlantName()}</strong>
					{$adminHTML}
					<br>
					Planted {$entry->getStartDate()->format('Y-m-d')}
					{$plantEndDate}
				</div>
HTML;
			}
			if (empty($plantHTML))
				$plantHTML = "Box is empty";
			else
				$plantHTML = "Plants: " . $plantHTML;

			$adminHTML = '';
			if ($GLOBALS['userLvl'] === Constants::LVL_ADMIN)
				$adminHTML = BoxLinks::render(['box' => $box]);

			$converted = json_encode($box->getRect());

			$popupHTML = BoxInfo::render([
				'box' => $box,
				$startDate,
				$endDate
			]);

			$boxHTML .= <<<HTML
            <div id="box-{$box->getID()}" class="box" data-rect='{$converted}'>
                <h2>{$box->getName()}<a class="box-popup-link">...</a></h2>
               	<div class="plant-icons">{$plantHTML}</div>
				<div class="popup-content box-popup">
					{$popupHTML}
				</div>
				<div class="controls">{$adminHTML}</div>
            </div>
HTML;
		}

		$configMgr = new ConfigMgr();

		return <<<HTML
        <div class="interactive-map">
			<h1 class="loading">Loading...</h1>
        	<div class="interactive-map-inside">
        		<img class="background" src="{$configMgr->getValue('Interactive map background image')}"/>
            	{$boxHTML}
            </div>
            <div class="zoom">
            	<input type="range" class="zoom-control" min="1" max="5" value="1" step="0.05">
            </div>
        </div>
		<div class="overlay">
			<div class="overlay-background"></div>
			<div class="overlay-content"></div>
		</div>
HTML;
	}
}