<?php 
      include_once '../../../../../global.php';

$cropimagedata=$_POST['hiddenCropData1'];
$crpimagtype=$_POST['hiddenCropType1'];
if($_FILES['banner_image']['name']!="")
{
   if($cropimagedata!="" && $crpimagtype!="")
    {
      
      $mediaData=array('id'=>"0",'smid'=>'1','amid'=>"39",'asmid'=>"1",'aiid'=>'','mediaName'=>"cropimageC",'mediaType'=>"image",'cropimageC'=>$cropimagedata,'base64enc'=>'1','extension'=>$crpimagtype,'multimedia'=>"0");
      $manage_media=manage_media_temp($mediaData); 

    }
    else
    {
        $mediaData=array('id'=>'0','smid'=>'1','amid'=>'39','asmid'=>'1','aiid'=>'','mediaName'=>'banner_image','mediaType'=>'image','multimedia'=>"0");
        $manage_media=manage_media_temp($mediaData);
    }
}
echo json_encode($manage_media);

?>
