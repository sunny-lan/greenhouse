<?php

//todo remove in production
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('SITE_ROOT', $_SERVER["DOCUMENT_ROOT"] . '/greenhouse/');
require_once SITE_ROOT.'backend/Constants.php';
require_once SITE_ROOT.'backend/Util.php';
require_once SITE_ROOT.'backend/DBMgr.php';
require_once SITE_ROOT.'backend/DBObject.php';
require_once SITE_ROOT.'backend/Box.php';
require_once SITE_ROOT.'backend/BoxMgr.php';
require_once SITE_ROOT.'backend/BoxPlantEntry.php';
require_once SITE_ROOT.'backend/BoxPlantEntryMgr.php';
require_once SITE_ROOT.'backend/Plant.php';
require_once SITE_ROOT.'backend/PlantMgr.php';
require_once SITE_ROOT.'backend/Shift.php';
require_once SITE_ROOT.'backend/ShiftMgr.php';
require_once SITE_ROOT.'backend/User.php';
require_once SITE_ROOT.'backend/UserMgr.php';

require_once SITE_ROOT.'backend/login.php';