<?php
include_once '../../../../global.php';
function check_poi_exists($value)
{
	$chk=array('success'=>'false');
	$geoData=get_geofence(array('userId'=>$_POST['userId'],"mid"=>$_POST['mid'],"smid"=>$_POST['smid'],"iid"=>$_POST['iid']));
    $dataAvailable=json_decode($geoData['data'][0]['poiData'],true);
	foreach ($dataAvailable as $dt) {
		if($value['lat']==$dt['lat'])
		{
			$chk=array('success'=>'true','data'=>$dt);
		}
	}
	return $chk;
}


if($_POST['poiData']){
	$poiData=json_decode($_POST['poiData'],true);
	$allData=array();
	foreach ($poiData as $key => $value) {
			$check=check_poi_exists($value);
			if($check['success']=='true')
			{
				$value['address']=$check['data']['address'];
				$value['creationDate']=$check['data']['creationDate'];
			}
			else
			{
				$address=getaddress($value);
				$value['address']=$address['data'];
				$value['creationDate']=date('Y-m-d');
			}
			array_push($allData, $value);
		}
		$data=array('userId'=>$_POST['userId'],"mid"=>$_POST['mid'],"smid"=>$_POST['smid'],"iid"=>$_POST['iid'],'poiData'=>json_encode($allData));
		$manage=manage_geofence($data);	
}
else
{
	$manage=manage_geofence($_POST);	
}
echo json_encode($manage);
?>