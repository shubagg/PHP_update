<?php 
is_user_logged_in();

$abc=get_module_submodule(array());

//$id=isset($_GET['id'])?$_GET['id']:9;
$get_template='';
$get_id = "9";
if(isset($_GET['id']))
{
	$get_id = $_GET['id'];

$get_template=get_template_by_id(array("id"=>$get_id));
}
$get_modules=get_module_submodule(array());
//$get_events=curl_post("/get_events",array("mid"=>'3'));
//print_r($get_events);

$languages=get_languages(array());
$languages=$languages['data'];
if($get_id=='9')
{
	$get_id = '0';
}
?>

<?php get_admin_header(); ?>  

<?php include_once(include_admin_template("notification","template")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script>
var ui_url='<?php echo admin_ui_url();?>';
var site_url='<?php echo site_url();?>';
var module_res='<?php echo json_encode($get_modules['data']);?>';
var if_value_prestnt='<?php echo $_GET['id']; ?>';
var module_id='<?php echo  isset($_GET['id'])?$get_template['data'][0]['mid']:0 ?>';
var sub_module_id='<?php echo  isset($_GET['id'])?$get_template['data'][0]['smid']:0 ?>';
var event_id='<?php echo  isset($_GET['id'])?$get_template['data'][0]['eid']:0 ?>';
var field_id='<?php echo  isset($_GET['id'])?$get_template['data'][0]['fieldValue']:0 ?>';

//var redirectTempUrl='<?php echo get_url("manage_template");?>';
var redirectTempUrl=site_url+'admin/manageTemplate';

//get_sub_module
</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','template'); ?>"></script>
<script>
if(if_value_prestnt!="")
{
	
	get_sub_module(module_id);
	get_events(sub_module_id);
}
</script>