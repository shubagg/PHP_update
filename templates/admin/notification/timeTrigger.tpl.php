<div id="main">
<script>
function checkalldata(){}
</script>
			<div id="content">
				<div class="row">
					
					<div class="button_holder">
						<div class="popover-area-hover align-lg-right">

							<?php 
                               
                                 $condition=array();
                $box1=array('name'=>$ui_string['add'],'icon'=>'glyphicon glyphicon-list-alt','attr'=>'href="manageTimeTrigger?id='.$_GET['id'].'"',"class"=>"btn btn-default");

                               
                                array_push($condition,$box1);
                                include_admin_template_params("notification","box",$condition);
                               
           
                            ?>

						</div>
					</div>
      <section class="panel">
					<header class="panel-heading">
					<div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<h3><strong> <?php echo $ui_string['timeTrigger']; ?></strong> </h3>
								
						
						</div>
          
						
					</div>
					</header>
        <div class="panel-body">
							<div class="table-responsive">
                            <?php 
                           
                            $column_head=array($ui_string['triggerId'],$ui_string['cronId'],$ui_string['triggerFilePath'],$ui_string['action']);  
                            $show_fields=array('triggerId','cronId','fileName','action'); 
                            $All_data=array("head"=>$column_head);
                            $table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                       
                            get_ajax_datatable($table_data,$show_fields,admin_ui_url()."notification/ajax/timeTrigger_datatable_ajax.php?id=".$_GET['id']); 
                          
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
  <div class="modal-body">
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
