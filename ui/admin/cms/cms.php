<?php 
 include_once('../../../global.php');

is_user_logged_in();

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

?>



<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>



<?php get_admin_left_sidebar($language); ?> 



<?php 

	include_once(include_admin_template("cms","cms")); 

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






<script type="text/javascript" src="<?php echo getAdminJsUrl('cms','cms'); ?>"></script>



<script type="text/javascript">

	// Call CkEditor

	CKEDITOR.replace( 'editorCk', {

		startupFocus : false,

		uiColor: '#FFFFFF'

	});

	</script>



 <?php get_admin_footer(); ?> 