<?php
include_once '../../../../global.php';
$user_ids=implode("|",explode(",",$_POST['user_ids']));
$output=curl_post("/delete_contact",array("id"=>$user_ids));
echo json_encode($output);
?>