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
if(isset($_POST['end_date']) && !empty($_POST['end_date']))
{
$data['end_date']=$_POST['end_date'];
}
$course_data = curl_post("/rpa_robot_start_to_stop_time",$data);
$all_data = $course_data['data'];
echo $all_data = json_encode($all_data);
?>