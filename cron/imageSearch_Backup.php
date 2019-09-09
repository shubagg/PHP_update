<?php 
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
$mediaPath=$site_url."uploads/28/media/images";
//$mediaInfo=select_mongo("media",array("aiid"=>"3333"),array("mediaName","extension"));
$mediaInfo=select_limit_mongo("media",array("aiid"=>"3333","ScanStatus"=>array('$exists'=>false)),array("mediaName","extension","ass_id","smid"),0,1);

$mediaInfo=add_id($mediaInfo,"id"); 
	$mediaName="";
	$ass_id ="";
	$smid ="";
	if(sizeof($mediaInfo)>0){
		$mediaArray=array();
		foreach ($mediaInfo as $key => $value) {
				$mediaArray['image_url'][]=$mediaPath."/".$value['mediaName'];
				$mediaArray['id']=$value['id'];
				$mediaName=$value['mediaName'];
				$ass_id =$value['ass_id'];
				$smid =$value['smid'];
		}
		if(sizeof($mediaArray)>0){
			$mediaArray= json_encode($mediaArray);
			$sendingUrl="http://192.168.1.12:400/reading_check";
			$res=get_curl_cron_response($sendingUrl,$mediaArray);		
			
			$get_response=json_decode($res);
			if(sizeof($get_response)>0){ 
				
				$res = update_mongo('media',array("ScanStatus"=>"1"),array('_id'=>new MongoId($get_response->id)));
			    if($res['n']==0)
			    {
			        $resp=array("success"=>"false","data"=>$data,"error_code"=>"470103");
			    }
			    else
			    {   

			    	$res = insert_mongo('imageSearch',array('smid'=>$smid,'ass_id'=>$ass_id,'model'=>$get_response->car_model,"reading"=>$get_response->odo_data,"mediaId"=>$get_response->id,"media"=>$mediaName,"createdOn"=>new MongoDate()));   
			        $resp=array("success"=>"true","data"=>$data,"error_code"=>"470104");
			    }
			}else{
				
				$resp=array("success"=>"false","data"=>$data,"error_code"=>"470103");
			}
			print_r($resp);
		}
		
	}
	

?>