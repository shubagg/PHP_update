<?php 
is_user_logged_in();
get_admin_header(); 
get_admin_header_menu( $language );

$warehouseId=get_user_manager_warehouse(array('userId'=>$_SESSION['user']['user_id']));
include_once(include_admin_template("inventory","user_inventry")); 
?>
<script type="text/javascript">function checkalldata(){}
var currentWarehouseId='<?php echo $warehouseId; ?>';
</script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('inventory','user_inventory'); ?>"></script>
<script type="text/javascript">
function load_page(type,tab_name,extraData)
{
    $.ajaxSetup ({
        cache: false
    });
    var loadUrl = site_url+"admin/controller/index.php?type="+type+"&class="+tab_name+extraData;
      $('.tab-pane').html('');
    $( "#"+tab_name ).load(loadUrl,function(){
    	refresh_custom_dt();
    });
}
load_page('getStoreInventory','store_inventory');
console.log('Vipin needs to update this code remove search button if there is no json for advance search');
$('.top-advance-search').show();
</script>
<?php get_admin_footer();  ?>


