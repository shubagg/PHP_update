<?php
include_once '../../../../global.php';
$data=array();
if(isset($_POST['user_id']) && !empty($_POST['user_id']))
{
$data['userId']=$_POST['user_id'];
}
if(isset($_POST['strt_date']) && !empty($_POST['strt_date']))
{
$data['strt_date']=$_POST['strt_date'];
}

$course_data = curl_post("/rpa_robot_run_count",$data);
$all_data = $course_data['data'];
//$all_data=array('0'=>array('demo','sasasa'),'1'=>array('test',6.23),'2'=>array('awq',7.23));
echo $all_data = json_encode($all_data);
?>