<?php
include_once ('../../../../global.php');
$action=$_REQUEST['action'];

    if(isset($_REQUEST['data_id']))
{
     $data_id=$_REQUEST['data_id'];
     $output=curl_post("/delete_comment",array("id"=>$data_id));
     
     logger_ui("delete_comment/delete","",$output,5);
     
     if($output['errorcode']=="7003")
     {
        echo "1";
     }
     else 
     {
        echo "0";
     }
}

if(isset($_REQUEST['data_ids']))
{
    $blog_id=$_POST['data_ids'];
    $sizes=explode(",",$blog_id);
    $blog_ids=implode("|",$sizes);
    $output=curl_post("/delete_comment",array("id"=>$blog_ids));
    logger_ui("delete_comment/delete","",$output,5);
     
     if($output['errorcode']=="7003")
     {
        echo "1";
     }
     else 
     {
        echo "0";
     }
}

?>
