<?php
include_once('../../../../global.php');
$query = array();
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $query['username'] = $_POST['user_id'];
}
/*    if (isset($_POST['strt_date']) && !empty($_POST['strt_date'])) {
  $query['strt_date'] = $_POST['strt_date'];
  }
  if (isset($_POST['robot_id']) && !empty($_POST['robot_id'])) {
  $query['robot_id'] = $_POST['robot_id'];
  } */
if (isset($_POST['user_id']) && $_POST['user_id'] != "") {
    // $task_data = get_task_done_fail_status($query);
    $task_data = get_dashboard_data($query);
    $finaldata = $task_data['data'];
    if (isset($_POST['type']) && $_POST['type'] == 'done-fail') {
        $chartheader = array($ui_string['s_no'], 'Action Name', 'Status','Message');
        $rowData = array();
        $setData = '';
        $size = count($finaldata[0]['actions_completed']);
        $alldata = array();
        $s_no = 1;
        if ($size > 0) {
            for ($i = 0; $i < $size; $i++) {
                if($finaldata[0]['failure_occured']==false)
                {
                $newrowData = array('S no' => $s_no, 'Action Name' => $finaldata[0]['actions_completed'][$i]['action_type'], "Status" =>"Success" , 'Message' => $finaldata[0]['actions_completed'][$i]['action_handling_message']);
                }
                else
                {
                $newrowData = array('S no' => $s_no, 'Action Name' => $finaldata[0]['actions_completed'][$i]['action_type'], "Status" =>"Failure" , 'Message' => $finaldata[0]['actions_completed'][$i]['action_handling_message']);
                }
                $s_no = $s_no + 1;
                array_push($alldata, $newrowData);
            }
        }
        $size_fail = count($finaldata[0]['failure_details']);
        if ($size_fail > 0) {
            for ($i = 0; $i < $size_fail; $i++) {
                $newrowData = array('S no' => $s_no, 'Action Name' => $finaldata[0]['failure_details'][$i]['action_type'], 'Status' => '', "Message" => $finaldata[0]['failure_details'][$i]['action_handling_message']);
                $s_no = $s_no + 1;
                array_push($alldata, $newrowData);
            }
        }
        if ($size <= 0 && $size_fail <= 0) {
            echo 0;
            die;
        }
    } else {
        echo 0;
        die;
    }
} else {
    echo 0;
    die;
}
array_push($rowData, $alldata);
$mydata = call_user_func_array("array_merge", $rowData);
$output = DataTableExportReport_xls($chartheader, $mydata);
echo json_encode($output);
?>