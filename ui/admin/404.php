<?php
include("../../global.php");
is_user_logged_in();
get_admin_header();
get_admin_header_menu($language);
get_admin_left_sidebar($language);
?>
<div id="main">
   <div id="content">
      <div class="row">
      		<h2 style="text-align:center;">404 Page Not Found</h2>
      </div>
   </div>
</div>
<?php
get_admin_footer();
?>