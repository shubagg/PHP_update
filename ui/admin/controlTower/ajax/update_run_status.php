<?php
include_once '../../../../global.php';
$asid = $_POST['asid'];
$output= stop_robot(array('id'=>$asid,'status'=>"1"));
echo json_encode($output);
?>