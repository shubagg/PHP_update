<?php 
      include_once '../../../../../global.php';


//$_POST['userId']=$_SESSION['user']['user_id'];
$_POST['smid']='2';
$_POST['status']='1';
$_POST['basePrice']=intval($_POST['basePrice']);
$_POST['capacity']=intval($_POST['capacity']);
$mediaid=$_POST['mediaid'];
unset($_POST['mediaid']);
$cropimagedata=$_POST['hiddenCropData'];
$crpimagtype=$_POST['hiddenCropType'];
unset($_POST['hiddenCropData']);
unset($_POST['hiddenCropType']);
$_POST['location']=array(floatval($_POST['lng']),floatval($_POST['lat']));


$userData = array('email'=>time()."@demo.com",'phone'=>$_POST['phone'],'name'=>$_POST['title'],'category'=>'5a4239dd281cda4d60a5777f','role'=>'5a3cdb4a281cda081ccb4aab','username'=>time()."@demo.com",'deviceToken'=>'','deviceId'=>'','login_type'=>'normal','status'=>'1','user_type'=>'hotel','password'=>'123456','booking_req_email'=>$_POST['booking_req_email'],'hotelUserId'=>$_POST['hotelUserId']);




if(isset($_POST['userId']) && !empty($_POST['userId']))
{
  $userData['id'] = $_POST['userId'];
}
else
{
  $userData['id'] = 0;
}

$manageProduct = array();
$userRestult =  manage_user($userData);
//echo "<pre>"; print_r($userRestult); die;
if($userRestult['success']=='true')
{
  $_POST['userId'] = $userRestult['data'];
  $manageProduct=manage_product($_POST);
  if($_FILES['product_image']['name']!="")
  {
      delete_previous_media(array('amid'=>'16',"asmid"=>'1',"aiid"=>$manageProduct['data']));
     if($cropimagedata!="" && $crpimagtype!="")
      {
        
        $mediaData=array('id'=>"0",'smid'=>'1','amid'=>"16",'asmid'=>"1",'aiid'=>$manageProduct['data'],'mediaName'=>"cropimageC",'mediaType'=>"image",'cropimageC'=>$cropimagedata,'base64enc'=>'1','extension'=>$crpimagtype,'multimedia'=>"0");
        $outputs=manage_media($mediaData); 

      }
      else
      {
          $mediaData=array('id'=>'0','smid'=>'1','amid'=>'16','asmid'=>'1','aiid'=>$manageProduct['data'],'mediaName'=>'product_image','mediaType'=>'image','multimedia'=>"0");
          $manage_media=manage_media($mediaData);
      }
  }
  if(!empty($mediaid))
  {
    foreach ($mediaid as $value) 
    {
      $mediaData=gettempmedia(array("id"=>$value));
      if (!empty($mediaData['data'])) {
        $mediaData['data'][0]['aiid']=$manageProduct['data'];
        movetempmedia($mediaData['data'][0]);
      }
    }
  }
}

echo json_encode($manageProduct);

?>
