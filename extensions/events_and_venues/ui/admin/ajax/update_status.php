<?php
include_once '../../../../../global.php';
if(isset($_REQUEST['id']) && isset($_REQUEST['s']))
{
	$output=curl_post("/updatestatus",array("id"=>$_POST['id'],"status"=>$_POST['s']));
	echo json_encode($output);
}

?>