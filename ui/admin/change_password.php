<?php 
include_once '../../global.php';

$forgotKey=isset($_GET['code'])?$_GET['code']:"";
?>


<?php require_once ($server_path."templates/admin/change_password.php"); ?>

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
var site_url='<?php echo site_url();?>';
</script>

<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/user.js"></script>
