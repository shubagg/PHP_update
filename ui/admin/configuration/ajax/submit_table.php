<?php 
if($_REQUEST['type']=="getjson"){
	echo json_encode(array_values($_POST['tabledata']));	
}

?>