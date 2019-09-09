<?php
include("../../../../../../includes/connection.php");

$data=json_decode($jsondata,true);
$jsondata=json_encode($data['json']);

$data ['status'] = "0";
$data['json'] = $jsondata;
$data['timestamp'] = time();

$res = insert_mongo("currentAction",$data,array());
//print_r($res);

/*global $notification_url;
$url = $notification_url."modules/notification/include/core/ntfc/ws/email_action.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
"jsondata=".$jsondata."");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo $server_output = curl_exec ($ch);
curl_close ($ch);

*/

/*$data=json_decode($jsondata,true);
$jsondata=json_encode($data['json']);
$str=stripcslashes("insert into current_action (customer_id,event_id,module_id,user_id,uid2,ctg_id,uid3,strt_date,uid4,status,json,servername) values('$data[customer_id]','$data[event_id]','$data[module_id]','$data[user_id]','$data[uid2]','$data[ctg_id]','$data[uid3]','','$data[uid4]',0,'$jsondata','$data[servername]')");
    $ins_qry2=mysql_query($str);
    if(!$ins_qry2)
    {
        echo $err= mysql_error();
        $modulename="Action";
        $event="Add";
        $errorstring=$err;
        $timedate=date("Y-m-d h:i:s");
        $filename="action.php";
        $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
        
        $file=fopen("errorlogfile.txt","a");
        fwrite($file,"$data");
        fclose($file);
    }*/
?>
