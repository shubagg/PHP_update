<?php
include_once '../../global.php';


// delete commented records from comment table 


// delete_mongo('comment',array('scid'=>array('$nin'=>array('669','309','247','667','194','232','343'))));

//delete_mongo('comment',array('scid'=>'309','orderId'=>array('$nin'=>array('FO0218_66106','RD0218_74804','RD0218_8747','RD0218_16160','RD0218_81648'))));


/*$deleteAddress = delete_mongo('productOrderPlaced',array('scid'=>'770'));

if($deleteAddress['n'] == 0)
{       
	print_r( array('data'=>$data['address_id'],'error_code'=>'1600055','success'=>'false'));
}
else
{
	print_r( array('data'=>$deleteAddress['n'],'error_code'=>'100','success'=>'true'));
}
*/

// update department_code in all productOrderPlaced table 



/*
$orderData =select_mongo("productOrderPlaced",array());
$orderData=add_id($orderData,"id");

foreach($orderData as $order)
{
	echo "<pre>";
	print_r($order);
	
	$department = $order['department'];
	$recId = $order['id'];
	
	if($department != '')
	{
	// get department code
	$dptData = select_mongo("productCategory",array('_id'=>new MongoId($department)));
	$dptData = add_id($dptData,"id");
	
	$dptCode = $dptData[0]['code'];
	
	// update dpt code 
	$data = array('department_code'=>$dptCode);
	update_mongo('productOrderPlaced',$data,array("_id"=>new MongoId($recId)));
	}
	else /// delete records	
	{
		delete_mongo('productOrderPlaced',array("_id"=>new MongoId($recId)));
	}
}*/


// update user

$userData =select_mongo("user",array('user_type'=>'hotel'),array());
$userData=add_id($userData,"id");

foreach($userData as $user)
{
	//echo "<pre>";
	//print_r($user);
	//die;
	
	$email = $user['email'];
	$userId = $user['id'];
	if($email != '')
	{
		// update booking_req_email and status  
		$data = array('booking_req_email'=>$email,'status'=>'1','password'=>'12345678');
		update_mongo('user',$data,array("_id"=>new MongoId($userId)));
		
		$dataProduct = array('booking_req_email'=>$email,'password'=>'12345678');
		
		update_mongo('product',$dataProduct,array("userId"=>$userId));
	}
}





?>