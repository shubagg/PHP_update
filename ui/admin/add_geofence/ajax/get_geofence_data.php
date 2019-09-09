<?php
require_once '../../../../global.php';

/*$a = array('userId'=>base64_decode($_POST['userId']),'mid'=>$_POST['mid'],'smid'=>$_POST['smid'],'iid'=>$_POST['iid']);
print_r($a);*/

$geoData=get_geofence(array('userId'=>base64_decode($_POST['userId']),'mid'=>$_POST['mid'],'smid'=>$_POST['smid'],'iid'=>$_POST['iid']));
if($geoData['success']=='true')
{
	echo json_encode($geoData['data']);
}
else
{
	echo json_encode(array("success"=>"false","error_code"=>"16023"));
	//echo "false";
}
//echo json_encode(array("success"=>"false","error_code"=>"16023"));

?>