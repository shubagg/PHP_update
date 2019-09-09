<?php
require_once($server_path.'framework/widget/'.'columnChartWidget.php');

function resourceloginusers_initWidgetMarkup(&$returnValue)
{
	columnChartInitWidgetMarkup($returnValue);
	
}

function resourceloginusers_getWidgetMarkup($widgetJson)
{
	global $site_url;
	$widgetID = $widgetJson['id'];
	
	$widgetJsonString = json_encode($widgetJson);
	$async = $res[0]['async'];
	if($widgetJson['async']=='true')
	{
		$dataAjaxUrlPath = "resources/ajax/resourceLoginUsersData.php";
		return $abc = '<script>
		var ajaxDataUrl = "'.$dataAjaxUrlPath.'";
		asyncChart[\''.$widgetID.'\'] = {"function":"drawChartCol","ajaxUrl":ajaxDataUrl,"widgetId":"'.$widgetID.'","widgetJSON":'.$widgetJsonString.'} ;
		</script>';		 
		
	}else
	{
	 	$chart_data = resourceloginusers_getWidgetAsyncMarkup($widgetJson);
				
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

function resourceloginusers_getWidgetAsyncMarkup($widgetJson)
{
	$chartConfigArray = json_decode($widgetJson['config_Json'],true);
	$course_data = curl_post("/get_login_users_widget",$chartConfigArray);
    $all_data = $course_data['data'];
    $all_data = json_encode($all_data);
	return $all_data;
}
	
?>
