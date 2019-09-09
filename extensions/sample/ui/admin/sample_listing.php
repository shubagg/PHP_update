<?php 
is_user_logged_in();
get_admin_header();
get_admin_header_menu($language); 
get_admin_left_sidebar($language); 
?> 
<div id="main">
Sample Page
</div>
<?php get_admin_footer(); ?> 