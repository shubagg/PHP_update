<div id="main">
<script>
function checkalldata(){}
</script>
			<div id="content">
				<div class="row">
<?php
// echo admin_ui_url()."resources/dashboardController.php";
// die;
	$dashboards=getUserDashboards(array('user_id' => '22'));
	$li_id=1;
?>
<div>
	<h3>Tabs</h3>
	     <div class="but_list">
	       <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			<?php foreach ($dashboards as $key) { 
				if ($li_id==1) {
				?>
				<li role="presentation" class="active"><a href="#abc_<?php echo $li_id; ?>" id=<?php echo $key['id']; ?> role="tab" data-toggle="tab" aria-controls="abc_<?php echo $li_id; ?>" aria-expanded="true">Home</a></li>
			  <?php
			}
			else {
				?>
			  <li role="presentation"><a href="#abc_<?php echo $li_id; ?>" id=<?php echo $key['id']; ?> role="tab" data-toggle="tab" aria-controls="abc_<?php echo $li_id; ?>" aria-expanded="true">Back</a></li>
			  
			  <?php } 
			  $li_id=$li_id+1;
			   } 
			   ?>
			</ul>
			<div id="myTabContent" class="tab-content">
			<?php
			$li_id=1;
			 foreach ($dashboards as $key) { 
				if ($li_id==1) {
				?>
		  <div role="tabpanel" class="tab-pane fade in active" id="abc_<?php echo $li_id; ?>" aria-labelledby="<?php echo $key['id']; ?>">
		       





		        <div class="button_holder">
						<div class="popover-area-hover align-lg-right">
<a onclick="$('#categories').modal();">
<div class="display_block">
		<div class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
			<span>Add Gadget</span>
		</div>
</div>
</a>

						</div>
					</div>
                
                <section class="panel top-gap">
					<header class="panel-heading">
					<div class="row">
					
					<div class="col-md-4 margn_tp_7">
						
								<h3><strong></strong> <?php echo $key['dash_name']; ?></h3>
								
						
						</div>
            <?php if(check_user_permission("resources","users","all")==1){?>
						<div class="col-md-8">
				 
                       
						</div>

            <?php } ?>
						
					</div>
					</header>
					
						<div class="panel-body panel_bg_d">
						
						
						<div class="col-md-12 col-sm-12  col-xs-12  ">
						<div class="row">
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						<div id="widget_div_1" class="col-md-6 col-sm-6 col-xs-12 drag-box">

						<h3> Drag your gadgets here or <a href="#">add a new gadget.</a></h3>
						<a onclick="$('#categories').modal();">
						<div class="display_block">
								<div id="" class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
									<span>Add Gadget</span>
								</div>
						</div>
						</a>
						<!-- <img  id="widget_div_1" width="100%" height="300" src=""> -->
						</div>
						<div id="widget_div_2" class="col-md-6 col-sm-6 col-xs-12 drag-box">
							<h3>Drag your gadgets here or <a href="#">add a new gadget.</a></h3>
							<a onclick="$('#categories').modal();">
						<div class="display_block">
								<div class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
									<span>Add Gadget</span>
								</div>
						</div>
						</a>

							<!-- <img  id="widget_div_2" width="100%" height="300" src=""> -->
						</div>
						
						
						</div>
						
						
						</div>
                       
        
                  <div>
  <!-- Nav tabs -->
					<div id="add" class="modal fade" data-width="300">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<i class="glyphicon glyphicon-plus-sign"></i> Add
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body center_button">
							<a href="student_info_form.html">
								<div class="popup_button_1">
									 Add Student
								</div>
							</a> <a href="#">
								<div class="popup_button_2">
								    Add Employee
								</div>
							</a>
						</div>
						<!-- //modal-body-->
					</div>

          <!-- Import    -->

          <div id="md-settings" class="modal fade md-slideUp" tabindex="-1" data-width="800">
          <div class="modal-header bd-theme-inverse-darken">
            <h4 class="modal-title" style="width:94%;float:left;">
              <i class="fa fa-inbox">
              </i> Import User
            </h4>
             <button type="button" class="btn btn-defaul" data-toggle="tooltip" data-dismiss="modal" data-placement="top" title="Close"><i class="fa fa-times"></i></button>
          </div>
          <div class="modal-body" id="upload_xls">
          </div>
          <div class="modal-footer">   
            <button type="submit" name="submit_file" class="btn btn-danger cust_btn "  onclick="return ValidateExtension()"> <?= $ui_string['h_save'] ?> 
            </button> 
            <button type="text" class="btn btn-default" data-dismiss="modal" aria-hidden="true"> <?= $ui_string['h_cancel'] ?>
            </button>
          </div>
        </div>



          <!-- End Import -->
					<div id="roles" class="modal fade container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								 <?php echo $ui_string['add_role'];?>
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
                        <?php if(check_user_permission("resources","users","role_all")==1){ ?>  
							<a onclick="open_add_role('add')" class="right tooltip-area">
								<button type="button" data-toggle="tooltip" data-placement="top" title="Add Role" class="btn btn-default bottom-gap" >
									<i class="glyphicon glyphicon-plus-sign"></i> <!--<?php echo $ui_string['add_role'];?>-->
								</button>
							</a>
                        <?php } ?>    
							<div class="clr"></div>
							  
							  <div class="">
                           
                            </div> 
						</div>
						<!-- //modal-body-->
					</div>
					<!-- //Role popup ends-->
<div id="add_roles" class="modal fade"
            data-header-color="#736086" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
            <button type="button" class="close" onClick="close_role_model();">
                <i class="fa fa-times"></i>
              </button>
              <h4 class="modal-title">
                 <span id="rolehead"></span>

                 <span data-color="red" class="checkbox">
                          <input type="checkbox" id="checkrole" class="new-check-box">
                          <a href="javascript:;"><strong><label style="font-size:14px; font-weight:bold;" for="checkrole"><?php echo $ui_string['select_all'];?></label></strong></a>
                </span>
              </h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
              <form class="form-horizontal" data-collabel="3" data-label="color" id="addRole">
                
                                
                               <input type="hidden" name="role_add" value="role_add"/>
                              <input type="hidden" name="role_id" id="role_id" value="0"/>
                               <?php  echo get_data_field('text',$ui_string['role'],'rolename','rolename','required_field addRole updateRole','data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid role" data-error-show-in="erolename" data-error-setting="2" data-error-text="Please enter role name"','','','',''); ?>  
                              <?php  //print_r($user_role);
                               if(!empty($user_role)){
                               foreach($user_role as $element)
                               {
                                    $module_id=$element['id'];
                               
                                    $moduleName=$element['moduleName'];     
                              ?>
                <div class="form-group role-data">
                  <label class="control-label remove_bg"><?php echo $element['moduleName'];?></label>
                   
                  
                        <div>
                          <ul class="" data-color="red">
                                              <?php 
                                              foreach($element['submodule'] as $r){ ?>
                                             <?php echo $r['name'];?>
                                               <?php foreach($r['permission'] as $v){
                                              ?>              
                            <li><input class="ads_Checkbox chk" type="checkbox" id="ich-<?php echo $element['moduleVal'].'-'.$r['smval'].'-'.$v['pid']; ?>" name="permission[]" value="<?php echo $element['moduleVal'].'-'.$r['smval'].'-'.$v['pid']; ?>" /><label for="ich-<?php echo $element['moduleVal'].'-'.$r['smval'].'-'.$v['pid']; ?>"><?php echo $v['name'];?></label>
                            </li>
                          <?php } ?>
                          <?php } ?>
                          </ul>
                        </div>
                </div>
                                <?php 
                                    } } 
                                ?>
                <button type="button" onClick="close_role_model();" class="btn btn-inverse btn_width right bottom-gap">
                  <i class="glyphicon glyphicon-remove-circle"></i><?php echo $ui_string['close'];?>
                </button>
                                <span id="grouprole"></span>
              </form>
            </div>
            <!-- //modal-body-->
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
                    <div id="categories" class="modal fade container" style="width: 800px;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								 Add Gadget
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body gadget-modal-body">
                         <div class="col-md-12 modal-scroll">
						 <div class="row">
						 <div class="col-md-3 gadget-border">
						 <div class=""><div class="modal-title"><strong>MODULES</strong></div>
                         
                         
                         <ul class="">
                         
                         <li class=" "><a href="#"  ><span class="aui-badge">7</span>All</a></li>
                         
                         <li class=" "><a href="#" onclick="show_basic_charts(22)" ><span class="aui-badge" >4</span>Course</a></li>
                         <li class=" "><a href="#" onclick="show_basic_charts(23)" ><span class="aui-badge">1</span>Job</a></li>
                         <li class=" "><a href="#" onclick="show_basic_charts(24)" ><span class="aui-badge">2</span>Attendance</a></li>
                         
                         
                         </ul></div>
						 
						 
						 </div>
						 <div id="basic_charts111" class=" col-md-9 gadget-border-1">
						 <div class="col-md-12 modal-message"><div   class="aui-message aui-message-info info"><p class="title"><strong>More gadgets available</strong></p><p>Additional gadgets have been found and can be loaded.</p><p><a href="#" data-purpose="load">Load all gadgets</a></p></div></div>
				<!-- 		 
						  <?php 
                //print_r($dashboard_data);
                foreach ($basic_chart_data as $key) {
                 // echo("_____Dash_name : ".."     ");
                
                ?> -->
						
						 <div id="basic_charts11" class="col-md-12  col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php echo assets_url(); ?>admin/img/chart/column.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4><?php echo $key['chart_name']; ?></h4><p><?php echo $key['chart_desc']; ?></p> </div>
						 
							<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
					<!-- 	 <?php

						}
						 ?>
						   -->
						 <!-- <div class="col-md-12  col-sm-12 col-xs-12  modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php// echo admin_assets_url(); ?>/img/chart/2.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Agile Days Remaining in Sprint Gadget</h4><p>Displays days remaining in a sprint (Wallboard capable)</p> </div>
						<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php //echo admin_assets_url(); ?>/img/chart/3.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Agile Sprint Burndown Gadget</h4><p>Sprint burndown chart to track remaining work (Wallboard capable).</p> </div>
						 
							<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						  <img width="120" height="60" src=" <?php //echo admin_assets_url(); ?>/img/chart/4.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Average Age Chart</h4><p>Displays the average number of days issues have been unresolved.</p> </div>
						 
							<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php// echo admin_assets_url(); ?>/img/chart/5.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Average Number of Times in Status</h4><p>Displays created issues vs resolved issues for a project or saved filter.</p> </div>
						 
						<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						 
						 
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php //echo admin_assets_url(); ?>/img/chart/6.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Activity Stream</h4><p>Lists recent activity in a single project, or in all projects.</p> </div>
						 
						<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php //echo admin_assets_url(); ?>/img/chart/7.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Activity Stream</h4><p>Lists recent activity in a single project, or in all projects.</p> </div>
						 
						 <div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
					
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div> -->
						 
						 
						 </div>
						 
						 </div>
						 
						 
						 </div>
						 
			 
			  
			  
			  
							<div class="clr"></div>
							
                           
						</div>
						<!-- //modal-body-->
					</div>
                    
				</div>
				<!-- //content > row-->
			</div>

		  </div>



			<?php
			}
			else {
				?>

		  <div role="tabpanel" class="tab-pane fade" id="abc_<?php echo $li_id; ?>" aria-labelledby="<?php echo $key['id']; ?>">





		     <div class="button_holder">
						<div class="popover-area-hover align-lg-right">
<a onclick="$('#categories').modal();">
<div class="display_block">
		<div class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
			<span>Add Gadget</span>
		</div>
</div>
</a>

						</div>
					</div>
                
                <section class="panel top-gap">
					<header class="panel-heading">
					<div class="row">
					
					<div class="col-md-4 margn_tp_7">
						
								<h3><strong></strong><?php echo $key['dash_name']; ?></h3>
								
						
						</div>
            <?php if(check_user_permission("resources","users","all")==1){?>
						<div class="col-md-8">
				 
                       
						</div>

            <?php } ?>
						
					</div>
					</header>
					
						<div class="panel-body panel_bg_d">
						
						
						<div class="col-md-12 col-sm-12  col-xs-12  ">
						<div class="row">
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						<div id="widget_div_1" class="col-md-6 col-sm-6 col-xs-12 drag-box">

						<h3> Drag your gadgets here or <a href="#">add a new gadget.</a></h3>
						<a onclick="$('#categories').modal();">
						<div class="display_block">
								<div id="" class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
									<span>Add Gadget</span>
								</div>
						</div>
						</a>
						<!-- <img  id="widget_div_1" width="100%" height="300" src=""> -->
						</div>
						<div id="widget_div_2" class="col-md-6 col-sm-6 col-xs-12 drag-box">
							<h3>Drag your gadgets here or <a href="#">add a new gadget.</a></h3>
							<a onclick="$('#categories').modal();">
						<div class="display_block">
								<div class="custom_button btn btn-default btn_cu " data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
									<span>Add Gadget</span>
								</div>
						</div>
						</a>

							<!-- <img  id="widget_div_2" width="100%" height="300" src=""> -->
						</div>
						
						
						</div>
						
						
						</div>
                       
        
                  <div>
  <!-- Nav tabs -->
					<div id="add" class="modal fade" data-width="300">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<i class="glyphicon glyphicon-plus-sign"></i> Add
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body center_button">
							<a href="student_info_form.html">
								<div class="popup_button_1">
									 Add Student
								</div>
							</a> <a href="#">
								<div class="popup_button_2">
								    Add Employee
								</div>
							</a>
						</div>
						<!-- //modal-body-->
					</div>

          <!-- Import    -->

          <div id="md-settings" class="modal fade md-slideUp" tabindex="-1" data-width="800">
          <div class="modal-header bd-theme-inverse-darken">
            <h4 class="modal-title" style="width:94%;float:left;">
              <i class="fa fa-inbox">
              </i> Import User
            </h4>
             <button type="button" class="btn btn-defaul" data-toggle="tooltip" data-dismiss="modal" data-placement="top" title="Close"><i class="fa fa-times"></i></button>
          </div>
          <div class="modal-body" id="upload_xls">
          </div>
          <div class="modal-footer">   
            <button type="submit" name="submit_file" class="btn btn-danger cust_btn "  onclick="return ValidateExtension()"> <?= $ui_string['h_save'] ?> 
            </button> 
            <button type="text" class="btn btn-default" data-dismiss="modal" aria-hidden="true"> <?= $ui_string['h_cancel'] ?>
            </button>
          </div>
        </div>



          <!-- End Import -->
					<div id="roles" class="modal fade container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								 <?php echo $ui_string['add_role'];?>
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
                        <?php if(check_user_permission("resources","users","role_all")==1){ ?>  
							<a onclick="open_add_role('add')" class="right tooltip-area">
								<button type="button" data-toggle="tooltip" data-placement="top" title="Add Role" class="btn btn-default bottom-gap" >
									<i class="glyphicon glyphicon-plus-sign"></i> <!--<?php echo $ui_string['add_role'];?>-->
								</button>
							</a>
                        <?php } ?>    
							<div class="clr"></div>
							  
							  <div class="">
                           
                            </div> 
						</div>
						<!-- //modal-body-->
					</div>
					<!-- //Role popup ends-->
<div id="add_roles" class="modal fade"
            data-header-color="#736086" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
            <button type="button" class="close" onClick="close_role_model();">
                <i class="fa fa-times"></i>
              </button>
              <h4 class="modal-title">
                 <span id="rolehead"></span>

                 <span data-color="red" class="checkbox">
                          <input type="checkbox" id="checkrole" class="new-check-box">
                          <a href="javascript:;"><strong><label style="font-size:14px; font-weight:bold;" for="checkrole"><?php echo $ui_string['select_all'];?></label></strong></a>
                </span>
              </h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
              <form class="form-horizontal" data-collabel="3" data-label="color" id="addRole">
                
                                
                               <input type="hidden" name="role_add" value="role_add"/>
                              <input type="hidden" name="role_id" id="role_id" value="0"/>
                               <?php  echo get_data_field('text',$ui_string['role'],'rolename','rolename','required_field addRole updateRole','data-check-valid="blank,nospecial" data-valid-nospecial-error="Please enter valid role" data-error-show-in="erolename" data-error-setting="2" data-error-text="Please enter role name"','','','',''); ?>  
                              <?php  //print_r($user_role);
                               if(!empty($user_role)){
                               foreach($user_role as $element)
                               {
                                    $module_id=$element['id'];
                               
                                    $moduleName=$element['moduleName'];     
                              ?>
                <div class="form-group role-data">
                  <label class="control-label remove_bg"><?php echo $element['moduleName'];?></label>
                   
                  
                        <div>
                          <ul class="" data-color="red">
                                              <?php 
                                              foreach($element['submodule'] as $r){ ?>
                                             <?php echo $r['name'];?>
                                               <?php foreach($r['permission'] as $v){
                                              ?>              
                            <li><input class="ads_Checkbox chk" type="checkbox" id="ich-<?php echo $element['moduleVal'].'-'.$r['smval'].'-'.$v['pid']; ?>" name="permission[]" value="<?php echo $element['moduleVal'].'-'.$r['smval'].'-'.$v['pid']; ?>" /><label for="ich-<?php echo $element['moduleVal'].'-'.$r['smval'].'-'.$v['pid']; ?>"><?php echo $v['name'];?></label>
                            </li>
                          <?php } ?>
                          <?php } ?>
                          </ul>
                        </div>
                </div>
                                <?php 
                                    } } 
                                ?>
                <button type="button" onClick="close_role_model();" class="btn btn-inverse btn_width right bottom-gap">
                  <i class="glyphicon glyphicon-remove-circle"></i><?php echo $ui_string['close'];?>
                </button>
                                <span id="grouprole"></span>
              </form>
            </div>
            <!-- //modal-body-->
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
                    <div id="categories" class="modal fade container" style="width: 800px;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								 Add Gadget
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body gadget-modal-body">
                         <div class="col-md-12 modal-scroll">
						 <div class="row">
						 <div class="col-md-3 gadget-border">
						 <div class=""><div class="modal-title"><strong>MODULES</strong></div>
                         
                         
                         <ul class="">
                         
                         <li class=" "><a href="#"  ><span class="aui-badge">7</span>All</a></li>
                         
                         <li class=" "><a href="#" onclick="show_basic_charts(22)" ><span class="aui-badge" >4</span>Course</a></li>
                         <li class=" "><a href="#" onclick="show_basic_charts(23)" ><span class="aui-badge">1</span>Job</a></li>
                         <li class=" "><a href="#" onclick="show_basic_charts(24)" ><span class="aui-badge">2</span>Attendance</a></li>
                         
                         
                         </ul></div>
						 
						 
						 </div>
						 <div id="basic_charts111" class=" col-md-9 gadget-border-1">
						 <div class="col-md-12 modal-message"><div   class="aui-message aui-message-info info"><p class="title"><strong>More gadgets available</strong></p><p>Additional gadgets have been found and can be loaded.</p><p><a href="#" data-purpose="load">Load all gadgets</a></p></div></div>
				<!-- 		 
						  <?php 
                //print_r($dashboard_data);
                foreach ($basic_chart_data as $key) {
                 // echo("_____Dash_name : ".."     ");
                
                ?> -->
						
						 <div id="basic_charts11" class="col-md-12  col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php echo assets_url(); ?>admin/img/chart/column.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4><?php echo $key['chart_name']; ?></h4><p><?php echo $key['chart_desc']; ?></p> </div>
						 
							<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
					<!-- 	 <?php

						}
						 ?>
						   -->
						 <!-- <div class="col-md-12  col-sm-12 col-xs-12  modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php echo admin_assets_url(); ?>/img/chart/2.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Agile Days Remaining in Sprint Gadget</h4><p>Displays days remaining in a sprint (Wallboard capable)</p> </div>
						<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php echo admin_assets_url(); ?>/img/chart/3.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Agile Sprint Burndown Gadget</h4><p>Sprint burndown chart to track remaining work (Wallboard capable).</p> </div>
						 
							<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						  <img width="120" height="60" src=" <?php echo admin_assets_url(); ?>/img/chart/4.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Average Age Chart</h4><p>Displays the average number of days issues have been unresolved.</p> </div>
						 
							<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php echo admin_assets_url(); ?>/img/chart/5.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Average Number of Times in Status</h4><p>Displays created issues vs resolved issues for a project or saved filter.</p> </div>
						 
						<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						 
						 
						 <div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php echo admin_assets_url(); ?>/img/chart/6.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Activity Stream</h4><p>Lists recent activity in a single project, or in all projects.</p> </div>
						 
						<div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
						 
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 modal-descrbe" style="display: block;">
						     <div class="line-bottom">
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 <img width="120" height="60" src=" <?php echo admin_assets_url(); ?>/img/chart/7.png">
						 </div>
						 <div class="col-md-6 col-sm-6 col-xs-12"><h4>Activity Stream</h4><p>Lists recent activity in a single project, or in all projects.</p> </div>
						 
						 <div class="col-md-3 col-sm-3 col-xs-12">	 <a onclick="open_add_category('add')" class="right tooltip-area">
								<button type="button" class="custom_button btn btn-default btn_cu pull-right ">Add gadget</button>
							</a></div>
					
						
						 </div>
						 
						 
						 
						  <div class="clr"></div>
						</div> -->
						 
						 
						 </div>
						 
						 </div>
						 
						 
						 </div>
						 
			 
			  
			  
			  
							<div class="clr"></div>
							
                           
						</div>
						<!-- //modal-body-->
					</div>
                    
				</div>
				<!-- //content > row-->
			</div>







		  </div>
		   <?php } 
			  $li_id=$li_id+1;
			   } 
			   ?>
		  </div>
		
   </div>
		</div>
</div>













            			<!-- //content-->
		</div>
		<!-- //main-->

<div id="add_category" class="modal fade  add-gadget-modal" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
           <h4 class="modal-title"><span>Add Gadget</span></h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body ">
              <form class="form-horizontal" data-collabel="4" data-label="color" id="addCategory">
              <div class="col-md-12  col-sm-12 col-xs-12 text-center gadget-imgfull">
<div class="col-md-12 col-sm-12 col-xs-12"><h4>Activity Stream</h4><p>Lists recent activity in a single project, or in all projects.</p> </div>
 <img   src=" <?php echo admin_assets_url(); ?>/img/chart/linechrt.png">

                   </div>
               
        		<!---<span id="groupbut"></span>-->
<div class="col-md-12 col-sm-12 col-xs-12 modal-iframe">
 
<form class="form-horizontal labelcustomize" data-collabel="4" data-label="color" id="addCategory">
              <div class="row">
<div class="col-md-6">
<div class="col-md-10">
<div class="form-group">
  <label for="sel1">.</label>
  <select class="form-control" id="sel1">
    <option>ddl</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
</div>
</div>
</div>

<div class="col-md-6">
   
<div class="col-md-10">    
  <div class="form-group">
  <label for="usr">.</label>
  <input type="text" class="form-control"   placeholder="input-box">
</div> 
 </div>
</div>

</div>

        <div class="row">
<div class="col-md-6">
<div class="col-md-10">
<div class="form-group">
 
  <textarea class="form-control" rows="5" id="comment" placeholder="textarea"></textarea>
</div>
</div>
</div>

<div class="col-md-6">
   
<div class="col-md-10">    
                    
                               
        		 <div class="checkbox">
  <label><input type="checkbox" value="">Checkbox</label>
</div>

<div class="radio">
  <label><input type="radio" name="optradio">Radio-button</label>
</div>
 </div>
</div>

</div>
              </form>
  
 

</div>

              </form>
            </div>
            <!-- //modal-body-->  
    </div>
       <div id="basic_search" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
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
      </div>
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
 
	</div>