<?php 
is_user_logged_in();
get_admin_header(); 
get_admin_header_menu( $language );





include_once(include_admin_extensions_template("aintu_form_job","aintu_form_job","formjobreport"));

?>

<script type="text/javascript">

function load_page(type,tab_name)
{

    $.ajaxSetup ({
        cache: false
    });
    var jsonPath = "extensions/jsonController/";

    var loadUrl = site_url+"admin/controller/index.php?type="+type+"&class="+tab_name+"&jsonPath="+jsonPath;
      $('.tab-pane').html('');
      
    $( "#"+tab_name ).load(loadUrl,function(){
    	refresh_custom_dt();
    });
}
load_page('pendingFormjob','pending');

//$('.top-advance-search').show();
</script>
<?php get_admin_footer(); ?>