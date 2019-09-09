<?php
include("../database.php");

//$data=json_decode(stripcslashes($_POST['jsondata']),true);
$data=json_decode(str_replace("\\",'',trim($_POST['jsondata'])),true);
$arr=array();
$tm=time();
if($data['type']=="desk")
{
    $str=stripcslashes("select * from notification_$data[customer_id] where uid1=$data[userid] and status=0 and seen=0 order by id desc");
}
else
{
    $str=stripcslashes("select id,string_id,moduleid,eventid,uid1,uid2,uid3,uid4,uid5 from notification_$data[customer_id] where uid1=$data[userid] and status=0 and download=0 order by id desc");
}

$sel=mysql_query($str);
while($row=mysql_fetch_object($sel))
{
    array_push($arr,$row);
}
echo json_encode($arr);
?>