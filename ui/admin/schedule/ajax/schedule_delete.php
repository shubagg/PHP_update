<?php 
include_once '../../../../global.php';
$scheduleId=$_REQUEST[id];
if(isset($scheduleId))
	{
        $data=delete_mongo('schedule',array('_id'=>new MongoId($scheduleId)));

        $res =  array("success"=>"true","data"=>$scheduleId,"error_code"=>"16000");
        echo json_encode($res);
    }
    else{
        $res = array("success"=>"false","data"=>$scheduleId,"error_code"=>"16000");
        echo json_encode($res);
    }
    
?>