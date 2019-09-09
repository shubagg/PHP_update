<?php 
/*Check User Permission*/
if(check_user_permission('rpa', 'schedule', 'all') != '1' || check_user_permission('rpa', 'schedule', 'view') != '1') {
    header("location:".site_url()."admin/404");
}
is_user_logged_in(); 
get_admin_header();
get_admin_header_menu(); 
get_admin_left_sidebar(); 
?> 
<div id="masterDiv">
</div>

<!-- <script type="text/javascript" src="<?php echo site_url(); ?>ui/admin/quotation/js/quotation.js" /></script> -->
<script type="text/javascript">
function load_page(type)
{ 
  $.ajaxSetup ({
    cache: false
  });
  var loadUrl = site_url+"admin/controller/index.php?type="+type;
  $( "#masterDiv" ).load(loadUrl,function(){
    refresh_custom_dt();  
  });
}
load_page('schedule');

</script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>schedule/js/schedule.js"></script>
<?php echo delete_confirmation_popup(); ?> 
<?php get_admin_footer(); ?> 
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.timepicker.min.js"></script>
	<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/jquery.timepicker.min.css" />
  <link rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo admin_assets_url(); ?>css/bootstrap-clockpicker.min.css">
  <script src="<?php echo admin_assets_url(); ?>js/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/bootstrap-clockpicker.min.js"></script>


