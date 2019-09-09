<?php 

$advanced_search = $this->get_advance_search(); 

if($advanced_search)
{
	
?>
<script type="text/javascript">
	$('.top-advance-search').show();
</script>
<?php 
}else{
?>
<script type="text/javascript">
	$('.top-advance-search').hide();
</script>


<?php	
}

$listing_data = $this->customise_listing_data();
if(isset($listing_data['status']) && $listing_data['status']=='true')
{
  
   include_once(include_admin_extensions_template("feedback_form","common_templates/feedbackform","listing"));
}
?>