<?php

include_once '../../../../global.php';

if(isset($_REQUEST['action']) && $_REQUEST['action']=='report')
{

 	$head_data=$_POST['head_data'];
 	$show_data=$_POST['show_data'];
 	$head=array();
 	//print_r($show_data);die;
	if(sizeof($show_data)>0)
	{
		$ex=curl_post("/export_xls",array('head_data'=>$head,"header_fields"=>json_encode($head_data),"show_data"=>json_encode($show_data)));

	    //$export_xls=export_xls($header_fields,$show_data,$head);
		echo json_encode($ex);
	}
	else
	{
		$ret=array('success'=>'false','error_code'=>'120','data'=>'');
		echo json_encode($ret);
	}
}
?>