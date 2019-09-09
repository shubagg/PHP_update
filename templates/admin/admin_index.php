<?php
$remember=isset($_COOKIE['remember'])?$_COOKIE['remember']:'';
$username=isset($_COOKIE['username'])?$_COOKIE['username']:'';
$password=isset($_COOKIE['password'])?$_COOKIE['password']:'';

$companyData=get_company_data();
$login_class = "";
if(isset($companyData['login_class']))
{
	$login_class=$companyData['login_class'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->

<title><?php echo ucfirst($companyData['name']); ?> |  <?php echo $ui_string['adminpanel'];?></title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo site_url()."company/".$companyData['cid']."/favicon.ico"; ?>">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>plugins/combineCss/tm_css.css?84000" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/style.css?84000" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/style.css?84000" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/font-awesome/font-awesome.min.css?84000" />  
<?php
foreach (customAssets() as $key => $val) {
  if($val[0]=="css"){
    echo '<link type="text/css" rel="stylesheet" href="'.getCompanySpecificAssets($val[0],$val[1]).'" />';
  }
}
?>

<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/loader.css" />
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.min.js?84000"></script>
<script src="<?php echo site_url()."ui/js_error.php";?>"></script>
<script>
$(document).ready(function(){
    $("#forgot").click(function(){
        $("#login").hide();
        $("#forgotpassword").show();
        $("#current_process").val("2");
    });
    $("#back").click(function(){
    	 $("#forgotpassword").hide();
        $("#login").show();
        $("#current_process").val("1");
   
       
    });
});
</script>

<style>.error {
font-size: 12px !important;
color: #f00;

}
.capbox {
display: inline-block;
zoom: 1;
width: 100%;
}

.capbox-inner {
font: bold 11px arial, sans-serif;
color : #000000;
background-color: #03312d;
margin: 5px auto 0px auto;
padding: 3px 0px;

}
.orange-buton{
		    background-color: #4a9ad0;
}
#captcha {
font: bold 17px verdana, arial, sans-serif;
font-style: italic;
color: #000000;
background-color: #FFFFFF;
padding: 10px 20px;
}

#captcha_code {     margin: 1px 0px 1px 0px;
width: 100%;
padding: 12px 10px; }


.blue-theme .account-wall {
    background: rgba(0, 0, 0, .9);
}

.red-theme .account-wall {
    background: rgba(0, 0, 0, .9);
}	
	
	.blue-theme .orange-buton{
		    color: rgb(255, 255, 255);
    background-color: rgb(10, 166, 153);
    border-color: rgb(10, 166, 153);
	}
	.custom-button-n{
    text-align: left;
    padding-left: 30px;
    margin-top: 10px;
    color: #fff;
	cursor: pointer;
}
	
</style>
</head>
<body class="full-lg <?php echo $login_class;?>">
<section>
  <div class="loader-box">
    <div class="loader"></div>
  </div>
</section>
<div id="wrapper">

<div id="main" class="login-bg">
<?php $companyData=get_company_data(); ?>

<div class="container">
<div class="row">
<div class="col-lg-4 col-lg-offset-4 logn_bx">

<div class="account-wall">


<section class="align-lg-center">
<div class="site-logo" style="background: #FFF url(<?php echo site_url()."company/".$companyData['cid']."/login-logo.png"; ?>) no-repeat scroll center center;"></div>
<h1 class="login-title"><span><?php echo $ui_string['welcome'];?></span></h1>
</section>
<input type="hidden" name="current_process" id="current_process" value="1">
<div id="login">
<form id="form-signin" class="form-signin" method="post" action="" enctype="multipart/form-data">
<?php $csrf->echoInputField(); ?>

<section class="login-center">


<div class="input-group">
<input value="<?php echo $username;?>" type="text" data-check-valid="blank" data-error-show-in="eusername" data-error-setting="2" data-error-text="<?php echo $ui_string['12026'];?>" class="form-control required_field form-signin" name="username" id="username" placeholder="<?php echo $ui_string['email'];?>">
</div>
<div id="eusername" class="error"></div>
<div class="input-group" style=" margin-bottom: 10px;">
	
<input value="<?php echo $password;?>" type="password" data-check-valid="blank" data-error-show-in="epassword" data-error-setting="2" data-error-text="<?php echo $ui_string['1209'];?>" class="form-control required_field form-signin"  name="password" id="password" placeholder="<?php echo $ui_string['password'];?>">
</div>
<div id="epassword" class="error"></div>
<?php if(isset($_SESSION["captcha_code"])){$display='style="margin-bottom: 10px;margin-top: 10px;"';$required_field="required_field";}else {$display='style="margin-bottom: 0px;display:none;"';$required_field="";}?>


<div <?php echo $display;?> id="captcha-div">

<!-- START CAPTCHA -->

<div class="capbox">

<div id="captcha" oncopy="return false" oncut="return false" onpaste="return false"><?php echo isset($_SESSION["captcha_code"])?$_SESSION["captcha_code"]:'';?></div>

<div class="capbox-inner">

<input oncopy="return false" oncut="return false" onpaste="return false" type="text" data-check-valid="blank" data-error-show-in="ecaptcha_code" data-error-setting="2" data-error-text="<?php echo $ui_string['12080'];?>" class="<?php echo $required_field;?> form-signin"  name="captcha_code" id="captcha_code" size="15" placeholder="<?php echo $ui_string['12080'];?>"><br>
<span id="ecaptcha_code" class="error"></span>

</div>
</div>

<!-- END CAPTCHA -->
</div>
	<div class="btns_sec">
	<button class="btn btn-lg btn btn-theme-inverse btn-block orange-buton" type="button" id="sign-in" onclick="return validation('form-signin')"><?php echo $ui_string['signin'];?></button> 


	<div class="custom-button-n" id="forgot"><?php echo $ui_string['forgotpassword'];?></div>
	</div>
<div class="download-button">

<a class="apple_iv" target="_blank" href="#"></a>
<a class="andi" target="_blank" href="#"></a> 
</div>
</section>

</form>
</div>
<div id="forgotpassword" style="display: none">
    <form id="form-forgot" class="form-signin" method="post" action="" enctype="multipart/form-data">
       <?php $csrf = new CSRF_Protect(); $csrf->echoInputField();?>
      <div class="input-group">
          <input value="" type="text" data-check-valid="blank" data-error-show-in="eemail" data-error-setting="2" data-error-text="<?php echo $ui_string['12077'];?>" class="form-control required_field form-forgot" name="email" id="email" placeholder="<?php echo $ui_string['email'];?>">
      </div>
       <span id="eemail" class="error"></span>
		<div class="btns_sec">
		      <button class="btn btn-lg btn-theme-inverse btn-block" type="button" id="forgot-submit" onclick="return validation('form-forgot')"><?php echo $ui_string['send'];?></button>
     
	  <div class="custom-button-n" id="back"><?php echo $ui_string['back'];?></div>
		</div>

    </form>
</div>

<!--<a class="footer-link" href="javascript://"><?php echo date("Y",time());?>  <?php if(isset($ui_string['copyright'])) { echo $ui_string['copyright']; } ?> </a>-->

</div>	
<!-- //account-wall-->

</div>

</div>
<!-- //row-->
</div>
<!-- //container-->

</div>
<!-- //main-->
</div>
<style type="text/css">
  #login .input-group .form-control:first-child, #forgotpassword .input-group .form-control:first-child{
    color: #fff !important;
  }
  #captcha{
    margin-bottom: 10px;
        width: 103px;
    margin-left: 34px;
  }
</style>