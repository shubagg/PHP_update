<?php
$basePath=dirname(dirname(__FILE__));

include("$basePath/global.php");
include('runCron.php');

$cron=new TeamCron('2');

?>
