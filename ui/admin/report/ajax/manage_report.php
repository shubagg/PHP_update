<?php
include_once '../../../../global.php';


if($_REQUEST['action']=="getrecord")
{

	$wsname=$_REQUEST['webserviceName'];
	$params =  json_decode($_REQUEST['params'],true);


   $record_report = $wsname($params);
   echo json_encode($record_report['data']);
}

if($_REQUEST['action']=="get_report_data")
{


   	$mid = $_REQUEST['mid'];
   	$smid = $_REQUEST['smid'];
      $report_id = $_REQUEST['report_id'];
   	$userId = $_REQUEST['userId'];

   	unset($_REQUEST['mid']);
   	unset($_REQUEST['smid']);
   	unset($_REQUEST['userId']);
      unset($_REQUEST['report_id']);
   	unset($_REQUEST['action']);
   	$jsonArr = json_encode($_REQUEST);
   	$getdata = get_report_data(array("mid"=>$mid,"smid"=>$smid,"userId"=>$userId,"report_id"=>$report_id,"jsonArr"=>$jsonArr));
   	echo json_encode($getdata);
}


?>
