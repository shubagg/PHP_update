<?php
include_once '../../../../global.php';

$geoData=get_geofence(array('userId'=>$_POST['userId'],"mid"=>$_POST['mid'],"smid"=>$_POST['smid'],"iid"=>$_POST['iid']));
$dataAvailable=json_decode($geoData['data'][0]['poiData'],true);
unset($dataAvailable[$_POST['key']]);

$data=array('poiData'=>json_encode(array_values($dataAvailable)),'userId'=>$_POST['userId'],"mid"=>$_POST['mid'],"smid"=>$_POST['smid'],"iid"=>$_POST['iid']);
$manage=manage_geofence($data);	
echo json_encode($manage);

?>