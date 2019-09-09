<?php
include_once '../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']=="update_notification")
{	
    
    $output=curl_post("/update_notification",array('id'=>$_REQUEST['id']));
    echo json_encode($output);
   
    //logger_ui("notification_manage","",$output,5);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="clear_notification")
{	
    $output=curl_post("/clear_notification",array("userId"=>$_SESSION['user']['user_id']));
    //print_r($output);
   
    logger_ui("notification_manage","",$output,5);
    //echo $output;
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="get_notification")
{	
    $output=curl_post("/get_notification_by_id",array("id"=>0,"userId"=>$_REQUEST['userId'],"nor"=>3,"index"=>$_REQUEST['index'],'desktopNotification'=>'1','seen'=>'0'));
   
    logger_ui("notification_manage","",$output,5);
    echo json_encode($output);
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="count_notification")
{	
    $output=curl_post("/count_notification",array("userId"=>$_REQUEST['userId'],'desktopNotification'=>'1','seen'=>'0'));
   
    logger_ui("notification_manage","",$output,5);
    echo json_encode($output);
}


if(isset($_REQUEST['action']) && $_REQUEST['action']=="delete_notification")
{   
    //print_r($_POST);die;
    $userIds=implode("|",explode(",",$_POST['userIds']));
    $output=curl_post("/delete_notification_by_id",array("ids"=>$userIds,'anouid'=>''));
    echo json_encode($output);
   
  
}

?>
