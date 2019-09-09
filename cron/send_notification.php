<?php
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
include('runCron.php');

$action="";
if(isset($_POST['action']))
{
	$action=$_POST['action'];
}

$cron=new TeamCron('1',$action);
print_r($cron);

?>
