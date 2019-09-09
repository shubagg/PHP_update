<?php
include_once '../../../../global.php';
$dash_id = $_POST['dash_id'];
$widget_id = $_POST['widget_id'];

$data = array('dash_id'=>$dash_id ,'widget_id'=>$widget_id);
$widget_data = curl_post("/get_widget_detail",$data);

$widget_data = $widget_data['data'][0];
//$widget_data = json_encode($widget_data);

?>