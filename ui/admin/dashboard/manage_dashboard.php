<?php 
include_once("../../../global.php");

include(lang_url()."resourse/en.php");

is_user_logged_in();
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<script>
var parent_cats='<?php echo implode(",",$parent_cats);  ?>';
</script>
<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("dashboard","dash_list")); ?>



  <!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->



<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>dashboard/js/dashboard.js"></script><!-- 
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/resource.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/user.js"></script>  
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>dash/js/role.js"></script>  -->
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  

 <?php get_admin_footer(); ?> 
