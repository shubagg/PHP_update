<?php 
session_start();


include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

is_user_logged_in();



$user_id=isset($_GET['id'])?$_GET['id']:'';
$get_users=curl_post($webservice_url."/get_users",array("user_id"=>$user_id));
//print_r($get_users['users']);

$category_data="";
$id="";



    if($user_id!=""){
      
    if(!empty($get_users)){foreach($get_users as $key => $element){
        
    foreach($element as $subkey => $subelement){
        
      
        $cats=$subelement['category'];
        $category_data=explode(",",$cats);
        $id=$subelement['id'];
        
       
        
    } } }
 }



$get_users_list=curl_post($webservice_url."/get_user_roomers",array("category_id"=>$cats));

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("resources","user_roomers")); ?>

	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<?php get_admin_footer(); ?> 

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var admin_assets_url='<?php echo admin_assets_url();?>';
</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>  
 
