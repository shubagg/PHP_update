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



								<h3><strong>Allocate Inventory </h3>

								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->



							</div>





						</div>

					</header>



					<div class="panel-body">
						<div class="row">
							<form id="" class="form-horizontal" method="post" action="">

								<div class="col-sm-3">
									<label>Category</label>
									<select class="form-control">
										<option value=""> Normal </option>
										<option value="United States">United States</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="Australia">Australia</option>
										<option value="China">China</option>
										<option value="Japan">Japan</option>
										<option value="Thailand">Thailand</option>
									</select>
								</div>

								<div class="col-sm-3">
									<label>Product</label>
									<select class="form-control">
										<option value=""> Normal </option>
										<option value="United States">United States</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="Australia">Australia</option>
										<option value="China">China</option>
										<option value="Japan">Japan</option>
										<option value="Thailand">Thailand</option>
									</select>
								</div>

								<div class="col-sm-3">
									<label>Allocated To</label>
									<select class="form-control">
										<option value=""> Normal </option>
										<option value="United States">United States</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="Australia">Australia</option>
										<option value="China">China</option>
										<option value="Japan">Japan</option>
										<option value="Thailand">Thailand</option>
									</select>
								</div>

								<div class="col-sm-3">
									<label class="">Quantity</label>
									<input type="text" class="form-control" value="" placeholder="">
									<span id="econfirm_password" class="error"></span>
								</div>
								<div class="col-sm-3">
									<label class="control-label remove_bg col-md-2">Job</label>
									<input type="text" class="form-control" value="" placeholder="">
									<span id="econfirm_password" class="error"></span>
								</div>



								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="pull-right">
										<button type="button" class="btn btn-theme-inverse margn-tp-20"> Save </button>
										<button type="button" class="btn btn-theme-inverse margn-tp-20"> Scan </button>
										<button type="button" class="btn btn-theme-inverse margn-tp-20"> Cancel </button>

									</div>
								</div>

							</form>
						</div>

						<div class="row">
							<div class="col-xs-12 margn-tp-20">
								<div class="scan-div-border"></div>

								<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Category</th>
											<th>Product</th>
											<th>Quantity</th>
											<th>Allocated To</th>
											<th>Job</th>
											<th width="30%">Action</th>
										</tr>
									</thead>
									<tbody align="center">
										<tr>
											<td>1</td>
											<td valign="middle">Dummy</td>
											<td>3</td>
											<td>Purchased</td>
											<td>Dummy</td>
											<td>
						<span class="tooltip-area">

								<a href="javascript:void(0)" class="btn btn-default btn-sm" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
								</span>
											
											</td>
										</tr>
										
									</tbody>
								</table>

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