<?php        
    $advanced_search = $this->get_advance_search(); 
    if($advanced_search){
?>
<span class="top-advance-search"><button class="btn btn-default adv_srch" style="background: transparent; border: none;" >Advance Search <i class="fa fa-plus-circle" aria-hidden="true"></i></button></span>
<?php
  include_once(include_admin_template("common_templates/default", "default_advanced_search"));    
}
?>
                <!--------------------------------- Include Page Header ------------------------------------------>
        <?php 
          // include_once(include_admin_template("common_templates/allTickets", "page_header"));
        ?>      
            <!------------------------------ Include Listing Page -------------------------------------->
            <?php 
                $listing_data = $this->customise_listing_data();
                if(isset($listing_data['status']) && $listing_data['status']=='true')
                {
                   include_once(include_admin_template("common_templates/allTickets", "listing1"));
                }
            ?>    
<!--</div>-->
