<?php 
include_once("../../../global.php");
include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);
if(check_user_permission('job', 'forms', 'fill')!='1' && check_user_permission('job', 'forms', 'all')!='1' ) 
{

        $editPermission = true;
        $assignPermission = true;
        include_once(include_admin_template("customTemplates","unauthorised")); 
        die;
}

include_once(include_admin_extensions_template('aintu_form_job','aintu_form_job','createform'));


  ?>



	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

<script>
var site_url='<?php echo site_url();?>';
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var formsmid="<?php echo $_GET['form']?>";
var redirectUrlcreateform="<?php echo site_url().'admin/form/formdetail';?>";
</script>

<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/vi_validation.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>form/js/form.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<!--<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.js"></script>-->
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.form.js"></script>
<script>

$(".nav-tabs li a").on("click", function() {
	
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var rclick= ( $(e.target).closest('li').index() + 1 );
  $("#userquestion").hide();
if(rclick==3)
{
	$("#userquestion").show();
}
})

	setTimeout(function(){
	
		$('.sorting').trigger('click');
			
	},200);

})
</script>

<?php get_admin_footer(); ?>
