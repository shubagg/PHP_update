<body class="leftMenu nav-collapse in">

	<!--

		/////////////////////////////////////////////////////////////////////////

		//////////     HEADER  CONTENT     ///////////////

		//////////////////////////////////////////////////////////////////////

		-->



	<?php

	get_admin_header_menu( $language );

	?>



	<div id="main" class="dashboard">

		<script>
			function checkalldata() {}
		</script>



		<div id="content">

			<div class="row">

				<section class="panel">

					<header class="panel-heading">

						<div class="row">



							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">



								<h3><strong>Store </h3>

								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->



							</div>




						</div>

					</header>




					<div class="panel-body">

						<div>

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#request_stock" aria-controls="home" role="tab" data-toggle="tab">Requested Stock</a>
								</li>
								<li role="presentation"><a href="#stock_in" aria-controls="profile" role="tab" data-toggle="tab">Stock In</a>
								</li>
								<li role="presentation"><a href="#stock_out" aria-controls="messages" role="tab" data-toggle="tab">Stock Out</a>
								</li>
								<li role="presentation"><a href="#reurned_stock" aria-controls="settings" role="tab" data-toggle="tab">Returned Stock</a>
								</li>
								<li role="presentation"><a href="#avail_stock" aria-controls="settings" role="tab" data-toggle="tab">Available Stock</a>
								</li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="request_stock">


									<section class="panel margn-tp-20">
										<header class="panel-heading">
											<div id="filter-panel" class="filter-panel">


												<div class="row">
													<div class="col-md-6">

														<h3><strong>
                          Advance Search                          </strong></h3>
													


													</div>
													<div class="col-md-6 text-right">
														<h4>
															<div><button class="btn btn-theme-inverse" id="adv_search_btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> Expand</button>
															</div>
														</h4>
													</div>
												</div>
											</div>
										</header>
										<div class="panel-body">
											<div class="grid" id="adv_search" style="display: none">

												<div class="row " id="stadd_0">
													<div class="col-md-3 col-xs-12">
														<div class="form-group" id="div_sel1_0">
															<select onchange="change_box(this.id,0)" name="" id="sel1_0" class="form-control sel1">
																<option data_id="a" value="j.`deviceId`">Device Id</option>
																<option data_id="a" value="date">Date</option>
															</select>
														</div>
													</div>
													<div class="col-md-3 col-xs-12">
														<div class="form-group" id="div_sel2_0">
															<select class="form-control sel2" id="sel2_0">
																<option value="=">Is equal to</option>
																<option value=">">Is greater than</option>
																<option value="<">Is less than</option>
																<option value=">=">Is greater than equal to</option>
																<option value="<=">Is less than equal to</option>
																<option value="!=">Is not equal to</option>
																<option value="like">Is Like</option>
															</select>
														</div>
													</div>
													<div class="col-md-3 col-xs-12" id="div_inp1_0"><input name="" id="inp1_0" required="required" type="text" class="form-control inp1">
													</div>
													<div class="col-md-3 col-xs-12">
														<div class="form-group col-md-8" id="div_sel3_0"><input type="radio" class="sel3" value="AND" id="and_radio_0" name="radio_0" onchange="add_new_query(this.value,0);">And &nbsp; <input type="radio" class="sel3" value="OR" id="or_radio_0" name="radio_0" onchange="add_new_query(this.value,0);">Or</div>
														<div>
															<div onclick="remove_query_div(0)" class="badge bg-theme search-badge"><span class="glyphicon glyphicon-minus"></span>
															</div>
														</div>
													</div>
												</div>
												<div id="stadd" class="" style="display:block">



												</div>
												<div class="text-right mt-15">
													<button type="button" onclick="test1()" class="btn btn-theme-inverse">Make Query</button>
													<button type="button" onclick="save_query()" class="btn btn-theme-inverse">Save Query</button>
													<button type="button" onclick="make_datatable()" class="btn btn-theme-inverse">Search</button>
													<button type="button" onclick="refresh_custom_dt()" class="btn btn-theme-inverse">Refresh</button>
												</div>
												<div class="row">
													<div class="col-md-12 margn_tp_7" style="display: block;">
														<label></label>
														<textarea id="query_write" readonly class="form-control" rows="5"></textarea>
													</div>
												</div>

											</div>

										</div>



									</section>

									<div class="table-responsive margn-tp-20">
										<form>
											<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example1">
												<thead>
													<tr>
														<th>S.No</th>
														<th>Item Name</th>
														<th>category</th>
														<th>Req. by</th>
														<th>Req. Date</th>
														<th>Approved by</th>
														<th>Job</th>

														<th>Action</th>
													</tr>
												</thead>
												<tbody align="center">
													<tr class="odd gradeX">
														<td>1</td>
														<td>keboard</td>
														<td>It</td>
														<td class="center"> John</td>
														<td class="center">19-03-2014</td>
														<td class="center">John</td>
														<td class="center">Dummy</td>

														<td class="center"><button type="button" class="btn btn-theme-inverse 
																												 "> Approve </button>
														</td>
													</tr>




												</tbody>
											</table>
										</form>

									</div>

								</div>
								<div role="tabpanel" class="tab-pane" id="stock_in">

									<div class="row">



										<div class="col-sm-2 pull-right">

											<a href="<?php echo admin_ui_urls();?>notification/add_inventry.php" class="btn btn-theme-inverse pull-right"><i class="fa fa-plus-circle"></i> Add Inventory</a>

										</div>


									</div>

									<div class="table-responsive margn-tp-20">
										<form>
											<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example2">
												<thead>
													<tr>
														<th>S.No</th>
														<th>Item Name</th>
														<th>category</th>
														<th>Qty</th>
														<th>In Date</th>
														<th>Vender Name</th>

													</tr>
												</thead>
												<tbody align="center">
													<tr class="odd gradeX">
														<td>1</td>
														<td>keboard</td>
														<td>It</td>
														<td class="center"> 5</td>
														<td class="center">19-03-2014</td>
														<td class="center">John</td>

													</tr>





												</tbody>
											</table>
										</form>

									</div>


								</div>
								<div role="tabpanel" class="tab-pane" id="stock_out">


									<div class="row">


										<div class="col-sm-2 pull-right">

											<a href="<?php echo admin_ui_urls();?>notification/allocate_inventry.php" class="btn btn-theme-inverse pull-right"><i class="fa fa-plus-circle"></i> Allocate</a>

										</div>


									</div>

									<div class="table-responsive margn-tp-20">
										<form>
											<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example3">
												<thead>
													<tr>
														<th>S.No</th>
														<th>Item Name</th>
														<th>category</th>
														<th>Qty</th>
														<th>Out Date</th>
														<th>job</th>
														<th>Allocated To</th>
														<th>Status</th>

													</tr>
												</thead>
												<tbody align="center">
													<tr class="odd gradeX">
														<td>1</td>
														<td>keboard</td>
														<td>It</td>
														<td class="center"> 8</td>
														<td class="center">19-03-2014</td>
														<td class="center">Recieved</td>
														<td class="center"> Dummy</td>
														<td class="center"> Dummy</td>

													</tr>



												</tbody>
											</table>
										</form>

									</div>



								</div>
								<div role="tabpanel" class="tab-pane" id="reurned_stock">



									<div class="row">


										<div class="col-sm-2 pull-right">

											<a href="<?php echo admin_ui_urls();?>notification/accept_return_inventry.php" class="btn btn-theme-inverse pull-right"><i class="fa fa-plus-circle"></i> Accept return</a>

										</div>


									</div>

									<div class="table-responsive margn-tp-20">
										<form>
											<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example4">
												<thead>
													<tr>
														<th>S.No</th>
														<th>Item Name</th>
														<th>category</th>
														<th>Qty</th>
														<th>Returned By</th>
														<th>Returned Date</th>
														<th>Job</th>

													</tr>
												</thead>
												<tbody align="center">
													<tr class="odd gradeX">
														<td>1</td>
														<td>keboard</td>
														<td>It</td>
														<td class="center"> 7</td>
														<td class="center">19-03-2014</td>
														<td class="center">19-03-2014</td>
														<td class="center">Dummy</td>

													</tr>



												</tbody>
											</table>
										</form>

									</div>


								</div>
								<div role="tabpanel" class="tab-pane" id="avail_stock">


									<div class="table-responsive margn-tp-20">
										<form>
											<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example5">
												<thead>
													<tr>
														<th>S.No</th>
														<th>Item Name</th>
														<th>category</th>
														<th>Qty</th>
														<th>Consyumed Date</th>
														<th>Threshold quanity</th>
														<th>Action</th>

													</tr>
												</thead>
												<tbody align="center">
													<tr class="odd gradeX">
														<td>1</td>
														<td>keboard</td>
														<td>It</td>
														<td class="center"> 9</td>
														<td class="center">19-03-2014</td>
														<td class="center">Dummy</td>
														<td class="center">
															<button type="button" class="btn btn-theme-inverse " data-toggle="modal" data-target="#myModal"> Reorder </button>
															<a href="<?php echo admin_ui_urls();?>notification/allocate_inventry.php" class="btn btn-theme-inverse 
																					 "> Allocate </a>


														</td>

													</tr>



												</tbody>
											</table>
										</form>

									</div>

								</div>
							</div>

						</div>



					</div>


				</section>

			</div>

		</div>

	</div>

	<?php get_admin_left_sidebar($language); ?>



	<div id="success_modal" class="modal fade" data-header-color="#736086">

		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">

								<i class="fa fa-times"></i>

							</button>

		

			<h4 class="modal-title" id="model_head">

								<i class="glyphicon glyphicon-ok-circle"></i> <?php echo $ui_string['con'];?>

							</h4>

		

		</div>

		<!-- //modal-header-->

		<div class="modal-body">

			<div class="confirmation_successful">

				<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>

				<span id="model_des">
					<?php echo $ui_string['con_suc'];?>
				</span>

			</div>

		</div>

		<!-- //modal-body-->

	</div>



	<div id="sure_to_delete" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300">

		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

			<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> <?php echo $ui_string['are_you_sure'];?></h4>

		</div>

		<!-- //modal-header-->

		<form class="form-horizontal" data-collabel="2" data-label="color" id="deleteData">

			<div class="modal-body">

				<div class="button_holder">



					<div id="deletType">



					</div>

				</div>

			</div>

		</form>

		<!-- //modal-body-->

	</div>

	<div id="myModal" class="modal fade" role="dialog">


		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Re-Order</h4>
		</div>
		<div class="modal-body">

			<form>
				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Category 
        </label>
						<input type="text" class="form-control required_field" data-check-valid="blank" data-error-show-in="pname" data-error-text="Please enter project name" id="title" name="title">
					</div>
					<span class="error" id="pname" style="margin-left:15px;">
      </span>
				

				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label"> Item Name 
        </label>
						<input type="text" class="form-control required_field" data-check-valid="blank" data-error-show-in="pname" data-error-text="Please enter project name" id="title" name="title">
					</div>
					<span class="error" id="pname" style="margin-left:15px;">
      </span>
				

				</div>


				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Quantity 
        </label>
						<input type="text" class="form-control required_field" data-check-valid="blank" data-error-show-in="pname" data-error-text="Please enter project name" id="title" name="title">
					</div>
					<span class="error" id="pname" style="margin-left:15px;">
      </span>
				

				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<label class="control-label">Vendor 
        </label>
						<input type="text" class="form-control required_field" data-check-valid="blank" data-error-show-in="pname" data-error-text="Please enter project name" id="title" name="title">
					</div>
					<span class="error" id="pname" style="margin-left:15px;">
      </span>
				

				</div>


			</form>



		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-theme-inverse "> Submit </button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>


	</div>

	<div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300">

		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>





			<h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>

		</div>

		<!-- //modal-header-->

		<div class="modal-body">

			<div class="button_holder">

				<p><strong id="error_body"></strong>
				</p>

			</div>

		</div>

		<!-- //modal-body-->

	</div>



	<div id="success_modal" class="modal fade" data-header-color="#736086">

		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">

								<i class="fa fa-times"></i>

							</button>

		

			<h4 class="modal-title" id="model_head">

								<i class="glyphicon glyphicon-ok-circle"></i> <?php echo $ui_string['con'];?>

							</h4>

		

		</div>

		<!-- //modal-header-->

		<div class="modal-body">

			<div class="confirmation_successful">

				<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>

				<span id="model_des">
					<?php echo $ui_string['con_suc'];?>
				</span>

			</div>

		</div>

		<!-- //modal-body-->

	</div>