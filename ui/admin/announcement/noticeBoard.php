<?php 
 
include(lang_url()."global_en.php");
include(lang_url()."resource_en.php");
is_user_logged_in();


 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

include_once(include_admin_template("announcement","noticeBoard")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script type="text/javascript">
var ui_url='<?php echo admin_ui_url();?>';
</script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/resource.js"></script>  
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>announcement/js/announcement.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>


