<?php
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
global $con;
logger("5","Local Cron Start","",5,"/sync_job_in_local");
$currentDate=date("Y-m-d H:i:s");
$get_jobs=mysqli_query($con,"SELECT j.id,j.title,ja.status,j.form_id,j.form_data FROM job j, jobassignedstatus ja WHERE j.id=ja.iid and ja.status=2 and j.id not in(select job_id from job_sync)");
$response=array('success'=>'true','data'=>'ok','error_code'=>'100');
$totalRecords=mysqli_num_rows($get_jobs);


while($fet_jobs=mysqli_fetch_assoc($get_jobs))
{
	//echo "<pre>"; print_r($fet_jobs); die;
	$insert_job_in_temp=mysqli_query($con,"insert into job_sync (job_id,date_of_sync,status) VALUES('".$fet_jobs['id']."','".$currentDate."',0)");
	if(!$insert_job_in_temp){
			$logger_array1=array('type'=>'error','query'=>"insert into job_sync (job_id,date_of_sync,status) VALUES('".$fet_jobs['id']."','".$currentDate."',0)");
			logger("5",json_encode($logger_array1),"",5,"/sync_job_in_local");
			$response['success']='false';
		}
		else
		{
			$logger_array1=array('type'=>'success','query'=>"insert into job_sync (job_id,date_of_sync,status) VALUES('".$fet_jobs['id']."','".$currentDate."',0)");
			logger("5",json_encode($logger_array1),"",5,"/sync_job_in_local");
		}
	$formStructure = select_mongo('form',array('_id'=> new MongoId($fet_jobs['form_id'])),array());
	$formStructure = add_id($formStructure);
	$formStructure = $formStructure[0];
	$formString = $formStructure['strings']['en'];
	//echo "<pre>"; print_r($formString); die('ts');
	$formData = json_decode($fet_jobs['form_data'],true);
	$media=select_mongo('media',array('aiid'=>$fet_jobs['id']),array());
	$media=add_id($media);
	//echo "<pre>"; print_r($media); die;
	foreach($media as $md){


		if($md['mediaType']!='image')
		{
			continue;
		}
		$get_String = getFormString('image',$md['id'],$md['l_id']);
		if($get_String=='')
		{
			continue;
		}
		
	/*	echo "<pre>"; print_r($md);
		echo $get_String; die;*/
		$get_String = $get_String .'.'.$md['type'];
		
		$addMedia=mysqli_query($con,"insert into job_media_sync (job_id,media_id,status,mediaName) VALUES('".$fet_jobs['id']."','".$md['id']."',0,'".$get_String."')");
		if(!$addMedia){
			$logger_array2=array('type'=>'error','query'=>"insert into job_media_sync (job_id,media_id,status) VALUES('".$fet_jobs['id']."','".$md['id']."',0)");
			logger("5",json_encode($logger_array2),"",5,"/sync_job_in_local");
			$response['success']='false';
		}
		else
		{
			$logger_array2=array('type'=>'success','query'=>"insert into job_media_sync (job_id,media_id,status) VALUES('".$fet_jobs['id']."','".$md['id']."',0)");
			logger("5",json_encode($logger_array2),"",5,"/sync_job_in_local");
		}
	}

}
die;
if($totalRecords==0)
{
	echo "2";
}
else
{
	if($response['success']=='false'){
		echo "0";
	}else{
		echo "1";
	}
}

function getFormString($type,$id,$lid)
{

	global $formData;
	foreach($formData as $fdata){

	if($type==$fdata['type']){
		$count = 0;
		foreach ($fdata['fields'] as $feildkey => $feildvalue) {
			if(isset($feildvalue['mediaId']) && ($feildvalue['mediaId']==$id))
			{
				
				$string = get_stringID($fdata['id']);
				$count = $feildkey+1;
				return $string.'-'.$count;
			}
			else if(isset($feildvalue['l_id']) && ($feildvalue['l_id']=="$lid"))
			{
				
				$string = get_stringID($fdata['id']);
				$count = $feildkey+1;
				return $string.'-'.$count;
			}	
		}	
			
	}
}
	return null;
}
function get_stringID($id){
	global $formStructure,$formString;
	
	foreach($formStructure['field'] as $fdata){
		
		if($id==$fdata['id']){
			$string = trim($formString[$fdata['title']],"*");
			return $string;
		}
	}
	return null;
}
?>