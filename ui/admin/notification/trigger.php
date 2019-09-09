<?php 
 

is_user_logged_in();

$id=isset($_GET['id'])?$_GET['id']:9;

$get_trigger=curl_post("/get_trigger_by_id",array("id"=>$id));

$get_modules=curl_post("/get_modules",array());
$get_accounts=curl_post("/get_account_by_id",array("id"=>""));
 
$get_week_notif="";
$get_date_notif="";
$resulthour="";
$resultmin="";

$a=(count($get_accounts['data'])>0)?1:0;

$languages=get_languages(array());
$languages=$languages['data'];
if($id=='9')
{
	$id = '0';
}
?>

<?php get_admin_header(); ?>  

<?php include_once(include_admin_template("notification","trigger")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script>
var site_url='<?php echo site_url();?>';
//var redirectManageTriggerUrl='<?php echo get_url("manage_trigger");?>';
var redirectManageTriggerUrl=site_url+"admin/manageTrigger";
var module_res='<?php echo json_encode($get_module_list['data']);?>';
var ui_url='<?php echo admin_ui_url();?>';


var eventid='<?php echo  isset($_GET['id'])?$get_trigger['data'][0]['eid']:0 ?>';
var temp_id='<?php echo  isset($_GET['id']) ? $get_trigger['data'][0]['tempId']:0 ?>';
var mtemp_id='<?php echo  isset($_GET['id'])?$get_trigger['data'][0]['mtempId']:0 ?>';
var ctg_id='<?php echo  isset($_GET['id'])?$get_trigger['data'][0]['ctgId']:0 ?>';
var midtri='<?php echo  isset($_GET['id'])?$get_trigger['data'][0]['mid']:0 ?>';
var smidtri='<?php echo  isset($_GET['id'])?$get_trigger['data'][0]['smid']:0 ?>';
var mailTypeget='<?php echo  isset($_GET['id'])?$get_trigger['data'][0]['mailType']:0 ?>';
var a='<?php echo $a;?>';
var presend_data='<?php echo $_GET['id']?>';
if(ctg_id!='')
{
    $("#tempdiv").show();
}

</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','trigger'); ?>"></script>
<script>
if(presend_data!="")
{
	get_submodule_triger(midtri);	
	hideRestDiv();
}

</script>

