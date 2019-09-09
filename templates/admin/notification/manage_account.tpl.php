<body class="leftMenu nav-collapse in">

		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->

    	<?php
         get_admin_header_menu($language); ?>   	

<div id="main" class="dashboard">
         
			<div id="content">
                <div class="row">
                   
                        <div class="popover-area-hover align-lg-right">	
                            <?php if(check_user_permission("notification","notification1","all")==1) { ?>
                            <a href="manageAccount/AddAccount">
							<div class="btn btn-default "   data-toggle="popover" data-placement="left" data-content="
								<?php echo $ui_string['clk_add_account'];?>" data-original-title="
								<?php echo $ui_string['add_account'];?>">
								<span>
									<?php echo $ui_string['add'];?>
								</span>
    							</div> 
                            </a>
                            <?php } ?>
                        </div>
                    
                    
                    <section class="panel">
					<header class="panel-heading">
					<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h3>
									<strong><?php echo $ui_string['man'];?></strong> <?php echo $ui_string['account'];?> 
								</h3>
								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->
						
						</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="text-right tooltip-area select_all">
						 						 <span class="checkbox slect_aal_btn" data-color="red">
						<input type="checkbox" id="check11" onClick="checkall()">
						<a href="javascript:;" for="check11" class="lighter"><strong><label for="check11" style="font-size:14px; font-weight:600; color:#AAA;"><?php echo $ui_string['sel_all'];?></label></strong></a>
						</span>
										<button type="button" onClick="delete_account_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete">
											<i class="glyphicon glyphicon-trash"></i>
										</button>
                        </div> 
                       
						</div>
						
					</div>
					</header>
						<div class="panel-body">
					        	<div class="table-responsive">

                                    <?php 

                                    if(check_user_permission("notification","notification1","all")==1) {
                                    $column_head=array('checkbox','Account Name','Account Type','Domain','Username','Password','From Name','From Email','URL','Port','Action');  
                                    $show_fields=array('checkbox','accName','accType','domain','username','password','from_name','email','url','port','Action');
                                    }
                                    else
                                    {
                                        $column_head=array('checkbox','Account Name','Account Type','Domain','Username','Password','From Name','From Email','URL','Port');  
                                    $show_fields=array('checkbox','accName','accType','domain','username','password','from_name','email','url','port');
                                    }



                                    $button1=array("title"=>"Edit","attr"=>"onclick=go_to('manageAccount/AddAccount',$(this).attr('data-id'))","icon"=>"fa fa-pencil");
                                    $button2=array("title"=>"Delete","attr"=>"onclick='delete_account(this.id)'","icon"=>"fa fa-trash-o");
                                    //$button3=array("title"=>"Status","attr"=>"onclick=change_status(this.id)","icon"=>"glyphicon glyphicon-off");
                                    $rbuttons=array($button1,$button2);
                                    
                                    $get_account=get_account_by_id(array('id'=>0));
                                    
                                    $row_data=array();
                                   if(!empty($get_account['data']))
                                   {
                                    foreach($get_account['data'] as $account)
                                    {
                                        $show_info=array();
                                        foreach($show_fields as $fields)
                                        {
                                            $fields=explode("-",$fields);
                                            switch($fields[0])
                                            {
                                                case "checkbox":
                                                    $ret="checkbox";
                                                break;
                                                case "Action":
                                                    $ret="Action";
                                                break;
                                                case "status":
                                                    $ret="status-".$account['approved'];
                                                break;
                                                case "category":
                                                    $get_user_categories=curl_post($webservice_url."/get_user_category",array("category_id"=>$account['category'],"description"=>$fields[1]));
                                                    $ret=$get_user_categories['success'];
                                                break;
                                                default :
                                                    $ret=$account[$fields[0]];
                                                break;
                                            }
                                            array_push($show_info,$ret);
                                        }
                                        
                                        $ar=array("id"=>$account['id'],"data"=>$show_info,"Action"=>$rbuttons);
                                        array_push($row_data,$ar);
                                    }
                                }
                                    
                                    $All_data=array("head"=>$column_head,"rows"=>$row_data);
                                    $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                    
                                    get_admin_datatable($table_data);
                                 ?>    
								</div>
                            </div>						
                    </section>  
			     </div>
            </div>
		</div>
		<?php get_admin_left_sidebar(); ?>   
        
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
							<div id="deletType"></div>
                    				    </div>
                    				</div>
                    </form>                
				<!-- //modal-body-->
		    </div> 
            
            <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
				<div class="modal-header">
						<button  type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">
						<i class="glyphicon glyphicon-exclamation-sign"></i>
						<span id="error_head"></span>
					</h4>
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

    
    
