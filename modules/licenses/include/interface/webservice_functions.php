<?php

function licenses_webservice_manage_licenses_request() {
    $postvar = get_post_data();
    $return = manage_licenses_request($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

function licenses_webservice_get_licenses_request() {
    $postvar = get_post_data();
    $return = get_licenses_request($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

function licenses_webservice_check_user_licenses() {
    $postvar = get_post_data();
    $return = check_user_licenses($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

function licenses_webservice_status_update() {
    $postvar = get_post_data();
    $return = status_update($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

function licenses_webservice_company_active_status() {
    $postvar = get_post_data();
    $return = company_active_status($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

function licenses_webservice_add_customer_license_information() {
    $postvar = get_post_data();
    $return = add_customer_license_information($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

function licenses_webservice_manage_po_request() {
    $postvar = get_post_data();
    $return = manage_po_request($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

function licenses_webservice_verify_license_status() {
    $postvar = get_post_data();
    $return = verify_license_status($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "55");
}

?>
