<?php
include_once '../../../../global.php';
$stock=json_decode($_POST['stock'],true);
$check=array();
foreach($stock as $stockData)
{
	$stockData['id']=0;
	$stockData['status']=1;
	$stockData['warehouse']=$_POST['warehouseId'];
	$stockData['quantityAvailable']=intval($stockData['quantity']);
	$stockData['quantityAllocated']=0;
	$manage_inventory=manage_option_inventory($stockData);
	$manage_history=manage_history(array('id'=>'0','mid'=>'16','smid'=>'1','iid'=>$manage_inventory['data'],'key'=>'added','userId'=>$_SESSION['user']['user_id']));
	array_push($check,$manage_inventory['success']);
}
if(in_array('false', $check)){
	echo json_encode(array('success'=>'false','error_code'=>'101','data'=>'Not Added'));
}else{
	echo json_encode(array('success'=>'true','error_code'=>'100','data'=>'ok'));
}
?>