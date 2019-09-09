<?php
include_once ('../../../../global.php');
$middlejson=select_mongo("robotlist",array("_id"=>new MongoId($_GET['id'])),array("nestable_structure"));
$middlejson=add_id($middlejson,"id");
$taskList=$middlejson[0]['nestable_structure'];
echo json_encode($taskList);
?>