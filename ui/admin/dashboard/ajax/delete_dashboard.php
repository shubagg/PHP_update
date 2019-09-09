<?php
include_once '../../../../global.php';

$dash_id = $_POST['id'];
$data = array('id'=>$dash_id);
$widget_data = curl_post("/delete_dashboard",$data);
$widget_data = json_encode($widget_data);
echo $widget_data;
?>