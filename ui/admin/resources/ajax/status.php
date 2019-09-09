<?php
include_once '../../../../global.php';

if($_POST['val']==1)
{
    $res=change_module_status(array('mid'=>$_POST['mid'],'status'=>'1'));
    echo json_encode($res);
}
else
{
    $res=change_module_status(array('mid'=>$_POST['mid'],'status'=>'0'));
    echo json_encode($res);
}



?>