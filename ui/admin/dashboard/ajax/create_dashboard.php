<?php
$noclose=true;
include_once '../../../../global.php';
$DashManage=$_POST['DashManage'];
$dash_manage=explode(',',$_POST['DashManage']);
$dash_name = $_POST['dash_name'];
$dash_id = $_POST['id'];
$action = $_GET['action'];
if(isset($_POST['dash_type']))
{
$dash_type = $_POST['dash_type'];
}
else
{
	$dash_type=1;
}

$dash_desc = $_POST['dash_desc'];
$user_id = $_POST['user_id'];
//$creation_date = $_POST['creation_date'];
$template_type = $_POST['template_type'];
//$aa = array('dash_name'=>$dash_name ,'dash_desc'=>$dash_desc,'sequence_no'=>$sequence_no,'creation_date'=>$creation_date);
	if(isset($action) && $action=='edit_dashboard')
	{
		$output=curl_post("/get_dashboard",array('id'=>$dash_id));
		echo json_encode($output);
	}
	else if(isset($action) && $action=='update_dashboard')
	{
		$dashboard_data = curl_post("/create_dashboard",array('id'=>$dash_id,'dash_name'=>$dash_name ,'user_id'=>$user_id ,'dash_desc'=>$dash_desc,'dash_type'=>$dash_type,'template_type'=>$template_type,'DashManage'=>$DashManage));
print_r($dashboard_data['data']);
	}
	else
	{
		$dashboard_data = curl_post("/create_dashboard",array('dash_name'=>$dash_name ,'user_id'=>$user_id ,'dash_desc'=>$dash_desc,'dash_type'=>$dash_type,'template_type'=>$template_type,'DashManage'=>$DashManage));
print_r($dashboard_data['data']);
	}
