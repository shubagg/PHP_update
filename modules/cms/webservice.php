<?php
// old web services
$app->post('/cms_pg', 'add_cms_pg');
$app->post('/cms_pg_list', 'cms_pg_listing');
$app->post('/cms_pg_data', 'cms_pg_data');
$app->post('/cms_pg_status', 'cms_page_staus');
$app->post('/cms_pg_delete', 'cms_page_delete');

$app->post('/get_pg_by_id', 'get_page_by_id');
$app->post('/get_pg_by_name', 'get_page_by_name');

$app->post('/check_pg_name', 'check_cms_pg_name');
$app->post('/check_pg_url', 'check_cms_pg_url');

// new web services
$app->post('/manage_cms', 'cms_webservice_manage_cms');
$app->post('/get_cms_by_id', 'cms_webservice_get_cms_by_id');
$app->post('/get_cms_by_slug', 'cms_webservice_get_cms_by_slug');
$app->post('/delete_cms', 'cms_webservice_delete_cms');

// press web services
$app->post('/manage_press', 'cms_webservice_manage_press');
$app->post('/get_press_by_id', 'cms_webservice_get_press_by_id');
$app->post('/delete_press', 'cms_webservice_delete_press');

// Breaking news web services
$app->post('/manage_bn', 'cms_webservice_manage_bn');
$app->post('/get_bn_by_id', 'cms_webservice_get_bn_by_id');
$app->post('/delete_bn', 'cms_webservice_delete_bn');

// team web services
$app->post('/manage_team', 'cms_webservice_manage_team');
$app->post('/get_team_by_id', 'cms_webservice_get_team_by_id');
$app->post('/delete_team', 'cms_webservice_delete_team');

//RPA..

$app->post('/run_robot', 'cms_webservice_run_robot');
$app->post('/stop_robot', 'cms_webservice_stop_robot');
$app->post('/check_robot_to_run', 'cms_webservice_check_robot_to_run');
$app->post('/run_popup_user', 'cms_webservice_run_popup_user');
$app->post('/copy_data', 'cms_webservice_copy_data');
$app->post('/manage_training_panel', 'cms_webservice_manage_training_panel');
$app->post('/run_invoice_status', 'cms_webservice_run_invoice_status');
$app->post('/add_robot', 'cms_webservice_add_robot');
$app->post('/manage_schedule_robot', 'cms_webservice_manage_schedule_robot');
$app->post('/getschedulebyid', 'cms_webservice_getschedulebyid');
$app->post('/add_dashboard_data', 'cms_webservice_add_dashboard_data');


/* * ***************** New Webservices for Nikky ************************* */

$app->post('/run', 'cms_webservice_run');
$app->post('/get_all_robot_list', 'cms_webservice_get_all_robot_list');
$app->post('/schedule', 'cms_webservice_schedule');
$app->post('/get_all_template_list', 'cms_webservice_get_all_template_list');
$app->post('/template_export', 'cms_webservice_template_export');
$app->post('/template_import', 'cms_webservice_template_import');
$app->post('/getbytablename', 'cms_webservice_getbytablename');

//nikky charts webservice
$app->post('/rpa_robot_start_to_stop_time', 'webservice_rpa_robot_start_to_stop_time');
$app->post('/getTaskListData', 'webservice_getTaskListData');
$app->post('/get_schedule_chart', 'cms_webservice_get_schedule_chart');
$app->post('/get_robot_by_id', 'cms_webservice_get_robot_by_id');
$app->post('/get_task_done_fail_status', 'cms_webservice_get_task_done_fail_status');
$app->post('/rpa_robot_run_count', 'cms_webservice_rpa_robot_run_count');
$app->post('/getrobotdata', 'cms_webservice_getrobotdata');
$app->post('/decode_export_data', 'cms_webservice_decode_export_data');
$app->post('/add_fetch_queue_data', 'cms_webservice_add_fetch_queue_data');
$app->post('/get_template_list', 'cms_webservice_get_template_list');
// inventory webservice
$app->post('/inventory', 'cms_webservice_inventory');
?>

