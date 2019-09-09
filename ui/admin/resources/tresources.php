<?php  
is_user_logged_in();
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
$get_modules=curl_post("/get_module",array());
$modules=$get_modules['data'];
?>
<?php get_admin_header(); ?>
<?php get_admin_header_menu(); ?>
<?php get_admin_left_sidebar(); ?> 
<?php include_once(include_admin_template("resources","tresources")); ?>

<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','category'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','resource'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','test'); ?>"></script>  
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script> 

<script>
var ui_url='<?php echo ui_url();?>';

var admin_ui_url='<?php echo admin_ui_url();?>';

//var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';
</script>  

 <?php get_admin_footer(); ?> 
