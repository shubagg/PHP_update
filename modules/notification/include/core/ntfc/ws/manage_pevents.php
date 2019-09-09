<?php
include("../database.php");

$data=json_decode(str_replace("\\",'',trim($_POST['jsondata'])),true);

$jsondata=json_encode($data['json']);

$check=mysql_query("select event_id from cron_action where event_id=$data[event_id] and customer_id=$data[customer_id]");
if(mysql_num_rows($check)>0)
{
    $str=stripcslashes("update cron_action set json='$jsondata' where event_id=$data[event_id] and customer_id=$data[customer_id]");
}
else
{
    $str=stripcslashes("insert into cron_action (customer_id,event_id,user_id,crs_id,ctg_id,job_id,strt_date,test_id,status,json,servername) values('$data[customer_id]','$data[event_id]','$data[user_id]','$data[crs_id]','$data[ctg_id]','$data[job_id]','','$data[test_id]',0,'$jsondata','$data[servername]')");
}


    $ins_qry2=mysql_query($str);
    if(!$ins_qry2)
    {
        $err= mysql_error();
        $modulename="Action";
        $event="Add";
        $errorstring=$err;
        $timedate=date("Y-m-d h:i:s");
        $filename="action.php";
        $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
        
        $file=fopen("errorlogfile.txt","a");
        fwrite($file,"$data");
        fclose($file);
    }



?>