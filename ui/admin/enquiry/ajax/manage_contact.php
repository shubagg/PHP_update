<?php
include_once '../../../../global.php';


if($_REQUEST['action']=="contact")
{
	 $contact_id=$_REQUEST['id'];
	// $user_ids=implode("|",explode(",",$_POST['id']));
	 $output=curl_post("/delete_contact",array("id"=>$contact_id));
	 echo "1";
}



?>
