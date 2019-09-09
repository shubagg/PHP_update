<?php 
$_GET['type']='warehouse';
include($server_path."/ui/admin/controller/index.php");
get_admin_left_sidebar($language);
get_enroll_users_popup( '',$all_cats, 'enroll-user', '1',array( 'mid'=>'41','smid'=>'1'))
?>
<div id="warehouse_popup" class="modal fade" role="dialog">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add Warehouse</h4>
	</div>
	<div class="modal-body">
		<form method="post" id="manage_warehouse_form">
			<input type="hidden" id="warehouseId" value="0"/>
			<div class="form-group row">
				<div class="col-md-12">
					<label class="control-label"> Title </label><em>*</em>
					<input type="text" class="form-control required_field manage_warehouse_form" data-check-valid="blank" data-error-show-in="etitle" data-error-text="Please enter title" id="title" name="title">
				</div>
				<span class="error" id="etitle" style="margin-left:15px;"></span>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label class="control-label"> Address </label><em>*</em>
					<textarea class="form-control required_field manage_warehouse_form" data-check-valid="blank" data-error-show-in="eaddress" data-error-text="Please enter address" id="address" name="address"></textarea>
				</div>
				<span class="error" id="eaddress" style="margin-left:15px;"></span>
			</div>

			<!--<div class="form-group row">
				<div class="col-md-12">
					<label class="control-label">Owner </label>
					<select class="form-control required_field manage_warehouse_form" data-check-valid="blank" data-error-show-in="eowner" data-error-text="Please select owner" id="owner" name="owner">
						<option value="">Select Owner</option>
						<?php foreach($storeOwners['data'] as $storeOwner){ ?>
							<option value="<?php echo $storeOwner['id']; ?>"><?php echo $storeOwner['name']; ?></option>
						<?php } ?>
					</select>
				</div>
				<span class="error" id="eowner" style="margin-left:15px;"></span>
			</div>-->
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" id="addware" class="btn btn-theme-inverse warehouse_form_submit"> Submit </button>
	</div>
</div>