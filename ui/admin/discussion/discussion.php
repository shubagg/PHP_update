<?php 

include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

 if(isset($_GET['id']))
 {	
 	$get_users=array();
 	$selectedid=$_GET['id'];
 	$getrecordbyid=$_GET['id'];
 	$get_users_data=curl_post("/get_forum_userwise",array("userId"=>$_SESSION['user']["user_id"]));
 	foreach($get_users_data['data'] as $getrecordbyfrom)
 	{
 		if($getrecordbyfrom['status']==$getrecordbyid)
 		{
 			array_push($get_users,$getrecordbyfrom);
 		}	
 	}
 	$get_users['data'] = $get_users;
 }
 else
 {
 	$get_users=curl_post("/get_forum_userwise",array("userId"=>$_SESSION['user']["user_id"]));		
 }
 
 logger_ui("blog_tpl","",$get_users,5);     //logger


 include_once(include_admin_template("discussion","discussion")); ?>



	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->


<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/vi_validation.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>discussion/js/discussion_manage.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
</script>  
<script>
function changelisting()
{
	var e = document.getElementById("discussionlist");
	var strUser = e.options[e.selectedIndex].value;
	if(strUser=="all")
	{
		window.location=admin_ui_url+"discussion/discussion.php";	
	}
	else
	{
		window.location=admin_ui_url+"discussion/discussion.php?id="+strUser;
	}
}
</script

<?php get_admin_footer(); ?>
