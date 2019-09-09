<?php 
include_once '../../../../../global.php';

$finalTaxArray = array();
if($_POST['id']==0)
{
	$counter = 0;
	
	$minRange = $_POST['minRange'];
	$maxRange = $_POST['maxRange'];
	$taxRate = $_POST['taxRate'];
	
	foreach($_POST['minRange'] as $value)
	{
		$finalTaxArray[] = array('min'=>$minRange[$counter],'max'=>$maxRange[$counter],'taxrate'=>$taxRate[$counter]);
		$counter++;
	}
	
	// get Hotel Name 
	$usercond = array();
	$usercond['_id'] = new MongoId($_POST['hotelUserId']); 
	$userfetchData = select_mongo('user',$usercond,array());
	$userfetchData = add_id($userfetchData,"id");
	$userHotelName = $userfetchData[0]['name'];

	
	$data['createdOn']=new MongoDate();
	$id = new MongoId();
	$taxId['_id'] = $id;
	$tid =  $taxId['_id']->{'$id'};	 
	$insert_data = array('_id'=>$id,'hotelName'=>$userHotelName,'hotelUserId'=>$_POST['hotelUserId'],'tax'=>$finalTaxArray,'status'=>'1','createdOn'=>new MongoDate());
	
	// check exist 
	
	$cond = array();
	$cond['hotelUserId'] = $_POST['hotelUserId'];
	$cond['status'] = '1'; 
	$fetchData = select_mongo('gstTax',$cond,array());
	$fetchData = add_id($fetchData,"id");
	
	if(count($fetchData)>0)
	{
		$return = array("success"=>"false","data"=>'',"error_code"=>"16003");
		
	}else
	{
		insert_mongo('gstTax',$insert_data);
		$return = array("success"=>"true","data"=>$tid,"error_code"=>"16001");
	}
}else
{
	$counter = 0;
	$id = $_POST['id'];
	$minRange = $_POST['minRange'];
	$maxRange = $_POST['maxRange'];
	$taxRate = $_POST['taxRate'];
	
	
	// get Hotel Name 
	$usercond = array();
	$usercond['_id'] = new MongoId($_POST['hotelUserId']); 
	$userfetchData = select_mongo('user',$usercond,array());
	$userfetchData = add_id($userfetchData,"id");
	$userHotelName = $userfetchData[0]['name'];
	
	foreach($_POST['minRange'] as $value)
	{
		$finalTaxArray[] = array('min'=>$minRange[$counter],'max'=>$maxRange[$counter],'taxrate'=>$taxRate[$counter]);
		$counter++;
	}
	$update_data = array('hotelName'=>$userHotelName,'hotelUserId'=>$_POST['hotelUserId'],'tax'=>$finalTaxArray);
	
	$cond['_id'] = new MongoId($id);
	
	update_mongo('gstTax',$update_data,$cond);
	
	$return = array("success"=>"true","data"=>$id,"error_code"=>"16002");
	
}
echo json_encode($return);

?>
