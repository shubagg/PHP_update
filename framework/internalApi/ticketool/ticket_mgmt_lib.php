<?php
/* 
 * function get_tickets()
 * @param $return_type (array OR json) 
 * @return array() OR Json of setting details
 */
function get_tickets_detail($request_data, &$return_type = 'array') {
    $return_data = array();
    $ticket_details = get_tickets(array('get_total' => 1, 'smid' => 2, 'id' => '', 'projectId' => ''));
    pr($ticket_details);die;
    if($return_type == 'json') {
        $return_data = json_encode($return_data);
    }
    return $return_data;
}

?>

