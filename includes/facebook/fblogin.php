<?php
require 'src/config.php';
require 'src/facebook.php';
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $config['App_ID'],
  'secret' => $config['App_Secret'],
  'cookie' => true
));

if(isset($_GET['logout']))       
{
    $url = 'https://www.facebook.com/logout.php?next=' . urlencode('http://demo.phpgang.com/facebook_login_graph_api/') .
      '&access_token='.$_GET['tocken'];
    session_destroy();
    header('Location: '.$url);
}
if(isset($_GET['fbTrue']))
{
    $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=".$config['App_ID']."&redirect_uri=" . urlencode($config['callback_url'])
       . "&client_secret=".$config['App_Secret']."&code=" . $_GET['code']; 

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
    print_r($user); 
     if((!isset($user->email))||($user->email==''))
     {
        $redirect = $current_url.'?logout=1&tocken='.$params['access_token'];
        header('Location: ' . $redirect);
        
     }
    // $extra = "<a href='index.php?logout=1&tocken=".$params['access_token']."'>Logout</a><br>";     
    /* $user;*/
     //print_r($user);
 ?>
 <script>

 
    if(same_page)
    {
        document.getElementById('email').value = "<?php echo $user->email; ?>";
        $('#pwd').removeClass('required_field signup');
        $('#phone').removeClass('required_field signup');
        $('#signup_submit').click();
    }
    else if(next_page)
    {
        document.getElementById('email_wsup').value = "<?php echo $user->email; ?>";
        document.getElementById('pwd_wsup').value = "<?php echo $user->name; ?>";
        $('#phone_wsup').removeClass('required_field without_signup');
        $('#signup_for_payment').click();    
        
    }
    else
    {
        
    }
    </script>
 <?php    
     
}
else
{    
    $content = '"https://www.facebook.com/dialog/oauth?client_id='.$config['App_ID'].'&redirect_uri='.$config['callback_url'].'&scope=email,user_likes"';
}
?>
<script>
 function facebook_login(after_google_signup)
{
    alert(<?php echo $content;?>);
    window.location.href = <?php echo $content;?>;    
}
</script>