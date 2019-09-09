<?php 
    
    $listing_data = $this->customise_listing_data();
    if(isset($listing_data['status']) && $listing_data['status']=='true')
    {
       include_once(include_admin_template("common_templates/report", "listing1"));
    }
?>
                

