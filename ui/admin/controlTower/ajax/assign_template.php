<?php

/* 
 * Assign Template to Users
 */
include_once '../../../../global.php';
$tmp = select_mongo('ocrtemplate', array('_id' => new MongoId($_POST['template_id'])));
$retrun = add_id($tmp, "id");
$template_data=$retrun;
$user_id=explode(',',$_POST['user_id']);
$size=sizeof($user_id);
for($i=0;$i<=$size-1;$i++)
{
    $template_data[0]['userId']=$user_id[$i];
    $res = insert_mongo('ocrtemplate', $template_data[0]);
}
?>
