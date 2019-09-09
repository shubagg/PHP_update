<?php
include_once '../../../../global.php';

$get_contact=get_email_by_id(array('id'=>0)); 
if(!empty($get_contact['data']))
{
	$show_data=array();
	foreach($get_contact['data'] as $contact_fatch)
	{
	    $data=array("email"=>$contact_fatch['email']);
	    array_push($show_data,$data);
	}
	$header_fields=array('Email ID');
	$ex=curl_post("/export_xls",array("header_fields"=>json_encode($header_fields),"show_data"=>json_encode($show_data)));
	echo json_encode($ex);
}
else
{
	return "0";
}
?>