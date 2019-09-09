<?php 
 

is_user_logged_in();


?>

<?php get_admin_header(); ?>  

<?php include_once(include_admin_template("notification","manage_account")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script>
var ui_url='<?php echo admin_ui_url();?>';
var deltedSuccess='<?php echo get_url("manage_account"); ?>';
</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','account'); ?>"></script>
