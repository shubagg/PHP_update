<?php
error_reporting(1);
$user_id;
$id='815419751856336';
$secret='913100eb01bc7bd04071a8a68c5246fe';

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

$fb_user_id="";

function getFbUserProfile()
{
 global $fb_session,$fb_user_id;
 print_r($fb_session);
 if($fb_session) {
    echo "sdfsdf";
        try{
          echo "rt";
        $request = new FacebookRequest( $fb_session, 'GET', '/me' );
        print_r($request);
        $response = $request->execute();
        $graphObject = $response->getGraphObject()->asArray();
        $fb_user_id = $graphObject['id'];
        print_r($graphObject);
        return $graphObject;
      }
      catch(Exception $e)
        {

        }
 }
}
function getFbFriends()
{
 global $fb_session,$fb_user_id;
 if(isset($fb_user_id))
 {
  try{
  $request = new FacebookRequest( $fb_session, 'GET', '/'.$fb_user_id."/friends");
    $response = $request->execute();
    // get response
     return $temp = $response->getGraphObject()->asArray();
      }
  catch(Exception $e)
  {

  }
 }
}

$fb_session = new FacebookSession("CAALlnrSmZBNABAFZCdkYFYRUdlQIiTyo0ez7oh7I2gDdu9Ks74Rf9SEHbwa8TAm1dG5U8Pju1GVNGJfeaVhHXtSunSnYRKf2701ZBf3AY99ZCtN2BcSANt0ji0ZAIEIPaUWjyGJEDT6NQcjfKaiJsgjOn2qUXhTgb9X011f7J1SPultCpfEUshDqZArWqZCPXMZD");
//print_r($fb_session);
print_r(getFbUserProfile());
print_r(getFbFriends());
?>