<?php 
include_once("../../../global.php");
is_user_logged_in();
check_user_permission_with_redirect("rpa","contactform");
$companyData=get_company_data();
?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("contactform","contactform")); ?>



<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  
<script type="text/javascript" src="<?php echo site_url()."company/".$companyData['cid']."/"; ?>assets/js/chat-bot-form.js"></script>
 <?php get_admin_footer(); ?> 
