<?php 
include_once("../../../global.php");

//include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");


?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("cms","shipping-cms")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<script>

var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var all_report=<?php echo json_encode($report_type); ?>;
var site_url="<?php echo site_url(); ?>";
var media_url = "<?php echo media_url(); ?>";
var defaultimage=site_url+"/assets/admin/img/addg.png";
var extensions_ui_url= site_url+'/extensions/events_and_venues/ui/admin/';

</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>brand/js/manage_attributes.js"></script>
<?php get_admin_footer(); ?> 