<?php
require 'Slim/Slim.php';
require 'includes/class.user.php';
require 'includes/class.articleAudio.php';
require 'includes/class.article.php';
require 'includes/class.playlist.php';
require 'includes/class.channel.php';
require 'includes/functions.php';

//error_reporting(1);
//$path = "/slim";
$path = "";
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->view(new \JsonApiView());
$app->add(new \JsonApiMiddleware());

//user routes
$app->post($path.'/user/:action','user_action');
$app->get($path.'/user/:action','user_action');

//interest routes
$app->get($path.'/interest/list','interest_list');

//channel routes
$app->get($path.'/channel/list','channel_list');
$app->post($path.'/channel/search','search_channel');

// article routes
$app->get($path.'/article/:action','article_action');
$app->post($path.'/article/:action','article_action');


function user_action($name)
{
	global $app;
	//$postVar = $app->request->post();
	//print_r($postVar);
	switch($name)
	{
		case 'signup':
			user_signup();
		break;

		case 'signin':
			user_signin();
		break;
		case 'reset_password':
			reset_password();
		break;
		case 'get_channel':
			user_get_channel();
		break;
		case 'set_channel':
			user_set_channel();
		break;
		case 'set_interest':
			user_set_interest();
		break;
		case 'playlist':
			user_playlist();
		break;
		case 'update_profile':
			user_update_profile();
		break;
		case 'profile_pic':
			user_profile_pic();
		break;
		case 'listened':
			user_listened();
		break;
		case 'recommended':
			user_recommended();
		break;
		case 'shared':
			user_shared();
		break;
		case 'update_profile_pic':
			user_update_profile_pic();
		break;
	}
     //echo "Hello, " . $name;
     $app->render(200,$postVar);
}

function article_action($name)
{
	global $app;

	switch($name)
	{
		case 'list':
			article_list();
		break;
		case 'details':
			article_details();
		break;
	}

}
function rs($data=array(),$code='100',$success="true",$msg="")
{
	global $app;
	if($data=="")
		$data=array();

	$app->render(200,array('data'=>$data,'success'=>$success,'errorcode'=>$code));
}
$app->run();
?>