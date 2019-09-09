<?php
include_once '../../../../../../global.php'; 
$deleteAttribute=delete_attribute($_POST);
echo json_encode($deleteAttribute);
?>