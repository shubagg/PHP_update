<?php

/***********Aintu webservices****************/
$app->post('/create_extension_form_job','webservice_create_extension_form_job');
$app->post('/get_extension_all_jobs','webservice_extension_all_jobs');
$app->post('/extension_approval_process','webservice_extension_approval_process');
$app->post('/extensionjob_approval_done_process','webservice_extensionjob_approval_done_process');

$app->post('/ex_fetch_collection','webservice_ex_fetch_collection');
$app->post('/ex_drop_collection','webservice_ex_drop_collection');
$app->post('/manageAppLogs','webservice_ex_manageAppLogs');


?>