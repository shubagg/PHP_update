<?php

/* 
 * Copy Robot
 */
include_once '../../../../global.php';
$robot_id=$_POST['robot_id'];
$title=$_POST['title'];
$unique_id = $_SESSION['user']['name'] . "_" . rand();
$user_id=$_SESSION['user']['user_id'];
if(!empty($robot_id) && !empty($title))
{
    $robotData = select_mongo("robotlist", array('_id' => new MongoId($robot_id)));
    $robotData = add_id($robotData, "id");
    $robotData= $robotData[0];
    if(sizeof($robotData)>0)
    {
        $robotData['robot'][0][tasklist][0]['uniqueid']=$unique_id;
        $robotData['robot'][0][tasklist][0]['userId']=$user_id;
        $robotData['title']=$title;
        $robotData['_id']=new MongoId();
        unset($robotData['id']);
        $res = insert_mongo('robotlist',$robotData);
        if($res['n'] == 1)
        {
            echo json_encode(array("success"=>"false","data"=>"","error_code"=>"18000"));
        }
        else
        {
            $ins_id = db_id($robotData);
            $robotno = rand(1, 10);
            $robotno = "robot" . $robotno;
            $ip_address = $_SERVER['HTTP_HOST'];
            $count = 0;
            $run_time =strtotime(date('Y-m-d h:i a'));
            $res = insert_mongo('robotlistAssociate', array("createDate" => new MongoDate(), "asid" => $ins_id, "status" => "1", "runtime" => $robotno, "path" => "c:/window/rpa", "host" => "localhost", "description" => "robot 1", "name" => $title, "template_name" => "", "userId" => $user_id, "ip_address" => $ip_address,'count'=>$count,'run_time'=>$run_time, 'parent_id' => "0", 'map_id' => "0"));
        }
        echo json_encode(array("success"=>"true","data"=>$title,"error_code"=>"18001"));
    }
    
    
}

