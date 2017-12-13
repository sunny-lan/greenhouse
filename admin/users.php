<?php
require_once '../include.php';
(function() {
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
    <li>
        id {$user1->getID()} - {$user1->getName()} - {$typeStr} - 
        <a href="javascript: setPage(['id', '{$user1->getID()}'], '../updateUser.php');">edit</a> -   
        <a href="javascript: setPage(['id', '{$user1->getID()}'], 'handlers/deleteUser.php');">delete</a>
    </li>
HTML;
    }

    $page = <<<HTML
    <ul>{$usersHTML}</ul>
    <a href="{$util::linkStr("/createUser.php")}">create user</a>
HTML;


    echo PageWrapper::render([
        "title" => "Users",
        "content" => $page
    ]);
})();