<body class="leftMenu nav-collapse in">
	
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->

    	<?php
         get_admin_header_menu(); ?>   	

		<div id="main">
        
			<div id="content">
				<section class="panel">
                
                  <header class="panel-heading">
                        <h3><strong><?php if(isset($_GET['id']) && $_GET['id']!=""){echo $ui_string['edit'];}else{echo $ui_string['add'];}?>  <?php echo $ui_string['device']; ?></strong> </h3>
                    </header>
                
					<div class="panel-body panel_bg_d">
                  
						<form name="frm" class="form-horizontal" data-collabel="3" data-label="color" parsley-validate>	
						
                                <div class="form-group" style="display: none;">
								    <label class="control-label remove_bg"><?php echo $ui_string['sel_mod'];?><font color='red'>*</font></label>
									<div class="row">
										<div class="col-sm-12">
                                            
											<select  class=" form-control" name="amid" id="amid" >
												<option value=""> Select Module  </option>
												<option value="10" selected="selected">10</option>

                                                
									         </select>
                                             <span id="err_module" class="error"></span> 
										</div>
									</div>
							
						     	</div>
								
                                <div class="form-group" style="display: none;">
									<label class="control-label remove_bg"><?php echo $ui_string['sel_smod'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
											<div class="col-sm-12">
												<select  class=" form-control" name="asmid" id="asmid" onChange="checktype();" >
													<option value=""> Select Sub Module  </option>
													<option value="10" selected="selected">10</option>
    
                                                    
										         </select>
                                                 <span id="err_smodule" class="error"></span> 
											</div>
										</div>
									</div>
								</div>
                                
                                
								
								
					          <div class="form-group">
									<label class="control-label remove_bg"><?php echo $ui_string['title'];?><font color='red'>*</font> </label>
									<div>
                                    <div class="">
										<input type="text" name="title" id="title" value="<?php echo $get_device['data'][0]['title'];?>" class="form-control">		
									
                                        <span id="err_title" class="error"></span>
                                        </div>
                                      </div>
									</div>
                                    
                                <div class="form-group">
									<label class="control-label remove_bg"><?php echo $ui_string['devicenam']; ?><font color='red'>*</font> </label>
									<div>
                                    <div class="">
										<input type="text" name="devicename" id="devicename" value="<?php echo $get_device['data'][0]['deviceName'];?>" class="form-control">		
									
                                        <span id="err_devicename" class="error"></span>
                                        </div>
                                      </div>
									</div>
                                
                                <div class="form-group"  style="display: block;">
                                
									<label class="control-label remove_bg"><?php echo $ui_string['desc'];?><font color='red'>*</font> </label>
                                    
									<div>
                                    <div class="">
											
									<textarea name="desct" id="desct" class="form-control" rows="5" cols="5"> <?php echo $get_device['data'][0]['description'];?> </textarea>
                                    <input type="hidden" value="<?php echo $get_device['data'][0]['id'];?>" id="deviceid" name="deviceid">
                                        <span id="err_desc" class="error"></span>
                                        </div>
                                      </div>
								</div>
                                    
									<div class="form-group btn-grp text-right">
									<div class="col-md-6 pull-right">
                                    
                             
								<button type="button" class="btn btn-theme-inverse define_action" data-toggle="modal" data-target="" onClick="on_submit()">
                                
                                 <?php
                                    if(isset($_GET['id']) && $_GET['id']!="")
                                    {
                                        echo $ui_string['update'];
                                    }
                                    else
                                    {
                                        echo $ui_string['confirm'];
                                    }
                                ?></button>
								<button type="reset" class="btn btn-inverse" onClick="location.href='<?php echo $admin_ui_url;?>device/manage_device.php'">
								<?php echo $ui_string['cancel'];?>
							</button> 
                                
                                </div>
                            </div>
                                <div class="clearfix"></div>
                                
							</form>
					</div>
					<section>
			</div>
		</div>
		<?php get_admin_left_sidebar(); ?>   
        
                <div id="confirm-click-1" class="modal fade" data-backdrop="static" data-keyboard="false" data-header-color="#736086" >
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="glyphicon glyphicon-ok-circle "></i> <?php echo $ui_string['conf'];?></h4>
                    </div>
                
                    <div class="modal-body text_alignment" >
                
                        <div class="confirmation_successful">
                            <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
                                <?php
                                    if(isset($_GET['id']) && $_GET['id']!="")
                                    {
                                        echo "Successfully Updated";
                                    }
                                    else
                                    {
                                        echo "Successfully Created";
                                    }
                                ?>
                        </div>
                    </div>
                
                </div>
                
                <div id="success_modal" class="modal fade"
						data-header-color="#736086">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title" id="model_head">
								<i class="glyphicon glyphicon-ok-circle"></i> <?php echo $ui_string['conf'];?>
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body text_alignment">
							<div class="confirmation_successful">
								<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
								<span id="model_des"><?php echo $ui_string['con_suc'];?></span>
							</div>
						</div>
						<!-- //modal-body-->
					</div>
        

    
    
