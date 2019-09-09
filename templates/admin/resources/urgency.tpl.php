<div id="main">
	    <div id="content">
      <section class="panel" >
        <header class="panel-heading">
          <div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
						<h3>
							<strong>
								<?php echo $ui_string['urgency'];?>
							</strong>
						</h3>
            </div>
<?php /*?>
            <div class="col-md-6 text-right">
              <div class="panel-tools no_botm_bor" style="  background-color: transparent;
    border: 0;" >
                <ul class="tooltip-area">
								<li style="display: list-item; text-align:right">
									<a href="javascript:void(0)" class="btn  btn-collapse in" title="Collapse" style="font-size: 12px;     width: 25%; text-decoration: underline;">Query</a>
								</li>
                </ul>
              </div>
            </div>
          </div>
<?php */?>
        </header>
			<div class="panel-body">
								<div class="table-responsive">
                            
                            <?php 
                              if(check_user_permission("resources","users","urgency_all")==1){
                                  $column_head=array($ui_string['urgencyType'],$ui_string['action']);
                                  $show_fields=array('type','Action');  
                              }
                              else
                              {

                                  $column_head=array($ui_string['urgencyType']);
                                  $show_fields=array('type');  
                              }
                                
                                $button1=array("title"=>"Edit","attr"=>"onclick=get_urgency(this.id)","icon"=>"fa fa-pencil");

                              
                                $rbuttons=array($button1);
                          
                               
                                $row_data=array();
                                
                                $get_users=get_urgency_data(array());
                                foreach($get_users['data'] as $users)
                                {
                                   
                                    $show_info=array();
                                    foreach($show_fields as $fields)
                                    {
                                        $fields=explode("-",$fields);
                                        switch($fields[0])
                                        {
                                            
                                            case "Action":
                                                $ret="Action";
                                            break;
                                            
                                        
                                            case "status":
                                                $ret="status-".$users['status'];
                                            break;
                                            
                                            
                                            default :
                                                $ret=$users[$fields[0]];
                                            break;
                                        }
                                        array_push($show_info,$ret);
                                    }
                                    
                                    $ar=array("id"=>$users['id'],"data"=>$show_info,"Action"=>$rbuttons);
                                    array_push($row_data,$ar);
                                }
                                
                               // print_r($row_data);
                                $All_data=array("head"=>$column_head,"rows"=>$row_data);
                                $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                
                                get_admin_datatable($table_data);
                             ?>    
              </div>
						</div>
      </section>
    </div>
</div>





    <div id="urgencyModal" class="modal fade in" data-width="300">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-times"></i>
              </button>
              <h4 class="modal-title" id="model-title">
                <?php echo $ui_string['urgencyEdit'];?>
              </h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
              
            <form id="urgencyForm" parsley-validate="">
            
               <div class="form-group row">
      
                <input type="hidden" id="uId" name="uId"> 
         
               </div>
               <div class="form-group row">
                      
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <label class="control-label"><?php echo $ui_string['urgencyType'];?></label>
                        <input type="text" data-check-valid="blank" data-error-show-in="etype" data-error-setting="2" data-error-text="<?php echo $ui_string['12070'];?>" class="form-control required_field urgency error1" name="type" id="type" placeholder=""  />
                     <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="etype"></li></ul>
              
                      </div> 

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <label class="control-label"><?php echo $ui_string['no_of_notification'];?></label>
                        <input type="number" data-check-valid="blank" data-error-show-in="eno_of_notification" data-error-setting="2" data-error-text="<?php echo $ui_string['13012'];?>" class="form-control required_field urgency error1" name="no_of_notification" id="no_of_notification" placeholder=""  />
                     <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eno_of_notification"></li></ul>
              
                      </div> 

                      <div class="col-md-12">
                         <label class="control-label"><?php echo $ui_string['notification_send_after_time'];?></label>
                        <input type="number" data-check-valid="blank" data-error-show-in="enotification_send_after_time" data-error-setting="2" data-error-text="<?php echo $ui_string['13013'];?>" class="form-control required_field urgency error1" name="notification_send_after_time" id="notification_send_after_time" placeholder=""  />
                     <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="enotification_send_after_time"></li></ul>
              
                      </div> 
              </div>
                 
              
            </form></div>
            <!-- //modal-body-->
            <div class="modal-footer" id="cng-pwd">       
            
            
            </div>
              
          </div>


            <?php echo success_fail_message_popup();?> 