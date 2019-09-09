<?php 



is_user_logged_in();

$cat = get_category(array());
$all_cats=$cat['data'];
$parent_cats=array();
foreach($all_cats as $cats)
{
    if($cats['parent_id']==0)
    {
        array_push($parent_cats,$cats['id']);
    }
}

$get_modules=get_module(array());
if(isset($get_modules['data']))
{
$modules=$get_modules['data'];
}

$get_roles = get_roles(array());
$roles=$get_roles['data'];



$get_module_json=get_module_json(array());
$user_role=$get_module_json['data'];

//$aaa=get_submodule_id(array("mid" =>"1","sname"=>"users"));
//print_r($aaa);
//echo "fjhdjkfhjf";

//print_r($user_role);


//$resarrs=check_user_permission("resource1","create");

//print_r($resarrs);

//print_r($_SESSION['user']);

//$imageData=get_association_data("1","10","1",$_SESSION['user']["user_id"]);

//print_r($imageData);
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>
<script>
var parent_cats='<?php echo implode(",",$parent_cats);  ?>';
var changePassword='<?php echo get_url("changePassword");  ?>';
</script>
<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources","manage_password")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->




<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','category'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','resource'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>  
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','role'); ?>"></script> 
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  

 <?php get_admin_footer(); ?> 
