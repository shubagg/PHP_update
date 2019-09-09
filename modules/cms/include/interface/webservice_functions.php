<?php

/* * ************Breaking news webservices************************ */

function cms_webservice_manage_bn() {
    $postvar = get_post_data();
    $result = manage_bn($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_bn_by_id() {
    $postvar = get_post_data();
    $result = get_bn_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_delete_bn() {
    $postvar = get_post_data();
    $result = delete_bn($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

/* * ************breaking news webservices************************ */

/* * ************Prss webservices************************ */

function cms_webservice_manage_press() {
    $postvar = get_post_data();
    $result = manage_press($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_press_by_id() {
    $postvar = get_post_data();
    $result = get_press_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_delete_press() {
    $postvar = get_post_data();
    $result = delete_press($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

/* * ************Prss webservices************************ */

/* * ************Team webservices************************ */

function cms_webservice_manage_team() {
    $postvar = get_post_data();
    $result = manage_team($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_team_by_id() {
    $postvar = get_post_data();
    $result = get_team_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_delete_team() {
    $postvar = get_post_data();
    $result = delete_team($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

/* * ************TEam webservices************************ */

function cms_webservice_manage_cms() {
    $postvar = get_post_data();
    $result = manage_cms($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_cms_by_id() {
    $postvar = get_post_data();
    $result = get_cms_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_cms_by_slug() {
    $postvar = get_post_data();
    $result = get_cms_by_slug($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_delete_cms() {
    $postvar = get_post_data();
    $result = delete_cms($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

// old web services fucntions
function add_cms_pg() {
    $postvar = get_post_data();


    if (!isset($postvar['pg_heading']) || !isset($postvar['pg_url']) || !isset($postvar['pg_content']) || !isset($postvar['pg_un_name'])) {

        rs("", "116", "false");
    }


    if ($postvar['pg_id'] != '') {
        $tmp = update_pg($postvar['pg_id'], $postvar['pg_heading'], $postvar['pg_url'], $postvar['pg_content'], $postvar['pg_un_name']);
    } else {
        $tmp = add_pg($postvar['pg_heading'], $postvar['pg_url'], $postvar['pg_content'], $postvar['pg_un_name']);
    }

    rs("");
}

function cms_pg_listing() {
    $tmp = pg_listing();
    $tmp = data_array($tmp);
    rs($tmp);
}

function cms_pg_data() {
    $postvar = get_post_data();
    $tmp = pg_data($postvar['pg_id']);

    $tmp = add_id($tmp, "id");
    rs($tmp);
}

function cms_page_staus() {
    $postvar = get_post_data();
    $tmp = pg_status($postvar['pg_id'], $postvar['status']);

    $tmp = add_id($tmp, "id");
    rs($tmp);
}

function cms_page_delete() {
    $postvar = get_post_data();
    $tmp = pg_delete_cms($postvar['pg_id']);

    rs($tmp);
}

function get_page_by_id() {
    $postvar = get_post_data();
    $tmp = pg_by_id($postvar['pg_id']);
    rs($tmp);
}

function get_page_by_name() {
    $postvar = get_post_data();
    $tmp = pg_by_name($postvar['pg_name']);
    rs($tmp);
}

function check_cms_pg_name() {
    $postvar = get_post_data();
    $tmp = pg_by_name($postvar['pg_name']);
    if (count($tmp) > 0) {
        rs("false");
    } else {
        rs("true");
    }
}

function check_cms_pg_url() {
    $postvar = get_post_data();

    $tmp = pg_by_url($postvar['pg_url']);

    if (count($tmp) > 0) {
        rs("false");
    } else {
        rs("true");
    }
}

//RPA...
function cms_webservice_run_robot() {
    $postvar = get_post_data();
    $result = run_robot($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_stop_robot() {
    $postvar = get_post_data();
    $result = stop_robot($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_check_robot_to_run() {
    $postvar = get_post_data();
    $postvar['table'] = "robotrunstatus";
    $result = get_data_by_table($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_run_popup_user() {
    $postvar = get_post_data();
    $result = run_popup_user($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_copy_data() {
    $postvar = get_post_data();
    $result = copy_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_manage_training_panel() {
    $postvar = get_post_data();
    $result = manage_training_panel($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_run_invoice_status() {
    $postvar = get_post_data();
    $postvar['table'] = "invoice_execute_status";

    $result = run_invoice_status($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_add_robot() {
    $postvar = get_post_data();
    $result = add_robot($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_add_dashboard_data() {
    $postvar = get_post_data();
    $result = add_dashboard_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_manage_schedule_robot() {
    $postvar = get_post_data();
    $result = manage_schedule_robot($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_getschedulebyid() {
    $postvar = get_post_data();
    $result = getschedulebyid($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

/* * ***************** New Webservices for Nikky ************************* */

function cms_webservice_run() {
    $postvar = get_post_data();
    $result = run($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_all_robot_list() {
    $postvar = get_post_data();
    $result = get_all_robot_list($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_schedule() {
    $postvar = get_post_data();
    $result = schedule($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_all_template_list() {
    $postvar = get_post_data();
    $result = get_all_template_list($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_template_export() {
    $postvar = get_post_data();
    $result = template_export($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_template_import() {
    $postvar = get_post_data();
    $result = template_import($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_getbytablename() {
    $postvar = get_post_data();
    $result = getbytablename($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

//charts nikky
function webservice_rpa_robot_start_to_stop_time() {
    $postvar = get_post_data();
    $result = rpa_robot_start_to_stop_time($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function webservice_getTaskListData() {
    $postvar = get_post_data();
    $result = getTaskListData($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_schedule_chart() {
    $postvar = get_post_data();
    $result = get_schedule_chart($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_get_robot_by_id() {
    $postvar = get_post_data();
    $result = get_robot_by_id($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}
function cms_webservice_get_task_done_fail_status() {
    $postvar = get_post_data();
    $result = get_task_done_fail_status($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}
function cms_webservice_getrobotdata() {
    $postvar = get_post_data();
    $result = getrobotdata($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}

function cms_webservice_rpa_robot_run_count() {
    $postvar = get_post_data();
    $result = rpa_robot_run_count($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}
function cms_webservice_decode_export_data() {
    $postvar = get_post_data();
    $result = decode_export_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}
function cms_webservice_add_fetch_queue_data() {
    $postvar = get_post_data();
    $result = add_fetch_queue_data($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}
function cms_webservice_get_template_list() {
    $postvar = get_post_data();
    $result = get_template_list($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}
function cms_webservice_inventory() {
    $postvar = get_post_data();
    $result = inventory($postvar);
    rs($result['data'], $result['error_code'], $result['success'], "24");
}
?>