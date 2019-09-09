<?php
include_once '../../../../global.php';

$get_contact=curl_post("/get_contact",array("id"=>"0"));
if(!empty($get_contact['data']))
{
	$show_data=array();
	foreach($get_contact['data'] as $contact_fatch)
	{
	    $data=array("name"=>$contact_fatch['name'],"email"=>$contact_fatch['email'],"phone"=>$contact_fatch['phone'],"subject"=>$contact_fatch['subject'],"orderno"=>$contact_fatch['orderno'],"info"=>$contact_fatch['info']);
	    array_push($show_data,$data);
	}
	$header_fields=array('Name','Email ID','Phone','Subject','Order No','Description');
	$ex=curl_post("/export_xls",array("header_fields"=>json_encode($header_fields),"show_data"=>json_encode($show_data)));
	echo json_encode($ex);
}
else
{
	return "0";
}
?>