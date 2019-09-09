<div id="main">
<script>
function checkalldata(){}
</script>
			<div id="content">
				<div class="row">
					
       
       			<section class="panel">
                
                <header class="panel-heading">
                        <h3><strong>
                        	<?php 
                        	if(isset($_GET['type']) && $_GET['type']!="")
                        	{
                        		if($_GET['type']=='1'){echo $ui_string['loginLogs'];}
                        		else if($_GET['type']=='2'){ echo $ui_string['departmentLogs'];}
                        		else if($_GET['type']=='3'){ echo $ui_string['roleLogs'];}
                        		else if($_GET['type']=='4'){ echo $ui_string['jobLogs'];}
                        		
                        	}
                        	?>
                        </strong> </h3>
                    </header>
                
						<div class="panel-body panel_bg_d">
							<div class="row">	
								<div class="col-md-4 margn-bottom-20">
									<input type="hidden" name="mid" id="mid" value="<?php echo isset($_GET['mid'])?$_GET['mid']:'';?>">
									<input type="hidden" name="smid" id="smid" value="<?php echo isset($_GET['smid'])?$_GET['smid']:'';?>">
									<input type="hidden" name="type" id="type" value="<?php echo isset($_GET['type'])?$_GET['type']:'';?>">
		                      		<input readonly="readonly" value="<?php echo date("m/d/Y",time());?>" type="text" name="starttime" id="starttime" data-check-valid="blank" data-error-show-in="eage" data-error-setting="2" data-error-text="<?php echo $ui_string['fromDate']; ?>" class="form-control  form_datetime9" />
		                      		<span id="estarttime"></span>
		                        </div>
		                        <div class="col-md-4 margn-bottom-20">
								
		                      		<input readonly="readonly" value="<?php echo date("m/d/Y",time());?>" type="text" name="endtime" id="endtime" data-check-valid="blank" data-error-show-in="eage" data-error-setting="2" data-error-text="<?php echo $ui_string['toDate']; ?>" class="form-control  form_datetime9" />
		                      		<span id="eendtime"></span>
		                        </div>
		                         <div class="col-md-1 margn-bottom-20">

		                         	<button id="showmapManlBtn" class="btn btn-default btn-block" style="font-size: 18px;" data-color="mint" data-size="s" onclick="getLogsData();"><span class="fui-location"></span><span id="manlShowMapLbl" class="regbtn"><i class="fa fa-search" aria-hidden="true"></i></span></button>
		                         </div>
		                    </div>
							<div class="table-responsive" id="logsDetails">
                           
                          <?php include('logsDetailsAjax.tpl.php'); ?>   
                                

                </div>	
						</div>
					</section>
                   
					

					
					
				
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<!-- //main-->
	</div>

		


    
	
