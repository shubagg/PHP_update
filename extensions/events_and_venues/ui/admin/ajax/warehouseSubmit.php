<?php include_once '../../../../../global.php';
$_POST['userId']=$_SESSION['user']['user_id'];
$_POST['smid']='2';
$_POST['status']='1';
$_POST['warehouseId']='58808071a32974cd223c9869';
$newarray=array_combine($_POST['Pricetitle'],$_POST['Pricerate']);
$finalarray=array();
$desc=$_POST['Pricedesc'];
$_POST['inventory']=intval($_POST['inventory']);
$tickets=$_POST['PriceTicket'];
$_POST['customField']['second']= strtotime($_POST['customField']['date']) *1000;
$timeToFind=date("Y-m-d",strtotime($_POST['customField']['date']));
$_POST['customField']['filterSecond']= strtotime($timeToFind) *1000;
$counter=0;
foreach ($newarray as $key => $value) 
{
	if($key!="" && $value!="")
	{
		$finalarray[]=array('title'=>$key,'rate'=>$value,'desc'=>$desc[$counter],'ticket'=>$tickets[$counter]);
	}
	$counter++;
}
$_POST['PriceDetail']=$finalarray;
unset($_POST['Pricetitle']);
unset($_POST['Pricerate']);
unset($_POST['Pricedesc']);
unset($_POST['PriceTicket']); 
$manageProduct=curl_post('/manage_option_inventory_warehouse',($_POST));
if(isset($_POST['productId']))
{
	$updatewarehousestatus=manage_product(array('id'=>$_POST['productId'],'warehouseStatus'=>'1'));	
}
if($_FILES['Priceimg'])
{ 
	 $mediaData=array('id'=>'0','smid'=>'2','amid'=>'16','asmid'=>'1','aiid'=>$manageProduct['data'],'mediaName'=>'Priceimg','mediaType'=>'image','multimedia'=>"1");
        $manage_media=manage_media($mediaData);
}

echo json_encode($manageProduct);

?>
