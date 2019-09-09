<?php
require '../global.php';
require 'Slim/Slim.php';

//error_reporting(1);

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->view(new \JsonApiView());
$app->add(new \JsonApiMiddleware());
//echo "kjsakjsakjc";
//echo get_current_token();
$refreshedToken=array();

if(OAUTH){
	$webserviceTitle=explode("webservices/",$_SERVER['REQUEST_URI']);
	$webserviceTitle=$webserviceTitle[1];
	if(!in_array($webserviceTitle, $webservicesWithoutOauth)){
		if(isset($_POST['token'])){
			$deviceType=$_POST['deviceType'];
			unset($_POST['deviceType']);
			$tokenData=explode("-",$_POST['token']);
			$token=$tokenData[0];
			$permissions=$tokenData[1];


			$client_id=$_POST['client_id'];
			$client_secret=$_POST['client_secret'];
			$refresh_token=$_POST['refresh_token'];
			if(isset($data['deviceType'])){ $deviceType=$data['deviceType']; unset($data['deviceType']); }
			unset($_POST['token']);unset($_POST['client_id']);unset($_POST['client_secret']);unset($_POST['refresh_token']);
			$_POST['perms']=$permissions;
			$checkToken=verify_token(array('token'=>$token,'client_id'=>$client_id,'client_secret'=>$client_secret,'refresh_token'=>$refresh_token,'deviceType'=>$deviceType));
			if(!is_array($checkToken)){  $checkToken=json_decode($checkToken,true); }
			//$log='';

			if($checkToken['success']!='true'){
				if($deviceType=='web'){
					$generate_refresh_token=refresh_token(array('refresh_token'=>$refresh_token));
					if($generate_refresh_token['success']=='true')
					{
						$generate_refresh_token['data']['access_token']=$generate_refresh_token['data']['access_token']."-LALIT-".$permissions;
						$refreshedToken=$generate_refresh_token['data'];
					}
					else
					{
						echo json_encode($generate_refresh_token);die;
					}
					
				}else{
					echo json_encode($checkToken);
					die;
				}
				
			}

		}else{
			echo json_encode(array('success'=>'false','data'=>'token required','error_code'=>'101'));
			die;
		}
		
	}
}

//adding module webservices

require_once($server_path.'includes/modules_webservices_lists.php');

//adding extensions module webservices
require_once($server_path.'extensions/extension_modules_webservices_lists.php');


function webservice_access_denied(){
	rs('Access Denied','101','false');
}


function rs($data=array(),$code='100',$success="true",$mod)
{
	logger($mod,$code,$data,4,get_caller());
	global $app,$refreshedToken;
	if($data=="")
		$data=array();
	if(sizeof($refreshedToken)){ $data['refreshedToken']=$refreshedToken; }
	$app->render(200,array('data'=>$data,'success'=>$success,'errorcode'=>$code));
}
$app->run();
?>
