<?php
include_once '../../../../global.php';
include_once(server_path() . 'controller/process_sla.php');
$sla_class->sla_cron_job();
?>
