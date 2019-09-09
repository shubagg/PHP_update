<?php
/* 
 * function get_users_by_enrollment()
 * @param array() itemId and $return_type (array OR json) 
 * @return array() OR Json of roles details
 */
function get_users_by_enrollment($request_data, &$return_type = 'array') {
    #Get Setting details
    $return_data = get_all_users_by_enrollment(array('itemId' => $request_data['itemId']));
    if($return_type == 'json') {
        $return_data = json_encode($return_data);
    }
    return $return_data;
}

function get_user_details_by_id($request_data, &$return_type = 'array') {
    //$return_data = curl_post("/get_user_info_by_id", array("id" => $request_data['userId']));
    $return_data = get_user_info_by_id(array("id" => $request_data['userId']));
    if($return_type == 'json') {
        $return_data = json_encode($return_data);
    }
    return $return_data;
}
?>