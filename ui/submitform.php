<?php 
   
 
 $user_id = $_GET['user_id'];
 $job_id = $_GET['job_id'];
 $action=$_REQUEST['action'];
   
 if($action=='submitservey')
{   

    $req=$_REQUEST;
    //print_r($req);
    $user_id = $req['user_id'];
    $job_id = $req['job_id'];
    unset($req['user_id']);
    unset($req['job_id']);
    unset($req['action']); 
    $json = json_encode($req);
     
    $output=curl_post("/manage_job_related_data",array('iid'=>$job_id,'userid'=>$user_id,'note'=>$json,'type'=>"feedback",'mediaid'=>""));
    print_r($output);
}



?>