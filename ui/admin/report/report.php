<?php 


//include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

is_user_logged_in();
$mid= $_GET['mid'];
$smid= $_GET['smid'];
$report_id = $_GET['report_id'];
$reportName = get_report_name(array("mid"=>$mid,"smid"=>$smid,"report_id"=>$report_id));
$reportName = $reportName['data'];

$getdata = get_report_uidata_by_mid(array("mid"=>$mid,"smid"=>$smid,'report_id'=>$report_id));

$searchfields = json_encode($getdata['data'][0]['setting']['searchFields']);


//echo $searchfields; die;


if(isset($_COOKIE['cookie_column_head_'.$mid.'_'.$report_id.'_'.$_SESSION['user']['user_id']]))
{
 	$FilterFields=json_decode($_COOKIE['cookie_column_head_'.$mid.'_'.$report_id.'_'.$_SESSION['user']['user_id']]);
 	
}

else
{
	$FilterFields=array();
	$defaultFields = $getdata['data'][0]['setting']['defaultFields'];
	if(!empty($defaultFields)){foreach ($defaultFields as $key => $value) {
		array_push($FilterFields, $value['fieldName']);
	} }


}
$allFieldsArr=array();
$allFields = $getdata['data'][0]['setting']['allFields'];
if(!empty($allFields)){
	foreach ($allFields as $key => $value) {
		array_push($allFieldsArr, $value['fieldName']);
	}
}

$chartDayFormat = $getdata['data'][0]['setting']['chartDayFormat'];
$allCharts = $getdata['data'][0]['setting']['chart'];
?>

<?php get_admin_header(); ?>
<link rel="stylesheet" href="<?php echo assets_url(); ?>ladda/ladda-themeless.min.css">


<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php 
    include_once(include_admin_template("report","report"));
?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
var mid='<?php echo $mid;?>';
var smid='<?php echo $smid;?>';
var report_id='<?php echo $report_id;?>';
var searchFieldJson = '<?php echo $searchfields; ?>';
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var admin_template_path_site='<?php echo admin_template_path_site();?>';
var FilterFields='<?php echo json_encode($FilterFields);?>';
var allFieldsArr='<?php echo json_encode($allFieldsArr);?>';


</script>

<script src="<?php echo assets_url(); ?>ladda/spin.min.js"></script>
<script src="<?php echo assets_url(); ?>ladda/ladda.min.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('report','manage_report'); ?>"></script>



<script>

/*@@@@@@@@@@@@@@@@@@@@  chart start @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawLineChart);
google.charts.setOnLoadCallback(drawPieChart);
google.charts.setOnLoadCallback(drawBarChart);

/*@@@@@@@@@@@@@@@@@@@@  chart end @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

 

</script>


<?php get_admin_footer(); ?> 