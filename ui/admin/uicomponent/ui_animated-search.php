<?php 

//include(lang_url()."global_en.php");

 is_user_logged_in();

 get_admin_header(); 
 get_admin_header_menu($language); 
 get_admin_left_sidebar($language);

 include_once(include_admin_template("uicomponent","ui_animated-search"));
 
 ?>

<style> 
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 100%;
}
</style>

<?php get_admin_footer(); ?>
