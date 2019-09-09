<?php 

include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

is_user_logged_in();

$cat = curl_post("/get_category",array());
$all_cats=$cat['data'];
$parent_cats=array();
foreach($all_cats as $cats)
{
    if($cats['parent_id']==0)
    {
        array_push($parent_cats,$cats['id']);
    }
}

$get_modules=curl_post("/get_module",array());
$modules=$get_modules['data'];

$get_roles = curl_post("/get_roles",array());
$roles=$get_roles['data'];

//print_r($_SESSION['user']);
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>
<script>var parent_cats='<?php echo implode(",",$parent_cats);  ?>';</script>
<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("resources","resources")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->




<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/category.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/resource.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/user.js"></script>  
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/role.js"></script> 
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';

</script>  

 <?php get_admin_footer(); ?> 
