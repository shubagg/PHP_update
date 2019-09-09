<?php 

//include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

 include_once(include_admin_template("uicomponent","ui_carousel"));
 
 ?>

 <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>

<?php get_admin_footer(); ?>
