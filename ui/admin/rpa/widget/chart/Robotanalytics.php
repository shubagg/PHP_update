<?php
require_once($server_path.'framework/widget/'.'columnChartWidget.php');

function Robotanalytics_initWidgetMarkup(&$returnValue)
{
	columnChartInitWidgetMarkup($returnValue);
	
}

function Robotanalytics_getWidgetMarkup($widgetJson)
{
	global $site_url;
	$widgetID = $widgetJson['id'];
	
	$widgetJsonString = json_encode($widgetJson);
	$async = $res[0]['async'];
	if($widgetJson['async']=='true')
	{
		$dataAjaxUrlPath = "rpa/ajax/Robotanalytics.php";
		return $abc = '<script>
		var ajaxDataUrl = "'.$dataAjaxUrlPath.'";
		asyncChart[\''.$widgetID.'\'] = {"function":"drawChartCol","ajaxUrl":ajaxDataUrl,"widgetId":"'.$widgetID.'","widgetJSON":'.$widgetJsonString.'} ;
		</script>';		 
		
	}else
	{
	 	$chart_data = salesreport_getWidgetAsyncMarkup($widgetJson);
				
		$abc = 'var abc_'.$widgetID.' = '.$chart_data;
		return '
		<script>
		'.$abc.' 
		var arr1 = []; 
		arr1.push("drawChartCol","'.$widgetID.'","abc_'.$widgetID.'");
		arr.push(arr1);
		</script>';
		
		
	}

	
}

function Robotanalytics_getWidgetAsyncMarkup($widgetJson)
{
	
	$chartConfigArray = json_decode($widgetJson['config_Json'],true);
	$course_data = curl_post("/widget_top_viewed_product",$chartConfigArray);
    $all_data = $course_data['data'];
    $all_data = json_encode($all_data);
	return $all_data;

}



	
?>