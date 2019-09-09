<?php get_admin_header(); ?>
<?php get_admin_header_menu(); ?>
<?php get_admin_left_sidebar(); ?>
<div id="main" class="dashboard">
<?php get_breadcrumb(); ?>

    <div id="content">
        <div class="row">
            <div class="col-lg-12">
                <!--------------------------------- Include Page Header ------------------------------------------>
        <?php 
    
          // include_once(include_admin_template("common_templates/allTickets", "page_header"));
    
        ?>
                
                <!--------------------------------- Include Advanced Search ------------------------------------------>
                
            <?php 
                    $advanced_search = $this->get_advance_search(); 
                    //echo $advanced_search; die('test');
                    if($advanced_search)
                    {
                        include_once(include_admin_template("common_templates/allTickets", "advanced_search"));    
                    }
                    
                    
               

            ?>
                
<!------------------------------ Include Listing Page -------------------------------------->
            
            <?php 
                $listing_data = $this->customise_listing_data();
                if(isset($listing_data['status']) && $listing_data['status']=='true')
                {
                   include_once(include_admin_template("common_templates/allTickets", "listing1"));
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
