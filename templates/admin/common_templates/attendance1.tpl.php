
<!------------------------------ Include Listing Page -------------------------------------->               
            <?php 

                    $advanced_search = $this->get_advance_search(); 
                    //echo $advanced_search; die('test');
                    if($advanced_search)
                    {
                        include_once(include_admin_template("common_templates/attendance", "advanced_search"));    
                    }
                    
                    
               

            ?>
                
<!------------------------------ Include Listing Page -------------------------------------->
            
            <?php 
                $listing_data = $this->customise_listing_data();
                if(isset($listing_data['status']) && $listing_data['status']=='true')
                {
                   include_once(include_admin_template("common_templates/attendance", "listing1"));
                }
            ?>
                
            

