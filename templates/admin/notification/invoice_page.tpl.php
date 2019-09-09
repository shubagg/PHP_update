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
										<section class="panel corner-flip">
												<div class="panel-body">
														<div class="invoice">
																<div class="row">
																		<div class="col-sm-6">
																			<a href="#"> <img alt="" src="assets/img/logo_invice.png"> </a>
																		</div>
																		<div class="col-sm-6 align-lg-right">
																				<h3>INVOICE NO. #572307</h3>
																				<span>25 january 2014</span>
																		</div>
																</div>
																<hr>
																<div class="row">
																		<div class="col-sm-3">
																				<h4>From :</h4>
																				John Doe <br>
																				Mr Nilson Otto <br>
																				FoodMaster Ltd </div>
																		<div class="col-sm-3">
																				<h4>To :</h4>
																				1982 OOP <br>
																				Madrid, Spain <br>
																				+1 (151) 225-4183 </div>
																		<div class="col-md-6 align-lg-right">
																				<h4>Payment Details :</h4>
																				<strong>V.A.T Reg #:</strong> 542554(DEMO)78 <br>
																				<strong>Account Name:</strong> FoodMaster Ltd <br>
																				<strong>SWIFT code:</strong> 45454DEMO545DEMO
																		</div>
																</div>
																<br>
																<br>
																<table class="table table-bordered">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th width="60%" class="text-left">Product</th>
																						<th>Quantity</th>
																						<th class="text-right">Price</th>
																				</tr>
																		</thead>
																		<tbody>
																				<tr>
																						<td class="text-center">1</td>
																						<td>Lorem Ipsum</td>
																						<td class="text-center">1</td>
																						<td class="text-right">$852</td>
																				</tr>
																				<tr>
																						<td class="text-center">2</td>
																						<td>Nulla pellentesque</td>
																						<td class="text-center">1</td>
																						<td class="text-right">$785</td>
																				</tr>
																				<tr>
																						<td class="text-center">4</td>
																						<td>Leo ornare lacinia</td>
																						<td class="text-center">1</td>
																						<td class="text-right">$1524</td>
																				</tr>
																				<tr>
																						<td class="text-center">5</td>
																						<td>Est arcu integer consectetuer</td>
																						<td class="text-center">1</td>
																						<td class="text-right">$74</td>
																				</tr>
																		</tbody>
																</table>
																<br><br>
																<div class="row">
																		<div class="col-sm-6">
																				<div class="align-lg-left"> 795 Park Ave, Suite 120 <br>
																						San Francisco, CA 94107 <br>
																						P: (234) 145-1810 <br>
																						Full Name <br>
																						first.last@email.com
																				</div>
																		</div>
																		<div class="col-sm-6">
																				<div class="align-lg-right">
																						<ul>
																								<li> Sub - Total amount: <strong>$3,235</strong> </li>
																								<li> VAT: <strong>7.7%</strong> </li>
																								<li> Discount: ----- </li>
																								<li> Grand Total: <strong>$3,485</strong> </li>
																						</ul>
																						<br>
																						<a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i> </a>
																						<a href="#" class="btn btn-theme-inverse hidden-print"> SAVE </a>
																				</div>
																		</div>
																</div>
														</div>
														<!-- //invoice -->
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