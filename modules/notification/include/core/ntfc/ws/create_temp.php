<?php
include("../database.php");
//$data=json_decode($_POST['jsondata'],true);
$q="CREATE TABLE IF NOT EXISTS `mail_template_$_POST[customer_id]` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_name` varchar(255) NOT NULL,
  `temp_desc` text NOT NULL,
  `created_at` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)";
mysql_query($q);

if($_POST['action']=="add")
{
    $field=explode("(",$_POST['fields'],2);
    $fields=$field[0]."(id,".$field[1];
    
    
    $value=explode(",",$_POST['values']);
    $val1=substr($value[0],1);
    
    
    $str=stripcslashes("insert into mail_template_$_POST[customer_id] (id,temp_name,temp_desc,created_at,status) values($_POST[id],$val1,$value[1],$value[2],'1')");
    $ins_qry2=mysql_query($str);
    if(!$ins_qry2)
    {
        $err= mysql_error();
        $modulename="Template";
        $event="Add";
        $errorstring=$err;
        $timedate=date("Y-m-d h:i:s");
        $filename="create_temp.php";
        $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
        
        $file=fopen("errorlogfile.txt","a");
        fwrite($file,"$data");
        fclose($file);
    }
}
else if($_POST['action']=="edit")
{
    $str=stripcslashes("update mail_template_$_POST[customer_id] set temp_desc='$_POST[temp_desc]',temp_name='$_POST[temp_name]' where id=$_POST[id]");
    $ins_qry2=mysql_query($str);
    if(!$ins_qry2)
    {
        $err= mysql_error();
        $modulename="Template";
        $event="Edit";
        $errorstring=$err;
        $timedate=date("Y-m-d h:i:s");
        $filename="create_temp.php";
        $data="\n".$modulename."\t".$event."\t".$timedate."\t".$filename."\t".$errorstring;
        
        $file=fopen("errorlogfile.txt","a");
        fwrite($file,"$data");
        fclose($file);
    }
}
else
{
    $str=stripcslashes("delete from mail_template_$_POST[customer_id] where id in ($_POST[id])");
    $ins_qry2=mysql_query($str);
}



?>