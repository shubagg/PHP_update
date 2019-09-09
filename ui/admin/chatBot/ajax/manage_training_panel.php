<?php 
include_once ('../../../../global.php');
if($_REQUEST['type']=="submitquestion"){
	$resp=manage_training_panel($_POST);
	echo json_encode($resp);
}
if($_REQUEST['type']=="train_request_send"){
	$url="http://192.168.1.12:500/postjson"; //http://192.168.1.16:300/postjson //http://teamerge.in:300/postjson 
	$postData=get_data_by_table(array("table"=>"chatbottraining"));
	$finalArray=array();
	foreach ($postData['data'] as $key => $value) {
		array_push($finalArray,array("id"=>$value['id'],"patterns"=>array($value['patterns']),"responses"=>array($value['responses']),"tag"=>$value['tag']));
	}
	$finalArrays['data']=$finalArray;
	$get_question=get_curl_cron_response($url,json_encode($finalArrays));
	$deletedId=json_decode($get_question,true);	
	if(!empty($deletedId)){
		$deleterecod=implode("|",$deletedId['tag']);
		$rep=delete_by_tablename(array("tablename"=>"chatbottraining","id"=>$deleterecod));
		echo json_encode($rep);
	}
	
}
?>