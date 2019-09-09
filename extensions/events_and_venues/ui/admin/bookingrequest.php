<?php 
is_user_logged_in();
get_admin_header();
get_admin_header_menu($language); 
get_admin_left_sidebar($language); 

?> 
<div id="main">
<script>
var site_url="<?php echo site_url(); ?>";
var media_url = "<?php echo media_url(); ?>";
var defaultimage=site_url+"/assets/admin/img/addg.png";
var extensions_ui_url= site_url+'/extensions/events_and_venues/ui/admin/';
function checkalldata() {}
</script>
			<div id="content">
				<div class="row">
                <div class="button_holder">
      						<div class="popover-area-hover align-lg-right">
      						</div>
					     </div>
                
           <section class="panel top-gap">
    					<header class="panel-heading">
        					<div class="row">
        						<div class="col-md-4 margn_tp_7">
        								<h3><strong>Booking Request</strong> List</h3>
        						</div>
								
								
        						<div class="col-md-8">
									<!-- calendar  -->
									
									<div class="text-right select_all tooltip-area btn-grp">
									<input placeholder="yyyy-mm-dd" type="text" name="sdt" id="sdt" class="cal booking_date" style="padding: 5px 0px;"><strong> To</strong>
									<input placeholder="yyyy-mm-dd" type="text" name="edt" id="edt" class="cal booking_date" style="padding: 5px 0px;">
									<button type="button" onclick="dateSearch()" data-toggle="tooltip" data-placement="top" title="Search" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
										<button type="button" onclick="resetSearch()" data-toggle="tooltip" data-placement="top" title="Refresh" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></button>
										
									
									</div> 
								
									</div>
								<!--<div class="col-md-1">
									<div class=" select_all tooltip-area btn-grp">
								
									</div> 
        						</div>-->
        					</div>
    					</header>
					
    						<div class="panel-body panel_bg_d">
    							<div class="table-responsive">
                                <?php 
                                  //$column_head=array($ui_string['checkbox'],$ui_string['name'],$ui_string['email'],$ui_string['profile'],$ui_string['area'],$ui_string['manager'],$ui_string['profile_image'],$ui_string['status'],$ui_string['action']);  
                                  $column_head=array('OrderId','Title','User','Booking Date-time','From Date','To Date','Description','Total Amt','Status','Image');  
                                  $show_fields=array('orderId','title','username','date','startDate','endDate','description','totalPrice','status','user_avatar');
                                	$All_data=array("head"=>$column_head);
                                	$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_ui_url()."/events_and_venues/ui/admin/ajax/datatable_ajax_venuerequest.php"); 
                                    
                               ?>    
    							</div>
    						</div>
					</section>
                  <div>
                     <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
                				<div class="modal-header">
                						<button  type="button" class="close"></button>
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

                         <div class="modal fade in" id="approveaddPopup" role="dialog" data-backdrop="static" data-width="900" data-keyboard="false">
                          <div class="modal-content">
                            <div class="modal-header">
                                    <button type="button" class="close closecity" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Venue Status</h4>
                            </div>
                            <div class="modal-body new_panel">
                                  <form id="statusaddPopupSubmit" class="form-horizontal" method="post" enctype="multipart/form-data">
                                 <div class="form-group ">
                                      <label class="control-label remove_bg col-md-2">Comment</label>
                                      <div class="col-md-10">
                                         <textarea id="comment" name="comment" data-check-valid="blank" data-error-show-in="eTitle" data-error-setting="2" data-error-text="Please enter comment" class="form-control required_field statusaddPopupSubmit" ></textarea>

                                         <input type="hidden" id="productid" name="productId" value="0">
                                         <input type="hidden" id="id" name="id" value="0">
                                           <span id="eTitle" class="error"></span>
                                        </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label remove_bg col-md-2">Payment Session Expire Time</label>
                                      <div class="col-md-10">
                                         <select name="paymetExpireTime" class="form-control" id="paymetExpireTime" >
                                          <?php for($zz=1; $zz<=24;$zz++){?>
                                           <option value="<?php echo $zz; ?>"><?php echo $zz; ?> Hour/s</option>
                                           <?php } ?>
                                         </select>
                                          <span id="epaymetExpireTime" class="error"></span>
                                      </div>
                                  </div>
                               <div style="clear:both;"></div>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-default"  onclick="return validation_submit('statusaddPopupSubmit','Approved');">Approved</button>
                                    <button type="button" class="btn btn-default"  onclick="return validation_submit('statusaddPopupSubmit','Rejected');">Rejected</button>
                            </div></form>
                          </div>
                        </div>    
            
                         <div class="modal fade in" id="approveaddPopupdetail" role="dialog" data-backdrop="static" data-width="900" data-keyboard="false">
                          <div class="modal-content">
                            <div class="modal-header">
                                    <button type="button" class="close closecity" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">View Venue Status</h4>
                            </div>
                            <div class="modal-body new_panel">
                                  
                                 <div class="form-group ">
                                      <label class="control-label remove_bg col-md-2">Comment</label>
                                      <div class="col-md-10">
                                         <textarea id="commentshow"  disabled="disabled" data-check-valid="blank" data-error-show-in="eTitle" data-error-setting="2" data-error-text="Please enter comment" class="form-control required_field statusaddPopupSubmit" ></textarea>
                                        </div>
                                  </div>
                                    </br></br></br>
                                  <div class="form-group ">
                                      <label class="control-label remove_bg col-md-2">Status</label>
                                      <div class="col-md-10">
                                         <approval id="statusdetail"></approval>
                                        </div>
                                  </div>
                               <div style="clear:both;"></div>
                            </div>
                            <div class="modal-footer">
                                 
                            </div>
                          </div>
                        </div>   

				</div>
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
                 <?php //echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
	</div>
<script type="text/javascript" src="<?php echo extensions_ui_url(); ?>/events_and_venues/ui/admin/js/venue_request.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>
 <?php get_admin_footer(); ?> 
