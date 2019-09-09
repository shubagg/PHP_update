<?php
include_once '../../../../../global.php';
if(isset($_REQUEST['action']) && $_REQUEST['action']=="deletewarehouse")
{
	$output=curl_post("/deletewarehouse",array("id"=>$_POST['user_ids']));
	echo json_encode($output);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="deleteeventvenue")
{
	//$user_ids=implode("|",explode(",",$_POST['user_ids']));
	$output=curl_post("/deleteEvent",array("id"=>$_POST['user_ids'],"delete"=>"1"));
	echo json_encode($output);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="deleteStatelocation")
{
	$user_ids=implode("|",explode(",",$_POST['user_ids']));
	$output=curl_post("/delete_country_state_cities_by_tablename",array("tablename"=>'states',"id"=>$user_ids));
	echo json_encode($output);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="deletecitylocation")
{
	$user_ids=implode("|",explode(",",$_POST['user_ids']));
	$output=curl_post("/delete_country_state_cities_by_tablename",array("tablename"=>'cities',"id"=>$user_ids));
	echo json_encode($output);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="category")
{
	$output=curl_post("/deleteCategory",array("id"=>$_POST['user_ids']));
	echo json_encode($output);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="deletetax")
{
	$output=curl_post("/deleteTax",array("id"=>$_POST['taxId']));
	echo json_encode($output);
}
?>