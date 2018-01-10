<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-27
 * Time: 3:15 PM
 */

require_once '../include.php';

(function () {
	$mgr = new UserMgr();
	$currDate = new DateTime();

	$match = Constants::LVL_SUPERVISOR;
	$lbl = "Supervisor: ";
	if ($GLOBALS['userLvl'] === Constants::LVL_SUPERVISOR) {
		$match = Constants::LVL_STUDENT;
		$lbl = "Student: ";
	}

	$supervisors = "";
	foreach ($mgr->listUsers() as $user) {
		if ($user->getType() == $match) {
			$supervisors .= <<<HTML
        	<option value='{$user->getID()}'>{$user->getName()}</option>
HTML;
		}
	}

	$page = <<<HTML
	<div class="input-row">
		<label>{$lbl}</label>
		<select name="supervisor">
			<option value="">unspecified</option>
			{$supervisors}
		</select>
	</div>
	<div class="input-row">Activity: <input name="activity"></div>
	<div class="input-row">Duration: <input name="hours">hours <input name="minutes">minutes</div>
	<div class="input-row">Date completed: <input name="date" value="{$currDate->format('Y-m-d')}"></div>
	<input type="submit" value="submit">
HTML;

	$page = Form::render([
		'action' => 'handlers/createShift.php',
		'content' => $page
	]);

	echo PageWrapper::render([
		"title" => "Add shift",
		"content" => $page
	]);
})();