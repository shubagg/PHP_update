<?php 
include_once("../../../global.php");

//include(lang_url()."global_en.php");
include(lang_url()."resourse/en.php");
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 
<?php 
        include_once("../crop/crop.php"); 
?>
<?php include_once(include_admin_template("categories","manage_category")); ?>


<script>
var admin_ui_url='<?php echo admin_ui_url(); ?>';
var product_categories="<?php echo get_url('product_categories'); ?>";
</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>categories/js/product_category.js"></script>
<?php get_admin_footer(); ?> 
