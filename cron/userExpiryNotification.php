<?php
include("../global.php");

$panel_expire1=strtotime(date("Y-m-d", time()) . " +10 days");

$start = new MongoDate();
$end = new MongoDate($panel_expire1);
$getUsersetting = select_mongo("user",array('panel_expire'=>array('$gte'=>$start,'$lt'=>$end)));
$getUsersetting = add_id($getUsersetting);

//echo "<pre>";
//print_r($getUsersetting);
foreach ($getUsersetting as $value) {
    
		
		echo $value['panel_expire']['sec'];
		echo "<br>";
	

	}
?>