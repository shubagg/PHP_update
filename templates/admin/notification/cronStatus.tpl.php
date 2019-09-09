<div id="main" class="dashboard">
<script>
function checkalldata(){}
</script>
<style type="text/css">
#data_table_1_filter{display: none;}
</style>
			<div id="content">
				<div class="row">
					
					
						<div class="popover-area-hover align-lg-right">

							<?php 
                               
                                 $condition=array();
                                $box1=array('name'=>$ui_string['crons'],'icon'=>'glyphicon glyphicon-list-alt','attr'=>'href="cron" target="_blank"',"class"=>"btn btn-default ");
                               
                                array_push($condition,$box1);
                                include_admin_template_params("notification","box",$condition);
                               
           
                            ?>

						</div>
					
                <section class="panel">
					<header class="panel-heading">
					<div class="row">
					
						<div class="col-md-4">
						
								<h3><strong> <?php echo $ui_string['cronStatus']; ?></strong> </h3>
								
						
						</div>
          
						
					</div>
					</header>

						<div class="panel-body">
							<div class="row">	
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margn-bottom-20">
								
		                      		<input readonly value="<?php echo date("m/d/Y",time());?>" type="text" name="starttime" id="starttime" data-check-valid="blank" data-error-show-in="eage" data-error-setting="2" data-error-text="<?php echo $ui_string['fromDate']; ?>" class="form-control  form_datetime9" />
		                      		<span id="estarttime"></span>
		                        </div>
		                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margn-bottom-20">
								
		                      		<input readonly value="<?php echo date("m/d/Y",time());?>" type="text" name="endtime" id="endtime" data-check-valid="blank" data-error-show-in="eage" data-error-setting="2" data-error-text="<?php echo $ui_string['toDate']; ?>" class="form-control  form_datetime9" />
		                      		<span id="eendtime"></span>
		                        </div>
		                         <div class="col-lg-1 col-md-1 col-sm-4 col-xs-12 margn-bottom-20">

		                         	<button id="showmapManlBtn" class="btn btn-default btn-block" style="font-size: 18px;" data-color="mint" data-size="s" onclick="getCronStatusData();"><span class="fui-location"></span><span id="manlShowMapLbl" class="regbtn"><i class="fa fa-search" aria-hidden="true"></i></span></button>
		                         </div>
		                    </div>
							<div class="table-responsive" id="crondata">
                           
                            <?php  include('cronStatusByAjax.tpl.php'); ?>   
                           
                           
                          
                              
                  
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
