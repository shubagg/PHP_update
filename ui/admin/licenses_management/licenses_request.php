<?php
/*Check User Permission*/
if(check_user_permission('licenses', 'licenses', 'all') != '1' || check_user_permission('licenses', 'licenses', 'view') != '1') {
    header("location:".site_url()."admin/404");
}
is_user_logged_in();
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("licenses_management","licenses_request")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->




<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('licenses_management','licenses'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

<script>
var ui_url='<?php echo ui_url();?>';
var site_url='<?php echo site_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  

 <?php get_admin_footer(); ?> 
