<?php
include_once '../../../../global.php';

$widget_id = $_POST['widget_id'];

$data = array('id'=>$widget_id);
$widget_data = curl_post("/delete_widget",$data);
$widget_data = json_encode($widget_data);
echo $widget_data;
?>