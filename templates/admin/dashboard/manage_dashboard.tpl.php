<div id="main">
<script>
function checkalldata(){}
</script>
			<div id="content">
				<div class="row">
                
                <div class="button_holder">
						<div class="popover-area-hover align-lg-right">
<a onclick="$('#dashboard_popup').modal();">
<div class="display_block">
		<div class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
			<span>Create New Dashboard</span>
		</div>
</div>
</a>

						</div>
					</div>
               
                <section class="panel top-gap">
					<header class="panel-heading">
					<div class="row">
					
					<div class="col-md-4 margn_tp_7">
						
								<h3><strong></strong> Dashboard</h3>
								
						
						</div>
            <?php if(check_user_permission("resources","users","all")==1){?>
						<div class="col-md-8">
				 
                       
						</div>

            <?php } ?>
						
					</div>
					</header>
					
						<!-- <div class="panel-body panel_bg_d"> -->
                       
             <!-- <div class="table-responsive">
                            
                         <div class="table-responsive"> -->
                            
                  <!--           <div id="data_table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"></div><div class="row"><div class="col-sm-12"><table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover dataTable no-footer" id="data_table_1" role="grid" aria-describedby="data_table_1_info" style="width: 1475px;">
				<thead>
                                
					<tr role="row"><th class="sorting" tabindex="0" aria-controls="data_table_1" rowspan="1" colspan="1" style="width: 93px;" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="data_table_1" rowspan="1" colspan="1" style="width: 181px;" aria-label="Email: activate to sort column ascending">Owner</th><th class="sorting" tabindex="0" aria-controls="data_table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Profile: activate to sort column ascending">Shared With</th><th class="sorting" tabindex="0" aria-controls="data_table_1" rowspan="1" colspan="1" style="width: 80px;" aria-label="Area: activate to sort column ascending">Created On</th><th class="sorting" tabindex="0" aria-controls="data_table_1" rowspan="1" colspan="1" style="width: 125px;" aria-label="Manager: activate to sort column ascending">Type</th></tr>
				</thead>
				        <tbody align="center">
										
                        
   <tr role="row" class="odd"><td>Abhishek</td><td>abhi@gmail.com</td><td>abc</td><td>xyz</td><td>123</td></tr>
     <tr role="row" class="odd"><td>Abhishek</td><td>abhi@gmail.com</td><td>abc</td><td>xyz</td><td>123</td></tr>   <tr role="row" class="odd"><td>Abhishek</td><td>abhi@gmail.com</td><td>abc</td><td>xyz</td><td>123</td></tr>   <tr role="row" class="odd"><td>Abhishek</td><td>abhi@gmail.com</td><td>abc</td><td>xyz</td><td>123</td></tr>   <tr role="row" class="odd"><td>Abhishek</td><td>abhi@gmail.com</td><td>abc</td><td>xyz</td><td>123</td></tr></tbody>
</table>
              </div>   
              </div>
						</div> -->

             <div class="panel-body panel_bg_d">
                       
             <div class="table-responsive">
                            
              <?php 
                $column_head=array('Name','Owner','Created On','Type');
                $show_fields=array('dash_name','','creation_date',''); 

                $All_data=array("head"=>$column_head);
                $table_data=array("table_id"=>"dashboard","table_data"=>$All_data);

                get_ajax_datatable($table_data,$show_fields,admin_ui_url()."dashboard/ajax/dash_datatable_ajax.php");                           
              ?>    
              </div>
                        </div>

					</section>
                  <div>
  
        		    </div>
                    <div id="dashboard_popup" class="modal fade container" style="width: 800px;" >
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<?php echo $ui_string['category'];?>
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
                         
							<form class="form-horizontal labelcustomize" data-collabel="4" data-label="color" id="addCategory">
                     <div class="form-group ">
	<label class="control-label remove_bg col-md-4"><span class="color">Name<font color="red">*</font></span></label>
	<div class="col-md-4">
		<input type="text" id="categoryname" name="categoryname" data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid category name" data-error-show-in="ecategoryname" data-error-setting="2" data-error-text="Please enter category name" class="form-control required_field addCategory updateCategory" value="" placeholder="">
	    <span id="ecategoryname" class="error"></span>
    </div>
</div>  

<!-- ////////////////////   USER_ID    /////////////////////// -->
<div class="form-group ">
  <label class="control-label remove_bg col-md-4"><span class="color">User Id<font color="red">*</font></span></label>
  <div class="col-md-4">
    <input type="text" id="user_id" name="user_id" data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid User Id" data-error-show-in="euser_id" data-error-setting="2" data-error-text="Please enter User Id" class="form-control required_field addCategory updateCategory" value="" placeholder="">
      <span id="euser_id" class="error"></span>
    </div>
</div> 
<div class="form-group ">
  <label class="control-label remove_bg col-md-4"><span class="color">Description<font color="red">*</font></span></label>
  <div class="col-md-4">
    <textarea rows="4" cols="50" id="categorydescription" name="categorydescription" data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid description" data-error-show-in="ecategorydescription" data-error-setting="2" data-error-text="Please enter description" class="form-control required_field addCategory updateCategory" value="" placeholder=""></textarea>
      <span id="ecategorydescription" class="error"></span>
    </div>
</div> 
                    <div class="form-group">
                      <label class="control-label no_padding remove_bg col-md-4"><span class="color">Sequence Number<font color="red"></font></span></label>
                      <div class="col-md-4">
                        <select id="seq_no" class="form-control seq_no_b" name="seq_no">
                            <option value="0">Select Sequence No.</option>
                                                                
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                
                        </select> 
                      </div>
                    </div>
                   
                            	   
              </form>
			  <div class="col-md-12 chart-margin">
        <div class="col-md-2"></div>
        <div class="col-md-8">
			  <h5>Choose dashboard layout</h5>
			  <br>
			  
			  <div class="row">
			  <div class="col-md-4 border-chart-div">
			 
			  <div class="col-md-12  border-chart"></div>
			    			  </div>
			   <div class="col-md-4 border-chart-div">
			 
			  <div class="col-md-12  border-chart1"></div>
			    			  </div>
				<div class="col-md-4 border-chart-div">
			 
			  <div class="col-md-12  border-chart2"></div>
			    			  </div>
			  
			  <!-- <div class="col-md-4 border-chart-div">
			 
			  <div class="col-md-12  border-chart3"></div>
			    			  </div> -->
			   <!-- <div class="col-md-4 border-chart-div">
			 
			  <div class="col-md-12  border-chart4"></div>
			    		git_operation.tpl	  </div> -->
							   
			  
			  </div>
			  
			  </div>
			  
			  </div>
			  <?php $redirectURL = $site_url.'manage_dashboard'; ?>
			  
			  <div><button type="button" class="btn btn-theme-inverse" id="create_dash" onclick="create_dashboard();"> submit </button>
</div>                                    
			  
							<div class="clr"></div>
							
                           
						</div>
						<!-- //modal-body-->
					</div>
                    
				</div>
				<!-- //content > row-->
			</div>
			<!-- //content-->
		</div>
		<!-- //main-->

<!-- <div id="add_category" class="modal fade" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
              <h4 class="modal-title"><span id="cathead"></span></h4>
            </div> -->
            <!-- //modal-header-->
           <!--  <div class="modal-body ">
              <form class="form-horizontal" data-collabel="4" data-label="color" id="addCategory">
              
                    <div class="form-group">
                      <label class="control-label no_padding remove_bg"><?php echo $ui_string['select_category'];?><font color="red">*</font></label>
                      <div>
                        <select id="pcategory" class="form-control pcategory_b" name="pcategory">
                            <option value="0"><?php echo $ui_string['parent_category'];?></option>
                             <?php show_category_accordians($dat,'-',0,1,'');?>
                        </select> 
                      </div>
                    </div>
                   	<input type="hidden" name="cat_add" value="cat_add"/>
                   	<input type="hidden" name="cat_id" id="cat_id" value="0"/>
                     
                    	<input type="hidden" name="category_code" value="profile"/>
                    <?php  echo get_data_field('text',$ui_string['name'],'categoryname','categoryname','required_field addCategory updateCategory','data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid category name" data-error-show-in="ecategoryname" data-error-setting="2" data-error-text="Please enter category name"','','',''); ?>
                   <?php  echo get_data_field('text',$ui_string['code'],'category_code','category_code','required_field addCategory updateCategory','data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid category code" data-error-show-in="ecategory_code" data-error-setting="2" data-error-text="Please enter category code"','','','','profile'); ?>
        	   	<button type="button" class="btn btn-inverse btn_width right bottom-gap"  data-dismiss="modal">
        		<i class="glyphicon glyphicon-remove-circle"></i> <?php echo $ui_string['close'];?></button>
        		<span id="groupbut"></span>
              </form>
            </div> -->
            <!-- //modal-body-->  
   <!--  </div> -->
      <!--  <div id="basic_search" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="del1"><i class="fa fa-times"></i></button>
            <h3><i class="glyphicon glyphicon-search"></i> <?php echo $ui_string['search'];?></h3>
        </div>
        <div class="modal-body text_alignment">
                <span class="searcherrorcat" style="color: red;" class="error"></span>
                       <form id="catsearchform"> 
                        <table>
                        <?php
                            show_accordian($dat,'',0,1,'user_category',$category_data,$user_id);
                        ?>
                        </table>       
            <div class="clr"></div>
          <button type="button" data-dismiss="modal" class="btn btn-inverse top-gap bottom-gap right left-gap">
            <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
            <button onclick="get_category_user()" type="button" class="btn btn-theme-inverse top-gap bottom-gap right" >
            <i class="glyphicon glyphicon-search"></i> Search</button>    
           </form> 
        </div>
      </div> -->
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
= 
	</div>