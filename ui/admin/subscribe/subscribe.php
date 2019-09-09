<?php 
include_once("../../../global.php");

is_user_logged_in();

get_admin_header(); 

get_admin_header_menu(); 

get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("subscribe","subscribe")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php 
$json_array = array("head"=>array("S.No","Email"),
	                "rows"=>$stack,
	                "userInfo"=>array(array("name"=>"","address"=>"","phone"=>""))
	                );
   //print_r($stack);
   //echo "hello";
?>



<script>
$(document).ready(function() {
    $("#per_sh").click(function() {
	    $(".per_d").show(500);
		 $(".amoun_d").hide(500);
        
    });
	
	$("#amt_sh").click(function() {
	    $(".amoun_d").show(500);
		 $(".per_d").hide(500);
        
    });
	
});
</script>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var assets_url = '<?php echo assets_url(); ?>';
var pdfdata='<?php echo json_encode($json_array); ?>';
</script> 

<script type="text/javascript" src="<?php echo getAdminJsUrl('subscribe','manage_subscribe'); ?>"></script>

<?php get_admin_footer(); ?> 

<script>
$('table[data-provide="data-table"]').dataTable({
		"iDisplayLength": 50
	});
$('#DataTables_Table_0_length').parent().prepend('<div class="pull-right tooltip-area"><a onclick="excelexportenquery();" data-toggle="tooltip" title="Export to Exel" data-container="body" data-placement="bottom" class="custom-setting-btn"  style="margin-right:0px; margin-left:20px;" data-toggle="modal" data-target="#md-normal"><i class="fa fa-file-text-o"></i></a> <a data-toggle="tooltip" title="Export to PDF" onclick="export_dashboard_pdf(pdfdata)"; data-container="body" data-placement="bottom"  class="custom-setting-btn" data-toggle="modal" data-target="#md-normal"><i class="fa fa-file-pdf-o"></i></a></div>');
</script>

