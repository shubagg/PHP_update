<?php
include_once("../../../../global.php");
$return = array(
    //'payload' => new stdClass(),
    'payload' => '',
    'status' => FALSE,
    'message' => 'Request Was Failed',
    'code' => 400
);
if(!empty($_POST['type'])) {
    $return_search = '';
    include_once(framework_doc_path() . 'internalApi/settings/setting_mgmt_lib.php');
    if(in_array(strtolower($_POST['type']), array('status', 'priority', 'severity', 'jobtype'))) {
        if(!empty($_POST['query'])) {
            $options_values = get_setting(array("mid" => '5', "smid" => '2', 'request_type' => strtolower($_POST['type']), 'selected_type_selections' => explode(',' , $_POST['selected_type_selections'])));
            $search_text = $_POST['query'];
            if(!empty($options_values['data'])) {
                foreach($options_values['data'] as $k => $v) {
                    if(stripos($v, $search_text) !== false) {
                        $return_search .= get_ticket_setting_label($k, $v, strtolower($_POST['type']), explode(',' , $_POST['selected_type_selections']));
                    }
                }
            }
        } else {
            $setting_data = get_setting(array("mid" => '5', "smid" => '2', 'request_type' => strtolower($_POST['type']), 'label' => 1, 'selected_type_selections' => explode(',' , $_POST['selected_type_selections'])));
            $return_search .= $setting_data['data'];
        }
    } else if($_POST['type'] == 'assignee') {
        $search_text = !empty($_POST['query']) ? $_POST['query'] : '';
        $return_search .= get_all_tkt_assigned_users($search_text, explode(',' , $_POST['selected_type_selections']));
        
    } else if($_POST['type'] == 'project') {
        $search_text = !empty($_POST['query']) ? $_POST['query'] : '';
        $return_search .= get_assigned_users_project($search_text, explode(',' , $_POST['selected_type_selections']));
    }
    if(!empty($return_search)) {
        $return['payload'] = $return_search;
        $return['status'] = TRUE;
        $return['message'] = "Request Was Success";
        $return['code'] = 200;
    } else {
        $return['message'] = "<li>Oops! No Matches</li>";
    }
}
echo json_encode($return);
return;

