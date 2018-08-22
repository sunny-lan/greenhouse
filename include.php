<?php
//todo remove in production
error_reporting(E_ALL);

ini_set('display_errors', 1);
define('SUB_DIR', '/');
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
require_once SITE_ROOT . 'backend/Picture.php';
require_once SITE_ROOT . 'backend/PictureMgr.php';

require_once SITE_ROOT . 'components/Component.php';
require_once SITE_ROOT . 'components/JSRequire.php';
require_once SITE_ROOT . 'components/Form.php';
require_once SITE_ROOT . 'components/TimeFilter.php';
require_once SITE_ROOT . 'components/Map.php';
require_once SITE_ROOT . 'components/InteractiveMap.php';
require_once SITE_ROOT . 'components/BoxInfo.php';
require_once SITE_ROOT . 'components/PageWrapper.php';
require_once SITE_ROOT . 'components/Navbar.php';
require_once SITE_ROOT . 'components/links/BoxLinks.php';
require_once SITE_ROOT . 'components/links/BoxPlantEntryLinks.php';
require_once SITE_ROOT . 'components/selectors/BoxSelector.php';
require_once SITE_ROOT . 'components/selectors/PlantSelector.php';
require_once SITE_ROOT . 'components/selectors/PageSelector.php';
require_once SITE_ROOT . 'components/selectors/UserSelector.php';
require_once SITE_ROOT . 'components/formfields/UserFormFields.php';
require_once SITE_ROOT . 'components/formfields/PageFormFields.php';
require_once SITE_ROOT . 'components/formfields/BoxPlantEntryFormFields.php';
require_once SITE_ROOT . 'components/formfields/BoxFormFields.php';
require_once SITE_ROOT . 'components/formfields/HarvestFormFields.php';
require_once SITE_ROOT . 'components/formfields/PictureFormFields.php';
require_once SITE_ROOT . 'components/HarvestDisplay.php';

require_once SITE_ROOT . 'backend/login.php';