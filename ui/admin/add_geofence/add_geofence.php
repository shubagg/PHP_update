<?php 

//include_once("../../../global_function.php");  
//include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

//is_user_logged_in();
$cat = curl_post("/get_category",array());
$all_cats=$cat['data'];


$get_modules=curl_post("/get_module",array());
$modules=$get_modules['data'];

$get_roles = curl_post("/get_roles",array());
$roles=$get_roles['data'];
set_page_name("");
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("add_geofence","add_geofence")); 


?>

<!--
////////////////////////////////////////////////////////////////
		//////////     JAVASCRIPT  LIBRARY     //////////		
////////////////////////////////////////////////////////////////
-->




<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>add_geofence/js/geofence.js"></script> 
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var userId='<?php echo $_GET["userid"]; ?>';
var mid='<?php if(isset($_GET["mid"])){ echo $_GET["mid"];} ?>';
var smid='<?php if(isset($_GET["smid"])){ echo $_GET["smid"];} ?>';
var iid='<?php if(isset($_GET["iid"])){ echo $_GET["iid"];} ?>';
var gLat='<?php  echo $_GET['lat']; ?>';
var gLng='<?php  echo $_GET['lng']; ?>';
</script>  

 <?php get_admin_footer(); ?> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAU1OHkTDKO1bAYtaINNJY46KQY0gjiC6g&libraries=drawing"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>add_geofence/js/geocode.js"></script> 
<script>
//google.maps.event.addDomListener(window, 'load', initialize);
setTimeout(function(){
	//alert('bbbom')
      show_geofence();
    },1000);
</script>
