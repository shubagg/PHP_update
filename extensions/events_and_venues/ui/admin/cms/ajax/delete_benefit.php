<?php
include_once '../../../../../../global.php'; 
$user_ids=$_POST['user_ids'];
$output=delete_benefit(array("id"=>$user_ids));
echo json_encode($output);
?>