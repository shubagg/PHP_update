<?php 

//include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

 include_once(include_admin_template("uicomponent","ui_list-group"));
 
 ?>



<?php get_admin_footer(); ?>
