<?php

/******Aintu webservices*****/
function webservice_create_extension_feedback_form()
{
    $postvar = get_post_data();
    $return = create_extension_feedback_form($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}
function webservice_get_feedback_jobs()
{
    $postvar = get_post_data();
    $return = get_feedback_jobs($postvar);
    rs($return['data'], $return['error_code'], $return['success'], "5");
}
?>