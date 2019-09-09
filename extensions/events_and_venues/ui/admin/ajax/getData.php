<?php include_once '../../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']=="attributesData")
{
  $getcategorydata=get_feature(array("id"=>$_POST['id'],"groupId"=>$_POST['groupId']));

  $id=$getcategorydata['data'][0]['id'];
  $imageData=get_association_data("16","10","1",$id);
  $profile_picture=$imageData['media']['1'][$id][0]['mediaName'];
  if($profile_picture!=''){$img_url= media_url().'images/'.$profile_picture;}  
  else{$img_url=admin_assets_url().'img/avatar.png';}  
  $newDataArray=array();
  foreach ($getcategorydata['data'] as $key => $value) 
  {
  	$newDataArray=array("title"=>$value['title'],"description"=>$value['description'],"image"=>$img_url,"id"=>$id);
  }
  echo json_encode($newDataArray);  
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="getwarehousedata")
{
  $getwarehousedata=get_inventory_option_id(array("id"=>$_POST['id'],"productId"=>""));
  $newDataArray=array();
  $imageData=get_association_data("16","10","1",$_POST['id']);
  $FileArray=$imageData['media']['1'][$_POST['id']];
  $dataImage=json_decode($getwarehousedata['data'][0]['PriceDetail'],'ARRAY'); 
  $newArray=array();
  for($i=0 ;$i<sizeof($dataImage); $i++){
    $imagename=site_url().'uploads/media/images/'.$FileArray[$i]['mediaName'];
    $newArray[]=array('title'=>$dataImage[$i]['title'],'rate'=>$dataImage[$i]['rate'],'desc'=>$dataImage[$i]['desc'],'ticket'=>$dataImage[$i]['ticket'],'image'=>$imagename);
  }

  $newArray=json_encode($newArray);
 
  foreach ($getwarehousedata['data'] as  $newvalue) 
  {
     
     $newDataArray=array("pricedetail"=>$newArray,"type"=>$newvalue['type'],"productId"=>$newvalue['productId'],"date"=>$newvalue['customField']['date'],"price"=>$newvalue['customField']['price'],"inventory"=>$newvalue['inventory'],"description"=>$newvalue['customField']['description'],"id"=>$newvalue['id'],"duration"=>$newvalue['duration']);
  }
  echo json_encode($newDataArray);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="gettaxdata")
{
	$id = $_POST['id'];
	$where = array('_id'=> new MongoId($id));
	$fetchData = select_mongo('gstTax',$where,array());
	$fetchData = add_id($fetchData,"id");
	$taxData = $fetchData[0];
	echo json_encode($taxData);	
}


if(isset($_REQUEST['action']) && $_REQUEST['action']=="location_get_statesData")
{

  $locatin_get_statesData=get_states(array("id"=>$_POST['id'],"countryId"=>$_POST['countryId']));
  $id=$_POST['id'];
  
  $imageData=get_association_data("11","10","1",$id);
  $profile_picture=$imageData['media']['1'][$id][0]['mediaName'];
  if($profile_picture!=''){$img_url=media_url().'images/'.$profile_picture;}  
  else{$img_url=admin_assets_url().'img/addg.png';}  
  $newDataArray=array();
  foreach ($locatin_get_statesData['data'] as  $newvalue) 
  {
    $newDataArray=array("countryId"=>$newvalue['countryId'],"title"=>$newvalue['title'],"image"=>$img_url,"id"=>$newvalue['id']);
  }
  echo json_encode($newDataArray);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="location_get_cityData")
{
  $location_get_cityData=get_cities(array("id"=>$_POST['id']));
  $newDataArray=array();
  foreach ($location_get_cityData['data'] as  $newvalue) 
  {
    $newDataArray=array("stateId"=>$newvalue['stateId'],"title"=>$newvalue['title'],"id"=>$newvalue['id']);
  }
  echo json_encode($newDataArray);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="location_get_cityData_by_stateid")
{
  $location_get_cityData=get_cities(array("stateId"=>$_POST['id']));
  $newDataArray=array();
  foreach ($location_get_cityData['data'] as  $newvalue) 
  {
    $newDataArray[]=array("stateId"=>$newvalue['stateId'],"title"=>$newvalue['title'],"id"=>$newvalue['id']);
  }
  echo json_encode($newDataArray);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="get_category_by_cityorloc_id")
{
  
  $cond = array();
  if($_POST['type']=='state')
  {
	$cond['stateId'] = $_POST['id'];
  }
  if($_POST['type']=='city')
  {
	  $cond['cityId'] = $_POST['id'];
  }
  $cond['status'] = '1';
  $getHotels = select_mongo('product',$cond,array());
  $getHotels = add_id($getHotels);
  $hotelCaltegory = array();
  foreach($getHotels as $getHotel)
  {
	  if(isset($getHotel['category']))
	  {
		  foreach($getHotel['category'] as $hCat)
		  {
			  $hotelCaltegory[] = $hCat;
		  }
	  }
  }
  $hotelCaltegory = array_unique($hotelCaltegory);
  $hotelCaltegory = array_values($hotelCaltegory);
  $finalHotelCatArr = array();
  foreach($hotelCaltegory as $hotelCatId)
  {
	  $finalHotelCatArr [] = new MongoId($hotelCatId);
  }
  
  $location_get_cityData=get_cities(array("stateId"=>$_POST['id']));
  $getData=select_mongo("productfeature",array('_id'=>array('$in'=>$finalHotelCatArr)),array());
  
  $categoryData=add_id($getData);
  $newDataArray=array();
  foreach ($categoryData as  $newvalue) 
  {
    $newDataArray[]=array("title"=>$newvalue['title'],"id"=>$newvalue['id']);
  }
  echo json_encode($newDataArray);
}




if(isset($_REQUEST['action']) && $_REQUEST['action']=="location_Latlng")
{
  $locationLatLng=getcoordinates(array("address"=>$_POST['address']));
  echo json_encode($locationLatLng);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="getmedia")
{
  $imageData=get_association_data("39","10","1",$_POST['iid']);
  echo json_encode($imageData);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="getviewmore")
{ 

   $id=(int) ($_POST['id']); 

   $getCategoriesData=get_categories(array('index'=>$id,'nor'=>2,'groupId'=>'587f04eca32974a8103c9869'));
  //pr($getCategoriesData); die;
  $data='';
  foreach ($getCategoriesData['data'] as $value) { $catId=array('category'=>array($value['id']));
    $data .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 categorybox">';
    $data .='<div class="cat_bx_E animated showing" onClick="window.location=\''.get_url('category').'?'.http_build_query($catId).'\'" data-effect="fadeInLeft">';
    $data .='<div class="tile_u" style="background-image: url(\''.$value['image'].'\');">';
    $data .='<div class="top-res-box-overlay"></div>';
    $data .='<div class="tile_u_name">';
    $data .='<h1 class="bar_name text-center">'.$value['title'].'</h1>';
    $data .='</div></div></div></div>';
  }
  echo $data;
}
?>
