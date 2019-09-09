<?php
include_once '../../../../../global.php';
$user_ids=implode("|",explode(",",$_POST['user_ids']));
$output=curl_post("/delete_product",array("id"=>$user_ids,"delete"=>"1"));
echo json_encode($output);
?>