<?php
include("../database.php");
$arr=array();
$tm=time();


$str="select n.id,n.string_id as sid,n.moduleid as mid,n.eventid as eid,n.uid2 as u2,n.uid3 as u3,n.uid4 as u4,n.ms,s.txt as t from notification_$_POST[customer_id] n LEFT JOIN strings s ON s.id=n.string_id where n.uid1=$_POST[userid] and n.status=0 and n.download=0 order by n.id desc";
$i=0;
//echo  $str;
$sel=mysql_query($str);
if(mysql_num_rows($sel)>0)
{
    while($row=mysql_fetch_object($sel))
    {
       // mysql_query("update notification_$_POST[customer_id] set download=1 where id=$row->id");
       if($row->u4==0)
       {
            $row->u4="";
       }
       if($row->u3==0)
       {
            $row->u3="";
       }
       
       $arr[$i]['id']=$row->id;
       $arr[$i]['sid']=$row->sid;
       $arr[$i]['mid']=$row->mid; 
       $arr[$i]['eid']=$row->eid; 
       $arr[$i]['u2']=$row->u2; 
       $arr[$i]['u3']=$row->u3; 
       $arr[$i]['u4']=$row->u4;
       $arr[$i]['ms']=$row->ms;  
       $arr[$i]['t']=$row->t; 
       $i++;         
    }
    echo json_encode($arr);
}
else
{
    echo json_encode(array("success"=>"false"));
}


?>