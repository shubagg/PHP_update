<?php 
include_once '../../../../../../global.php'; 

$id=$_POST['id'];
$output=get_commentbenefit(array("id"=>$id));
echo json_encode($output['data']); 

?>
