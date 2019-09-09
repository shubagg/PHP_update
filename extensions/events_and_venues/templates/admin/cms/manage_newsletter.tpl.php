<body class="leftMenu nav-collapse in">
    	<?php
         get_admin_header_menu($language); ?>   	

		<div id="main">
          <?php get_breadcrumb(); ?>
			<div id="content">
                <div class="row">
                    <div class="button_holder">
                        <div class="popover-area-hover align-lg-center">	
                           
                            <a href="<?php echo get_url('btrigger'); ?>">
    				           <div class="custom_button btn btn-default bottom-gap2"   data-toggle="popover" data-placement="bottom">
                                    <i class="glyphicon glyphicon-user"></i><br/>
    								<span>Send Newsletter</span>
    							</div> 
                            </a>
                           
                        </div>
                    </div>
                    <section class="panel">
					<header class="panel-heading">
					<div class="row">
					
						<div class="col-md-6">
						
								<h3><strong>Manage</strong> Newsletter </h3>
								<!--<label class="color">Bootstrap Class<em><strong> table-responsive </strong></em></label>-->
						
						</div>
						<div class="col-md-6">
						<div class="text-right  select_all btn-grp">
						 						 <span class="checkbox" data-color="red">
						<input type="checkbox" id="check11" onclick="checkall()">
						<a href="javascript:;" for="check11" class="lighter"><strong><label for="check11" style="font-size:14px; font-weight:bold;">Select All</label></strong></a>
						</span>
						
						 <button type="button" onclick="delete_account_temp()" class="btn btn-primary btn-theme-inverse"><i class="glyphicon glyphicon-trash"></i> Delete</button>
						 
						    
                        </div> 
                       
						</div>
						
					</div>
					</header>
                        <div class="panel-body">
					        	<div class="table-responsive">

                                    <?php 

                                  
                                    $column_head=array('checkbox','Subject','Message','Date','Action');  
                                    $show_fields=array('checkbox','subject','description','date','Action');
                                    $button2=array("title"=>"Delete","attr"=>"onclick='delete_account(this.id)'","icon"=>"fa fa-trash-o");
                                    //$button3=array("title"=>"Status","attr"=>"onclick=change_status(this.id)","icon"=>"glyphicon glyphicon-off");
                                    $rbuttons=array($button2);
                                    
                                    $get_account=curl_post("/get_newsletter_by_id",array('id'=>0));
                                    
                                    $row_data=array();
                                    
                                   
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
                                                case "date":
                                                    $ret=date("M d,Y H:i",$account['createDate']['sec']);
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
								<i class="glyphicon glyphicon-ok-circle"></i> Confirmation
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body text_alignment">
							<div class="confirmation_successful">
								<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
								<span id="model_des">Confirmation Successful</span>
							</div>
						</div>
						<!-- //modal-body-->
					</div>
                    
            <div id="sure_to_delete" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Are you sure?</h4>
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
								<i class="glyphicon glyphicon-ok-circle"></i> Confirmation
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body text_alignment">
							<div class="confirmation_successful">
								<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
								<span id="model_des">Confirmation Successful</span>
							</div>
						</div>
						<!-- //modal-body-->
					</div>

    
    
