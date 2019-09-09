<?php 
global $companyId;
is_user_logged_in();
if(isset($_GET['uname']))
{  
   $uname=$_GET['uname'];
   $get_users=get_users(array("id"=>$uname));
}
else
{
   $get_users =get_users(array("id"=>$_SESSION['user']["user_id"],"user_type"=>''));
}
$users=$get_users['data'];
$imageData = get_media_by_id(array('id' => '0', 'smid' => '1', 'asmid' => '1', 'amid' => '1', 'aiid' => $_SESSION['user']["user_id"], 'object' => 'true'));
if(!empty($imageData['data']))
{
    	$img_url=$imageData['data'][0]['link'];
}
else
{
	$img_url = site_url().'company/'.$companyId.'/uploads/default_media/avatar.png'; 
}  

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources","profile")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->




<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script> 
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','category'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','resource'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>  
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','role'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var user_type="<?php echo $_SESSION['user']["user_type"];?>";
var addUserurl='<?php echo get_url("addUser") ?>';
var userDetailurl='<?php echo get_url("userDetail") ?>';
var profile='<?php echo get_url("profile") ?>';


</script>


  

 <?php get_admin_footer(); ?> 
 
 <script>

$(".md-effect").click(function(event){

					event.preventDefault();
					$(".error1").val("");
					$(".error").html("");
					var data=$(this).data();
					$("#md-effect").attr('class','modal fade').addClass(data.effect).modal('show')
			});




$('#abcfile').click(function(){
	$('#hiddenfile').click();
});

function showUploadForm(){
	$('#md-effect1').modal();
}

function close_image_popup(){
	$("#profile_picture1").val("");
	$(".error").html("");
	$("#vprofile_picture").val("");
	$('#md-effect1').modal('toggle');

}

</script>