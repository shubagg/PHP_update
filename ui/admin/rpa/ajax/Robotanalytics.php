<?php 
include_once '../../../../global.php';
$data=get_chart_detail(array('widget_id'=>$_POST['widgetId']));
$widgetJson=$data['data'][0]['config_Json'];
$chartConfigArray = json_decode($widgetJson,true);
$course_data = robot_analytic($chartConfigArray);
$all_data = $course_data['data'];
echo $all_data = json_encode($all_data);
?>