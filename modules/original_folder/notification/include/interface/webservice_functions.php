<?php
function notification_webservice_insert_notification()
{
    $postvar = get_post_data();
    $result = insert_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_send_ios_notification()
{
    $postvar = get_post_data();
    $result = send_ios_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_send_push_on_device()
{
    $postvar = get_post_data();
    $result = send_push_on_devices($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_send_notification()
{
    $postvar = get_post_data();
    $result = send_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_send_broadcast_notification()
{
    $postvar = get_post_data();
    $result = send_broadcast_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_modules()
{
    $postvar = get_post_data();
    $result = get_all_modules();
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_events()
{
    $postvar = get_post_data();
    $result = get_all_events($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_modules_by_id()
{
    $postvar = get_post_data();
    $result = get_modules_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_events_by_id()
{
    $postvar = get_post_data();
    $result = get_events_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_fields()
{
    $postvar = get_post_data();
    $result = get_all_fields($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_notification_by_id()
{
    $postvar = get_post_data();
    $result = get_notification_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_update_notification()
{
    $postvar = get_post_data();
    $result = update_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_notification()
{
    $postvar = get_post_data();
    $result = manage_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_strings_by_id()
{
    $postvar = get_post_data();
    $result = get_strings_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_clear_notification()
{
    $postvar = get_post_data();
    $result = clear_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_count_notification()
{
    $postvar = get_post_data();
    $result = count_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

/***********Account webservices**************/

function notification_webservice_get_account_by_id()
{
    $postvar = get_post_data();
    $result = get_account_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_account()
{
    $postvar = get_post_data();
    $result = manage_account($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_delete_account()
{
    $postvar = get_post_data();
    $result = delete_account($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");

}

/***********Trigger webservices**************/
function notification_webservice_check_trigger()
{
    $postvar = get_post_data();
    $result = check_trigger($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_trigger_by_id()
{
    $postvar = get_post_data();
    $result = get_trigger_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_trigger()
{
    $postvar = get_post_data();
    $result = manage_trigger($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_delete_trigger()
{
    $postvar = get_post_data();
    $result = delete_trigger($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_me_templates()
{
    $postvar = get_post_data();
    $result = get_me_templates($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

/***********Template webservices**************/

function notification_webservice_get_template_by_id()
{
    $postvar = get_post_data();
    $result = get_template_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_template()
{
    $postvar = get_post_data();
    $result = manage_template($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_delete_template()
{
    $postvar = get_post_data();
    $result = delete_template($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_module_submodule_event_template()
{
    $postvar = get_post_data();
    $result = get_module_submodule_event_template($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_send_announcement_notification()
{
    $postvar = get_post_data();
    $result = send_announcement_notification($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_announcement()
{
    $postvar = get_post_data();
    $result = manage_announcement($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_announcement_by_id()
{
    $postvar = get_post_data();
    $result = get_announcement_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_delete_announcement()
{
    $postvar = get_post_data();
    $result = delete_announcement($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_delete_notification_by_id()
{
    $postvar = get_post_data();
    $result = delete_notification_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_current_action_data()
{
    $postvar = get_post_data();
    $result = get_current_action_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_cron_status()
{
    $postvar = get_post_data();
    $result = manage_cron_status($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_previous_cron_status()
{
    $postvar = get_post_data();
    $result = get_previous_cron_status($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_cron_error_logs()
{
    $postvar = get_post_data();
    $result = manage_cron_error_logs($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_all_time_triggers_data()
{
    $postvar = get_post_data();
    $result = get_all_time_triggers_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_time_triggers_data()
{
    $postvar = get_post_data();
    $result = manage_time_triggers_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_cron_error_logs()
{
    $postvar = get_post_data();
    $result = get_cron_error_logs($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}


function notification_webservice_manage_cron()
{
    $postvar = get_post_data();
    $result = manage_cron($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_crons()
{
    $postvar = get_post_data();
    $result = get_crons($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_delete_time_trigger()
{
    $postvar = get_post_data();
    $result = delete_time_trigger($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_update_cron_status()
{
    $postvar = get_post_data();
    $result = update_cron_status($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_get_cron_status_data()
{
    $postvar = get_post_data();
    $result = get_cron_status_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

function notification_webservice_manage_notification_events()
{
    $postvar = get_post_data();
    $result = manage_notification_events($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "3");
}

?>
