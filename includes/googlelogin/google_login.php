<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
require_once 'src/apiClient.php';
require_once 'src/contrib/apiOauth2Service.php';
session_start();

$client = new apiClient();
$client->setApplicationName("Google Account Login");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
// $client->setRedirectUri('insert_your_redirect_uri');
// $client->setDeveloperKey('insert_your_developer_key');
$oauth2 = new apiOauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
if((isset($_REQUEST['error']))&&($_REQUEST['error']=='access_denied'))
{
    header("location:$_SESSION[current_url]");
}
if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  unset($_SESSION['google_data']); //Google session data unset
  $client->revokeToken();
}

if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();
  //print_r($user);
  $_SESSION['login_data']=$user;
  
//  header("location: home.php");
  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
 // $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
 // $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  //$personMarkup = "$email<div><img src='$img?sz=50'></div>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
    
    
  if($_SESSION['pg_direction']=='next_url')
  {
    
   echo "<script>window.location.href = 'http://pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_next'</script>";
    die;// header("location:http//pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_next");
  }
  else
  {
    
    echo "<script>window.location.href = 'http://pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_same'</script>";//header("location:http//pyksaas.com/raprika/ui/article/login/ajax/google_handler.php?add_user_same");
    die;
  }
  
  
} else
{
  $authUrl = $client->createAuthUrl();
}
?>

<script>
function gplus_login(after_google_signup)
{
    //alert(after_google_signup);
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
    
    window.location.href = "<?php echo $authUrl;?>";    
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
</script>
<?php if(isset($personMarkup)): ?>
<?php print $personMarkup ?>
<?php endif ?>

