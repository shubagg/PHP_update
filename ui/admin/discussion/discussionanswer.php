<?php 

include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

 

 include_once(include_admin_template("discussion","discussionanswer")); ?>



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
	alert(strUser);	
	window.location=admin_ui_url+"discussion/discussion.php?id="+strUser;
}
</script

<?php get_admin_footer(); ?>
