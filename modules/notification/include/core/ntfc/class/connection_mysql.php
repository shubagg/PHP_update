<?php
if( $_SERVER['HTTP_HOST'] != 'localhost'){
$link2 = mysql_connect("127.0.0.1","root","",true) or die('Could not connect: ' . mysql_error());
mysql_select_db("teammerge",$link2 ) or die ('Can\'t use vickys : ' . mysql_error());

}else{
$db_connect = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
mysql_select_db('teammerge') or die ('Can\'t use ways : ' . mysql_error());
}
?>