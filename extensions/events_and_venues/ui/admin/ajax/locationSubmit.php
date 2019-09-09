<?php include_once '../../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']=="addstate")
{


	$cropimagedata=$_POST['hiddenCropData'];
	$crpimagtype=$_POST['hiddenCropType'];
	unset($_POST['hiddenCropData']);
	unset($_POST['hiddenCropType']);
	unset($_REQUEST['action']);
	$_POST['countryId']='101';

	$manage_states=manage_states($_POST); 
	
	if($_FILES['product_image']['name']!="")
	{
		$res=delete_previous_media(array('amid'=>'11',"asmid"=>'1',"aiid"=>$manage_states['data']));
	   if($cropimagedata!="" && $crpimagtype!="")
	    {
	      
	      $mediaData=array('id'=>"0",'smid'=>'1','amid'=>"11",'asmid'=>"1",'aiid'=>$manage_states['data'],'mediaName'=>"cropimageC",'mediaType'=>"image",'cropimageC'=>$cropimagedata,'base64enc'=>'1','extension'=>$crpimagtype,'multimedia'=>"0");
	      $manage_media=manage_media($mediaData); 

	    }
	    else
	    {
	        $mediaData=array('id'=>'0','smid'=>'1','amid'=>'11','asmid'=>'1','aiid'=>$manage_states['data'],'mediaName'=>'product_image','mediaType'=>'image','multimedia'=>"0");
	        $manage_media=manage_media($mediaData);
	    }
	}
	echo json_encode($manage_states);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="addcity")
{
	unset($_REQUEST['action']);
	$manage_states=manage_city($_POST);
	echo json_encode($manage_states);	
}


?>
