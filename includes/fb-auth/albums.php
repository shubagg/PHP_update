<?php 
session_start();
ini_set('display_errors',1); 
error_reporting(E_ALL);
if($_REQUEST['signout'])
{
	unset($_SESSION['fb_token']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yo - Facebook Wrapper</title>



<style type="text/css">
    .box{
        margin: 5px;
        border: 1px solid #60729b;
        padding: 5px;
        width: 500px;
        height: 200px;
        overflow:auto;
        background-color: #e6ebf8;
    }
</style>




</head>

<body>
<?php
$user_id;
$id='1577688182443943';
$secret='8fa812d1c03dd9527b5eb8439254e033';

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

function getUserAllAlbums()
{
	global $session,$user_id;
	if(isset($user_id))
	{
		try{
		$request = new FacebookRequest( $session, 'GET', '/'.$user_id."?fields=id,albums" );
	  	$response = $request->execute();
	  	// get response
	  	$temp = $response->getGraphObject()->asArray();
	  	return $temp;
	  	 }
		catch(Exception $e)
		{

		}
	}
}



function getAlbumNames($includeProfileAlbum = false)
{
	// *** Get album data
		$albumsData = _getAlbumData();
		
		$albumNamesArray = array();
		
		if (count($albumsData['data']) > 0) {
			
			// *** Loop through album data
			foreach ($albumsData['data'] as $album) {
				//print_r($album);
				
				// *** Test if we want to include the Profile Pictures album
				if (($includeProfileAlbum || strtolower($album->name) != 'profile pictures')) {
				
					$albumNamesArray[$album->id] = $album->name;
				}
			}
		}
		
		return $albumNamesArray;
}
function _getAlbumData()
{
	global $session,$user_id;
	if(isset($user_id))
	{
		try{
		$request = new FacebookRequest( $session, 'GET', '/'.$user_id."/albums");
		  $response = $request->execute();
		  // get response
		   return $temp = $response->getGraphObject()->asArray();
		    }
		catch(Exception $e)
		{

		}
	}
}

function getCoverPhotoByAlbumId($albumid)
{
	global $session,$user_id;
	if(isset($user_id))
	{
		try{
		$request = new FacebookRequest( $session, 'GET', '/'.$albumid."/picture");
		  $response = $request->execute();
		  // get response
		   return $temp = $response->getGraphObject()->asArray();
		  }
		catch(Exception $e)
		{

		}
	}
}

function getPhotoByAlbumId($albumid)
{
	global $session,$user_id;
	if(isset($user_id))
	{
		try{
		$request = new FacebookRequest( $session, 'GET', '/'.$albumid."/photos");
		  $response = $request->execute();
		  // get response
		   return $temp = $response->getGraphObject()->asArray();
		  }
		catch(Exception $e)
		{

		}
	}
}


FacebookSession::setDefaultApplication($id, $secret);

$helper = new FacebookRedirectLoginHelper('http://optimizerpro.com/nav/fb-auth/albums.php');




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
		     scope => 'user_photos, friends_photos'
		     
		  );
	  echo '<a href="' . $helper->getLoginUrl($params) . '">Login</a>';
	}
	else
	{
		echo '<a href="?signout=1">Logout</a>';
	
	?>
    
    
    <table border="0" cellspacing="3" cellpadding="3">
        <tr>
            <td>
                <!-- Data retrived from user profile are shown here -->
                <div class="box">
                    <b>User Information using Graph API</b>
                    <?php 
					$profile = getUserProfile();
					print_r($profile);
					?>
                </div>
            </td>
           
        </tr>
       
        <tr>
            <td>
                <div class="box">
                    <b>User All Albums graph api</b>
                     <?php 
					$albums = getUserAllAlbums();					
					$allAlbums = $albums['albums']->data;
				print_r($allAlbums);
									   
				   if(is_array($allAlbums)){
				   // loop through all albums... 
				   foreach( $allAlbums as $index => $singleAlbum){
					   // example first album name - 
					$firstAlbumName = $allAlbums[$index]->name;
					$firstAlbumId = $allAlbums[$index]->id;
					$albumFromName = $allAlbums[$index]->from->name;
					//$firstAlbumDescription = $allAlbums[$index]->description;
					//$firstAlbumLink = $allAlbums[$index]->link;
					// in that way you can get all the info...
					  			
					} // end of foreach
				   } // end of is array
				   ?>
                </div>
            </td>
            <td>
                <div class="box">
                     <b>User Single Album By Albumid</b>
                     <?php 
					 	//$albumid = '786832264739219';
						$albumid = $firstAlbumId;
						$singleAlbum = getPhotoByAlbumId($albumid);
						foreach($singleAlbum['data'] as $fb_picture_arr){
							echo "<pre>";
							$maxHeight = 0;
							$maxWidth = 0;
							$closet_width_diff = 100;
							foreach($fb_picture_arr->images as $fb_album_pic){
								$height = $fb_album_pic->height;
								$width = $fb_album_pic->width;
								$width_diff = abs($width-350);
								if($closet_width_diff>$width_diff && $width < '501'){
									$closet_width_diff = $width_diff;
									$closetURL = $fb_album_pic->source;
									$closetWidth = $width;
									$closetHeight = $height;
									$closetURL = $fb_album_pic->source;
								}
								if($maxHeight<$height && $maxWidth<$width){
									$maxHeight = $height;
									$maxWidth = $width;
									$maxURL = $fb_album_pic->source;
								}
							}
							echo 'closeheight: '.$closetHeight.'; closetwidth: '.$closetWidth.'; closetURL: '.$closetURL.'; maxHeight: '.$maxHeight.'; maxwidth: '.$maxWidth.'; maxURL: '.$maxURL;
								echo "<br>";
							echo "</pre><br><br>";
						}
						
					
					?>

                </div>
                
            </td>
        </tr>
    
        
    </table>
   
<?php 

} // islogin
?>
</body>
</html>