<?php 
include_once("../../../global.php");
is_user_logged_in();
check_user_permission_with_redirect("rpa","imagelist");
$companyData=get_company_data();
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 
<div id="masterDiv">
</div>
<script>
function load_page(type)
{	  
	$.ajaxSetup ({
		cache: false
	});
	var loadUrl = site_url+"admin/controller/index.php?type="+type;
	$( "#masterDiv" ).load(loadUrl,function(){
		setTimeout(function () {
                       refresh_custom_dt();
                    }, 1000);	  
	});
}
load_page('imagelist');
</script>



<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  

 <?php get_admin_footer(); ?> 
