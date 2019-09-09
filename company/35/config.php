<?php
$showError=0;
$curlDebug=0;
$oAuth=0;
$enviroment_access=2;   //use 0 to run it on local , for server use 1  , for local server use 2
$inventory_module=0;
$product_barcode=1;
header('X-Frame-Options: DENY');
date_default_timezone_set("Asia/Kolkata");
define('COMPANY_ID', $companyId);

//GOOGLE_MAP_API_KEY
define('GOOGLE_MAP_API_KEY', 'AIzaSyCpn7vrYggdNI-oHkyDmpd5cFcMeUVuV7U');

//OAUTH RELATED SETTINGS
define("OAUTH",$oAuth);
define("ENVIROMENT_ACCESS",$enviroment_access);
define("INVENTORY_MODULE",$inventory_module);
define("PRODUCT_BARCODE",$product_barcode);

define("STORE_OWNER_ROLE_ID",'594ce170d88bfde82f00002a');
define("STORE_USER_ROLE_ID",'5971a620d88bfd2416000032');

//Log Functions
$cdnMediaUrl=$site_url;
$currentDirectoryPath=dirname(__FILE__);
include($currentDirectoryPath."/settings/webservices-without-oauth.php");
include($currentDirectoryPath.'/settings/enviroment.php');
include($currentDirectoryPath.'/settings/permissions_indexing.php');
define("FONT_ICON_ACCESS_URL",$font_icon_access_url);
define("SLM_DEFAULT_TIME", '2h 30m');
//custom Assets
include($currentDirectoryPath.'/customAssets.php');
?>