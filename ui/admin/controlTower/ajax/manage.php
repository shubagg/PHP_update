<?php
include_once ('../../../../global.php');
/*$action=$_REQUEST['action'];
if($action=='senddata')
{   
        $data['createDate'] = new MongoDate();
        $data['status'] = "0";
        $data['_id'] = new MongoId();
        $res = insert_mongo('checkrobotstatus',$data);
}*/

$action=$_REQUEST['action'];
if($action=='senddata')
{   
        $data['createDate'] = new MongoDate();
        $data['status'] = "0";
        $data['asid'] = $_POST['id'];
        $data['map_id'] = $_POST['c_id'];
        $data['ip'] = $_POST['ip'];
        $data['_id'] = new MongoId();
        $res = insert_mongo('robotrunstatus',$data);
        $resp = update_mongo('robotlistAssociate',array("status"=>'0'),array('_id'=>new MongoId($_POST['c_id']))); 
}

if($action=='delete_robot')
{   
        $res = delete_mongo('robotrunstatus',array('asid'=>$_POST['asid']));
        $resp=delete_mongo('robotlistAssociate',array('asid'=>$_POST['asid']));
        $resp=delete_mongo('robotlist',array('_id'=>new MongoId($_POST['asid'])));
         
}   
?>
