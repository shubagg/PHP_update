<?php
echo $path=$_SERVER["DOCUMENT_ROOT"]."/global.php";
include($path);


$lastdate = date("Y-m-d",strtotime('today - 1 days'))." 23:59";
$ctime = strtotime($lastdate);
$lastdate =  new MongoDate(strtotime($lastdate));
$cond = array('createdOn'=>array('$lt'=>$lastdate),'status'=>"1");
$getRecords = delete_mongo("toSend",$cond);

/*$getRecords = select_mongo("toSend",$cond,array());
$getRecords = add_id($getRecords,'id');
print_r($getRecords);
die;*/

$cond = array('timestamp'=>array('$lt'=>$ctime));
$getRecords = delete_mongo("currentAction",$cond);



$lastdate = date("Y-m-d",strtotime('today - 30 days'))." 23:59";
$lastdate =  new MongoDate(strtotime($lastdate));
$cond = array('ms'=>array('$lt'=>$lastdate));
$getRecords = delete_mongo("notification",$cond);
?>
