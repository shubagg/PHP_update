<?php
include_once '../../../../global.php';
	$data=get_chart_detail(array('widget_id'=>$_POST['widgetId']));
	$widgetJson=$data['data'][0]['config_Json'];
	$chartConfigArray = json_decode($widgetJson,true);
	$_POST['id']=$chartConfigArray['query'];
	require_once(server_path().'ui/admin/controller/reportWidget.php');
?>