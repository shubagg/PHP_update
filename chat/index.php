<?php
include_once '../global.php';
$chat_url="";
$chat_folder="";
$key=base64_encode($_SESSION['user']["user_id"].rand(100000, 999999));
$moduleInfo=module_access_url("35","1");
if($moduleInfo)
{
  	$info=json_decode($moduleInfo,true);
  	$chat_url=$info['url'];
  	$chat_folder=$info['chat_folder'];
  	$chatData=array();
	$chatData['id']=$_SESSION['user']["user_id"];
	$chatData['login_key']=$key;
	if(!empty($chatData))
	{
	    
	    $url=$chat_url."/webservices/manage_chat_user";
	    $updateUserData=curl_post_ext($url,$chatData);
	}

?>

<script type="text/javascript" src="<?php echo admin_assets_url(); ?>js/jquery.min.js"></script>

<script type="text/javascript">

$(window).resize(function () {
		//responsiveIframe();
});

$( document ).ready(function() {
	responsiveIframe();
});	
function responsiveIframe()
{
		var w = $(document).width();
		var h = $(document).height();
		$("#frame").attr("width",w);
		$("#frame").attr("height",h);
		//window.location.href='<?php echo $chat_url;?>/chat/index.php?userId=<?php echo $_SESSION['user']['user_id'];?>&width='+w+'&height='+h;

		setTimeout(function(){window.location.href='<?php echo $chat_url."/".$chat_folder;?>/index.php?userId=<?php echo base64_encode($_SESSION['user']['user_id']);?>&key=<?php echo $key;?>&width='+w+'&height='+h;},200);
}

</script>

<?php }  else { ?>

<h1 align="center"> No Chat Available</h1> 

<?php } ?>



