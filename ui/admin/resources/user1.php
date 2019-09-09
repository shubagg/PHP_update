<?php 

include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

is_user_logged_in();
$cat = curl_post("/get_category",array());
$all_cats=$cat['data'];

$get_modules=curl_post("/get_modules",array());
//print_r($get_modules);

$get_roles = curl_post("/get_roles",array());
$get_roles=$get_roles['data'];
//print_r($get_roles);
if($_GET['id'])
{
    $user_id=$_GET['id'];
    $get_users=curl_post("/get_users",array('id'=>$user_id));
    $user=$get_users['data'][0];
    
}        

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("resources","user")); ?>

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
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/user.js"></script>
 
