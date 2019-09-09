<?php
include_once '../../../../global.php';


if($_REQUEST['action']=="contact")
{
	 $contact_id=$_REQUEST['data_id'];
	 $output=curl_post("/delete_email",array("id"=>$contact_id));
	 echo "1";
}



?>
