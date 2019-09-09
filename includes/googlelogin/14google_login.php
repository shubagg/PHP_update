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
error_reporting(E_ALL);
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
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  //header('Location: ' . $redirect);
  //header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));

}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

/*if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  unset($_SESSION['google_data']); //Google session data unset
  $client->revokeToken();
}
*/
if ($client->getAccessToken()) {
  $g_user = $oauth2->userinfo->get();
  
  print_r($g_user);
  if(count($g_user)>0)
  {
    $_SESSION['google_data']=$g_user;
  ?>
  <script>
    if(same_page)
    {
        document.getElementById('email').value = "<?php echo $g_user['email']; ?>";
        $('#pwd').removeClass('required_field signup');
        $('#phone').removeClass('required_field signup');
        $('#signup_submit').click();
    }
    else if(next_page)
    {
        document.getElementById('email_wsup').value = "<?php echo $g_user['email']; ?>";
        document.getElementById('pwd_wsup').value = "<?php echo $g_user['name']; ?>";
        $('#phone_wsup').removeClass('required_field without_signup');
        $('#signup_for_payment').click();    
        
    }
    else
    {
        
    }
  </script>  
      
  <?php }
  else
  {
         header('Location: ' . $current_url);
    
  }

  
  
//  header("location: home.php");
  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
 // $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
 // $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  //$personMarkup = "$email<div><img src='$img?sz=50'></div>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
} 
else 
{
  $authUrl = $client->createAuthUrl();
  
  
}
?>
<script>
function gplus_login(after_google_signup)
{
    
    window.location.href = "<?php echo $authUrl;?>";    
}

</script>

<?php if(isset($personMarkup)): ?>
<?php print $personMarkup ?>
<?php endif ?>

