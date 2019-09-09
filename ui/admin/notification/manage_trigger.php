<?php 

is_user_logged_in();

?>

<?php get_admin_header(); ?>  

<?php include_once(include_admin_template("notification","manage_trigger")); ?>

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
//var redirectTriggerUrl='<?php echo get_url("manage_trigger");?>';
var redirectTriggerUrl=site_url+"admin/manageTrigger";
var eventid='0';
</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','trigger'); ?>"></script>