<?php
include_once ('../../../../global.php');
$action=$_REQUEST['action'];

if($action=='add_discussion')
{   
     $user_id=$_SESSION['user']["user_id"];
     $question = $_REQUEST['question'];
     $question =str_replace("|!|!","&",$question);
     $output=manage_forum(array('id'=>0,'question'=>$question,'answer'=>'','userId'=>$user_id));
     logger_ui("add_discussion/add","",$output,5);
    
     if($output['errorcode']=="7006")
     {
        echo "1";
     }
     else 
     {
        echo "0";
     }
    
}

if($action=='edit_discussion')
{
        $questionid=$_REQUEST['questionid'];
        $answer = trim($_REQUEST['answer']);
        $answer =str_replace("|!|!","&",$answer);
        $user_id=$_SESSION['user']["user_id"];
        $output=manage_forum(array('id'=>$questionid,'question'=>'','answer'=>$answer,'userId'=>'','answeredBy'=>$user_id,"status"=>"1"));
        logger_ui("add_blog/update","",$output,5);

     if($output['errorcode']=="7005")
     {
        echo "1";
     }
     else 
     {
        echo "0";
     }
     
    
}
if(isset($_REQUEST['data_id']))
{
     $data_id=$_REQUEST['data_id'];
     $output=curl_post("/delete_forum",array("id"=>$data_id));
     
     logger_ui("delete_forum/delete","",$output,5);
     
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
    $output=curl_post("/delete_forum",array("id"=>$blog_ids));
    logger_ui("delete_forum/delete","",$output,5);
     
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
