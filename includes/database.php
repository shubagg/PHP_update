<?php
//error_reporting(0);
$link2 = mysql_connect("127.0.0.1","root","") or die('Could not connect: ' . mysql_error());
        mysql_select_db("pyksaas_pyk_43",$link2 ) or die ('Can\'t use vickys : ' . mysql_error());

$checkpassword=mysql_query("select enc_pwd from user_$_COOKIE[customer_id] where id=$_COOKIE[id] ");
$fetchpassword=mysql_fetch_object($checkpassword);
/*
if(base64_decode($fetchpassword->enc_pwd)!=$_COOKIE['password'])
{
    ?> <script>window.location="index.php";</script> <?php
}*/
?>