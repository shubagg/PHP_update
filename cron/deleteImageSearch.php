<?php 
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
echo "<pre>";
$mediaPath=$site_url."uploads/".COMPANY_ID."/media/images";
//$mediaInfo=select_limit_mongo("media",array("aiid"=>"3333","smid"=>"1","ScanStatus"=>array('$exists'=>false)),array("mediaName","extension","ass_id","smid"),0,1);
$mediaInfo=select_mongo("media",array("aiid"=>"3333","smid"=>"1","ScanStatus"=>array('$exists'=>false)),array("mediaName","extension","ass_id","smid"));

$mediaInfo=add_id($mediaInfo,"id"); 

	$mediaName="";
	$ass_id ="";
	$smid ="";
	if(sizeof($mediaInfo)>0){
		
		foreach ($mediaInfo as $key => $value) {
				$mediaArray=array();
				$mediaArray['image_url'][]=$mediaPath."/".$value['mediaName'];
				$mediaArray['id']=$value['id'];
				$mediaName=$value['mediaName'];
				$ass_id =$value['ass_id'];
				$smid =$value['smid'];
				$mediaName_5 ='N/A';
				$id_5 ='N/A';
				$output = select_mongo('media',array('smid'=>'5','ass_id'=>$ass_id));
            	$reso = add_id($output,"id");
            	if(!empty($reso[0]) && count($reso[0])>0)
            	{
            		 $mediaArray['image_url_5'][]=$mediaPath."/".$reso[0]['mediaName'];
            		 $mediaName_5 = $reso[0]['mediaName'];
            		 $id_5=$reso[0]['id'];
            		 print_r($mediaArray);

            	}
            	else
            	{
            		$condition=array('_id' =>new MongoId($value['id']));
            		$response=delete_mongo('imageSearch', $condition);
            		print_r($response);
            		
            	}
    
		}
		
		
		
	}



	
	

?>