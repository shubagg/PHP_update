<?php 

is_user_logged_in();

//$id=isset($_GET['id'])?$_GET['id']:0;
$get_account=array();
$id = "9";
if(isset($_GET['id']))
{
	$id = $_GET['id'];


$get_account=get_account_by_id(array("id"=>$id));
}
  
?>

<?php get_admin_header(); ?>  

<?php include_once(include_admin_template("notification","account")); ?>

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
var cancelUrlmange='<?php echo get_url("manage_account"); ?>';

</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','account'); ?>"></script>
