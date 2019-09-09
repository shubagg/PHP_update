<?php 

//include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

 include_once(include_admin_template("uicomponent","ui_loader"));
 
 ?>

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<?php get_admin_footer(); ?>
