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



								<h3><strong>Product Transition History</h3>

								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->



							</div>





						</div>

					</header>



					<div class="panel-body">
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>Product Name  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>XYZ</label>

								</div>
							
						</div>
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>Allocated Date  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>19-03-2017</label>

								</div>
							
						</div>
						
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>Allocated By  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>john</label>

								</div>
							
						</div>
						
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>Used for  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>dummy</label>

								</div>
							
						</div>
						
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>User Quantity  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>5</label>

								</div>
							
						</div>
						
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>Returned to  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>dummy</label>

								</div>
							
						</div>
						
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>Returned Date  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>19-03-2017</label>

								</div>
							
						</div>
						
						<div class="row">
							
								<div class="col-md-4 col-sm-4 col-xs-12 tickt">
									<h5><strong>Returned Quantity  </strong></h5>
								</div>
								<div class="col-md-1 col-sm-1 hidden-xs">
									<strong>:</strong>
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<label>6</label>

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