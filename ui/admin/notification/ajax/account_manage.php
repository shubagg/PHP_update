<?php
include_once '../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']=="account_add")
{	
    $verifyRequest=$csrf->verifyRequest();
    if($verifyRequest['success']=='true')
    {
        $output=curl_post("/manage_account",array('domain'=>$_REQUEST['domain'],'username'=>$_REQUEST['username'],'password'=>$_REQUEST['password'],'accType'=>$_REQUEST['type'],'accName'=>$_REQUEST['name'],'from_name'=>$_REQUEST['from_name'],'email'=>$_REQUEST['email'],'url'=>$_REQUEST['url'],'port'=>$_REQUEST['port'],'id'=>$_REQUEST['id']));
        
        
        logger_ui("account_mange","",$output,5);
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

if(isset($_REQUEST['action']) && $_REQUEST['action']=="account_delete")
{
    $data_id=$_REQUEST['data_id'];

    $output=curl_post("/delete_account",array("id"=>$data_id));
     logger_ui("account_mange","",$output,5);
    if($output['errorcode']=="3012")
    {
        echo "1";
    }
    else
    {
        echo "0";
    }    
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="delete_multiple_account")
{
    $data_id=$_REQUEST['accountIds'];
    $pre=explode(",",$data_id);
    $res=implode("|",$pre);
    $output=curl_post("/delete_account",array("id"=>$res));
     logger_ui("account_mange","",$output,5);
    if($output['errorcode']=="3012")
    {
        echo "1";
    }
    else
    {
        echo "0";
    }    
}

?>
