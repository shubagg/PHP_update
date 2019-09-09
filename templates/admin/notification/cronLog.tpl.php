<div id="main">
<script>
function checkalldata(){}
</script>
<style type="text/css">
#data_table_1_filter{display: none;}
</style>
			<div id="content">
				<div class="row">
					
       
       			<section class="panel">
                
                <header class="panel-heading">
                        		<div class="row">
					
						<div class="col-md-4 margn_tp_7">
						
								<h3><strong> <?php echo $ui_string['cronLogs']; ?></strong> </h3>
								
						
						</div>
            
						<div class="col-md-8">
						<div class="text-right select_all tooltip-area btn-grp">
                      
                        </div> 
                       
						</div>

						
					</div>
                    </header>
                
						<div class="panel-body panel_bg_d">
							<div class="table-responsive">
                            <?php 
                           
                            $column_head=array($ui_string['logsId'],$ui_string['cronId'],$ui_string['cronName'],$ui_string['triggerId'],$ui_string['triggerName'],$ui_string['starttime'],$ui_string['endtime'],$ui_string['totaltime'],$ui_string['result']);  
                            $show_fields=array('logsId','cronId','cronName','triggerId','triggerName','starttime','endtime','totaltime','result'); 
                            $All_data=array("head"=>$column_head);
                            $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                       
                            get_ajax_datatable($table_data,$show_fields,admin_ui_url()."notification/ajax/cronLogs_datatable_ajax.php?id=".$_GET['id']); 
                          
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
        
        <!--------------------delete_confirmation popup---------------------------------------->
        
        
                 <?php echo delete_confirmation_popup();?> 
                 
                    
        <!------------------------end----------------------------------------------------------->
        
                    
                    
             
            
   


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
