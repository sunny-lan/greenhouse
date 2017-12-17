<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 3:31 PM
 */
require_once '../../include.php';

(function () {
    if ($GLOBALS['userLvl'] == Constants::LVL_ADMIN) {
        if (array_key_exists('id', $_POST)) {
            $entry = new BoxPlantEntry($_POST['id']);
            $entry->setPlant(new Plant($_POST['plantID']));
            $entry->setStartDate(DateTime::createFromFormat('Y-m-d', $_POST['startDate']));
            if (array_key_exists('endDate', $_POST))
                if (empty($_POST['endDate']))
                    $entry->setEndDate(null);
                else
                    $entry->setEndDate(DateTime::createFromFormat('Y-m-d', $_POST['endDate']));
        } else {
            $box = new Box($_POST['boxID']);
            $params = [
                'plant' => new Plant($_POST['plantID']),
                'startDate' => DateTime::createFromFormat('Y-m-d', $_POST['startDate'])
            ];
            if (array_key_exists('endDate', $_POST) && !empty($_POST['endDate']))
                $params['endDate'] = DateTime::createFromFormat('Y-m-d', $_POST['endDate']);
            $box->addPlantEntry($params);
        }
    }
    Util::returnPrevPage();
})();