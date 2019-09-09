<?php
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
$cond=array();
$pushTitle="";
$extra_data=array();
$to =   $_POST['starttime'];
$start = $to+(1*60*1000);
$cond['status']='0';
//$cond['ms']=array('$lte'=>intval($start),'$gte'=>intval($to));
$getRecords = select_mongo("toSend",$cond,array());
$row = add_id($getRecords,"id");
foreach ($row as $value) 
{
	update_mongo("toSend",array("status"=>"1"),array('_id'=>new MongoId($value['id'])));
	if(isset($value['pushTitle']) && $value['pushTitle']!="")
	{
		$pushTitle=$value['pushTitle'];
	}
	if(isset($value['extra_data']) && $value['extra_data']!="")
	{
		$extra_data=$value['extra_data'];
	}
	$response = send_notification(array('customerId'=>$value['customerId'],'mid'=>$value['mid'],'smid'=>$value['smid'],'userId'=>$value['userId'],'itemId'=>$value['itemId'],'eid'=>$value['eid'],"extra"=>$value['extra'],'pushTitle'=>$pushTitle,'ms'=>$value['ms'],'extra_data'=>$extra_data));
	
}

if(isset($response)) 
{
	if(empty($response['data']))
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
}
else
{
	echo "2";
}

?>
