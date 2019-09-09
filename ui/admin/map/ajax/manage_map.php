<?php
include_once ('../../../../global.php');
$action=$_REQUEST['action'];
if($action=='getNewTrackdata')
{
	$attdetail=curl_post("/get_user_tracking",array("mid"=>$_REQUEST['mid'],"smid"=>$_REQUEST['smid'],"iid"=>$_REQUEST['iid'],"userId"=>$_REQUEST['userId'],"fromDate"=>$_REQUEST['fromDate'],"toDate"=>$_REQUEST['toDate']));
	echo $attendence_map= json_encode($attdetail["data"]['userdata']);
}
?>