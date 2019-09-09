<?php
include_once '../../../../global.php';
$widget_id = $_POST['widget_id'];
$data = array('widget_id'=>$widget_id);
$widget_data = curl_post("/get_basic_widget_detail",$data);
$widget_data = $widget_data['data'][0];
if($widget_data['mid']=='37')
{
	$module_name='sla';
}
else
{
 $module_name = getModuleName($widget_data['mid']);
}
 $widget_data['module_name'] = $module_name; 
echo $widget_data = json_encode($widget_data);

?>