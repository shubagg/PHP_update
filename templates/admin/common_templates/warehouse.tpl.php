<?php get_admin_header(); ?>
<?php get_admin_header_menu(); ?>
<?php get_admin_left_sidebar(); ?>
<div id="main" class="dashboard">
<ol class="breadcrumb">
 <li>Admin </li><li class="active"> Warehouse</li></ol>

    <div id="content">
        <div class="row">
            <div class="col-lg-12">
                <!--------------------------------- Include Page Header ------------------------------------------> 
                <!--------------------------------- Include Advanced Search ------------------------------------------>
                
            <?php 
                    $advanced_search = $this->get_advance_search(); 
                    //echo $advanced_search; die('test');
                    if($advanced_search)
                    {
                        include_once(include_admin_template("common_templates/warehouse", "advanced_search"));    
                    }
                    
                    
               

            ?>
                
<!------------------------------ Include Listing Page -------------------------------------->
            
            <?php 
                $listing_data = $this->customise_listing_data();
                if(isset($listing_data['status']) && $listing_data['status']=='true')
                {
                   include_once(include_admin_template("common_templates/warehouse", "listing1"));
                }
            ?>
                
            </div>
        </div>
        <!-- //content > row-->
    </div>

<!--<div class="modal-scrollable z-1060">-->

</div>


<!--</div>-->
<?php get_admin_footer(); ?>
