<?php
include_once '../../../../global.php';

$action=$_REQUEST['action'];
if($action=='timeTrigger')
{
      $verifyRequest=$csrf->verifyRequest();
      if($verifyRequest['success']=='true')
      {
            $id = $_POST['id'];  
            $cronId = $_POST['cronId'];
            $fileName=trim($_POST['fileName']);
            $continueCronOnFailure=trim($_POST['continueCronOnFailure']);
            $alermTime=trim($_POST['alermTime']);
            $output = manage_time_triggers_data(array('id'=>$id,'cronId'=>$cronId,'fileName'=>$fileName,'continueCronOnFailure'=>$continueCronOnFailure,'alermTime'=>$alermTime));
            echo json_encode($output);
      }
      else
      {
            echo json_encode($verifyRequest);
      }   
}

if($action=='deleteTimeTrigger')
{
	  $id=implode("|",explode(",",$_POST['id']));
      $output = delete_time_trigger(array('id'=>$id));
      echo json_encode($output); 
}
?>