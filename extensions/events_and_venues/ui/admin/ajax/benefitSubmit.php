<?php 
include_once '../../../../../global.php';

$_POST['userId']=$_SESSION['user']['user_id'];
$_POST['smid']='1';
$_POST['status']='1';

if($_POST['id']=="")
{
  $_POST['id']='0';
}
$cropimagedata=$_POST['hiddenCropData'];
$crpimagtype=$_POST['hiddenCropType'];
unset($_POST['hiddenCropData']);
unset($_POST['hiddenCropType']);


$manageProduct=manage_benefit($_POST);

if($_FILES['product_image']['name'])
{
   if($cropimagedata!="" && $crpimagtype!="")
    {
      
      $mediaData=array('id'=>"0",'smid'=>'1','amid'=>"24",'asmid'=>"1",'aiid'=>$manageProduct['data'],'mediaName'=>"cropimageC",'mediaType'=>"image",'cropimageC'=>$cropimagedata,'base64enc'=>'1','extension'=>$crpimagtype,'multimedia'=>"0");
      $outputs=manage_media($mediaData); 

    }
    else
    {
        $mediaData=array('id'=>'0','smid'=>'1','amid'=>'24','asmid'=>'1','aiid'=>$manageProduct['data'],'mediaName'=>'product_image','mediaType'=>'image','multimedia'=>"0");
        $manage_media=manage_media($mediaData);
    }
}
echo json_encode($manageProduct);


?>
