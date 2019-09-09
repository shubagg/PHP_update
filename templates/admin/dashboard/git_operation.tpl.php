<body class="leftMenu nav-collapse in">

		<!--

		/////////////////////////////////////////////////////////////////////////

		//////////     HEADER  CONTENT     ///////////////

		//////////////////////////////////////////////////////////////////////

		-->



    	<?php

         get_admin_header_menu($language); ?>   	



		<div id="main" class="dashboard">

            <script>

                function checkalldata(){}

            </script>

        

			<div id="content">

                <div class="row">

                   


                 

                    

                    <section class="panel">

					<header class="panel-heading">

					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<h3>Git Operation</h3>

								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->


						</div>

					

						

					</div>

					</header>

					

                        <div class="panel-body">

					        	<div class="table-responsive">

                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example-gitoperation">
																		<thead>
																				<tr>
																						<th>Action</th>
																						<th>User</th>
																						<th>Branch</th>
																						<th>Comments</th>
																						<th>Time</th>
																				</tr>
																		</thead>
																		<tbody align="center">
																				<tr class="odd gradeX">
																						<td>Opened</td>
																						<td>Lalit</td>
																						<td>TM-issue-234</td>
																						<td class="center">add url in my branch</td>
																						<td class="center">1 hour ago</td>
																				</tr>
																				
																				<tr class="gradeC">
																						<td>Pushed</td>
																						<td>Pratyush Mishra</td>
																						<td>TM-issue-237</td>
																						<td class="center">add section of data-table in ticktet-tool</td>
																						<td class="center">2 hour ago</td>
																				</tr>
																				<tr class="gradeC">
																						<td>accepted</td>
																						<td>Navjot</td>
																						<td>TM-issue-290</td>
																						<td class="center">add url </td>
																						<td class="center">3 hour ago</td>
																				</tr>
																				<tr class="gradeA">
																						<td>closed</td>
																						<td>Anjli</td>
																						<td>TM-issue-298</td>
																						<td class="center">correction in my module</td>
																						<td class="center">3 hour ago</td>
																				</tr>
																				<tr class="gradeA">
																						<td>accepted</td>
																						<td>Nilesh</td>
																						<td>TM-issue-230</td>
																						<td class="center">fix bug in job module</td>
																						<td class="center">4 hour ago</td>
																				</tr>
																				<tr class="gradeX">
																						<td>Opened</td>
																						<td>Chandan</td>
																						<td>TM-issue-298</td>
																						<td class="center">fix bugs in attendence</td>
																						<td class="center">5 hour ago</td>
																				</tr>
																				<tr class="gradeX">
																						<td>closed</td>
																						<td>Sombir vats</td>
																						<td>TM-issue-233</td>
																						<td class="center">add section in ticktet-tool</td>
																						<td class="center">5 hour ago</td>
																				</tr>
																				
																		</tbody>
																</table>   

								</div>

                            </div>						

                    </section>  

			     </div>

            </div>

		</div>

		<?php get_admin_left_sidebar($language); ?>   

        

                <div id="success_modal" class="modal fade"

						data-header-color="#736086">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal"

								aria-hidden="true">

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

								<span id="model_des"><?php echo $ui_string['con_suc'];?></span>

							</div>

						</div>

						<!-- //modal-body-->

					</div>

                    

                     <div id="sure_to_delete" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >

                    <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>

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

            

            <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >

				<div class="modal-header">

						<button  type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

						

      

                        <h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>

				</div>

				<!-- //modal-header-->

			     <div class="modal-body">

				    <div class="button_holder"> 

			             <p><strong id="error_body"></strong></p>

				    </div>

				</div>

				<!-- //modal-body-->

		    </div>

            

            <div id="success_modal" class="modal fade"

						data-header-color="#736086">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal"

								aria-hidden="true">

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

								<span id="model_des"><?php echo $ui_string['con_suc'];?></span>

							</div>

						</div>

						<!-- //modal-body-->

					</div>



    

    
