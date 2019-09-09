<?php
include_once '../../global.php';
 if(isset($_SESSION['user']['user_id'])){
  $url=admin_ui_urls()."dashboard";  
  header("Location:".$url);  
 }

require_once ($server_path."templates/admin/admin_index.php"); ?>

<script>
var dashboardUrl="<?php echo get_url('dashboard'); ?>";
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
</script>

<script type="text/javascript" src="<?php echo assets_url(); ?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo lang_url_js(); ?>resourse/en.js"></script>
<script type="text/javascript" src="<?php echo getAdminJsUrl('resources','user'); ?>"></script>
<?php get_admin_footer(); ?>