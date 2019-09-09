<div id="main" class="dashboard">
<?php get_breadcrumb();
?>
<style type="text/css">.popupselectbox{ width: 100px; }</style>
		<div id="content">
			<div class="row">
				<section class="panel">
					<header class="panel-heading">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h3><strong><?php echo $ui_string['formjobreport'];?> </h3>
							</div>
							<?php if($stores['success']=='true'){ ?>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								 <div class="tooltip-area btn-grp">
										<select class="form-control" id="warehouse" <?php if(sizeof($stores['data'])==1){ ?> style="display:none;" <?php } ?>>
											<?php
												foreach($stores['data'] as $store)
												{
													?>
													<option value="<?php echo $store['id']; ?>"><?php echo ucfirst($store['title']); ?> </option>
													<?php
												}
											?>
										</select>
								</div>
							</div>
							<?php } ?>
						</div>
					</header>
					<div class="panel-body">
						<div>
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" onclick="load_page('pendingFormjob','pending')" class="active"><a id="tab_pending" href="#pending" aria-controls="home" role="tab" data-toggle="tab"><?php echo $ui_string['pending'];?></a></li>
								<li role="presentation" onclick="load_page('completedFormjob','complete')"><a id="tab_complete" href="#complete" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $ui_string['completed'];?></a></li>
								<li role="presentation" onclick="load_page('rejectedFormjob','reject')"><a id="tab_reject" href="#reject" aria-controls="messages" role="tab" data-toggle="tab"><?php echo $ui_string['rejected'];?></a></li>
								
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="pending">
									
								</div>
								<div role="tabpanel" class="tab-pane" id="complete">

								</div>
								<div role="tabpanel" class="tab-pane" id="reject">

								</div>
								
							</div>
							
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<?php get_admin_left_sidebar($language); ?>
	
<!-- Inventory Modals -->
	<div id="manage_inventory_list_modal" class="modal fade" role="dialog" data-width="800">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Stock</h4>
		</div>
		<div class="modal-body">
			<div class="text-right">
				<input type="text" name="scannedCode" onblur="reset_scan('scannedCode','scanBarcode')" id="scannedCode" style="opacity:0;" value="">
				<button type="button" class="btn btn-theme-inverse add_inventory_button"> Add Inventory </button>
				<button type="button" class="btn btn-theme-inverse scanBarcode" onclick="$('#scannedCode').focus();$('.scanBarcode').html('Scan Now');">Scan</button>
			</div>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped basic_datatable" id="manage_inventory_list_table">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Item Name</th>
						<th>Category</th>
						<th>Qty</th>
						<th>Vendor</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody align="center" id="manage_inventory_list_table_data">
					
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse add_to_stock"> Add to stock </button>
		</div>
	</div>

	<div id="manage_inventory_modal" class="modal fade" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Inventory</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="stock_in_form">
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Category </label>
						<select id="productCategory" name="productCategory" class="form-control productCategory required_field stock_in_form" data-check-valid="blank" data-error-show-in="eproductCategory" data-error-text="Please select category">
						<option value="">Select Category</option>
						<?php show_product_category_select_accordians($productCategory['data']," ","0",'1'); ?>
						</select>
					</div>
					<span class="error" id="eproductCategory" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Item Name </label>
						<select class="form-control required_field stock_in_form" data-check-valid="blank" data-error-show-in="eproducts" data-error-text="Please select product" id="items" name="items">
							<option value="">Select Item</option>
						</select>
					</div>
					<span class="error" id="eproducts" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Quantity </label>
						<input type="text" class="form-control required_field stock_in_form" data-check-valid="blank,numeric,gtval-0" data-valid-gtval-error="Please enter quantity greater than 0" data-error-show-in="equantity" data-error-text="Please enter quantity" data-valid-numeric-error="Please enter quantity in numeric digits" id="quantity" name="quantity">
					</div>
					<span class="error" id="equantity" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Vendor </label>
						<select class="form-control required_field stock_in_form" data-check-valid="blank" data-error-show-in="evendor" data-error-text="Please select vendor" id="vendor" name="vendor">
							<option value="">Select Vendor</option>
							<?php foreach($vendors['data'] as $vendor){ ?>
								<option value="<?php echo $vendor['id']; ?>"><?php echo $vendor['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<span class="error" id="evendor" style="margin-left:15px;"></span>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse stock_in_form_submit"> Submit </button>
		</div>
	</div>


<!-- Allocation Modals -->
	<div id="manage_allocation_list_modal" class="modal fade" role="dialog" data-width="900">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Allocate</h4>
		</div>
		<div class="modal-body">
			<div class="text-right">
				<input type="text" name="scannedCode_1" id="scannedCode_1" onblur="reset_scan('scannedCode_1','scanBarcode_1')" style="opacity:0;" value="">
				<button type="button" class="btn btn-theme-inverse add_allocation_button"> Add Allocation </button>
				<button type="button" class="btn btn-theme-inverse scanBarcode_1" onclick="$('#scannedCode_1').focus();$('.scanBarcode_1').html('Scan Now');">Scan</button>
			</div>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped basic_datatable" id="manage_allocation_list_table">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Item Name</th>
						<th>Category</th>
						<th>Qty</th>
						<th>Allocated To</th>
						<th>Job</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody align="center" id="manage_allocation_list_table_data">
					
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse add_to_allocation"> Add to stock </button>
		</div>
	</div>

	<div id="manage_allocation_modal" class="modal fade" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Allocation</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="allocation_form">
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Category </label>
						<select id="productCategoryAllocation" name="productCategoryAllocation" class="form-control productCategoryAllocation required_field allocation_form" data-check-valid="blank" data-error-show-in="eproductCategoryAllocation" data-error-text="Please select category">
						<option value="">Select Category</option>
						<?php show_product_category_select_accordians($productCategory['data']," ","0",'1'); ?>
						</select>
					</div>
					<span class="error" id="eproductCategoryAllocation" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Item Name </label>
						<select class="form-control required_field allocation_form" data-check-valid="blank" data-error-show-in="eproductsAllocation" data-error-text="Please select product" id="itemsAllocate" name="itemsAllocate">
							<option value="">Select Item</option>
						</select>
					</div>
					<span class="error" id="eproductsAllocation" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Quantity </label>
						<input type="text" class="form-control required_field allocation_form" data-check-valid="blank,numeric,gtval" data-error-show-in="equantityAllocation" data-error-text="Please enter quantity" data-valid-gtval-error="Please add quantity greater than 0" data-valid-numeric-error="Please enter quantity in numeric digits" id="quantityAllocate" name="quantityAllocate">
					</div>
					<span class="error" id="equantityAllocation" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Allocate To </label>
						<select class="form-control required_field allocation_form" data-check-valid="blank" data-error-show-in="euserAllocation" data-error-text="Please select user" id="userAllocate" name="userAllocate">
							<option value="">Select User</option>
							<?php foreach($allocateTo['data'] as $user){ ?>
								<option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<span class="error" id="euserAllocation" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Job </label>
						<div data-html-id = "job" data-html-classes = 'inp1' data-html-heading = 'no'  data-type='JOB' data-params-smid='1'  data-params-mid='5' class="renderComponents"></div>
						
					</div>
					<span class="error" id="ejob" style="margin-left:15px;"></span>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse allocate_form_submit"> Submit </button>
		</div>
	</div>

	<div id="reorder_inventory_modal" class="modal fade" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Reorder Inventory</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="reorder_inventory_form">
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Item Name </label>
						<input type="text" readonly="" class="form-control" id='reorderProductTitle' value="" />
					</div>
					<span class="error" id="eproducts" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Quantity </label>
						<input type="text" class="form-control required_field reorder_inventory_form" data-check-valid="blank,numeric,gtval-0" data-valid-gtval-error="Please enter quantity greater than 0" data-error-show-in="ereorderQuantity" data-error-text="Please enter quantity" data-valid-numeric-error="Please enter quantity in numeric digits" id="reorderQuantity" name="reorderQuantity">
					</div>
					<span class="error" id="ereorderQuantity" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Vendor </label>
						<select class="form-control required_field reorder_inventory_form" data-check-valid="blank" data-error-show-in="ereorderVendor" data-error-text="Please select vendor" id="reorderVendor" name="reorderVendor">
							<option value="">Select Vendor</option>
							
						</select>
					</div>
					<span class="error" id="ereorderVendor" style="margin-left:15px;"></span>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse reorder_inventory_form_submit"> Submit </button>
		</div>
	</div>

	<div id="scan_product" class="modal fade" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Scan Product</h4>
		</div>
		<div class="modal-body">
			Scanning
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse add_scanned_product"> Submit </button>
		</div>
	</div>
