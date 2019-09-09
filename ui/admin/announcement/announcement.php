<?php 
 
include(lang_url()."global_en.php");
is_user_logged_in();


 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

$style1='style="display:none"';
$style='';
$id=isset($_GET['id'])?$_GET['id']:0;
if($id!=0 && $id!="")
{
	$infoData1=get_announcement_by_id(array('id'=>$id));
	if(!empty($infoData1['data']))
	{
		$infoData=$infoData1['data'][0];
		if($infoData['type']=='push'){
			$style='';
			$style1='style="display:none"';

		}
		else if($infoData['type']=='email'){
			$style1='';
			$style='style="display:none"';
		}
	}	
}

$get_accounts=curl_post("/get_account_by_id",array("id"=>"0"));

$a=(count($get_accounts['data'])>0)?1:0;

$cat = curl_post("/get_category",array());
$all_cats=$cat['data'];
$parent_cats=array();
foreach($all_cats as $cats)
{
    if($cats['parent_id']==0)
    {
        array_push($parent_cats,$cats['id']);
    }
}

include_once(include_admin_template("announcement","announcement")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?>  
<script>
var ui_url='<?php echo admin_ui_url();?>';
var event_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['event_id']:0 ?>';
var temp_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['temp_id']:0 ?>';
var mtemp_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['mtemp_id']:0 ?>';
var ctg_id='<?php echo  isset($_GET['id'])?$get_trigger['data']['trigger_data'][0]['ctg_id']:0 ?>';
var a='<?php echo $a;?>';
var parent_cats=<?php echo json_encode($parent_cats); ?>;
if(ctg_id!='')
{
    $("#tempdiv").show();
}
</script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/user.js"></script>  

<script type="text/javascript" src="<?php echo admin_ui_url(); ?>announcement/js/announcement.js"></script>
<script type="text/javascript" src="<?php echo admin_assets_url(); ?>ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>


