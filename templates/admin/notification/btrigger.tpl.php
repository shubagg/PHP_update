		<div id="main">
        
			<div id="content">
			<div class="row">
				<section class="panel top-gap">
				<header class="panel-heading">
				 <h3><strong><?php echo $ui_string['broadcast'];?></strong> </h3>
                    </header>
					<div class="panel-body panel_bg_d">
						<form name="frm" class="form-horizontal" data-collabel="3" data-label="color" parsley-validate>	
								<div class="form-group">
									<label class="control-label remove_bg"><?php echo $ui_string['action'];?><font color='red'>*</font> </label>
									<div>
                                    <div class="row">
											<div class="col-sm-12">
                                            <select class="form-control" id="type" onchange="hideRestBDiv(this.value);">
                                             <option value="">--<?php echo $ui_string['selectaction'];?>--</option>
                                                    <option value="email"><?php echo $ui_string['email'];?></option>
                                                    <option value="sms"><?php echo $ui_string['sms'];?></option>
                                                    <option value="push"><?php echo $ui_string['push'];?></option>
                                            </select>
												
									
                                        <span id="valid_types" class="error"></span>
                                        </div>
                                      </div>
									</div>
								</div>
                                
								
								<div class="form-group" id="ckeditor" style="display:none">
									<label class="control-label remove_bg"><?php echo $ui_string['message'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
											<div class="col-sm-12">

                                      
                                      <textarea class="form-control ckeditor" id="pg_content" name="msg" rows="5" ></textarea>
                                      <span id="valid_msg" class="error">
                                      </span>
											</div>
										</div>
									</div>
								</div>
                                
                                <div class="form-group" id="textboxeditor">
									<label class="control-label remove_bg"><?php echo $ui_string['message'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
											<div class="col-sm-12">

                                      
                                      <textarea class="form-control" id="pg_content1" name="msg1" rows="5" ></textarea>
                                      <span id="valid_msg1" class="error">
                                      </span>
											</div>
										</div>
									</div>
								</div>
                                
                                <div class="form-group" id="accDiv">
									<label class="control-label remove_bg"><?php echo $ui_string['sel_acc'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
											<div class="col-sm-12">
												<select  class=" form-control" id="acc_id" name="acc">
											     <option value=""> <?php echo $ui_string['selectaccount'];?> </option>

                                                    <?php 
                                                        $jsondata=$get_accounts['data'];
                                                        
                                                        for($i=0;$i<sizeof($jsondata);$i++)
                                                        {
                                                    ?>
                                                            <option value="<?php echo $jsondata[$i]['id']; ?>" ><?php echo $jsondata[$i]['accName'];?></option>
                                                    <?php
                                    
                                                        }
                                                    ?>
							         </select>
                                      <span id="valid_acc_id" class="error">
                                      <?php 
                                      //if(sizeof($all_accounts)==0)
                                      //{
                                        //$a=1;
                                        //echo "<font color='red'><?php echo $ui_string['cre_acc'];?> <a href='http://$_SERVER[HTTP_HOST]/create_acc.php'><?php echo $ui_string['cl_here'];?></a></font>";                                      }
                                      ?>
                                      
                                      </span>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group" id="subjDiv">
									<label class="control-label remove_bg"><?php echo $ui_string['subject'];?><font color='red'>*</font> </label>
									<div>
									<input type="text" name="subj" id="subj" value="" class="form-control ">
                                     <span id="valid_cnt_name" class="error"></span>
									</div>
								</div>
								
		
								<header class="panel-heading bottom-gap" id="toDiv">
									<div class="row">
									<div class="control-label remove_bg col-md-3">
							      <label>  <span class="color"><?php echo $ui_string['to'];?> <font color='red'>*</font></span></label>
									 </div>
									 <div class="col-md-4">
							
								<div class="bootstrap-tagsinput" id="usertaginput">
				<!--				<span class="tag label label-default">5216</span> 
								<span class="tag label label-default">5216</span> -->
								</div>
								
								
							 </div>
									 <div class="col-md-2">
									 <div id="togrp">
								<div class="form-group" id="ctggrp">
								<button type="button" class="btn btn-theme-inverse col-md-12"  onclick="$('#enroll-user').modal();">
                                	 <?php echo $ui_string['select'];?>
                                 </button>
									<span id="valid_ctg_id" class="error"></span>
									
								</div>
								
								
								</div>
									 </div>
									 </div>
						        </header>
								
					          
                               <div class="col-md-12">
								<div class="text-right">
                                <button type="button" class="btn btn-theme-inverse" data-toggle="modal" data-target="" onclick="broadcast()">
                                	  <?php echo $ui_string['send'];?>
                                 </button>
                                 <button type="reset" class="btn btn-inverse" onClick="location.href='<?php echo get_url("manage_broadcast");?>'">
								 <?php echo $ui_string['cancel'];?>
							</button>
                                
								   
   
                                </div>
								</div>
							</form>
					</div>
					</section>
					</div>
			</div>
		</div>
		<?php 
			get_enroll_users_popup('',$all_cats,'enroll-user','2','',true);
		?>   
        
                <div id="confirm-click-1" class="modal fade" data-backdrop="static" data-keyboard="false" data-header-color="#736086" >
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="glyphicon glyphicon-ok-circle "></i><?php echo $ui_string['confirm'];?> </h4>
                    </div>
                
                    <div class="modal-body text_alignment" >
                
                        <div class="confirmation_successful">
                            <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
                               <?php echo $ui_string['notificationsuccess'];?> 
                        </div>
                    </div>
                
                </div>
        
	
    
    
