<?php
include_once ('../../../../global.php');
/* $action=$_REQUEST['action'];
  if($action=='senddata')
  {
  $data['createDate'] = new MongoDate();
  $data['status'] = "0";
  $data['_id'] = new MongoId();
  $res = insert_mongo('checkrobotstatus',$data);
  } */

$action = $_REQUEST['action'];
if ($action == 'senddata') {
    $data['createDate'] = new MongoDate();
    $data['status'] = "0";
    $data['asid'] = $_POST['id'];
    $data['map_id'] = $_POST['c_id'];
    $data['ip'] = $_POST['ip'];
    $data['_id'] = new MongoId();
    $data['userId'] = $_POST['userId'];
    $data['run_by'] = $_POST['run_by'];
    $data['run_user_id'] = $_POST['run_user_id'];
    $data['machine_id'] = $_POST['machine_id'];
    if(isset($_POST['count']) && $_POST['count']!='')
    {
      $count=$_POST['count']+1;
    }
    else
    {
      $count=0;
    }
    $run_time =strtotime(date('Y-m-d h:i a'));
    $robot_data = curl_post("/getTaskListData", array('id' => $data['asid']));
    if ($robot_data['success'] == 'true') {
        $data['title'] = $robot_data['data'][0]['title'];
    }
    $res = insert_mongo('robotrunstatus', $data);
    $resp_robotlist = update_mongo('robotlist', array('run_by'=>$_POST['run_by'],'run_user_id'=>$_POST['run_user_id'],'machine_id'=>$_POST['machine_id']), array('_id' => new MongoId($_POST['id'])));
    $resp = update_mongo('robotlistAssociate', array("status" => '0','count'=>$count,'run_time'=>$run_time), array('_id' => new MongoId($_POST['c_id'])));
}

if ($action == 'delete_robot') {
    $res = delete_mongo('robotrunstatus', array('asid' => $_POST['asid']));
    $resp = delete_mongo('robotlistAssociate', array('asid' => $_POST['asid']));
    $resp = delete_mongo('robotlist', array('_id' => new MongoId($_POST['asid'])));
}
if ($action == 'delete_template') {
    $res = delete_mongo('ocrtemplate', array('_id' => new MongoId($_POST['id'])));
}
?>
