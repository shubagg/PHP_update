<?php
include_once '../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']=="template_add")
{	
    $verifyRequest=$csrf->verifyRequest();
    if($verifyRequest['success']=='true')
    {
        header( 'Content-type: text/html; charset=utf-8' );
        ob_start ();
        //$output=curl_post("/manage_template",array('smid'=>$_POST['submodule'],'mid'=>$_POST['module_id'],'eid'=>$_POST['event_id'],'fieldValue'=>$_POST['field'],'tempName'=>$_POST['temp_name'],'tempDesc'=>"",'tempFor'=>$_POST['temp_for'],'id'=>$_POST['id'],'lang'=>$_SESSION['user']['lang']));
        
        $tempDesc_en=trim($_POST['tempDesc_en']);
        $ntempDesc_en=base64_encode($tempDesc_en);
        unset($_POST['current_editor']);
        unset($_POST['action']);
        unset($_POST['tempDesc_en']);
        sleep(2);
        $_POST['tempDesc_en']=$ntempDesc_en;
        ob_flush();
        $output=manage_template($_POST);
       
        if($output['errorcode']=="100")
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
     else
    {
      echo json_encode($verifyRequest);
    } 
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="get_events")
{	
    $output=get_submodule_events(array('smid'=>$_REQUEST['smidevent'],'mid'=>$_REQUEST['module_id']));
    
   logger_ui("coupon_mangess","",$output,5);
    if($output['error_code']=="100")
    {
       echo json_encode($output['data']);
    }
    else
    {
        echo "0";
    }
    
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="get_fields")
{	
    $output=curl_post("/get_fields",array('mid'=>$_REQUEST['module_id'],'eid'=>$_REQUEST['event_id']));
    echo json_encode($output); die;
    logger_ui("coupon_mange","",$output,5);
    
    if($output['errorcode']=="100")
    {
        echo json_encode($output['data']);
    }
    else
    {
        echo "0";
    } 
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="template_delete")
{
    $data_id=$_REQUEST['data_id'];

    $output=curl_post("/delete_template",array("id"=>$data_id));
    //logger_ui("coupon_mange","",$output,5);
    if($output['errorcode']=="3018")
    {
        echo "1";
    }
    else
    {
        echo "0";
    } 
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="delete_multiple_template")
{
    $data_id=$_REQUEST['templateIds'];
    //print_r($data_id);
    $record_delete=explode(",",$data_id);
    $record_delete=implode("|",$record_delete);

    $output=curl_post("/delete_template",array("id"=>$record_delete));
    //print_r($record_delete);
    //logger_ui("coupon_mange","",$output,5);
    if($output['errorcode']=="3018")
    {
        echo "1";
    }
    else
    {
        echo "0";
    }  
}

?>
