<?php

/******Aintu webservices*****/
function webservice_create_extension_form_job()
{
    $postvar = get_post_data();
    $return = create_extension_form_job($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}
function webservice_extension_all_jobs()
{
    $postvar = get_post_data();
    $return = get_extension_all_jobs($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}
function webservice_extension_approval_process()
{
    $postvar = get_post_data();
    $return = extension_approval_process($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}
function webservice_extensionjob_approval_done_process()
{
    $postvar = get_post_data();
    $return = extensionjob_approval_done_process($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}

function webservice_ex_fetch_collection()
{
    $postvar = get_post_data();
    $return = ex_fetch_collection($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}

function webservice_ex_drop_collection()
{
    $postvar = get_post_data();
    $return = ex_drop_collection($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}
function webservice_ex_manageAppLogs()
{
    $postvar = get_post_data();
    $return = manageAppLogs($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}
?>