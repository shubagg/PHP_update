<?php
include("../database.php");

$data=json_decode(stripcslashes($_POST['jsondata']),true);

$q="CREATE TABLE IF NOT EXISTS `triggers_$data[customer_id]` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `types` varchar(255) NOT NULL,
  `ctg_id` int(11) NOT NULL,
  `ctg_grp` int(11) NOT NULL,
  `crs_id` int(11) NOT NULL,
  `test_grp` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `all_users` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `others` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)";
mysql_query($q);

if($data['action']=="add")
{
     
    $str=stripcslashes("insert into triggers_$data[customer_id] (id,event_id,temp_id,subject,types,ctg_id,ctg_grp,crs_id,test_grp,test_id,others) values($data[id],$data[event_id],$data[temp_id],'$data[subject]','$data[types]','$data[ctg_id]','$data[ctg_grp]','$data[crs_id]','$data[test_grp]','$data[test_id]','$data[others]')");
    $ins_qry2=mysql_query($str);
   
    if(!$ins_qry2)
    {
        $err= mysql_error();
        $modulename="Trigger";
        $event="Add";
        $errorstring=$err;
        $timedate=date("Y-m-d h:i:s");
        $filename="email.php";
        $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
        
        $file=fopen("errorlogfile.txt","a");
        fwrite($file,"$data");
        fclose($file);
    }
}
else if($data['action']=="edit")
{
    
   
    $str=stripcslashes("update triggers_$data[customer_id] set event_id=$data[event_id],temp_id=$data[temp_id],subject='$data[subject]',types='$data[types]',ctg_id=$data[ctg_id],ctg_grp=$data[ctg_grp],crs_id=$data[crs_id],test_grp=$data[test_grp],test_id=$data[test_id],others='$data[others]' where id=$data[id]");
    $ins_qry2=mysql_query($str);
    if(!$ins_qry2)
    {
        $err= mysql_error();
        $modulename="Trigger";
        $event="Edit";
        $errorstring=$err;
        $timedate=date("Y-m-d h:i:s");
        $filename="email.php";
        $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
        
        $file=fopen("errorlogfile.txt","a");
        fwrite($file,"$data");
        fclose($file);
    }
}
else
{
    $str=stripcslashes("delete from triggers_$data[customer_id] where id in ($data[id])");
    $ins_qry2=mysql_query($str);
    if(!$ins_qry2)
    {
        $err= mysql_error();
        $modulename="Trigger";
        $event="delete";
        $errorstring=$err;
        $timedate=date("Y-m-d h:i:s");
        $filename="view_schedule_email.php";
        $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
        
        $file=fopen("errorlogfile.txt","a");
        fwrite($file,"$data");
        fclose($file);
    }
}
?>