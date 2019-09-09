<?php 

is_user_logged_in();

function getbasicWidgetInfo($widgetId)
{
		$id1 = new MongoId($widgetId);
		$userorder = select_mongo('basicWidget',array('_id'=>$id1));
		$res=add_id($userorder);
		$res = $res[0];
		return $res;
	
}
function getModuleNameByWidgetId($chart_id)
{
			
		$res = getbasicWidgetInfo($chart_id);
		$mid =  $res['mid'];
        $moduleRes = select_mongo('module',array('mid'=>$mid));
		$res = add_id($moduleRes);
		if($mid=='37')
		{
		$mval='sla';
		}
		else
		{
		$mval =  $res[0]['mval'];
		}
		return $mval; 
}

function getwidgetinitMarkup($widgetJson,&$returnValue)
	{	
		
		global $server_path;

		$module_name = getModuleNameByWidgetId($widgetJson['chart_id']);
		$widgetInfo = getbasicWidgetInfo($widgetJson['chart_id']);
		$widget_type = $widgetInfo['widget_type'];
		$server_path.'ui/admin/'.$module_name.'/widget/'.$widget_type.'/'.$widgetJson['chart_url'];
		if(file_exists($server_path.'ui/admin/'.$module_name.'/widget/'.$widget_type.'/'.$widgetJson['chart_url']))
			require_once($server_path.'ui/admin/'.$module_name.'/widget/'.$widget_type.'/'.$widgetJson['chart_url']);
		else
			echo $server_path.'ui/admin/'.$module_name.'/widget/'.$widget_type.'/'.$widgetJson['chart_url']." --- not found";
		$prefix = $widgetJson['prefix'];
		$initWidgetMarkup = $prefix.'_initWidgetMarkup';	 	
		$initWidgetMarkup($returnValue);	

}

function initWidgetMarkup($widgetJson)
{	
	
	global $server_path;
	$module_name = getModuleNameByWidgetId($widgetJson['chart_id']);
	$widgetInfo = getbasicWidgetInfo($widgetJson['chart_id']);
	$widget_type = $widgetInfo['widget_type'];
	 require_once($server_path.'ui/admin/'.$module_name.'/widget/'.$widget_type.'/'.$widgetJson['chart_url']);
	 $prefix = $widgetJson['prefix'];
 	 $getWidgetMarkup = $prefix.'_getWidgetMarkup';
 	 $content = $getWidgetMarkup($widgetJson);
	 return $content;
}

function getwidgetMarkup($chart_type)
{

	if($chart_type=='AreaChart')
	{
		$image = '<img  id="widget_div_1" width="100%" height="300" src="http://localhost/Teamerge/assets/admin/img/chart/area.png">';
		return $image;
	}
	elseif ($chart_type=='ColumnChart') {
		$image = '<img  id="widget_div_1" width="100%" height="300" src="http://localhost/Teamerge/assets/admin/img/chart/column.png">';
		return $image;
	}
	elseif ($chart_type=='BarChart') {
		$image = '<img  id="widget_div_1" width="100%" height="300" src="http://localhost/Teamerge/assets/admin/img/chart/bar.png">';
		return $image;
	}
	elseif ($chart_type=='PieChart') {
		$image = '<img  id="widget_div_1" width="100%" height="300" src="http://localhost/Teamerge/assets/admin/img/chart/pie.png">';
		return $image;
	}

}


function getwidgetasyncmarkup($json)
{

}

function Getwidgetsyncmarkup($json)
{

}



?>
