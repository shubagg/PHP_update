
<?php
//@session_start();
if( $_SERVER['HTTP_HOST'] != 'localhost:81'){
$link = mysql_connect("localhost","xeliumin_test","8f%QTsE5cSLi") or die('Could not connect: ' . mysql_error());
mysql_select_db('xeliumin_app_store_test',$link ) or die ('Can\'t use vickys : ' . mysql_error());
}else{
$db_connect = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
mysql_select_db('aptoid') or die ('Can\'t use ways : ' . mysql_error());
}

//error_reporting(0);
date_default_timezone_set("Asia/Calcutta"); 
?>