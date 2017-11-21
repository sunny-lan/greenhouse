<?php //todo this file is deprecated
require_once 'include.php';
$res = null;
try {

    $reqList = json_decode(file_get_contents('php://input'), true);

    if ($reqList === null)
        throw new Exception('Invalid request format', Constants::ERR_REQ);

    $results = [];

    if (array_key_exists('user', $GLOBALS))
        throw new Exception('Not logged in', Constants::ERR_LOGIN);

    $user = $GLOBALS['user'];

    foreach ($reqList as $req)
        $results[] = $user->{$req['name']}($req['param']);

    $res = [
        "type" => "result",
        "value" => $results
    ];

} catch (Exception $e) {
    $res = [
        "type" => "error",
        "msg" => strval($e) //todo change to less revealing in production
    ];
}

echo json_encode($res);




