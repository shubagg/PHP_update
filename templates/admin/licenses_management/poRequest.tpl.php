<div id="main" class="dashboard">
 <?php get_breadcrumb(); ?>
<script>
function checkalldata(){}
</script>
			<div id="content">
				<div class="row">
					<div class="align-lg-right">

               <?php 
                  $condition=array();
                  $box2=array('name'=>$ui_string['add'],'icon'=>'glyphicon glyphicon-list-alt','attr'=>'onclick="$(\'#po_request_modal\').modal();"',"class"=>"custom_button btn btn-default btn_cu ");
               
                     array_push($condition,$box2);
      
                  include_admin_template_params("resources","box",$condition); 
                  ?>
            </div>
       
       			<section class="panel">
                
                <header class="panel-heading">
                        <h3><strong><?php echo $ui_string['po_request'];?></strong> </h3>
                    </header>
                
						<div class="panel-body">
							<div class="table-responsive f-table">
                            <?php 
                            
                               $column_head=array($ui_string['sales_executive'],$ui_string['po_number'],$ui_string['company_name'],$ui_string['po_date'],$ui_string['no_of_license'],$ui_string['licenses_type'],$ui_string['comment']);  

                                $show_fields=array('sales_executive','po_number','company_name','po_date','no_of_license','licenses_type','comment');
                           
                              
                            $All_data=array("head"=>$column_head);
                            $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                
                            //get_admin_datatable($table_data);
                            
                             if(check_user_permission("licenses","licenses","all")==1 || check_user_permission("licenses","licenses","view")==1){
                                 get_ajax_datatable($table_data,$show_fields,admin_ui_url()."licenses_management/ajax/po_request_datatable_ajax.php"); 
                                }
                            
                            
                           ?>    
                  
                </div>	
						</div>
					</section>
                   
					

					
					
				
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<!-- //main-->
	</div>

		<div id="po_request_modal" class="modal fade in" data-width="300">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								PO Request
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
							
						<form id="po_request_form" parsley-validate="" method="post">
			            <div class="form-group row">
							  <div class="col-md-12">	
			                  <label class="control-label">SALES EXECUTIVE</label>
			                  <input type="hidden" name="id" id="id" value="0">
			                  <input type="text" name="sales_executive" id="sales_executive" data-check-valid="blank" data-error-show-in="esales_executive" data-error-setting="2" data-error-text="Enter sales executive name" class="form-control required_field po_request_form error1" >
			                  <ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="esales_executive"></li></ul>
							  </div>
			            </div>
					   <div class="form-group row">
		                    <div class="col-md-12">
		                    
		                     <label class="control-label">PO NUMBER</label>
		                     <input type="text" data-check-valid="blank" data-error-show-in="epo_number" data-error-setting="2" data-error-text="Enter PO Number" class="form-control required_field po_request_form error1" name="po_number" id="po_number" placeholder=""  />
		                 	<ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="epo_number"></li></ul>
						  
		                    </div> 
						</div>
						<div class="form-group row">
		                    <div class="col-md-12">
		                    
		                     <label class="control-label">COMPANY NAME</label>
		                     <input type="text" data-check-valid="blank" data-error-show-in="ecompany_name" data-error-setting="2" data-error-text="Enter company name" class="form-control required_field po_request_form error1" name="company_name" id="company_name" placeholder=""  />
		                 	<ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="ecompany_name"></li></ul>
						  
		                    </div> 
						</div>
						<div class="form-group row">
		                    <div class="col-md-12">
		                    
		                     <label class="control-label">PO DATE</label>
		                     <input type="text" data-check-valid="blank" data-error-show-in="epo_date" data-error-setting="2" data-error-text="Enter PO Date" class="form-control required_field po_request_form error1" name="po_date" id="po_date" placeholder="yyyy-mm-dd"  />
		                 	<ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="epo_date"></li></ul>
						  
		                    </div> 
						</div>
						<div class="form-group row">
		                    <div class="col-md-12">
		                    
		                     <label class="control-label">NO OF LICENSES</label>
		                     <input type="text" data-check-valid="blank" data-error-show-in="eno_of_license" data-error-setting="2" data-error-text="Enter no.of license" class="form-control required_field po_request_form error1" name="no_of_license" id="no_of_license" placeholder=""  />
		                 	<ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="eno_of_license"></li></ul>
						  
		                    </div> 
						</div>
						<div class="form-group row">
		                    <div class="col-md-12">
		                    
		                     <label class="control-label">TYPE OF LICENSE</label>
		                     <input type="radio" class="po_request_form error1" name="licenses_type" value="trial"/>Trial
		                     <input type="radio" class="po_request_form error1" name="licenses_type" value="corporate" checked="checked" />Corporate
		                 	<ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="elicenses_type"></li></ul>
						  
		                    </div> 
						</div>
						<div class="form-group row">
		                    <div class="col-md-12">
		                    
		                     <label class="control-label">COMMENTS</label>
		                     <textarea  row="5" data-check-valid="blank" data-error-show-in="ecomment" data-error-setting="2" data-error-text="Enter comment" class="form-control required_field po_request_form error1" name="comment" id="comment"></textarea> 
		                 	<ul class="parsley-error-list"><li class="required error" style="display: list-item;" id="ecomment"></li></ul>
						  
		                    </div> 
						</div>
						
						</form></div>
						<!-- //modal-body-->
						<div class="modal-footer" id="cng-pwd"><button type="button" class="btn btn-theme-inverse" onclick="return validation('po_request_form')">Submit</button></div>
							
					</div>


    
	
        <!--------------------success,fail message popup---------------------------------------->
        
        
                 <?php echo success_fail_message_popup();?> 
                 
                    
        <!------------------------end----------------------------------------------------------->
        
        
  
        
                    
                    
             
            
   


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
