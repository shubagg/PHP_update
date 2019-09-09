<?php
require_once($server_path.'framework/widget/'.'tableChartWidget.php');
$query = '';
$type = '';
function reportchart_initWidgetMarkup(&$returnValue)
{
	tableChartInitWidgetMarkup($returnValue);
	
}

function reportchart_getWidgetMarkup($widgetJson)
{
	global $site_url;
	$widgetID = $widgetJson['id'];
	
	global $site_url,$query,$type;
	$widgetID = $widgetJson['id'];
	$_SESSION['widget']=$widgetJson['id'];
	$widgetJsonString = json_encode($widgetJson);
	$async = $res[0]['async'];
	if($widgetJson['async']=='true')
	{
		//$dataAjaxUrlPath = "report/ajax/reportChartData.php";
		$data=get_chart_detail(array('widget_id'=>$widgetID));
	$widgetJson=$data['data'][0]['config_Json'];
	$chartConfigArray = json_decode($widgetJson,true);
	$id=$chartConfigArray['query'];
	$refresh_interval=$chartConfigArray['refresh_interval'];
	$query_data = curl_post('/get_saved_queries',array("id"=>$id));
if($query_data['success']=='true')
{
    $query_data = $query_data['data'][0];
    $query = $query_data['query'];
    $type = $query_data['type'];
		
}
else
{
    echo false;
    die;
}
//$_GET['type'] =  $query_data['type'];
 //require_once(server_path().'ui/admin/controller/report.php');
echo "<script type'text/javascript'>var type=''; var AdvSearchQuery='';

    load_page('$type','$query','$widgetID',$refresh_interval);      </script>"; //return $type;						
	}else
	{
	 	$chart_data = reportchart_getWidgetAsyncMarkup($widgetJson);
				
		$abc = 'var abc_'.$widgetID.' = '.$chart_data;
		return '
		<script>
		'.$abc.' 
		var arr1 = []; 
		arr1.push("drawTable","'.$widgetID.'","abc_'.$widgetID.'");
		arr.push(arr1);
		</script>';
	}

	
}

function reportchart_getWidgetAsyncMarkup($widgetJson)
{
	
	$chartConfigArray = json_decode($widgetJson['config_Json'],true);
	$chartConfigArray['percentage'] = 1;
//pr($chartConfigArray);
	//$params = array_merge($chartConfigArray, array('percentage' => '1'));
	$course_data = curl_post("/get_ticket_by_statstic_type",$chartConfigArray);
    	$all_data = $course_data['data']['record_data'];
    	$all_data = json_encode($all_data);
	return $all_data;

}



	
?>
<script type="text/javascript">
var reportArr=[];
var reportRefreshInt=[];
function load_page(type,query,widgetID,refresh_interval)
{

	reportArr.push({type:type,query:query,widgetID:widgetID,refresh_interval:refresh_interval});
	setTimeout(function(type,query,widgetID,refresh_interval){ 
		loadReports(type,query,widgetID,refresh_interval);
		
	}, 3000,type,query,widgetID,refresh_interval);
	
}	

function refreshReports(){
	$.each(reportArr,function(key,val){
		loadReports(val.type,val.query,val.widgetID,val.refresh_interval);
	});
}
function loadReports(type,query,widgetID,refresh_interval){
	var site_url = '<?php echo site_url(); ?>';
		$.ajaxSetup({
			cache:false
		});
		var loadUrl=site_url+"ui/admin/controller/reportWidget.php?JsonType="+type+"&divID="+widgetID;
		$('#'+widgetID).hide();
		$('#cl'+widgetID).show();
		$( "#"+widgetID).load(loadUrl,function(){
			AdvSearchQuery = query;
			refresh_custom_dt(function(){
				$('#'+widgetID).show();
				$('#cl'+widgetID).hide();
			});

			if(refresh_interval!= undefined && refresh_interval != 0 && !isNaN(refresh_interval))
			{

				if(reportRefreshInt[widgetID]!=undefined){
					clearInterval(reportRefreshInt[widgetID]);
				}
				reportRefreshInt[widgetID]=setInterval(function() {loadReports(type,query,widgetID,refresh_interval); },refresh_interval*60*1000);
				}
		});
}

</script>
<style>
.dataTables_wrapper{
height: 200px;
overflow: auto;
}
</style>
