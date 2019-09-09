<?php 
      include_once '../../../../../global.php';


$_POST['userId']=$_SESSION['user']['user_id'];
$_POST['smid']='2';
$_POST['status']='1';
$_POST['groupId']='587f0295a3297480103c9869';
$_POST['category']='';
$_POST['name']='amenities';
$cropimagedata=$_POST['hiddenCropData'];
$crpimagtype=$_POST['hiddenCropType'];
unset($_POST['hiddenCropData']);
unset($_POST['hiddenCropType']);

$manageProduct=manage_feature($_POST);

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
echo json_encode($manageProduct);

?>
