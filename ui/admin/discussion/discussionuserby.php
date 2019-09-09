<?php 


 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

 if(isset($_GET['panel']))
 {
 	$userwiserecord=$_GET['panel'];
 	$getrecordbyid=$_GET['panel'];
 	$get_users=curl_post("/get_forum_userwise",array("userId"=>$getrecordbyid));
 }
 else
 {
 	$get_users=get_user(array("query"=>array("parentId"=>$_SESSION['user']["user_id"])));
 			
 }		

 logger_ui("blog_tpl","",$get_users,5);     //logger


 include_once(include_admin_template("discussion","discussionuserby")); ?>



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
function userwiserecord(id)
{
	var user_id=$("#"+id).attr("data-id");
	window.location=admin_ui_url+"discussion/discussionuserby.php?panel="+user_id;
}
</script

<?php get_admin_footer(); ?>
