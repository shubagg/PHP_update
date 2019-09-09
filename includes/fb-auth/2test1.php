<?php 

session_start();
//print_r($_SESSION);
//$_SESSION['fb_token']="CAAFkVpcZCuqcBAE0YgD0tPnoGZCOlfNsgPAGd0yIbY73jvfvoXxCiX6W2Ov50jMmj6w3cmCe0LK8Qsyk0fP4XMpyGZCfkgW7MvZCiZAi3gpWF10eUZAQqAt1G20zHM0KkQopc1QV0Ozb4hxb0HwrR0JpBNZAiknCyXpPMYgfGx6fCX1BvVkkBuvTYoovpihzLgZD";
if($_REQUEST['signout'])
{
	unset($_SESSION['fb_token']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roni - Facebook Wrapper</title>




</head>

<body>
<?php
$user_id;
$id='118629428485087';
$secret='f8a4feca18fdead93cc73759cf21939a';

define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/facebook/src/Facebook/');
require __DIR__ . '/facebook/autoload.php';

require_once( __DIR__.'/facebook/src/Facebook/FacebookSession.php' );
require_once( __DIR__.'/facebook/src/Facebook/FacebookRedirectLoginHelper.php' );
require_once( __DIR__.'/facebook/src/Facebook/FacebookRequest.php' );
require_once( __DIR__.'/facebook/src/Facebook/FacebookResponse.php' );
require_once( __DIR__.'/facebook/src/Facebook/FacebookSDKException.php' );
require_once( __DIR__.'/facebook/src/Facebook/FacebookRequestException.php' );
require_once( __DIR__.'/facebook/src/Facebook/FacebookAuthorizationException.php' );
require_once( __DIR__.'/facebook/src/Facebook/GraphObject.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

function getUserProfile()
{
	global $session,$user_id;
	if($session)
	{
	 $request = new FacebookRequest( $session, 'GET', '/me' );
	 $response = $request->execute();
	 $graphObject = $response->getGraphObject()->asArray();
	 $user_id=$graphObject[id];
	 return $graphObject;
	}
}

FacebookSession::setDefaultApplication($id, $secret);

$helper = new FacebookRedirectLoginHelper('http://pyksaas.com/raprika/include/fb-auth/test1.php');




// see if a existing session exists
//print_r($_SESSION['fb_token']);
if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
    // create new session from saved access_token
    $session = new FacebookSession($_SESSION['fb_token']);
    // validate the access_token to make sure it's still valid
    try {
        if (!$session->validate()) {
            $session = null;
        }
    } catch (Exception $e) {
        // catch any exceptions
        $session = null;
    }
} else {
    // no session exists
    try {
        $session = $helper->getSessionFromRedirect();

    } catch (FacebookRequestException $ex) {
        // When Facebook returns an error
    } catch (Exception $ex) {
        // When validation fails or other local issues
        echo $ex->message;
    }
}

//storing token in session
 if(isset($session)&&(!isset($_SESSION['fb_token'])))
        $_SESSION['fb_token']=$session->getToken();

// see if we have a session

	if(!isset($session))
	{
		$params = array(
		     scope => 'user_about_me'
		     
		  );
	  echo '<a href="' . $helper->getLoginUrl($params) . '">Login</a>';
	}
	else
	{
		echo '<a href="?signout=1">Logout</a>';
	}
	?>
 <div class="box">
                    <b>User Information using Graph API</b>
                    <?php 
					$profile = getUserProfile();
					print_r($profile);
					?>
                </div>