<?php
//others
$app->post('/insert_notification', 'notification_webservice_insert_notification');
$app->post('/send_notification', 'notification_webservice_send_notification');
$app->post('/send_ios_notification', 'notification_webservice_send_ios_notification');
$app->post('/send_push_on_device', 'notification_webservice_send_push_on_device');
$app->post('/send_broadcast_notification', 'notification_webservice_send_broadcast_notification');
$app->post('/get_modules', 'notification_webservice_get_modules');
$app->post('/get_events', 'notification_webservice_get_events');
$app->post('/get_fields', 'notification_webservice_get_fields');
$app->post('/get_notification_by_id', 'notification_webservice_get_notification_by_id');
$app->post('/get_strings_by_id', 'notification_webservice_get_strings_by_id');

$app->post('/update_notification', 'notification_webservice_update_notification');
$app->post('/manage_notification', 'notification_webservice_manage_notification');
$app->post('/clear_notification', 'notification_webservice_clear_notification');
$app->post('/count_notification', 'notification_webservice_count_notification');
$app->post('/get_events_by_id', 'notification_webservice_get_events_by_id');
$app->post('/get_modules_by_id', 'notification_webservice_get_modules_by_id');

//Account webservices
$app->post('/get_account_by_id', 'notification_webservice_get_account_by_id');
$app->post('/manage_account', 'notification_webservice_manage_account');
$app->post('/delete_account', 'notification_webservice_delete_account');

//Trigger webservices
$app->post('/check_trigger', 'notification_webservice_check_trigger');
$app->post('/get_trigger_by_id', 'notification_webservice_get_trigger_by_id');
$app->post('/manage_trigger', 'notification_webservice_manage_trigger');
$app->post('/delete_trigger', 'notification_webservice_delete_trigger');
$app->post('/get_me_templates', 'notification_webservice_get_me_templates');

//Template webservices
$app->post('/get_template_by_id', 'notification_webservice_get_template_by_id');
$app->post('/manage_template', 'notification_webservice_manage_template');
$app->post('/delete_template', 'notification_webservice_delete_template');
$app->post('/get_module_submodule_event_template', 'notification_webservice_get_module_submodule_event_template');

$app->post('/send_announcement_notification', 'notification_webservice_send_announcement_notification');
$app->post('/manage_announcement', 'notification_webservice_manage_announcement');
$app->post('/get_announcement_by_id', 'notification_webservice_get_announcement_by_id');
$app->post('/delete_announcement', 'notification_webservice_delete_announcement');
$app->post('/delete_notification_by_id', 'notification_webservice_delete_notification_by_id');
$app->post('/get_current_action_data', 'notification_webservice_get_current_action_data');

$app->post('/manage_cron_status', 'notification_webservice_manage_cron_status');
$app->post('/get_previous_cron_status', 'notification_webservice_get_previous_cron_status');
$app->post('/manage_cron_error_logs', 'notification_webservice_manage_cron_error_logs');
$app->post('/get_all_time_triggers_data', 'notification_webservice_get_all_time_triggers_data');
$app->post('/manage_time_triggers_data', 'notification_webservice_manage_time_triggers_data');
$app->post('/get_cron_error_logs', 'notification_webservice_get_cron_error_logs');
$app->post('/manage_cron', 'notification_webservice_manage_cron');
$app->post('/get_crons', 'notification_webservice_get_crons');
$app->post('/delete_time_trigger', 'notification_webservice_delete_time_trigger');
$app->post('/update_cron_status', 'notification_webservice_update_cron_status');
$app->post('/get_cron_status_data', 'notification_webservice_get_cron_status_data');
$app->post('/manage_notification_events', 'notification_webservice_manage_notification_events');
?>
