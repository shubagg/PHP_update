<?php
include_once '../../../../global.php';
$type=$_POST['type'];

$userArray=array('query'=>array('_id'=>new MongoId($_SESSION['user']['user_id'])));
$userInfo=get_user($userArray);
$address=$userInfo[0]['address'];
$address = preg_replace("/\s|&nbsp;/",' ',$address);

$head=array('Name'=>$userInfo[0]['name'],'Phone'=>$userInfo[0]['phone'],'Address'=>$address);

$users=get_user(array('query'=>array('user_type'=>$type),'fields'=>array('name','user_type')));

$show_data=array();
foreach ($users as $key => $value) {

	if($type=='user')
	{
		$userData=calculate_agent_data(array('userId'=>$value['id']));
		$data=array("Name"=>$value['name'],'Total Devices'=>$userData[0]['total'],'running'=>$userData[0]['running'],'idle'=>$userData[0]['idle'],'stop'=>$userData[0]['stop'],'inactive'=>$userData[0]['inactive']);
	}
	else
	{
		$countTotalDevices=count_mongo('deviceInfo',array('assignedToAdmin'=>$value['id']));
		$countUsedDevices=count_mongo('deviceInfo',array('assignedToAdmin'=>$value['id'],'assignedToUser'=>array('$ne'=>'')));
		$data=array("Name"=>$value['name'],'Total Devices'=>$countTotalDevices,'Used Devices'=>$countUsedDevices);
    }
    array_push($show_data,$data);
}

if($type=='user')
{
	$header_fields=array('Name','Total Devices','Running','Idle','Stop','Inactive');
}
else
{
	$header_fields=array('Name','Total Devices','Used Devices');
}


if(sizeof($show_data)>0)
{
	$ex=curl_post("/export_xls",array('head_data'=>$head,"header_fields"=>json_encode($header_fields),"show_data"=>json_encode($show_data)));
	echo json_encode($ex);
}
else
{
	$ret=array('success'=>'false','error_code'=>'120','data'=>'');
	echo json_encode($ret);
}
?>