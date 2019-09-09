<?php include_once('../../../global.php'); ?>
<?php get_admin_header(); ?>
<?php get_admin_header_menu(); ?>
<?php get_admin_left_sidebar(); ?>

<div id="main" class="dashboard">


    <div id="content">
        <div class="row">
            <div id='result' class="col-lg-12">
                
            
            
            </div>
        </div>
        <!-- //content > row-->
    </div>

<!--<div class="modal-scrollable z-1060">-->
    

   
</div>
<button id="loadbasic">basic load</button>
    
 

    
<script type="text/javascript">


function load_page(type,tab_name)
{
    $.ajaxSetup ({
        cache: false
    });
    var loadUrl = site_url+"admin/controller/index.php?type="+type+"&class="+tab_name;
       
    $( "#result" ).load(loadUrl,function(){
        make_datatable();
    });
}
</script>
<!--</div>-->
<?php get_admin_footer(); ?>