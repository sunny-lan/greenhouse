<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-27
 * Time: 3:15 PM
 */

require_once '../include.php';

(function () {
	$currDate = new DateTime();

	$match = Constants::LVL_SUPERVISOR;
	$lbl = "Supervisor: ";
	if ($GLOBALS['userLvl'] === Constants::LVL_SUPERVISOR) {
		$match = Constants::LVL_STUDENT;
		$lbl = "Student: ";
	}

	$userSelect = UserSelector::render([
		'name' => 'supervisor',
		'value' => Util::guardA($_GET, 'user'),
		'filter' => $match
	]);

	$page = <<<HTML
	<div class="input-row">
		<label>{$lbl}</label>
		{$userSelect}
	</div>
	<div class="input-row">Activity: <input name="activity"></div>
	<div class="input-row">Duration: <input name="hours">hours <input name="minutes">minutes</div>
	<div class="input-row">Date completed: <input name="date" value="{$currDate->format('Y-m-d')}"></div>
	<input type="submit" value="Create">
HTML;

	$page = Form::render([
		'action' => 'handlers/createShift.php',
		'content' => $page
	]);

	$page = <<<HTML
	<h1 id="title">Create shift</h1>
    {$page}
HTML;

	echo PageWrapper::render([
		"title" => "Add shift",
		"content" => $page
	]);
})();