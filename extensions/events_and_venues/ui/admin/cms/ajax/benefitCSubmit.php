<?php 
include_once '../../../../../../global.php'; 

$manageProduct = manage_commentbenefit($_POST);

echo json_encode($manageProduct);


?>
