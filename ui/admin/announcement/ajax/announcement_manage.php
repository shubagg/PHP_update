<?php
include_once '../../../../global.php';
if(isset($_REQUEST['action']) && $_REQUEST['action']=="broadcast")
{   

    $output=send_announcement_notification(array('userId'=>$_REQUEST['users'],'ctgId'=>implode(",",explode("|",$_REQUEST['ctgId'])),'type'=>$_REQUEST['type'],'txt'=>$_REQUEST['msg'],'tempId'=>"",'date'=>$_REQUEST['date'],'title'=>$_REQUEST['title'],'customerId'=>$_REQUEST['customerId'],'mid'=>$_REQUEST['mid'],'smid'=>$_REQUEST['smid'],'eid'=>$_REQUEST['eid'],'id'=>$_REQUEST['id']));
   
    if($output['errorcode']=="100")
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="getUsers")
{   
    $emails = array();
    if($_REQUEST['ctgids']!='')
    {
        $ctgs = explode("|",$_REQUEST['ctgids']);
    
        $ctgusers = get_multiple_category_users($ctgs);

        foreach ($ctgusers as $key => $value) 
        {
            array_push($emails,$value['email']);
        }
    }
    
    
    if($_REQUEST['uids']!='')
    {
        $uids = explode(",",$_REQUEST['uids']);
        $uids = implode("|",$uids);
    
        $userdata = get_resource_by_id(array("id"=>$uids));
        foreach ($userdata['data'] as $key1 => $value1) {
           array_push($emails, $value1['email']);
        }
    }
    
    $final_array = array();
    $final_array = array_unique($emails);
    echo implode(",", $final_array);

    //you have to get users email here
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="trigger_add")
{	
    
    $output=curl_post("/manage_trigger",array('mid'=>$_REQUEST['module_id'],'eid'=>$_REQUEST['event_id'],'smid'=>$_REQUEST['submoduletri'],'tempId'=>$_REQUEST['temp_id'],'accId'=>$_REQUEST['acc_id'],'mtempId'=>$_REQUEST['mtemp_id'],'subject'=>$_REQUEST['subject'],'type'=>$_REQUEST['types'],'ctgId'=>$_REQUEST['ctg_id'],'id'=>$_REQUEST['id'],'msg'=>$_REQUEST['smsmsg'],'mailType'=>$_REQUEST['mailtypevalue'],'mailInterval'=>$_REQUEST['newstab']));
   
    logger_ui("trigger_manage","",$output,5);
    if($output['errorcode']=="100")
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="get_events")
{	
    $output=get_submodule_events(array('mid'=>$_REQUEST['module_id'],'smid'=>$_REQUEST['smidevent']));
   
    logger_ui("trigger_manage","",$output,5);
    if($output['error_code']=="100")
    {
        echo json_encode($output['data']);
    }
    else
    {
        echo "0";
    }
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="get_me_templates")
{	
    $output=curl_post("/get_me_templates",array('mid'=>$_REQUEST['module_id'],'eid'=>$_REQUEST['event_id'],'smid'=>$_REQUEST['smidtemp']));
   
    logger_ui("trigger_manage","",$output,5);
    if($output['errorcode']=="100")
    {
        echo json_encode($output['data']);
    }
    else
    {
        echo "0";
    }
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="trigger_delete")
{
    $data_id=$_REQUEST['data_id'];

    $output=curl_post("/delete_trigger",array("id"=>$data_id));

    logger_ui("trigger_manage","",$output,5);
    if($output['errorcode']=="3015")
    {
        echo "1";
    }
    else
    {
        echo "0";
    } 
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="delete_multiple_trigger")
{
    $data_id=$_REQUEST['triggerIds'];
    $data_id=explode(",", $data_id);
    $data_id=implode("|", $data_id);
   
    $output=curl_post("/delete_trigger",array("id"=>$data_id));
    logger_ui("trigger_manage","",$output,5);
    if($output['errorcode']=="3015")
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="trigger_check_type")
{   
    if($_REQUEST['mid']!="23")
    {
        $output=check_trigger(array('mid'=>$_REQUEST['mid'],'eid'=>$_REQUEST['eid'],'smid'=>$_REQUEST['smid'],'type'=>$_REQUEST['types']));
        
        logger_ui("trigger_check_type","",$output,5);
        if($output['data']=="0")
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
        echo "1";
    }
}
?>
