<?php 


//is_user_logged_in();

$tid=isset($_GET['tid'])?$_GET['tid']:'0';
$id=isset($_GET['id'])?$_GET['id']:'0';
//print_r($get_roles);
if($_GET['tid'])
{
    
    $get_data=curl_post("/get_all_time_triggers_data",array('id'=>$_GET['tid']));
    $triggerInfo=$get_data['data'][0];

    
 
    
}



    

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("notification","manageTimeTrigger")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->


<script>
var id='<?php echo $id;?>';
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var admin_assets_url='<?php echo admin_assets_url();?>';
var timeTrigger='<?php echo get_url("timeTrigger") ?>';
var manageTimeTrigger='<?php echo get_url("manageTimeTrigger") ?>';
</script>

<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','timeTrigger'); ?>"></script>
 
 
<?php get_admin_footer(); ?> 

