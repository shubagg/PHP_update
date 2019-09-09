<?php 

is_user_logged_in();
$cat = curl_post("/get_category",array());
$all_cats=$cat['data'];
$get_modules=curl_post("/get_modules",array());
$get_roles = curl_post("/get_roles",array());
$get_roles=$get_roles['data'];
$get_module_json=curl_post("/get_module_json",array());
$user_role=$get_module_json['data'];
$mr1 = array();
$id=isset($_GET['id'])?$_GET['id']:'';
if($_GET['id'])
{
    $user_id=$_GET['id'];
    $get_users=curl_post("/get_users",array('id'=>$user_id));
    $user=$get_users['data'][0];
    if($user['role']!=''){
    	$userRole=json_decode($user['role'],true);
            foreach ($userRole as $key => $val) {
                foreach ($val as $key1 => $val1) {
                	foreach($val1 as $key2=>$val2){
                    	$mr1[]=$key.'-'.$key1.'-'.$val2;
                	}
                } 
            }
	}  
}
	$imageData=get_association_data("1","10","1","580f1c7c6d9557493d3c9869"); 
    Print_r($imageData);  
    $profile_picture=$imageData['media']['1'][$id][0]['mediaName'];

    if($profile_picture!=''){$img_url=site_url().'uploads/media/images/'.$profile_picture;}  
    else{$img_url=admin_assets_url().'img/avatar.png';}  
?>
<?php get_admin_header(); ?>
<?php get_admin_header_menu(); ?>
<?php get_admin_left_sidebar(); ?>
<?php include_once(include_admin_template("resources","test")); ?>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var admin_assets_url='<?php echo admin_assets_url();?>';
function show_hide_permission(id){
    if(id=='show'){

         $("#rolePermission").slideDown();
         $("#perHide").show();
         $("#perShow").hide();

    }
    else if(id=='hide'){
         $("#rolePermission").slideUp();
         $("#perShow").show();
         $("#perHide").hide();
    }
}
</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/test.js"></script>
<?php get_admin_footer(); ?> 