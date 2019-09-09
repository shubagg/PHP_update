<?php
include("../../../../../../includes/connection.php");


$jsondata = $_REQUEST['jsondata'];
$data=json_decode($jsondata,true);
$jsondata=json_encode($data['json']);

$data ['status'] = "0";
$data['json'] = $jsondata;
$data['timestamp'] = time();

$res = $db->currentAction->insert($data);
?>