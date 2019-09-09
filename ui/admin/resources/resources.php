<?php 
is_user_logged_in();
check_permission('1','1');
$cat = get_category(array());
$all_cats=$cat['data'];
$parent_cats=array();
if(isset($all_cats))
{
foreach($all_cats as $cats)
{
    if($cats['parent_id']==0)
    {
        array_push($parent_cats,$cats['id']);
    }
}

}


$get_modules=get_modules(array());
if(isset($get_modules['data']))
{

$modules=$get_modules['data'];
}

$get_roles = get_roles(array());

$roles=$get_roles['data'];


$get_module_json=get_module_json(array());
$user_role=$get_module_json['data'];

$category_data="";
//$user_id=isset($_SESSION['user']['user_id'])?$_SESSION['user']['user_id']:"";
$user_id='';


$filedsDta=get_company_data();
$fileds=explode(",",strtolower($filedsDta['fields']));

$arrayfield=array();
foreach ($fileds as $key => $value) {
	$str=str_replace(' ','', $value);
	
	array_push($arrayfield, $ui_string[$str]);
}
$field_value=explode(",",$filedsDta['field_value']); 
if(check_user_permission("resources","users","all")==1)
{
	$fileds=$arrayfield;
	$field_value=$field_value;
}
else
{
	$fileds=array_splice($arrayfield, 0, count($arrayfield)-2);
	$field_value=array_splice($field_value, 0, count($field_value)-2);
}


 $dat=get_category_tree($all_cats,0); 

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>
<script>
var parent_cats='<?php echo implode(",",$parent_cats);  ?>';
</script>
<?php  get_admin_left_sidebar(); ?> 
<?php

include_once(include_admin_template("resources","resources")); 
?>
<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';
var addUserurl='<?php echo get_url("addUser") ?>';
var userDetailurl='<?php echo get_url("userDetail") ?>';
var parent_cats='<?php echo implode(",",$parent_cats);  ?>';


</script>  
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','category'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','resource'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>  
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','role'); ?>"></script>
<?php get_admin_footer(); ?> 
