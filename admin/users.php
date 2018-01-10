<?php
require_once '../include.php';
(function () {
	JSRequire::req('js/util.js');

	$mgr = new UserMgr();
	$util = new Util();

	$usersHTML = "";
	foreach ($mgr->listUsers() as $user1/* @var $user1 User */) {
		$type = $user1->getType();
		if ($type === Constants::LVL_ADMIN)
			$typeStr = "admin";
		else if ($type === Constants::LVL_SUPERVISOR)
			$typeStr = "supervisor";
		else if ($type === Constants::LVL_STUDENT)
			$typeStr = "student";
		else
			$typeStr = "unknown";

		$usersHTML .= <<<HTML
		<tr>
			<td>{$user1->getID()}</td>
			<td>{$user1->getName()}</td>
			<td>{$typeStr}</td>
			<td>
				<a href="javascript: setPage(['id', '{$user1->getID()}'], '../updateUser.php');">edit</a>  
				<a href="javascript: setPage(['id', '{$user1->getID()}'], 'handlers/deleteUser.php');">delete</a>
			</td>
		</tr>
HTML;
	}

	$page = <<<HTML
    <h1 id="title">Users</h1>
    <div id="actions">
    	<button onclick="{$util::linkStr("/createUser.php")}">Create</button>
    </div>
    <div id="data-table">
		<table>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Type</th>
				<th>Actions</th>
			</tr>
			{$usersHTML}
		</table>
	</div>
HTML;


	echo PageWrapper::render([
		"title" => "Users",
		"content" => $page
	]);
})();