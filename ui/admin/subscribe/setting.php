<?php 
include_once("../../../global.php");

//include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");


//$vehicle_list = get_user_device(array("userId"=>$_SESSION['user_id']));
//$vehicle_list = $vehicle_list['data'];
$vehicle_list = array(
	array("vehicleId"=>"565045709c76841c0d0f4240","company"=>"abc","poi"=>"abc","title"=>"vehicle1"),
	array("vehicleId"=>"5650459b9c7684f40d1e8480","company"=>"abc","poi"=>"abc","title"=>"vehicle2"),
	array("vehicleId"=>"565045b39c7684bc050f6950","company"=>"abc","poi"=>"abc","title"=>"vehicle3")
 );

//is_user_logged_in();
$cat = curl_post("/get_category",array());
$all_cats=$cat['data'];


$get_modules=curl_post("/get_module",array());
$modules=$get_modules['data'];

$get_roles = curl_post("/get_roles",array());
$roles=$get_roles['data'];

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php
	$report_type = curl_post("/get_report_type",array());
	logger_ui("report","",$report_type,5);
	$report_type = $report_type['data'];
	//print_r($report_type);
	//print_r(array_keys($report_type));

//$record_report=curl_post("/get_report_data",array('vehicleId'=>'Do748 74 88','duration'=>'','fromDate'=>'','toDate'=>,'','type'=>''));


?>
<?php include_once(include_admin_template("enquiry","setting")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->



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
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>report/js/manage_report.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/resource.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/user.js"></script>  
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/role.js"></script> 
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

<!----changes--->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>admin/plugins/gmaps/gmaps.js"></script>
<!----changes--->
<script>

var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var all_report=<?php echo json_encode($report_type); ?>;

function select_report(report_type)
{
	var report = {};
	var report_list='';
             
	var len=all_report[report_type].length, re_name;
	for(i=0;i<len;i++)
	{
		re_name=all_report[report_type][i];
		report_list +='<option value="'+re_name.id+'">'+re_name.name+'</option>'	
	}
	
	$('#report_types').html(report_list);
}

select_report('web report');
</script>  

<?php get_admin_footer(); ?> 


  
<script>
$('table[data-provide="data-table"]').dataTable();
$('#DataTables_Table_0_length').parent().prepend('<div class="pull-right tooltip-area"><a data-toggle="tooltip" title="Export to Exel" data-container="body" data-placement="bottom" class="custom-setting-btn"  style="margin-right:0px; margin-left:20px;" data-toggle="modal" data-target="#md-normal"><i class="fa fa-file-text-o"></i></a> <a data-toggle="tooltip" title="Export to PDF" data-container="body" data-placement="bottom"  class="custom-setting-btn" data-toggle="modal" data-target="#md-normal"><i class="fa fa-file-pdf-o"></i></a></div>');
</script>
<script>
  function getcurrent()
  {
	  var myDate = new Date();
	  var month=new Array();
	  month[0]="January";
	  month[1]="February";
	  month[2]="March";
	  month[3]="April";
	  month[4]="May";
	  month[5]="June";
	  month[6]="July";
	  month[7]="August";
	  month[8]="September";
	  month[9]="October";
	  month[10]="November";
	  month[11]="December";
	  var hours = myDate.getHours();
	  var minutes = myDate.getMinutes();
	  minutes = minutes < 10 ? '0'+minutes : minutes;
	  var strTime = hours + ':' + minutes;
	  return myDate.getDay()+" "+month[myDate.getMonth()]+" "+myDate.getFullYear()+" "+strTime;
    }

</script>
<script>
//call function auto reportdata
jQuery(document).ready(function(){ 
        
    	var today_date=getcurrent();
	document.getElementById("repfromdate").value=today_date;
	document.getElementById("reptodate").value=today_date;
        get_report_data();
		
	
});
</script>


