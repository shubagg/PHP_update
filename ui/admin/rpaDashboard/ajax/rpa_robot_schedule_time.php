<?php
include_once '../../../../global.php';
$data = array();
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $data['userId'] = $_POST['user_id'];
}
if (isset($_POST['strt_date']) && !empty($_POST['strt_date'])) {
    $data['strt_date'] = $_POST['strt_date'];
}
$course_data = curl_post("/get_schedule_chart", $data);
$all_data = $course_data['data'];
//$all_data=array('0'=>array('demo','anjali',array(0,0,0,1,0,0),array(0,0,0,16,0,0)),'1'=>array('test','sombir',array(0,0,0,10,0,0),array(0,0,0,14,0,0)));
//$all_data=array('0'=>array('demo','anjali',1527854983000,1527854522000),'1'=>array('test','sombir',1527854983000,1527854283000));
echo $all_data = json_encode($all_data);
?>