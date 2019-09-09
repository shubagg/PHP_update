<?php
/* 
 * function get_roles_by_mid()
 * @param array() mid,smid and $return_type (array OR json) 
 * @return array() OR Json of roles details
 */
function get_roles_by_mid($request_data, &$return_type = 'array') {
    $return_data = array();
    #Get Setting details
    //$setting_data = curl_post('get_module_setting_by_mid', array('mid' => $request_data['mid'], 'smid' => $request_data['smid']));
    $setting_data = get_module_setting_by_mid(array('mid' => $request_data['mid'], 'smid' => $request_data['smid']));
    if($setting_data['success'] == 'true') {
        if(!empty($setting_data['data'][0]['id'])) {
            $sub_module_setting_id = $setting_data['data'][0]['id'];
            $roles_details = get_module_roles(array('specific_id' => $sub_module_setting_id));
            $return_data = $roles_details;
        }
    } else {
        $return_data = $setting_data;
    }
    if($return_type == 'json') {
        $return_data = json_encode($return_data);
    }
    return $return_data;
}
?>

