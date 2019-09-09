<?php
include_once '../../../../global.php';
if(isset($_POST) && $_POST['userid']){
    $userid = $_REQUEST['userid'];
    $query = array();
    //$fields=array("asid");
    $query['userId']=$userid;

    $robotdata = select_mongo('robotlistAssociate',$query);
    $robot = add_id($robotdata,"id");
    echo json_encode($robot);
}

?>