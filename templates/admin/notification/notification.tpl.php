<div id="main">
<script>
function checkalldata(){}
</script>
<style type="text/css">
#data_table_1_filter{display: none;}
</style>
			<div id="content">
				<div class="row margn-tp-20">
					
       
       			<section class="panel">
                
                <header class="panel-heading">
                        		<div class="row">
					
						<div class="col-md-4 margn_tp_7">
						
								<h3><strong> <?php echo $ui_string['notification']; ?></strong> </h3>
								
						
						</div>
            
						<div class="col-md-8">
						<div class="text-right select_all tooltip-area btn-grp">
                        
                        <span class="checkbox slect_aal_btn" data-color="red" >
<input type="checkbox" id="check11" onclick="checkall();" class="all_check" />
<a href="javascript:;"><strong><label for="check11" style="font-size:14px; font-weight:600; color:#AAA;"><?php echo $ui_string['select_all'];?></label></strong></a>
</span>
						
						 <button type="button" onclick="delete_notification_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i> <!--<?php echo $ui_string['delete']; ?>--></button>
				
                        </div> 
                       
						</div>

						
					</div>
                    </header>
                
						<div class="panel-body panel_bg_d">
							<div class="table-responsive">
                            <?php 
                           
                            $column_head=array($ui_string['checkbox'],$ui_string['title'],$ui_string['timeAgo'],$ui_string['action']);  
                            $show_fields=array('checkbox','pmsg','timeAgo','action'); 
                            $All_data=array("head"=>$column_head);
                            $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                       
                            get_ajax_datatable($table_data,$show_fields,admin_ui_url()."notification/ajax/notification_datatable_ajax.php?userId=".$_SESSION['user']['user_id']); 
                          
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
