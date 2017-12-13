<?php

//todo remove in production
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('SUB_DIR', '/greenhouse');
define('SITE_ROOT', $_SERVER["DOCUMENT_ROOT"] . SUB_DIR . '/');
require_once SITE_ROOT . 'backend/Constants.php';
require_once SITE_ROOT . 'backend/Util.php';
require_once SITE_ROOT . 'backend/DBMgr.php';
require_once SITE_ROOT . 'backend/DBObject.php';
require_once SITE_ROOT . 'backend/Box.php';
require_once SITE_ROOT . 'backend/BoxMgr.php';
require_once SITE_ROOT . 'backend/BoxPlantEntry.php';
require_once SITE_ROOT . 'backend/BoxPlantEntryMgr.php';
require_once SITE_ROOT . 'backend/Plant.php';
require_once SITE_ROOT . 'backend/PlantMgr.php';
require_once SITE_ROOT . 'backend/Shift.php';
require_once SITE_ROOT . 'backend/ShiftMgr.php';
require_once SITE_ROOT . 'backend/User.php';
require_once SITE_ROOT . 'backend/UserMgr.php';
require_once SITE_ROOT . 'backend/ConfigMgr.php';
require_once SITE_ROOT . 'backend/Harvest.php';
require_once SITE_ROOT . 'backend/HarvestMgr.php';
require_once SITE_ROOT . 'backend/Page.php';
require_once SITE_ROOT . 'backend/PageMgr.php';

require_once SITE_ROOT . 'components/Component.php';
require_once SITE_ROOT . 'components/JSRequire.php';
require_once SITE_ROOT . 'components/PageWrapper.php';
require_once SITE_ROOT . 'components/Navbar.php';
require_once SITE_ROOT . 'components/UserFormFields.php';
require_once SITE_ROOT . 'components/PageFormFields.php';
require_once SITE_ROOT . 'components/BoxPlantEntryFormFields.php';
require_once SITE_ROOT . 'components/TimeFilter.php';
require_once SITE_ROOT . 'components/Map.php';
require_once SITE_ROOT . 'components/Harvest.php';

require_once SITE_ROOT . 'backend/login.php';