<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 2017-11-27
 * Time: 3:15 PM
 */

require_once '../include.php';

(function (){
$mgr = new UserMgr();
$currDate = new DateTime();

$supervisors = "";
foreach ($mgr->listUsers() as $user){
    if($user->getType()==Constants::LVL_SUPERVISOR){
        $supervisors.=<<<HTML
        <option value='{$user->getID()}'>{$user->getName()}</option>
HTML;
    }

}

$page = <<<HTML
    <form method="post" action="handlers/createShift.php">
    Supervisor: <select name="supervisor">
    <option value="">unspecified</option>
    {$supervisors}
    </select>
    Activity: <input name="activity">
    Duration: <input name="hours">hours <input name="minutes">minutes
    Date completed: <input name="date" value="{$currDate->format('Y-m-d')}">
    <input type="submit" value="submit">
</form>
HTML;

echo PageWrapper::render([
    "title" => "Add shift",
    "content" => $page
]);
})();