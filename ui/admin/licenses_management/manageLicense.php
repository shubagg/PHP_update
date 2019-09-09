<?php 
/*Check User Permission*/
if(check_user_permission('licenses', 'clicense', 'all') != '1' || check_user_permission('licenses', 'clicense', 'view') != '1') {
    header("location:".site_url()."admin/404");
}
is_user_logged_in();
$l_company_id="";
$userInfo=get_resource_by_id(array('id'=>$_SESSION['user']['user_id'],'fields'=>'l_company_id'));

if ($userInfo['success'] == 'true') {
    $l_company_id = $userInfo['data'][0]['l_company_id'];
}
$company_lecense_expiration = "-";
$comany_license = get_license_expiration();
if(!empty($comany_license['data'][0]['server_expiry_date'])) {
    $company_lecense_expiration = encrypt_decrypt('','decrypt','opensesame3',$comany_license['data'][0]['server_expiry_date']);
    if($company_lecense_expiration['success']=='true'){$company_lecense_expiration = htmlentities(str_replace(array('"', "'"), '', $company_lecense_expiration['data']));}
}
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("licenses_management","manageLicense")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->




<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('licenses_management','licenses'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

<script>
var ui_url='<?php echo ui_url();?>';
var site_url='<?php echo site_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  
<?php get_enroll_user_for_license('',array(),'enroll-user','1',array('mid'=>'55','smid'=>'1','userId'=>$_SESSION['user']['user_id'])); ?>

 <?php get_admin_footer(); ?> 
