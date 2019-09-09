<?php
include_once '../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']=="manage_cms")
{	
    
    $output=curl_post("/manage_cms",array('slug'=>$_REQUEST['slug'],'icon'=>$_REQUEST['icon'],'subtitle'=>$_REQUEST['subtitle'],'title'=>$_REQUEST['title'],'email'=>$_REQUEST['email'],'mobile'=>$_REQUEST['mobile'],'weburl'=>$_REQUEST['weburl'],'address'=>$_REQUEST['address'],'description'=>urlencode($_REQUEST['description']),'id'=>$_REQUEST['id']));
    
    if($output['errorcode']=="24008")
    {
        echo "1";
    }
    else if($output['errorcode']=="24001")
    {
        echo "2";
    } 
    else
    {
        echo "0";
    }    
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=="cms_delete")
{
    $data_id=$_REQUEST['data_id'];
    $output=curl_post("/delete_cms",array("id"=>$data_id));
    logger_ui("cms_manage","",$output,5);
    if($output['errorcode']=="24003")
    {
        echo "1";
    }
    else
    {
        echo "0";
    }    
}

?>
