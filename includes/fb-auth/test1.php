<?php
session_start();
if($_REQUEST['signout'])
{
	unset($_SESSION['fb_token']);
}
$user_id;
$id='815419751856336';//'118629428485087';
$secret='913100eb01bc7bd04071a8a68c5246fe';//'158185b6081f6886023fa4807814dcf7';

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
	 $request = new FacebookRequest( $session, 'GET', '/me?id,name,email' );
	 $response = $request->execute();
	 $graphObject = $response->getGraphObject()->asArray();
	 $user_id=$graphObject[id];
	 return $graphObject;
	}
}

FacebookSession::setDefaultApplication($id, $secret);

$helper = new FacebookRedirectLoginHelper('http://pyksaas.com/raprika/includes/fb-auth/test1.php/');
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
		$params = array(
		     scope => 'user_about_me,email,public_profile'
		     
		  );
           $hhhh = $helper->getLoginUrl($params);
	//  echo '<a href="' . $hhhh . '">Loginxcvxvzxvzxvxzv</a>';
					$profile = getUserProfile();
				//	print_r($profile);
                if($profile)
                {
                    $_SESSION['login_data'] = $profile;
                    /*$_SESSION['login_data']['email'] = $_SESSION['login_data']['email'];
                    $_SESSION['login_data']['session_id'] = $_SESSION['login_data']['id'];*/
                    if($_SESSION['pg_direction']=='next_url')
                      {
                        //echo "pgnext";
                       echo "<script>window.location.href = 'http://pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_next'</script>";
                        //header("location:http://pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_next");
                      }
                      else
                      {
                      //  echo "pgsame";
                        echo "<script>window.location.href = 'http://pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_same'</script>";//header("location:http//pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_same");
                        
                      }
                    
                    
                    
                }
                else
                {
                 //   echo "ddddddddddddddd";
                    header("location:$_SESSION[current_url]");
                }
?>
<script>
function fb_login(after_google_signup)
{
    if(after_google_signup=='next_url')
    {
       $.ajax({
                  type: "POST",
                  url:  uri+"article/login/ajax/google_handler.php?next_url",
                  data: 
                            {
                                'stage_couple_price':stage_couple_price,
                                'stage_couple_qty':stage_couple_qty,
                                'stage_female_price':stage_female_price,
                                'stage_female_qty':stage_female_qty,
                                'stage_male_price':stage_male_price,
                                'stage_male_qty':stage_male_qty,
                                'item_id':item_id,
                                'event_type':event_type,
                                'pg_direction':after_google_signup
                                
                            },
                            success: function(data)
                            {
                              
                                
                            }
                            
                }); 
        
      

    }
    else
    {   
        $.ajax({
                  type: "POST",
                  url:  uri+"article/login/ajax/google_handler.php?same_url",
                  data: 
                            {
                                'stage_couple_price':0,
                                'stage_couple_qty':0,
                                'stage_female_price':0,
                                'stage_female_qty':0,
                                'stage_male_price':0,
                                'stage_male_qty':0,
                                'item_id':'',
                                'event_type':'',
                                'pg_direction':after_google_signup
                                
                            },
                            success: function(data)
                            {
                              
                                
                            }
                            
                }); 
        
    }
    window.location.href = "<?php echo $hhhh ;?>";
}
</script>