<?php include_once("../../../global.php");

if(isset($_GET['action']) && $_GET['action']=="submit"){
	print_r($_POST);
}
if(isset($_GET['action']) && $_GET['action']=="upload_request"){
	
	$rep=pdf_status(array("ip"=>$_POST['ip'],"status"=>"0","id"=>"0","userid"=>$_POST['userid']));
	echo json_encode($rep);
}
if(isset($_GET['action']) && $_GET['action']=="uploading_process"){
	$rep=run_invoice_status(array("id"=>$_POST['id'],"table"=>"invoice_execute_status"));
	echo json_encode($rep);
}
?>