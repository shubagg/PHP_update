<?php 
 
is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

$id=isset($_GET['id'])?$_GET['id']:0;

$get_accounts=curl_post("/get_account_by_id",array("id"=>"0"));

$a=(count($get_accounts['data'])>0)?1:0;

include_once(include_admin_template("notification","btrigger")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script>
var redirectBtriggerUrl='<?php echo get_url("manage_broadcast");?>';
var ui_url='<?php echo admin_ui_url();?>';
var event_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['event_id']:0 ?>';
var temp_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['temp_id']:0 ?>';
var mtemp_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['mtemp_id']:0 ?>';
var ctg_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['ctg_id']:0 ?>';
var a='<?php echo $a;?>';
if(ctg_id!='')
{
    $("#tempdiv").show();
}
</script>

<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','broadcast'); ?>"></script>


