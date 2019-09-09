
<style>.select2-dropdown{z-index:9999 !important;}
.select2 {width:100% !important;}
</style>
<div id="main" class="dashboard">
<?php get_breadcrumb(); ?>
		<div id="content">
			<div class="row">
				<section class="panel">
					<header class="panel-heading">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h3><strong>Inventory </h3>
							</div>
						</div>
					</header>
					<div class="panel-body">
						<div>
							<?php if($warehouseId){ ?>
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li  onclick="load_page('getStoreInventory','store_inventory')" role="presentation" class="active"><a href="#store_inventory" aria-controls="home" role="tab" data-toggle="tab">Store Inventory</a></li>
								<li onclick="load_page('userInventory','user_inventory')" role="presentation"><a href="#user_inventory" aria-controls="profile" role="tab" data-toggle="tab">User Inventory</a></li>
								<li onclick="load_page('inventoryHistory','inventory_history')" role="presentation"><a href="#inventory_history" aria-controls="messages" role="tab" data-toggle="tab">Inventory History</a></li>
								<li onclick="load_page('inventoryRequestHistory','requestd_history')" role="presentation"><a href="#requestd_history" aria-controls="settings" role="tab" data-toggle="tab">Requested History </a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="store_inventory">
									
								</div>
								<div role="tabpanel" class="tab-pane" id="user_inventory">
									
								</div>
								<div role="tabpanel" class="tab-pane" id="inventory_history">
									<div class="row">
										<div class="col-sm-12">
											<label>Select Status</label>
										</div>
										<div class="col-sm-3">
											<select class="form-control requestType">
												<option value="RETURN,CONSUMED"> All </option>
												<option value="CONSUMED"> Consumed </option>
												<option value="RETURN">Return</option>
											</select>
										</div>
									</div>

									
								</div>
								<div role="tabpanel" class="tab-pane" id="requestd_history">
								
								</div>
							</div>
							<?php
							}
							else
							{
								echo "Store Not Available";
							}
							?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>

	<?php get_admin_left_sidebar($language); ?>

	<div id="request_inventory" class="modal fade" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Request</h4>
		</div>
		<div class="modal-body">
			<form method="POST" id="request_stock_form">
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Job </label>
						<div data-html-id = "requestJobId" data-html-classes = 'inp1' data-html-heading = 'no'  data-type='JOB' data-params-smid='1'  data-params-mid='5' class="renderComponents"></div>
					</div>
					<span class="error" id="erequestJobId" style="margin-left:15px;"></span>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Quantity </label>
						<input type="text" class="form-control request_stock_form required_field" data-check-valid="blank,numeric,gtval-0" data-valid-gtval-error="Please enter quantity greater than 0" data-error-show-in="erequestQuantity" data-error-text="Please enter quantity" data-valid-numeric-error="Please enter quantity in numeric digits" id="requestQuantity" name="requestQuantity">
					</div>
					<span class="error" id="erequestQuantity" style="margin-left:15px;"></span>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse requestInventoryButton"> Request </button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>


	<div id="return_popup" class="modal fade" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Return</h4>
		</div>
		<div class="modal-body">
			<form id="return_request_form" method="POST">
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Job </label>
						<div data-html-id = "returnJobId" data-html-classes = 'inp1 return_request_form validation-error' data-html-heading = 'no' data-type='JOB' data-params-smid='1'  data-params-mid='5' class="renderComponents"></div>
					</div>
					<!-- <span class="error" id="ereturnJobId" style="margin-left:15px;"></span> -->
				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Quantity </label><em>*</em>
						<input type="text" class="form-control return_request_form required_field" data-check-valid="blank,numeric,gtval-0" data-valid-gtval-error="Please enter quantity greater than 0" data-error-show-in="ereturnQuantity" data-error-text="Please enter quantity" data-valid-numeric-error="Please enter quantity in numeric digits" id="returnQuantity" name="returnQuantity">
					</div>
					<span class="error" id="ereturnQuantity" style="margin-left:15px;"></span>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse returnButton"> Return </button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>


	<div id="consume_popup" class="modal fade" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Consumed</h4>
		</div>
		<div class="modal-body">
			<form id="consumeForm" method="POST">
			<div class="form-group row">
					<!--<div data-html-id = inp1_0 data-html-classes = 'inp1' data-html-heading = 'no'  data-type='JOB'  data-params-smid='1'  data-params-mid='5' data-params-query_str ='"id=0"'  ></div>-->

					<div class="col-md-12">
						<label class="control-label"> Job </label>
						<div data-html-id = "consumeJobId" data-html-classes = 'inp1 consumeForm  validation-error' data-html-heading = 'no' data-type='JOB' data-params-smid='1'  data-params-mid='5' class="renderComponents"></div>
					</div>
					<!-- <span class="error" id="econsumeJobId" style="margin-left:15px;"></span> -->
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Quantity </label><em>*</em>
						<input type="text" class="form-control consumeForm required_field" data-check-valid="blank,numeric,gtval-0" data-valid-gtval-error="Please enter quantity greater than 0" data-error-show-in="econsumeTitle" data-error-text="Please enter quantity" data-valid-numeric-error="Please enter quantity in numeric digits" id="consumeTitle" name="consumeTitle">
					</div>
					<span class="error" id="econsumeTitle" style="margin-left:15px;"></span>
				</div>
				
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse consume_submit_button"> Consume </button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
<?php include_once(include_admin_template("inventory","common_inventory"));  ?>