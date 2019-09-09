<?php
include_once ('../../../../global.php');
$currentId = $_SESSION['user']['user_id'];
/*$userInfo = get_user_hirarchy(array('userId' => $currentId, 'mongoObject' => 'true'));
$where = array('status' => '1', '_id' => array('$in' => $userInfo['data'])); //'$ne'=>'super admin'
$tmp = select_mongo('user', $where, array("email", "login_status", "last_activity_update"));
$return = add_id($tmp, "id");*/
$check_where['role']='5cf4c668518be4001e000032';
$check_where['_id']=new MongoId($currentId);
$check_user=select_mongo('user',$check_where);
$check_res=add_id($check_user,'id');
if(!empty($check_res) &&  $check_res>0)
{
  $where=array('status'=>'1','id'=>$currentId);  
}
else 
{
    $where=array('status'=>'1','id'=>$currentId,'fields'=>'machine');
}
$machine = curl_post("/get_resource_by_id",$where);
if($machine['data'][0]['type']=='machine')
{
    $machine_id=$currentId;
}
else 
{
    $machine_id=implode('|',$machine['data'][0]['machine']);
}
$where_condition=array('status'=>'1','id'=>$machine_id,'fields'=>'email,login_status,last_activity_update');
$returns = curl_post("/get_resource_by_id",$where_condition);
if($returns['success']=='true')
{
    $return=$returns['data'];
if (sizeof($return) > 0) {
    foreach ($return as $useremail) {
        $username[] = $useremail['email'];
    }
}
}

$html = "";
$counter = 1;
$counter_time = 1;
$sizeofuser = sizeof($return);
foreach ($return as $user_value) {
    $add_class = "";
    if ($user_value['id'] == $currentId) {
        $add_class = " active";
        $user_email = $user_value['email'];
        $userid = $user_value['id'];
        $counter = 2;
        $imageData = get_media_by_id(array('id' => '0', 'smid' => '1', 'asmid' => '1', 'amid' => '1', 'aiid' => $userid, 'object' => 'true'));
        if (!empty($imageData['data'])) {
            $img_url = $imageData['data'][0]['link'];
        } else {
            $img_url = site_url() . 'company/' . $companyId . '/uploads/default_media/avatar.png';
        }
    }
//    if ($counter == 1) {
//        $userid = $user_value['email'];
//        $counter = 2;
//        $add_class = "active";
//    }
    $dashboard_task = select_sort_mongo('dashboard_task', array("username" => array('$in' => array($user_value['email']))), array("estimated_time", "time_elapsed", "username"), array('lastUpdate' => -1));
    $return_dashboard_task = add_id($dashboard_task, "id");
    $recent_robot_status = select_sort_limit_mongo('robotrunstatus', array("ip" => $user_value['email']), array("asid", "status"), array('_id' => -1), 0, 1);
    $return_recent_status_info = add_id($recent_robot_status, "id");
    $recent_robot_name = '-';
    if (!empty($return_recent_status_info[0])) {
        $recent_robot_info = select_mongo('robotlist', array("_id" => new MongoId($return_recent_status_info[0]['asid'])), array("title"));
        $recent_robot_info = add_id($recent_robot_info, "id");
        $recent_robot_name = !empty($recent_robot_info[0]['title']) ? $recent_robot_info[0]['title'] : '-';
    }
    if (!empty($return_recent_status_info[0]['status']) && $return_recent_status_info[0]['status'] == 1) {
        $recent_robot_name = 'Running Robot : ' . $recent_robot_name;
    } else {
        $recent_robot_name = 'Recent Robot : ' . $recent_robot_name;
    }
    $counter_time_name = "usertask_" . $counter_time;
    if (!empty($user_value['login_status']) && $user_value['login_status'] == 'ONLINE') {
        if (!empty($user_value['last_activity_update']) && ((intval(time()) - intval($user_value['last_activity_update'])) < 3600)) {
            $html .= '<div class="dotTextAlign"><span class="statusDot statusDotGreen"></span>';
        } else {
            $html .= '<div class="dotTextAlign"><span class="statusDot statusDotRed"></span>';
        }
    } else {
        $html .= '<div class="dotTextAlign"><span class="statusDot statusDotRed"></span>';
    }
    if (sizeof($return_dashboard_task) > 0) {
        $html .= '<a class="list-group-item ActiveUser checkclass' . $add_class . '" id="' . $counter_time_name . '" onclick="train_request_send(\'' . $return_dashboard_task[0]['username'] . '\',\'' . $counter_time_name . '\');" data-toggle="show-chat"><div class="media"><div class="media-list pr-20"><div class="avatar avatar-sm avatar-away"><img src="'.$img_url.'"><i></i></div></div><div class="media-list media-body"><h5 class="mt-0 mb-5" title=' . $return_dashboard_task[0]['username'] . '>' . $return_dashboard_task[0]['username'] . '</h5><small>ETA :' . $return_dashboard_task[0]['estimated_time'] . '</small></br><small>ET :' . $return_dashboard_task[0]['time_elapsed'] . '</small><h5 class="mt-0 mb-5">' . $recent_robot_name . '</h5></div></div></a>';
    } else {
        $html .= '<a class="list-group-item  checkclass ' . $add_class . '" id="' . $counter_time_name . '" onclick="train_request_send(\'' . $user_value['email'] . '\',\'' . $counter_time_name . '\',\'' . $user_value['id'] . '\');" data-toggle="show-chat"><div class="media"><div class="media-list pr-20"><div class="avatar avatar-sm avatar-away"><img src="'.$img_url.'"><i></i></div></div><div class="media-list media-body"><h5 class="mt-0 mb-5" title=' . $user_value['email'] . '>' . $user_value['email'] . '</h5><small>ETAA : 0</small></br><small>ET : 0 </small><h5 class="mt-0 mb-5">' . $recent_robot_name . '</h5></div></div></a>';
    }
    $html .= '</div>';
    $counter_time++;
}
echo json_encode(array("data" => $html, "id" => $user_email,"user_id"=>$userid, "userCount" => $sizeofuser));
?>
