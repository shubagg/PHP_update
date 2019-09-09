<?php 
is_user_logged_in();
get_admin_header(); 
get_admin_header_menu( $language );
$storeOwners=get_category_users(array('category_ids'=>'594ce14fd88bfdb822000030','fields'=>'name'));
include_once(include_admin_template("inventory","warehouse")); 
?>
<script type="text/javascript" src="<?php echo getAdminJsUrl('inventory','manage_warehouse'); ?>"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#adv_search").hide();
    $("#adv_search_btn").show();
    $("#adv_search_btn").click(function(){
    $("#adv_search").slideToggle();
    });
});
</script>
<?php get_admin_footer(); ?>