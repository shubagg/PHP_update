<?php
include("../../../../global.php");
error_reporting(0);
$formData=json_decode($_POST['form_data'],true);
$jobId=$_POST['jobId'];
$_SESSION['title']=$_POST['title'];
$_SESSION['description']=$_POST['title'];
$_SESSION['action_comment']=$_POST['action_comment'];
$_SESSION['form_data']=$_POST['form_data'];
$_SESSION['editMode']=$_POST['editMode'];

if(!empty($jobId))
{     
	
	$data=array('id'=>$jobId,'smid'=>3,'files'=>$_FILES,'form_data'=>$_POST['form_data'],'userid'=>$_POST['userId'],'senderid'=>$_POST['senderid'],'deviceType'=>'web','action'=>$_POST['action'],'approval_id'=>$_POST['approval_id'],'title'=>$_POST['title'],'action_comment'=>$_POST['action_comment']);

	$submitForm = curl_post('/create_extension_form_job',$data);
	$_SESSION['jobId']=$submitForm['data']['id'];
	echo json_encode($submitForm);
	
	
}
else
{
	
	$formValues=json_decode($_POST['formValue'],true);
	$data=array('id'=>'0','smid'=>'3','form_id'=>$_POST['formId'],'action_by'=>$_POST['userId'],'description'=>$_POST['description'],'category'=>$_SESSION['formcategory'],'title'=>$_POST['title'],'action_comment'=>$_POST['action_comment'],'form_data'=>$_POST['form_data'],'files'=>$_FILES,'type'=>'','aiid'=>'','asmid'=>'','amid'=>'');
	
	$submitForm = curl_post('/create_extension_form_job',$data);
	//pr($submitForm); die;
	$_SESSION['jobId']=$submitForm['data']['id'];
	echo json_encode($submitForm);
}
?>