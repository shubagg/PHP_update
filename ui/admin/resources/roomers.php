<?php 
session_start();


include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

is_user_logged_in();


$cat = curl_post($webservice_url."/get_category",array());
$all_cats=$cat['category'];

$cats=isset($_GET['id'])?$_GET['id']:'';


$get_users_list=curl_post($webservice_url."/get_user_list_by_room",array("category_id"=>$cats));

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("resources","roomers")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?> 

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var admin_assets_url='<?php echo admin_assets_url();?>';
</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>

<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','resource'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>  

 
