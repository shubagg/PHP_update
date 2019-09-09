<?php
header('Access-Control-Allow-Origin: *'); 
include("../database.php");

//$data=json_decode(stripcslashes($_POST['jsondata']),true);
//$data=json_decode(str_replace("\\",'',trim($_POST['jsondata'])),true);

$tm=time();

$str=stripcslashes("update notification_$_POST[customer_id] set seen=1 where uid1=$_POST[userid]");

$ins_qry2=mysql_query($str);
if(!$ins_qry2)
{
    $err= mysql_error();
    $modulename="Notification";
    $event="update";
    $errorstring=$err;
    $timedate=date("Y-m-d h:i:s");
    $filename="update_notification.php";
    $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
    
    $file=fopen("errorlogfile.txt","a");
    fwrite($file,"$data");
    fclose($file);
}



?>

