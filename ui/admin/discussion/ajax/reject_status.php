<?php
include_once '../../../../global.php';

$question_id=$_POST['user_id'];
$user_id=$_SESSION['user']["user_id"];
$output=curl_post("/manage_forum",array('id'=>$question_id,'question'=>'','answer'=>$answer,'userId'=>'','answeredBy'=>$user_id,"status"=>"2"));
echo json_encode($output);
?>