<?php 


//is_user_logged_in();

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("notification","cronStatus")); ?>

    
<script type="text/javascript" src="<?php echo getAdminJsUrl('notification','notification'); ?>"></script>

<script>
var site_url='<?php echo site_url();?>';
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';
var notificationUrl='<?php echo get_url("notification") ?>';


</script>  

 <?php get_admin_footer(); ?> 
