<?php 
include_once("../../../global.php");
is_user_logged_in();
?>
<script type="text/javascript">
	var site_url="<?php echo site_url(); ?>";
	var media_url = "<?php echo media_url(); ?>";
	var defaultimage=site_url+"/assets/admin/img/addg.png";
	var extensions_ui_url= site_url+'/extensions/events_and_venues/ui/admin/';
</script>

<?php
if(isset($_GET['slug']))
{
	$slug = $_GET['slug'];
}

$getSlugCms=curl_post("/get_cms_by_slug",array('slug'=>$slug));



$getcmsid = "9";

if(isset($getSlugCms['data'][0]['id']))

{

	$getcmsid = $getSlugCms['data'][0]['id'];

}
$id=isset($_GET['id'])?$_GET['id']:'';
if($_GET['id'])
{
	
    $user_id=$_GET['id'];
    echo $user_id;

}

?>



<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>



<?php get_admin_left_sidebar($language); ?> 



<?php //include_once(include_admin_template("cms","cms")); ?>
<?php 
	include_once(include_admin_extensions_template("events_and_venues","cms","cms")); 
?>



	<!--

////////////////////////////////////////////////////////////////////////

//////////     JAVASCRIPT  LIBRARY     //////////

/////////////////////////////////////////////////////////////////////

-->

<script>



var ui_url='<?php echo ui_url();?>';

var admin_ui_url='<?php echo admin_ui_url();?>';

//var all_report=<?php echo json_encode($report_type); ?>;

//var cmspath=<?php echo json_encode($site_paths); ?>;

</script>






<script type="text/javascript" src="<?php echo extensions_url(); ?>events_and_venues/ui/admin/cms/js/cms.js"></script>

<script type="text/javascript" src="<?php echo admin_assets_url(); ?>plugins/ckeditor/ckeditor.js"></script> 



<script type="text/javascript">

	// Call CkEditor

	CKEDITOR.replace( 'editorCk', {

		startupFocus : false,

		uiColor: '#FFFFFF'

	});

	</script>



 <?php get_admin_footer(); ?> 