<?php 
 

is_user_logged_in();


?>

<?php get_admin_header(); ?>  

<?php include_once(include_admin_template("notification","add_inventry")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script>
var ui_url='<?php echo admin_ui_url();?>';
var site_url='<?php echo site_url();?>';
//var deleteTempUrl='<?php echo get_url("manage_template");?>';
var deleteTempUrl=site_url+'admin/manageTemplate';
</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','template'); ?>"></script>
