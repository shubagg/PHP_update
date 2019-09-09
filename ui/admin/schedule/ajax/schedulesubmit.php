<?php
include_once '../../../../global.php';
$query=array();

if($_REQUEST['scheduletype']=='1-Hourly')
    {
        $query['user']=$_REQUEST[user];
        $query['starttime']=$_REQUEST[starttime];
        $query['every']=$_REQUEST[every];
        $query['scheduletype']=$_REQUEST[scheduletype];
    }
    else
    {
        $query['user']=$_REQUEST[user];
        $query['starttime']=$_REQUEST[starttime];
        $query['startdate']=$_REQUEST[startdate];
        $query['scheduletype']=$_REQUEST[scheduletype];
    }

$getScheduleData=select_mongo('schedule',$query);
$getres= add_id($getScheduleData,"id");

if(!empty($getres) && sizeof($getres)>0)
{
    $res = array('data'=>'Schedule Aleady Exist','error_code'=>'5004','success'=>'schedule');
}
else
{
    $currentUser = $_SESSION['user']['user_id'];
    if($_REQUEST['scheduletype']=='1-Hourly')
    {
        $_REQUEST['startdate']=date('Y-m-d',time());
    }
    $robot_id=explode('-',$_REQUEST['robot']);
    $robotid=$robot_id[1];
    $condition['_id']=new MongoId($robotid);
    $fields=array('name','userId');
    $getrobotnamedata=select_mongo('robotlistAssociate',$condition,$fields);
    $getrobotname= add_id($getrobotnamedata,"id");
    $_REQUEST['title']=$getrobotname[0]['name'];
    $_REQUEST['machine_id']=$_REQUEST['user'];
    $_REQUEST['userId']=$getrobotname[0]['userId'];
    $res = manage_schedule_robot($_REQUEST);
}

echo json_encode($res);
	
?>