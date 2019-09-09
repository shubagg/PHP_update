<?php 
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
//echo "<pre>";
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
					    	$filename =$mediaName_5."_5.jpeg";
					    	draw_rectangle_on_image($site_url,$mediaName_5,$get_response->rec_coordinate,$filename);
					    	
					    	$res = insert_mongo('imageSearch',array('smid'=>$smid,'ass_id'=>$ass_id,'model'=>$get_response->car_model,"reading"=>$get_response->odo_data,"mediaId"=>$get_response->id,"media"=>$mediaName,"createdOn"=>new MongoDate()));
					    	$res1 = insert_mongo('imageSearch',array('rec_coordinate'=>$get_response->rec_coordinate,'smid'=>'5','ass_id'=>$ass_id,'model'=>$get_response->car_model,"reading"=>$get_response->odo_data,"mediaId"=>$id_5,"media"=>$filename,"createdOn"=>new MongoDate()));   
					        $resp=array("success"=>"true","data"=>$data,"error_code"=>"470104");
					    }
					}else{
						
						$resp=array("success"=>"false","data"=>$data,"error_code"=>"470103");
					}
					print_r($resp);
				}

		}
		
		
		
	}



	function draw_rectangle_on_image($site_url,$image,$rec_coordinate,$filename)
	{
		$mediaPath=$site_url."uploads/".COMPANY_ID."/media/images/".$image;
		$path =$_SERVER["DOCUMENT_ROOT"].'/uploads/'.COMPANY_ID.'/media/images/'.$image;
		
		$canvas = imagecreatefromjpeg($mediaPath);

		// Allocate colors
		$red = imagecolorallocate($canvas, 255, 0, 0);

		imagesetthickness($canvas, 3);
		// Draw three rectangles each with its own color
		foreach ($rec_coordinate as $key => $value) {
			//print_r($value);
			imagerectangle($canvas, $value->x1, $value->y1, $value->x2,$value->y2, $red);
		}
		// Output and free from memory
		//header('Content-Type: image/jpeg');

		imagejpeg($canvas,'media/'.$filename);
		imagedestroy($canvas);
	}
	
	

?>