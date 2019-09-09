<?php 
include_once("../../../global.php"); 
include(lang_url()."global_en.php");
is_user_logged_in();

?>

<?php get_admin_header(); ?>  

<?php include_once(include_admin_template("cms","manage_newsletter")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script>
var ui_url='<?php echo admin_ui_url();?>';
$('.datatable').dataTable({
		"iDisplayLength": 50
	}); //call for data-table
  
</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>cms/js/newsletter.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>admin/js/checkbox_multiple_datatable.js"></script>
