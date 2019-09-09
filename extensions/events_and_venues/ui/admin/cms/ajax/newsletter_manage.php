<?php
include_once '../../../../../../global.php'; 


if(isset($_REQUEST['action']) && $_REQUEST['action']=="newsletter_delete")
{
    $data_id=$_REQUEST['data_id'];

    $output=curl_post("/delete_newsletter",array("id"=>$data_id));
    logger_ui("account_mange","",$output,5);
    
    echo "1";
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="delete_multiple_newsletter")
{
    $data_id=$_REQUEST['accountIds'];
    $pre=explode(",",$data_id);
    $res=implode("|",$pre);
    $output=curl_post("/delete_newsletter",array("id"=>$res));
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
