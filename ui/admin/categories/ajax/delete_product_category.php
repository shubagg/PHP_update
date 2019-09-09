<?php
include_once '../../../../global.php';
$delCategory=delete_product_category($_POST);
echo json_encode($delCategory);
?>