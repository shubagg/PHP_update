<?php 
is_user_logged_in();
get_admin_header(); 
get_admin_header_menu( $language );

if($_SESSION['user']['user_type']=='user')
{
    $stores=get_items_enrolled(array('userId'=>$_SESSION['user']['user_id'],'mid'=>'41','smid'=>'1','proj_group_id'=>STORE_OWNER_ROLE_ID));
    $stores=$stores['data'];
    if(sizeof($stores))
    {
        $stores=get_warehouse_by_id(array('id'=>implode(",",$stores)));
    }
}
else
{
	$stores=get_warehouse_by_id(array());
}
$vendors=get_category_users(array('category_ids'=>'594cb47bd88bfde81b000029','fields'=>'name'));
$productCategory=get_product_category(array('hierarchy'=>'true','parentId'=>'0','fields'=>'title,parentId'));
//$allocateTo=get_user_hirarchy(array('userId'=>$_SESSION['user']['user_id'],'object'=>'true'));

$allocateTo=get_all_users_by_enrollment(array('mid'=>'41','smid'=>'1','itemId'=>$stores['data'][0]['id'],'proj_group_id'=>STORE_USER_ROLE_ID));


include_once(include_admin_template("inventory","manage_inventry")); 

?>
<script type="text/javascript" src="<?php echo getAdminJsUrl('inventory','manage_inventory'); ?>"></script>
<script type="text/javascript">
var STORE_USER_ROLE_ID='<?php echo STORE_USER_ROLE_ID; ?>';
function load_page(type,tab_name)
{
    $.ajaxSetup ({
        cache: false
    });
    var loadUrl = site_url+"admin/controller/index.php?type="+type+"&class="+tab_name+"&warehouseId="+$('#warehouse').val();
      $('.tab-pane').html('');
    $( "#"+tab_name ).load(loadUrl,function(){
    	refresh_custom_dt();
    });
}
load_page('inventoryRequest','request_stock');
console.log('Vipin needs to update this code remove search button if there is no json for advance search');
//$('.top-advance-search').show();
</script>
<?php get_admin_footer(); ?>