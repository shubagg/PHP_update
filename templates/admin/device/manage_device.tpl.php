<body class="leftMenu nav-collapse in">

		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->

    	<?php
         get_admin_header_menu($language); ?>   	

		<div id="main">
         
			<div id="content">
                <div class="row">
                    <div class="button_holder">
                        <div class="popover-area-hover align-lg-right">	
                            <a href="device.php">
    				           <div class="custom_button btn_cu btn btn-default bottom-gap2" data-toggle="popover" data-placement="bottom" data-content="<?php echo $ui_string['clk_add_device'];?>" data-original-title="<?php echo $ui_string['add_device'];?>">
                                    
    								<span><?php echo $ui_string['add'];?></span>
    							</div> 
                            </a>
                        </div>
                    </div>
                    
                    <section class="panel">
                    
                    <header class="panel-heading">
					<div class="row">
					
						<div class="col-md-6 margn_tp_7">
						
								<h3><strong><?php echo $ui_string['dev'];?></strong> </h3>
								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->
						
						</div>
                        
                        <div class="col-md-6">
                          <div class="text-right tooltip-area  select_all btn-grp">
                          <span  class="checkbox slect_aal_btn"  data-color="red" >
        									<input type="checkbox" id="check11" onClick="checkall()" class="new-check-box" />
        									<a href="javascript:;"><strong><label for="check11" style="font-size:14px; font-weight:600; color:#AAA;"><?php echo $ui_string['selectall']; ?></label></strong></a>
        							   </span>
                                       
                                       <button type="button" onClick="delete_device_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i> <!--<?php echo $ui_string['delete']; ?>--></button>
                          </div>
                        
                        
                        </div>
                        
                        </div>
                        </header>
                    
                        <div class="panel-body panel_bg_d">
                            
                                
                            <div class="clearfix"></div>
					        	<div class="table-responsive">
                                    <?php 
                                    $column_head=array('checkbox','Title','Device Name','Description','Action');  
                                    
                                    $button1=array("title"=>"Edit","attr"=>"onclick=go_to('device.php','id='+$(this).attr('data-id'))","icon"=>"fa fa-pencil");
                                    $button2=array("title"=>"Delete","attr"=>"onclick='delete_device(this.id)'","icon"=>"fa fa-trash-o");
                                    $rbuttons=array($button1,$button2);
                                    
                                    $get_device_data=curl_post("/get_device_by_id",array('id'=>0,'smid'=>1));
                                    logger_ui("mange_device(listing all)","",$get_device_data,5);
                                    
                                    
                                    
                                    $row_data=array();
                                    $show_fields=array('checkbox','title','deviceName','description','Action');
                                   
                                    foreach($get_device_data['data'] as $device)
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
                                               
                                                default :
                                                    $ret=$device[$fields[0]];
                                                break;
                                            }
                                            array_push($show_info,$ret);
                                        }
                                        
                                        $ar=array("id"=>$device['id'],"data"=>$show_info,"Action"=>$rbuttons);
                                        array_push($row_data,$ar);
                                        
                                        
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
		<?php get_admin_left_sidebar($language); ?>   
        
                                <div id="success_modal" class="modal fade"
						data-header-color="#736086">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title" id="model_head">
								<i class="glyphicon glyphicon-ok-circle"></i> <?php echo $ui_string['conf'];?>
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body text_alignment">
							<div class="confirmation_successful">
								<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
								<span id="model_des"><?php echo $ui_string['conf_suc'];?></span>
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
                    <div class="modal-body text_alignment">
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
			     <div class="modal-body text_alignment">
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
								<i class="glyphicon glyphicon-ok-circle"></i> <?php echo $ui_string['conf'];?>
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body text_alignment">
							<div class="confirmation_successful">
								<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
								<span id="model_des"><?php echo $ui_string['con_suc'];?></span>
							</div>
						</div>
						<!-- //modal-body-->
					</div>
        

    
    
