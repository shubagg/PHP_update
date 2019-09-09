
<style type="text/css">
.bannerTable{
	width:100%;
	padding: 10px;
}
.bannerTable td{
	padding: 5px;
}
</style>

<div class="modal fade" id="bannerPopup" data-backdrop="static" data-width="500px" data-keyboard="false">
		<div class="modal-header">
<form id="bannerManage" method="post" enctype="multipart/form-data">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
		  <h4 class="modal-title">Banners</h4>
    	</div>
    	<div class="modal-body">
  <div class="modal-body new_panel">
  		<!-- hidden id of crop -->
    		 <input type="hidden" id="hiddenCropData1" name="hiddenCropData1"> 
		 	 <input type="hidden" id="hiddenCropType1" name="hiddenCropType1">
        <!-- hidden id of crop -->
		<table class="bannerTable table table-striped table-hover">
			<thead>
				<tr>
					<th>Banner</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr id="bannerNotAvailable"><td colspan="3">Banners not available</td></tr>
			</tbody>
		</table>
		<input type="file" style="display:none;" name="banner_image" id="bannerr_image" data-width="1600" data-height="450" data-error="crop_error1"  data-returnfunction="show_banner" data-showcrop="1" class="form-control cropimage" />
		<button type="button" class="btn btn-theme-inverse right" onclick="$('#bannerr_image').click();" ><i class="glyphicon glyphicon-plus"></i> Add More</button>
		<span id="eshowimage1" class="error crop_error1"></span>
		<div style="clear:both;"></div>
  </div></div>
   <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
   </div></form>
</div>
