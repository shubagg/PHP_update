<?php
include_once '../../../../global.php';

$cropimagedata=$_POST['hiddenCropData'];
$crpimagtype=$_POST['hiddenCropType'];
unset($_POST['hiddenCropData']);
unset($_POST['hiddenCropType']);

$manageCategory=manage_product_category($_POST);
if($_FILES['product_image']['name'])
{

	 if($cropimagedata!="" && $crpimagtype!="")
    {
      
      $mediaData=array('id'=>"0",'smid'=>'1','amid'=>"16",'asmid'=>"1",'aiid'=>$manageCategory['data'],'mediaName'=>"cropimageC",'mediaType'=>"image",'cropimageC'=>$cropimagedata,'base64enc'=>'1','extension'=>$crpimagtype,'multimedia'=>"0");
      $manage_media=manage_media($mediaData); 

    }
    else
    {
      
		$mediaData=array('id'=>'0','smid'=>'1','amid'=>'16','asmid'=>'1','aiid'=>$manageCategory['data'],'mediaName'=>'product_image','mediaType'=>'image','multimedia'=>"0");
		$manage_media=manage_media($mediaData);
    }

	
}
echo json_encode($manageCategory);
?>