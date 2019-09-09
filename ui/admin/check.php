<?php
error_reporting(E_ALL);
include '../../global.php';
//die("asdf");
// update hotelUserId and user_type

/*$cond = array();
$cond['category'] = array('$in'=>array('5a4239dd281cda4d60a5777f'));
$cond['user_type'] = 'hotel'; 
$fetchData = select_mongo('user',$cond,array());
$fetchData = add_id($fetchData,"id");


foreach($fetchData as $userInfo)
{		
	$updateData = array();
	$user_id = $userInfo['id'];
	
	$updateData = array('user_type'=>'user','status'=>'1','','hotelUserId'=>$user_id);
	$cond['_id'] = new MongoId($user_id);
	update_mongo('user',$updateData,$cond);
	
	$updateProData = array('hotelUserId'=>$user_id);
	$proCond['userId'] = $user_id;
	update_mongo('product',$updateProData,$proCond);
	
}



function getHotelIdFromProdIdd($productId)
{
	$cond = array('_id'=> new MongoId($productId));
	$getHotelId = select_mongo('product',$cond,array());
	$getHotelId = add_id($getHotelId);
	$hotelUserId = $getHotelId[0]['hotelUserId'];
	return $hotelUserId;
}

function taxCall($data)
{
	
	$product = $data['priceinfoDetails'];
	$TotalDays = $data['TotalDays'];
	$productId = $data['productId'];
	$hotelUserId = getHotelIdFromProdIdd($productId);
	
	// check the tax
	
	$checkCond = array('hotelUserId' => $hotelUserId);
	$isExist = select_mongo('gstTax',$checkCond,array());
	$isExist = add_id($isExist);
	$tax = 0;
	if(count($isExist)>0)
	{
		$productJsonArr = json_decode($product,true);
		$taxRates = $isExist[0]['tax'];
		
		foreach($productJsonArr as $pinfo)
		{
			$cond = array();
			$rate = $pinfo['rate'];
			$qty = $pinfo['ticket'];			
			$taxRateVal = 0;
			foreach($taxRates as  $taxRate)
			{
				if($rate >= $taxRate['min'] && $rate <= $taxRate['max'])
				{
					$taxRateVal = $taxRate['taxrate'];
					break;
				}
			}		
			$taxAmout = 0;
			$taxAmout = ($rate*$TotalDays*$qty*$taxRateVal)/100;
			$tax = $tax + $taxAmout;		
		}	
		return $tax;	
		
	}else{
		
		return $tax;
	}	
}


$data = array();
$data['priceinfoDetails'] =  '[{"title":"Single-Bed-Room","rate":"999","desc":"","ticket":"1","total":999},{"title":"Double-Bed-Room","rate":"2500","desc":"","ticket":"1","total":2500},{"title":"Child","rate":"500","desc":"","ticket":"1","total":500},{"title":"Extra Guest","rate":"1000","desc":"","ticket":"1","total":1000}]';
$data['TotalDays'] = '1';
$data['productId'] = '5a9e28c17d9ff62005000043';


echo $tax = taxCall($data);*/

// get first data
$gstCond = array();

$gstCond['_id'] = new MongoId('5a9e2424942ffa831edde9c5');
$gstData = select_mongo('gstTax',$gstCond,array());
$gstData = add_id($gstData,"id");
$gstData = $gstData[0];

unset($gstData['id']);
unset($gstData['hotelName']);
unset($gstData['hotelUserId']);

$cond = array();
$cond['category'] = array('$in'=>array('5a4239dd281cda4d60a5777f'));
$cond['user_type'] = 'user'; 
$fetchData = select_mongo('user',$cond,array());
$fetchData = add_id($fetchData,"id");


foreach($fetchData as $userInfo)
{		
	$gstData['hotelUserId'] = $userInfo['id'];
	$gstData['hotelName'] = $userInfo['name'];
	insert_mongo('gstTax',$gstData);
}



?>
