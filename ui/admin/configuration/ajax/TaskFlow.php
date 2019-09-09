<?php
include_once '../../../../global.php';
$userId = is_user_logged_in(); 
$cat=get_resource_by_id(array('id'=>$userId,'fields'=>'category'));
$parent=get_all_parent_category(array('id'=>$cat['data'][0]['category'][0]));
$data=get_chart_detail(array('widget_id'=>$_POST['widgetId']));
$widgetJson=$data['data'][0]['config_Json'];
$chartConfigArray = json_decode($widgetJson,true);
$chartConfigArray['category']=$cat['data'][0]['category'][0];
$course_data = get_userWise_Quotation($chartConfigArray);
$all_data = $course_data['data'];
echo $all_data = json_encode($all_data);
?>