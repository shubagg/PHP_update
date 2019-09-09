<?php
include_once ('../../../../global.php');
$action=$_REQUEST['action'];

if($action=='graphdata')
{   
        //$username=$_SESSION['user']['email'];
        $data=array();
        if(isset($_POST['id']) && $_POST['id']!=""){
                $email=$_POST['id'];
                $data=get_dashboard_data(array("username"=>strtolower("$email")));
        }
        echo json_encode($data);
}
else if($action=='task_status')
{   
        $data=array();
        $query=array();
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    	$query['userId'] = $_POST['user_id'];
		}
		if (isset($_POST['strt_date']) && !empty($_POST['strt_date'])) {
		    $query['strt_date'] = $_POST['strt_date'];
		}
		if (isset($_POST['robot_id']) && !empty($_POST['robot_id'])) {
		    $query['robot_id'] = $_POST['robot_id'];
		}
        if(isset($_POST['user_id']) && $_POST['user_id']!=""){
          $data=get_task_done_fail_status($query);
        }

        echo json_encode($data);
 }

?>
