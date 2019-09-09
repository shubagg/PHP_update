<?php 



is_user_logged_in();

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources","urgency")); ?>

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';
var urgencyUrl='<?php echo get_url("urgency") ?>';
</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>  
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>  
<script type="text/javascript">
</script>



 <?php get_admin_footer(); ?> 

