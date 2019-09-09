<?php 

include_once("../../../global_function.php");  
include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

//is_user_logged_in();


$get_modules=curl_post("/get_module",array());
$modules=$get_modules['data'];

$userId=$_GET['userid'];

$mid=$_GET['mid'];

$smid=$_GET['smid'];

$iid=$_GET['iid'];

$geoData=get_geofence(array('userId'=>base64_decode($userId),'mid'=>$mid,'smid'=>$smid,'iid'=>$iid));
if($geoData['data'][0]['poiData']){ $poiData=$geoData['data'][0]['poiData']; }else{  $poiData=json_encode(array()); }

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("add_poi","add_poi")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var allData=<?php echo $poiData; ?>;
var userid='<?php echo $userId; ?>';
var currentPoi='<?php echo $_GET["pr"]; ?>';
var mid='<?php echo $_GET['mid']; ?>';
var smid='<?php echo $_GET['smid']; ?>';
var iid='<?php echo $_GET['iid']; ?>';
var gLat='<?php echo $_GET['lat']; ?>';
var gLng='<?php echo $_GET['lng']; ?>';

if(gLat == '' || gLat == 'undefinded' || gLat == NULL)
{
	gLat = 26.267938;
}
if(gLng == '' || gLng == 'undefinded' || gLng == NULL)
{
	gLng = 78.21056;
}


</script>  

 <?php get_admin_footer(); ?> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>admin/plugins/gmaps/gmaps.js"></script>

<script type="text/javascript" src="<?php echo admin_ui_url(); ?>add_poi/js/poi.js"></script> 
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>add_poi/js/poi_extention.js"></script> 
