<?php
include_once '../../../../global.php';

$dash_id = $_POST['dash_id'];
$chart_id = $_POST['chart_id'];
$chart_type = $_POST['chart_type'];
$chart_name = $_POST['chart_name'];
$chart_img = $_POST['chart_img'];
$chart_url = $_POST['chart_url'];
$prefix = $_POST['prefix'];
$course = $_POST['course'];
$request_type = $_POST['request_type'];
$widget_id = $_POST['widget_id'];
$async='true';
/*if(isset($_POST['check1']))
{
$async =1;
}
else
{
$async = 0;
}*/

foreach($_POST as $key=>$value)
{
	if (strpos($key, 'conf_') !== false) {
		
		$json_key = str_replace('conf_','',$key);
		$config_Json[$json_key] = $value;
	}
}

if($request_type=="update")
{
	echo $widget_id;
	$data = array('id'=>$widget_id ,'config_Json'=>$config_Json);
	$chart_data = curl_post("/update_widget_detail",$data);
}
else{

	$data = array('dash_id'=>$dash_id ,'chart_id'=>$chart_id ,'chart_type'=>$chart_type,'chart_name'=>$chart_name,'chart_img'=>$chart_img,'chart_url'=>$chart_url,'config_Json'=>$config_Json,'prefix'=>$prefix,'async'=>$async);

	$chart_data = curl_post("/create_widget_detail",$data);
}

?>
