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

                   

                        <div class="popover-area-hover align-lg-right">

                        <?php if(check_user_permission("notification","notification1","all")==1) { ?>	



                            <a href="AddTemplate">

        <div class="btn btn-default"   data-toggle="popover" data-placement="left" data-content="<?php echo $ui_string['clk_add_template'];?>" data-original-title="<?php echo $ui_string['add_template'];?>">

                                 

    								<span><?php echo $ui_string['add'];?></span>

    							</div> 

                            </a>

                            <?php } ?>

                        </div>

                 

                    

                    <section class="panel">

					<header class="panel-heading">

					<div class="row">

					

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

						

								<h3><strong><?php echo $ui_string['man'];?></strong> <?php echo $ui_string['template'];?> </h3>

								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->

						

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

						<div class="align-lg-right select_all tooltip-area btn-grp">

						 <?php if(check_user_permission("notification","notification1","all")==1) { ?>

						  <span class="checkbox slect_aal_btn" data-color="red" >

<input type="checkbox" id="check11" onClick="checkall();" class="all_check" />

<a href="javascript:;"><strong><label for="check11" class="select-color"><?php echo $ui_string['sel_all']; ?></label></strong></a>

</span><!--

						<button type="button" class="btn btn-primary btn-transparent">

						<input type="checkbox" id="check11" onClick="checkall()" />

						<label class="lighter" for="check11" style="display:initial"><?php echo $ui_string['sel_all']; ?></label>

						</button>-->

						 <button type="button" onClick="delete_template_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i> <!--<?php echo $ui_string['delete']; ?>--></button>

						 

						   <?php } ?> 

                        </div> 

                       

						</div>

						

					</div>

					</header>

					

                        <div class="panel-body">

					        	<div class="table-responsive">

                                    <?php 

                                    

                                    if(check_user_permission("notification","notification1","all")==1) 

                                    {

                                        $column_head=array('checkbox','Template Name','Module Name','Sub-Module','Event Name','Template For','Description','Action');  

                                        $show_fields=array('checkbox','tempName','mid','smid','eid','tempFor','tempDesc','action');

                                    }

                                    else

                                    {

                                        $column_head=array('Template Name','Module Name','Sub-Module','Event Name','Template For','Description');  

                                        $show_fields=array('tempName','mid','smid','eid','tempFor','tempDesc');

                                    }



                                    $All_data=array("head"=>$column_head);

                                    $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);

                                        

                                    get_ajax_datatable($table_data,$show_fields,admin_ui_url()."notification/ajax/template_datatable_ajax.php"); 

                                     

                                    

                                 ?>    

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



    

    
