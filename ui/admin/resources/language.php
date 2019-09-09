<?php 

is_user_logged_in();

//print_r($_SESSION);
$languages=get_languages(array());
$languages=$languages['data'];
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu(); ?>

<?php get_admin_left_sidebar(); ?> 

<?php include_once(include_admin_template("resources","language")); ?>

	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->


<script type="text/javascript" src="<?php echo admin_ui_url(); ?>resources/js/language.js"></script>
<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var userId='<?php echo $_SESSION['user']['user_id'];?>';
var addUserurl='<?php echo get_url("addUser") ?>';
var userDetailurl='<?php echo get_url("userDetail") ?>';
var language='<?php echo get_url("language") ?>';
</script>  

<?php get_admin_footer(); ?> 
