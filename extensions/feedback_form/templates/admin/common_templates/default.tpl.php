<?php get_admin_header(); ?>
<?php get_admin_header_menu($language); ?>
<?php get_admin_left_sidebar(); ?>
<div id="main">
    <div id="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--------------------------------- Include Page Header ------------------------------------------>
            <?php 

            //include_once(include_admin_template("common_templates/default", "page_header"));?>
                
                <!--------------------------------- Include Advanced Search ------------------------------------------>
                
            <?php 
                    $advanced_search = $this->get_advance_search();
                    if($advanced_search)
                    {
                        include_once(include_admin_template("common_templates/default", "advanced_search"));    
                    }
                    
                    
               

            ?>
                
<!------------------------------ Include Listing Page -------------------------------------->
            
            <?php 
                $listing_data = $this->customise_listing_data();
                if(isset($listing_data['status']) && $listing_data['status']=='true')
                {
                   include_once(include_admin_template("common_templates/default", "listing1"));
                }
            ?>
                
            </div>
        </div>
        <!-- //content > row-->
    </div>
</div>
<!--<div class="modal-scrollable z-1060">-->
<?php /* ?>
<div id="table_header_setting" class="modal fade container in" tabindex="-1" aria-hidden="false">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title">
        <?php echo $ui_string['select_fields']; ?>
        </h4>
    </div>
                        <!-- //modal-header-->
    <div class="modal-body">
                          
        <div class="clr"></div>
             <div class="modal_data" id="modal_data">
                           
 
             </div> 
        </div>
                        <!-- //modal-body-->
        </div>

<!--</div>-->
<?php */ ?>
<?php get_admin_footer(); ?>
