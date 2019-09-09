<?php
//ini_set('mongo.long_as_object', 1);
$httpHost=explode(".",$_SERVER['HTTP_HOST']);
if(end($httpHost)=='com')
{
    $folder='';
    $server_path = $_SERVER["DOCUMENT_ROOT"]."/";
    $site_url = "https://$_SERVER[HTTP_HOST]/";
    $currentCompany=$httpHost[0];
}else{
    $currentStructure=array_values(array_filter(explode("/",$_SERVER['PHP_SELF'])));
    $folder=$currentStructure[0];
    $server_path = dirname(__FILE__)."/";
    $site_url = "http://$_SERVER[HTTP_HOST]/$folder/";
    $currentCompany='Nikky';
}

//echo $currentCompany; die;
$customAssets = array();
$new_log_file_url = $server_path . 'logs/';
require_once $server_path . 'includes/session.php';
require_once $server_path . 'includes/CSRF_Protect.php';
require_once $server_path . 'company/company.php';
require_once $server_path . 'includes/KLogger.php';
$csrf = new CSRF_Protect();
$company = get_company_data();
$companyId=$company['cid'];
include($server_path."company/".$companyId."/config.php");

if(isset($_SESSION['user']['lang']) && $_SESSION['user']['lang']!=''){ $currentLanguageCode=$_SESSION['user']['lang']; }
$start = microtime();
ini_set('display_errors', $showError);
if($showError){ error_reporting(E_ALL); }else{ error_reporting(0); }
$modules = array();

if(isset($_POST)){
    foreach ($_POST as $key => $value) {
       //pr($key); pr($value);
       // $value=stripslashes($value);
       // $checkJson=json_decode($value);
        if(json_last_error() === 0 || is_array($value)){
            $_POST[$key] =$value;
        }else{
            $_POST[$key] =htmlspecialchars(addslashes($value));
        }
        
    }
}
if(isset($_GET)){
    foreach ($_GET as $key => $value) {
        $_GET[$key] =htmlspecialchars($value);
    }
}
$pagename = "";
function get_company_data() {
    global $companies,$currentCompany;
    if(!isset($companies[$currentCompany])){
        include "ui/site/index.html";
        die;
    }
    $companies[$currentCompany]['name']=$currentCompany;
    return $companies[$currentCompany];
}

require_once $server_path . 'vendor/autoload.php';
require_once $server_path . 'includes/class/class.module.php';
require_once $server_path . 'includes/connection.php';
require_once $server_path . 'includes/connection_mysql.php';
require_once $server_path . 'includes/process_modules.php';
require_once $server_path . 'includes/dbfunction.php';

require_once $server_path . 'includes/multilanguage.php';
require_once $server_path . 'includes/template_management.php';
require_once $server_path.'includes/menu_management.php';
//AIzaSyAn8nTXISE7PSmFSJaNhFJOQwNzKv2A5OM


$media_url = $server_path . "uploads/$companyId/media/";


$notification_url = $site_url;
$other_server = "0";
$admin_ui_urls=$site_url."admin/";
$ui_url = $site_url . "ui/";
$admin_ui_url = $site_url . "ui/admin/";
$webservice_url = $site_url . "webservices";
$img_url = $site_url . "uploads/clubs";
$webservice_path = $server_path;
$resouce_mod = include_module_path('resource', '');
$template_path = $server_path . "templates/";
$admin_template_path = $server_path . "templates/admin/";
$admin_template_path_site = $site_url . "templates/admin/";
$lang_url = $server_path . "lang/";
//only for lg
$path = $server_path;
$static_content_url = $assets_url;
$static_admin_content_url = $admin_assets_url;
if (isset($_COOKIE['id']))
    $user = get_user($_COOKIE['id']);
else
    $user = "";
$coursePath = $admin_ui_url . "course";
define("COURSEPATH",$coursePath);
function coursePath() {
    global $admin_ui_url;
    return $admin_ui_url . "course";
}
$ui_media_url = $site_url . "uploads/$companyId/media/";
function extensions_ui_url()
{
  global $site_url;
  return $site_url."extensions/";
}
function ui_media_url() {
    global $ui_media_url;
    return $ui_media_url;
}
function admin_url()
{
  global $site_url;
  return $site_url."admin/";
}
function admin_ui_urls()
{
    global $admin_ui_urls;
    return $admin_ui_urls;
}
function assets_url() {
    global $assets_url;
    return $assets_url;
}
function project_specific_assets() {
    global $project_specific_assets;
    return $project_specific_assets;
}
function admin_assets_url() {
    global $admin_assets_url;
    return $admin_assets_url;
}

function get_global_js_url(){
    global $assets_url;
    return $assets_url."js/";
}

function static_content_url() {
    global $static_content_url;
    return $static_content_url;
}
function static_admin_content_url() {
    global $static_admin_content_url;
    return $static_admin_content_url;
}
function lang_url() {
    global $server_path;
    return $server_path . "lang/";
}
function lang_url_js() {
    global $site_url;
    return $site_url . "lang/";
}
function ui_url() {
    global $ui_url;
    return $ui_url;
}
function admin_ui_url() {
    global $admin_ui_url;
    return $admin_ui_url;
}
function admin_template_path_site() {
    global $admin_template_path_site;
    return $admin_template_path_site;
}
function include_template($module, $file) {
    global $template_path;
    return $template_path . $module . "/" . $file . ".tpl.php";
}
function include_admin_template($module, $file) {
    global $admin_template_path,$ui_string;
    return $admin_template_path . $module . "/" . $file . ".tpl.php";
}
function include_template_params($module, $file, $data) {
    global $template_path;
    include_once($template_path . $module . "/" . $file . ".tpl.php");
}
function include_admin_template_params($module, $file, $data) {
    global $admin_template_path;
    include_once($admin_template_path . $module . "/" . $file . ".tpl.php");
}
function template_path() {
    global $template_path;
    return $template_path;
}
function admin_template_path() {
    global $admin_template_path;
    return $admin_template_path;
}
function site_url() {
    global $site_url;
    return $site_url;
}
function media_url() {
    global $site_url,$companyId;
    $media_url = $site_url . "uploads/$companyId/media/";
    return $media_url;
}
function server_path() {
    global $server_path;
    return $server_path;
}
function engine_redirect($page) {
    if ($page == "")
        $page = site_url();
    echo "<script>window.location='{$page}';</script>";
    die;
}
function library_path() {
    global $server_path;
    return $server_path . "includes/libraries/";
}
function include_path() {
    global $server_path;
    return $server_path . "includes/";
}
function get_upload_dir_uri() {
    global $site_url,$companyId;
    return $site_url . "uploads/$companyId/";
}
function get_upload_dir_url() {
    global $site_url,$companyId;
    return $site_url . "uploads/$companyId/";
}
function get_company_path() {
    global $server_path,$companyId;
    return $server_path . "uploads/$companyId/";
}

function framework_doc_path() {
    global $server_path;
    return $server_path . "framework/";
}

function get_datetime($date) {
    $correct_date = date("jS F Y h:i:s A", $date);
    return $correct_date;
}
function pr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
function getAdminJsUrl($module,$fname)
{
    global $custom_js_url;
    return $custom_js_url."$module/$fname".".js?cache=".get_assets_caching();
}

function getCompanySpecificAssets($folder,$file)
{
    return site_url()."company/".COMPANY_ID."/custom_assets/".$folder."/".$file."?cache=".get_assets_caching();
}

function module_access_url($mid,$smid='')
{
    global $companyId,$server_path;
    $object=json_decode(file_get_contents($server_path.'company/'.$companyId.'/settings/modules-access-url.json'),true);
    foreach($object as $obj){ 
        if(isset($smid))
        {
            if($mid==$obj['mid'] && $smid==$obj['smid']){  return json_encode($obj); } 
        }
        else
        {

            if($mid==$obj['mid']){   return json_encode($obj); } 
        }
    }
    return false;
}

include("url.php");
require_once $server_path . 'includes/global_function.php';
require_once $server_path . 'company/'.$companyId.'/route.php';
require_once $server_path.'extensions.php';
require_once $server_path . 'framework/common_control.php'; //for common UI components. Created by- Umesh Chandra.
require_once $server_path . 'includes/permissions_values.php';
$assets_caching=1;
function get_assets_caching(){
    global $assets_caching;
    return $assets_caching;
}
function customAssets()
{
    global $customAssets;
    return $customAssets;
}
/***************Extension Functions Start*******************/
$extension_path = $server_path . "extensions/";


function extensions_url()
{
  global $site_url;
  return $site_url."extensions/";
}
function include_admin_extensions_template($extensions,$folder,$file) {
    global $extension_path,$ui_string;
    return $extension_path . $extensions . "/templates/admin/".$folder."/" . $file . ".tpl.php";
}
require_once $server_path.'extensions.php';
/****************Extension functions End*****************/

?>