<?php 


//include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 
<?php include_once(include_admin_template("resources","module_setting")); ?>

<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
</script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','status'); ?>"></script>
<?php get_admin_footer(); ?> 
