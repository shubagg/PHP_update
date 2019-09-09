<?php
include_once '../../../../../../global.php'; 
$manageAttribute=manage_attribute($_POST);
if($manageAttribute['success']=='true')
{
	if(sizeof($_FILES)>0)
	{
		$mediaData=array('id'=>'0','smid'=>'1','amid'=>'16','asmid'=>'2','aiid'=>$manageAttribute['data'],'mediaName'=>'image','mediaType'=>'image','multimedia'=>"0");
		$manage_media=manage_media($mediaData);
	}
}
echo json_encode($manageAttribute);
?>