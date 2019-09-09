<?php 
$advanced_search = $this->get_advance_search(); 
$topButton='<div class="row">
				<div class="col-sm-2 pull-right">
					<a href="javascript:;" class="btn btn-theme-inverse pull-right manageInventoryButton"><i class="fa fa-plus-circle"></i> Add Inventory</a>
				</div>
			</div>';
if($advanced_search)
{
   // include_once(include_admin_template("common_templates/inventory", "advanced_search"));    
}

$listing_data = $this->customise_listing_data();
if(isset($listing_data['status']) && $listing_data['status']=='true')
{
   include_once(include_admin_template("common_templates/inventory", "listing"));
}
?>