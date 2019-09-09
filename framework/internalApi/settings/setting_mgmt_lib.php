<?php
/* 
 * function get_setting()
 * @param array() mid,smid and $return_type (array OR json) 
 * @return array() OR Json of setting details
 */
function get_setting($request_data, &$return_type = 'array') {
    $return_data = array();
    #Get Setting details
    //$setting_data = curl_post('get_module_setting_by_mid', array('mid' => $request_data['mid'], 'smid' => $request_data['smid']));
    $setting_data = get_module_setting_by_mid(array('mid' => $request_data['mid'], 'smid' => $request_data['smid']));
    if(!empty($setting_data['data'][0])) {
        $setting_types = $setting_data['data'][0];
        if(in_array($request_data['request_type'], array('priority', 'status', 'severity', 'jobtype', 'jobcategory'))) {
            $setting = !empty($setting_types['uiSetting'][$request_data['request_type']]) ? $setting_types['uiSetting'][$request_data['request_type']] : array();
            if(!empty($setting)) {
                $setting_ids = !empty($setting_types['uiSetting'][$request_data['request_type'] . 'Id']) ? $setting_types['uiSetting'][$request_data['request_type'] . 'Id'] : array();
                if(!empty($request_data['dropdown'])) {
                    $options_values = '';
                    foreach($setting as $k => $v) {
                        $options_values .= "<option value='{$setting_ids[$k]}'>{$v}</option>"; 
                    }
                    $return_data['data'] = $options_values;
                } else if(!empty($request_data['label'])) {
                    $options_values = '';
                    foreach($setting as $k => $v) {
                        $options_values .= get_ticket_setting_label($setting_ids[$k], $v, strtolower($request_data['request_type']), $request_data['selected_type_selections']); 
                    }
                    $return_data['data'] = $options_values;
                } else {
                    $priority_data = array();
                    foreach($setting as $k => $v) {
                        $priority_data[$setting_ids[$k]] = $v; 
                    }
                    $return_data['data'] = $priority_data;
                }
            }
        }
//        if($request_data['request_type'] == 'priority') { #Manage Priorities
//            $setting = !empty($setting_types['uiSetting']['priority']) ? $setting_types['uiSetting']['priority'] : array();
//            if(!empty($setting)) {
//                $setting_ids = !empty($setting_types['uiSetting']['priorityId']) ? $setting_types['uiSetting']['priorityId'] : array();
//                if(!empty($request_data['dropdown'])) {
//                    $options_values = '';
//                    foreach($setting as $k => $v) {
//                        $options_values .= "<option value='{$setting_ids[$k]}'>{$v}</option>"; 
//                    }
//                    $return_data['data'] = $options_values;
//                } else {
//                    $priority_data = array();
//                    foreach($setting as $k => $v) {
//                        $priority_data[$setting_ids[$k]] = $v; 
//                    }
//                    $return_data['data'] = $priority_data;
//                }
//            }
//        } else if($request_data['request_type'] == 'status') { #Manage Status
//            $setting = !empty($setting_types['uiSetting']['status']) ? $setting_types['uiSetting']['status'] : array();
//            if(!empty($setting)) {
//                $setting_ids = !empty($setting_types['uiSetting']['statusId']) ? $setting_types['uiSetting']['statusId'] : array();
//                if(!empty($request_data['dropdown'])) {
//                    $options_values = '';
//                    foreach($setting as $k => $v) {
//                        $options_values .= "<option value='{$setting_ids[$k]}'>{$v}</option>"; 
//                    }
//                    $return_data['data'] = $options_values;
//                } else {
//                    $setting_data = array();
//                    foreach($setting as $k => $v) {
//                        $setting_data[$setting_ids[$k]] = $v; 
//                    }
//                    $return_data['data'] = $setting_data;
//                }
//            }
//        } else if($request_data['request_type'] == 'severity') { #Manage Status
//            $setting = !empty($setting_types['uiSetting']['severity']) ? $setting_types['uiSetting']['severity'] : array();
//            if(!empty($setting)) {
//                $setting_ids = !empty($setting_types['uiSetting']['severityId']) ? $setting_types['uiSetting']['severityId'] : array();
//                if(!empty($request_data['dropdown'])) {
//                    $options_values = '';
//                    foreach($setting as $k => $v) {
//                        $options_values .= "<option value='{$setting_ids[$k]}'>{$v}</option>"; 
//                    }
//                    $return_data['data'] = $options_values;
//                } else {
//                    $setting_data = array();
//                    foreach($setting as $k => $v) {
//                        $setting_data[$setting_ids[$k]] = $v; 
//                    }
//                    $return_data['data'] = $setting_data;
//                }
//            }
//        } else if($request_data['request_type'] == 'jobtype') { #Manage Status
//            $setting = !empty($setting_types['uiSetting']['jobtype']) ? $setting_types['uiSetting']['jobtype'] : array();
//            if(!empty($setting)) {
//                $setting_ids = !empty($setting_types['uiSetting']['jobtypeId']) ? $setting_types['uiSetting']['jobtypeId'] : array();
//                if(!empty($request_data['dropdown'])) {
//                    $options_values = '';
//                    foreach($setting as $k => $v) {
//                        $options_values .= "<option value='{$setting_ids[$k]}'>{$v}</option>"; 
//                    }
//                    $return_data['data'] = $options_values;
//                } else {
//                    $setting_data = array();
//                    foreach($setting as $k => $v) {
//                        $setting_data[$setting_ids[$k]] = $v; 
//                    }
//                    $return_data['data'] = $setting_data;
//                }
//            }
//        }
//        else if($request_data['request_type'] == 'jobcategory') { #Manage jobcategory
//            $setting = !empty($setting_types['uiSetting']['jobcategory']) ? $setting_types['uiSetting']['jobcategory'] : array();
//            if(!empty($setting)) {
//                $setting_ids = !empty($setting_types['uiSetting']['jobcategoryId']) ? $setting_types['uiSetting']['jobcategoryId'] : array();
//                if(!empty($request_data['dropdown'])) {
//                    $options_values = '';
//                    foreach($setting as $k => $v) {
//                        $options_values .= "<option value='{$setting_ids[$k]}'>{$v}</option>"; 
//                    }
//                    $return_data['data'] = $options_values;
//                } else {
//                    $setting_data = array();
//                    foreach($setting as $k => $v) {
//                        $setting_data[$setting_ids[$k]] = $v; 
//                    }
//                    $return_data['data'] = $setting_data;
//                }
//            }
//        } 
        else if($request_data['request_type'] == 'allsetting') {
            if(!empty($request_data['setting_type'])) {
                $all_setting = array();
                foreach($request_data['setting_type'] as $val) {
                    $settign_by_label = "";
                    $setting = !empty($setting_types['uiSetting'][$val]) ? $setting_types['uiSetting'][$val] : array();
                    $setting_ids = !empty($setting_types['uiSetting'][$val . 'Id']) ? $setting_types['uiSetting'][$val . 'Id'] : array();
                    foreach($setting as $k => $v) {
                        if(!empty($request_data['label'])) {
                            $settign_by_label .= get_ticket_setting_label($setting_ids[$k], $v, strtolower($val));
                        } else {
                            $all_setting[$val][$setting_ids[$k]] = $v;
                        }
                    }
                    if(!empty($request_data['label'])) {
                        $all_setting[$val] = $settign_by_label;
                    }
                }
                $return_data['data'] = $all_setting;
            }
        } else {
            $return_data['data'] = $setting_types;
        }
    }
    if($return_type == 'json') {
        $return_data = json_encode($return_data);
    }
    return $return_data;
}

function get_all_tkt_assigned_users($search_text, $selected_options = array()) {
    $option_values = '';
    $userid = $_SESSION['user']['user_id'];
    $associated_project = array();
    if (check_user_permission('job', 'ticket', 'all') == '1' || check_user_permission('job', 'ticket', 'view') == '1') {
        $check_view_permisssion = TRUE;
    }
    if (check_user_permission('job', 'ticket', 'view_all_project') == '1') {
        $associated_project = get_project_by_type(array('smid' => '1', 'get_active' => TRUE));
    } else {
        $associated_project = get_user_associate_item_list(array("mid" => "32", "smid" => '1', "userId" => $userid));
    }
    if(!empty($associated_project['data']) && $associated_project['status'] = 'true') {
        $project_ids = array();
        foreach($associated_project['data'] as $val) {
            $project_ids[] = $val['id'];
        }
        if(!empty($project_ids)) {
            $users = get_tkt_permission_users(array('proj_ids' => $project_ids, 'label' => 1, 'search_text' => $search_text, 'selected_options' => $selected_options));
            $option_values = $users['data'];
        }
    }
    return $option_values;
}

function get_assigned_users_project($search_text, $selected_options = array()) {
    $option_values = '';
    $userid = $_SESSION['user']['user_id'];
    $associated_project = array();
    if (check_user_permission('job', 'ticket', 'all') == '1' || check_user_permission('job', 'ticket', 'view') == '1') {
        $check_view_permisssion = TRUE;
    }
    if (check_user_permission('job', 'ticket', 'view_all_project') == '1') {
        $associated_project = get_project_by_type(array('smid' => '1', 'get_active' => TRUE));
    } else {
        $associated_project = get_user_associate_item_list(array("mid" => "32", "smid" => '1', "userId" => $userid));
    }
    if(!empty($associated_project['data']) && $associated_project['status'] = 'true') {
        foreach($associated_project['data'] as $val) {
            $checked = '';
            if(!empty($selected_options) && in_array($val['id'], $selected_options)) {
                $checked = 'checked="checked"';
            }
            if(!empty($search_text)) {
                if(stripos($val['name'], $search_text) !== false) {
                    $option_values .= "<li><label><i class='fa fa-tasks' aria-hidden='true'></i> <input type='checkbox' id='{$val['id']}' data-current_selector='project' class='adv_checkbox_selection' {$checked}/>{$val['name']} ({$val['code']})</label></li>";
                }
            } else {
                $option_values .= "<li><label><i class='fa fa-tasks' aria-hidden='true'></i> <input type='checkbox' id='{$val['id']}' data-current_selector='project' class='adv_checkbox_selection' {$checked}/>{$val['name']} ({$val['code']})</label></li>";
            }
        }
    }
    return $option_values;
}

function get_ticket_setting_label($case, $value, $type, $selected_options = array()) {
    $return = '';
    $checked = '';
    if(!empty($selected_options) && in_array($case, $selected_options)) {
        $checked = 'checked="checked"';
    }
    if($type == 'jobtype') {
        switch ($case) {
            case 1:
                $return = "fa-bug";
                $type_text_label = "text-danger";
                break;
            case 2:
                $return = "fa-gavel";
                $type_text_label = "text-warning";
                break;
            case 3:
                $return = "fa-leaf";
                $type_text_label = "text-info";
                break;
            default:
                $return = "fa-ban";
                $type_text_label = "text-primary";
        }
        return "<li><label><input type='checkbox' value='' id='{$case}' data-current_selector='{$type}' class='adv_checkbox_selection' {$checked}/><span class='text-center {$type_text_label}'><i class='fa {$return}' aria-hidden='true'></i> {$value}</span></li>";
    }
    if($type == 'severity') {
        switch ($case) {
            case 1:
                $return = "text-danger";
                break;
            case 2:
                $return = "text-warning";
                break;
            case 3:
                $return = "text-info";
                break;
            case 4:
                $return = "text-success";
                break;
            default:
                $return = "text-primary";
        }
        return "<li><label><input type='checkbox' value='' id='{$case}' data-current_selector='{$type}' class='adv_checkbox_selection' {$checked}/><span class='{$return} text-center'>{$value}</span></label></li>";
    }
    if($type == 'status') {
        switch ($case) {
            case 1:
                $return = "label-info";
                break;
            case 2:
                $return = "label-primary";
                break;
            case 3:
                $return = "label-default";
                break;
            case 4:
                $return = "label-warning";
                break;
            case 5:
                $return = "label-custom-y";
                break;
            case 6:
                $return = "label-custom-b";
                break;
            case 7:
                $return = "label-success";
                break;
            case 8:
                $return = "label-danger";
                break;
            default:
                $return = "label-danger";
        }
        return "<li><label><input type='checkbox' value='' id='{$case}' data-current_selector='{$type}' class='adv_checkbox_selection' {$checked}/><span class='label {$return}'>{$value}</span></label></li>";
    }
    if($type == 'priority') {
        switch ($case) {
            case 1:
                $return = "text-danger";
                break;
            case 2:
                $return = "text-warning";
                break;
            case 3:
                $return = "text-info";
                break;
            case 4:
                $return = "text-success";
                break;
            case 5:
                $return = "text-primary";
                break;
            default:
                $return = "text-primary";
        }
        return "<li><label><input type='checkbox' value='' id='{$case}' data-current_selector='{$type}' class='adv_checkbox_selection' {$checked}/><i class='fa fa-long-arrow-up' aria-hidden='true'></i> <span class='{$return} text-center'>{$value}</label></li>";
    }
}

/* 
 * function get_assigned_users()
 * @param array() userId, object and $return_type (array OR json) 
 * @return array() OR Json of setting details
 */
function get_assigned_users($request_data, &$return_type = 'array') {
    $return_data = array();
    #Get Setting details
    //$setting_data = curl_post('get_module_setting_by_mid', array('mid' => $request_data['mid'], 'smid' => $request_data['smid']));
    $user_data = get_user_hirarchy(array('userId' => $request_data['userId'], 'object' => !empty($request_data['object']) ? $request_data['object'] : false));
    if(!empty($user_data['data'])) {
        if(!empty($request_data['dropdown'])) {
            $option_values = '';
            foreach($user_data['data'] as $k => $v) {
                $option_values .= "<option value='{$k}'>{$v['email']}</option>"; 
            }
            $return_data['data'] = $option_values;
        } else if(!empty($request_data['label'])) {
            
        } else {
            $return_data['data'] = $user_data['data'];
        }
    }
    if($return_type == 'json') {
        $return_data = json_encode($return_data);
    }
    return $return_data;
}
?>
