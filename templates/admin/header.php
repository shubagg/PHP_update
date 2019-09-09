<?php
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
<?php is_user_logged_in();  ?>
<title><?php echo ucfirst($companyData['name']); ?> |  Admin Panel</title>
<!-- Favicons -->
<link rel="apple-touch-icon" sizes="72x72"  href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-72-precomposed.png"/>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-114-precomposed.png"/>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo admin_assets_url(); ?>ico/apple-touch-icon-144-precomposed.png"/>
<link rel="shortcut icon" href="<?php echo site_url()."company/".$companyData['cid']."/favicon.ico"; ?>">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>plugins/combineCss/tm_css.css?84000&cache=<?php echo get_assets_caching();?>" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/style.css?cache=<?php echo get_assets_caching();?>" />
<link type="text/css" rel="stylesheet" href="<?php echo admin_assets_url(); ?>css/loader.css" />
<?php
foreach (customAssets() as $key => $val) {
	if($val[0]=="css"){
		echo '<link type="text/css" rel="stylesheet" href="'.getCompanySpecificAssets($val[0],$val[1]).'" />';
	}
}
?>

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo FONT_ICON_ACCESS_URL; ?>" />  
 

<script src="<?php echo site_url()."ui/js_error.php";?>"></script>

	<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.ui.min.js"></script>



<script type="text/javascript" src="<?php echo site_url()."company/".$companyData['cid']."/"; ?>assets/js/jquery.nestable.js"></script>

<script> 
var site_url="<?php echo site_url(); ?>"; 
var admin_assets_url = "<?php echo admin_assets_url() ?>";
var admin_ui_urls = "<?php echo admin_ui_urls() ?>";
var showFields=[];
var popUpItemId='';
var coursePath='<?php echo coursePath(); ?>';
var currentUserId='<?php echo $_SESSION['user']['user_id']; ?>';
</script>
</head>
<body class="leftMenu header-logo nav-collapse in <?php echo $login_class;?>" style="background:url(<?php echo site_url()."company/".$companyData['cid']."/sidebar-logo.png"; ?>) no-repeat; background-color: #262a33;"><!-- 
<span onclick="dashboard();" style="width: 50px;    height: 50px;    display: block;  background: transparent;    border: 1px solid #fff;"></span> -->
<section>
	<div class="hamburger">  <svg viewBox="0 0 800 600">
     <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
     <path d="M300,320 L540,320" id="middle"></path>
     <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
   </svg><span class="ham-close">Close</span></div>
	<div class="loader-box">
		<div class="loader"></div>
	</div>
</section>
	<div id="wrapper">
	<script type="text/javascript">
	function dashboard() {
		window.location.href = admin_ui_urls+'dashboard';
				}	
	 $( document ).ready(function() {
		 $( ".hamburger" ).click(function() {
	   $('body').toggleClass("in");
	 });
	 (function () {
	   var i;
	   $(".hamburger").click(function () {
		 clearInterval(i);
		 return $(".hamburger").toggleClass("cross");
	   });
	 
	 }).call(this);
	 });
	</script>
	