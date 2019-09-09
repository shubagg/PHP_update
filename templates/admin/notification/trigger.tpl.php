    	<?php
         get_admin_header_menu($language); ?>   	

		<div id="main">
        
			<div id="content">
			<div class="row">
      <section class="panel">
				 <header class="panel-heading">
                        <h3><strong><?php if(isset($_GET['id']) && $_GET['id']!=""){echo $ui_string['edit'];}else{echo $ui_string['add'];}?>  <?php echo $ui_string['trigger'];?></strong> </h3>
                    </header>
        <div class="panel-body">
						<form name="frm" id="frm">
						<?php $csrf = new CSRF_Protect(); $csrf->echoInputField();?>	
							<div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $id;?>" id="id" /> 
									<div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label class="control-label" ><?php echo $ui_string['sel_mod'];?><font color='red'>*</font></label>

											<select  class="form-control" name="mid"<?php if(isset($_GET['id']) && $_GET['id']!=""){echo "readonly";}?> id="module" onchange="get_submodule_triger(this.value)">
												<option value=""> <?php echo $ui_string['sel_mod'];?>  </option>

                                                		<?php 
    															$get_module_list=get_module_submodule(array());
							                                    $jsondata=$get_module_list['data'];
							                                    for($i=0;$i<sizeof($jsondata);$i++)
							                                    {
						                                ?>
						                                        	<option value="<?php echo $jsondata[$i]['id']; ?>" <?php if(isset($get_trigger['data'][0]['mid']) && $get_trigger['data'][0]['mid']==$jsondata[$i]['id']){echo "selected";}?>  ><?php echo $jsondata[$i]['moduleName'];?></option>
						                                <?php
						                
						                                    	}
						                                ?>
									         </select>
                  <span id="valid_module_id" class="error"></span> </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label class="control-label"><?php echo $ui_string['sub_mo'];?><font color='red'>*</font></label>

							<select  class="form-control" name="smid" id="submoduletri" <?php if(isset($_GET['id']) && $_GET['id']!=""){echo "readonly";}?> onchange="get_events_triger(this.value)">
                                <option value=""> <?php echo $ui_string['sel_sub_mod'];?> </option>
                               
                            </select> 
                  <span id="valid_submoduletri" class="error"></span> </div>
											</div>
									</div>
							
							
								
						<div class="form-group">
							<div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label class="control-label"><?php echo $ui_string['sel_eve'];?><font color='red'>*</font></label>

												<select  class=" form-control" name="eid"<?php if(isset($_GET['id']) && $_GET['id']!=""){echo "readonly";}?> id="event" onchange="checktype();" >

											

													<option value=""> <?php echo $ui_string['sel_eve'];?>  </option>
    													

                                                    
										         </select>
                  <span id="valid_event_id" class="error"></span> </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label class="control-label"><?php echo $ui_string['action'];?><font color='red'>*</font> </label>
                                            <?php //$arr = explode(",", $trig_data[0]['types']); ?>
                                            
                                            <select class="form-control" name="type" id="types"<?php if(isset($_GET['id']) && $_GET['id']!=""){echo "readonly";}?> onchange="hideRestDiv();">
                                           
                                                    <option value="email" <?php if(isset($get_trigger['data'][0]['type']) && $get_trigger['data'][0]['type']=='email'){echo "selected";}?> ><?php echo $ui_string['email'];?></option>
                                                    <option value="sms" <?php if(isset($get_trigger['data'][0]['type']) && $get_trigger['data'][0]['type']=='sms'){echo "selected";}?>><?php echo $ui_string['sms'];?></option>
                                                    <option value="push" <?php if(isset($get_trigger['data'][0]['type']) && $get_trigger['data'][0]['type']=='push'){echo "selected";}?>><?php echo $ui_string['push'];?></option>
                                            </select>
												
									
                                        <span id="valid_types" class="error"></span>
                                        </div>
								
							</div>
									
							</div>
                                <div class="form-group" id="mailtype" style="display:none">
									<div>
										<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label"><?php echo $ui_string['mail_type'];?><font color='red'>*</font></label>
												<select  class=" form-control" id="mailtypechoose" name="mailtypechoose" onchange="show_mail_type(this.value)">
												<option value="">Select Mail type</option>
												<option value="day" <?php if($get_trigger['data'][0]['mailType']=="day") { echo "selected"; } ?>><?php echo $ui_string['day'];?></option>
												<option value="weekly" <?php if($get_trigger['data'][0]['mailType']=="weekly") { echo "selected"; } ?>> <?php echo $ui_string['weekly'];?></option>
												<option value="month" <?php if($get_trigger['data'][0]['mailType']=="month") { echo "selected"; } ?> > <?php echo $ui_string['month'];?></option>
												
							         </select>
                    <span id="valid_mailtype_id" class="error"> </span> </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="timeinterval" style="display:none">
                    <label class="control-label" >
                    <div id="time_name"></div>
                    </label>
											<div id="add_time_interval">
												<div id="show_time" >
													<?php if($get_trigger['data'][0]['mailType']=="day")
															{
																	$res=explode(":",$get_trigger['data'][0]['mailInterval']);
																	$resulthour=$res[0];
																	$resultmin=$res[1];

															}

													 ?>
													 <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													 <input type="number" class="form-control" value="<?php if($resulthour!=""){ echo $resulthour; } ?>" placeholder="HH" id="to_hour" name="to_hour" min="01" max="24">
													 </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													  <input type="number" class="form-control" value="<?php if($resultmin!=""){ echo $resultmin; } ?>" placeholder="MM" id="to_min" name="to_min"  min="00" max="60">
													 </div>
													 </div>
													
													
													
													
												</div>

                                        		
                                      	
                                      			<div class="input-group date  form_datetime" id="show_calendar" data-picker-position="bottom-left" data-date-format="dd MM yyyy - HH:ii p">
													<?php if($get_trigger['data'][0]['mailType']=="month")
															{
															    $get_date_notif=$get_trigger['data'][0]['mailInterval'];
															}
															?>
															
													<input type="text" class="form-control" value="<?php if($get_date_notif!="") { echo $get_date_notif; }?>" id="notifromdate" name="fromdate">

													<span class="input-group-btn">
													<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
													<button class="btn btn-default cust_btn" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>

												<div id="show_week">
												<?php if($get_trigger['data'][0]['mailType']=="weekly")
															{
															    $get_week_notif=$get_trigger['data'][0]['mailInterval'];
															}
															?>
												<select class="form-control" id="addweek">
													<option value=""> <?php echo $ui_string['choose']." ".$ui_string['day'] ?></option>
													<option value="1" <?php if($get_week_notif=="1") { echo "selected"; } ?>> <?php echo $ui_string['monday']; ?></option>
													<option value="2" <?php if($get_week_notif=="2") { echo "selected"; } ?>> <?php echo $ui_string['tuesday']; ?></option>
													<option value="3" <?php if($get_week_notif=="3") { echo "selected"; } ?>> <?php echo $ui_string['wednesday']; ?></option>
													<option value="4" <?php if($get_week_notif=="4") { echo "selected"; } ?>> <?php echo $ui_string['thursday']; ?></option>
													<option value="5" <?php if($get_week_notif=="5") { echo "selected"; } ?>> <?php echo $ui_string['friday']; ?></option>
													<option value="6" <?php if($get_week_notif=="6") { echo "selected"; } ?>> <?php echo $ui_string['saturday']; ?></option>
													<option value="7" <?php if($get_week_notif=="7") { echo "selected"; } ?>> <?php echo $ui_string['sunday']; ?></option>
												</select>
											</div>
                                      <span id="valid_choose_id" class="error">
                                      </span>
											</div>
											
											</div>
										</div>
									</div>
								</div>
								<div class="form-group" id="tempDiv">
              <label class="control-label"><?php echo $ui_string['sel_temp'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<select  class=" form-control" id="temp_id" name="tempId">
											<option value=""> <?php echo $ui_string['sel_temp'];?> </option>

                                                    
							         </select>
                                      <span id="valid_temp_id" class="error">
                                      
                                      
                                      </span>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group" id="smsDiv" style="display:none">
									<label class="control-label remove_bg"><?php echo $ui_string['sel_sms'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="exTab2">
												<ul  class="nav nav-pills">
					                                <?php if(!empty($languages)){ foreach ($languages as $lang) {?>
					                                <li <?php if($_SESSION['user']['lang']==$lang['code']){ echo 'class="active"';} else { echo 'class=""';} ?>>
					                                <a  href="#msg<?php echo $lang['code'];?>" data-toggle="tab"><?php echo $lang['title'];?></a>
					                                </li>
					                                 <?php } }?> 
				                            	</ul>
				                            	<div class="tab-content ">
			                                        <?php $i=1;if(!empty($languages)){ foreach ($languages as $lang) {?>
			                                        <div <?php if($_SESSION['user']['lang']==$lang['code']){ echo 'class="tab-pane active"';} else { echo 'class="tab-pane"';} ?> id="msg<?php echo $lang['code'];?>">
			                                      
			                                           <textarea name="msg_<?php echo $lang['code'];?>" class="form-control" rows="7" cols="78"><?php echo $get_trigger['data'][0]['msg_'.$lang['code']];?></textarea>
			                                          
			                                        </div>
			                                         <?php $i++;} }?> 
                                     			</div>
												
                                      
											</div>
											<textarea name="msg" id="smstxt" class="form-control" style="display:none;" rows="7" cols="78"><?php echo $get_trigger['data'][0]['msg'];?></textarea>
                                      			<span id="valid_sms_name" class="error"> </span>
										</div>
									</div>
								</div>
                                
                                
                                <div class="form-group" id="accDiv">
									<label class="control-label remove_bg"><?php echo $ui_string['sel_acc'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<select  class=" form-control" id="acc_id" name="accId">
											     <option value=""> <?php echo $ui_string['sel_acc'];?> </option>

                                                    <?php 
                                                        $jsondata=$get_accounts['data'];
                                                        for($i=0;$i<sizeof($jsondata);$i++)
                                                        {	
                                                    ?>		
                                                            <option value="<?php echo $jsondata[$i]['id']; ?>" <?php if(isset($get_trigger['data'][0]['accId']) && $get_trigger['data'][0]['accId']==$jsondata[$i]['id']){echo "selected";}?>  ><?php echo $jsondata[$i]['accName'];?></option>
                                                    <?php
                                    
                                                        }
                                                    ?>
							         </select>
                                      <span id="valid_acc_id" class="error">
                                  
                                      
                                      </span>
											</div>
										</div>
									</div>
								</div>
                                
                                
                                
                                
								
								<div class="form-group" id="subjDiv">
              <label class="control-label"><?php echo $ui_string['subject'];?><font color='red'>*</font> </label>
              <div id="exTab1">
										<ul  class="nav nav-pills btn-color">
		                                <?php if(!empty($languages)){ foreach ($languages as $lang) {?>
		                                <li <?php if($_SESSION['user']['lang']==$lang['code']){ echo 'class="active"';} else { echo 'class=""';} ?>>
		                                	<a  href="#<?php echo $lang['code'];?>" data-toggle="tab"><?php echo $lang['title'];?></a>
		                                </li>
		                                 <?php } }?> 
		                            </ul>
		                            <div class="tab-content ">
                                        <?php $i=1;if(!empty($languages)){ foreach ($languages as $lang) {?>
                                        <div <?php if($_SESSION['user']['lang']==$lang['code']){ echo 'class="tab-pane active"';} else { echo 'class="tab-pane"';} ?> id="<?php echo $lang['code'];?>">
                                    
                                            <input type="text" name="subject_<?php echo $lang['code'];?>" id="subject_<?php echo $lang['code'];?>" value="<?php if (isset($get_trigger['data'][0]['subject_'.$lang['code']])) { echo $get_trigger['data'][0]['subject_'.$lang['code']]; }?>" class="form-control">
                                          
                                        </div>
                                         <?php $i++;} }?> 

                                     </div>
									
									</div>
									<input type="hidden" name="subject" id="subj" value="<?php echo $get_trigger['data'][0]['subject']; ?>" class="form-control" id="inputTwo">
                                     <span id="valid_cnt_name" class="error"></span>
								</div>
								

								<header class="panel-heading bottom-gap" id="toDiv" style="display:none">
							         <label><?php echo $ui_string['to'];?> <font color='red'>*</font></label>
						        </header>
						        <!--
								<div id="togrp">
								<div class="form-group" id="ctggrp">
									<label class="control-label remove_bg"><?php echo $ui_string['select'];?></label>
									<div>
										<div class="row">
											<div class="col-sm-6">
                                            <?php $ctgs=explode(",",$get_trigger['data']['trigger_data'][0]['ctg_id']); ?>
												<select  class="form-control" multiple="multiple" name="ctg_id[]" id="ctg_id" onchange="showtempdiv();" >
													<option value="" >Category </option>
												    <option value="1" <?php if(in_array("1",$ctgs)){echo "selected";} ?>>Category1 </option>
													<option value="2" <?php if(in_array("2",$ctgs)){echo "selected";} ?>>Category2 </option>
										         </select>
                                                  <span id="valid_ctg_id" class="error"></span>
											</div>
											
											
										</div>
									</div>
								</div>
								
								
								</div>
					           <?php
                               
                               ?>
                               <div id="tempdiv" class="form-group" <?php if($trig_data[0]['ctg_id']!="" && isset($_GET['id'])){}else{echo "style='display: none'";}?>>
									<label class="control-label remove_bg"><?php echo $ui_string['sel_temp'];?><font color='red'>*</font></label>
									<div>
										<div class="row">
											<div class="col-sm-12">
												<select  class=" form-control" name="mtemp" id="mtemp">
													<option value=""> Select Template  </option>
    
                                                    
										         </select>
                                                 <span id="valid_mtemp_id" class="error"></span> 
											</div>
										</div>
									</div>
								</div>	-->
            <div class="pull-right">
								<button type="button" class="btn btn-theme-inverse" data-toggle="modal" data-target="" onclick="on_submit()">
                                
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

                              
          			</div>
                               
							</form>
					</div>
					</section>
					</div>
			</div>
		</div>
		<?php get_admin_left_sidebar($language); ?>   
        
                <div id="confirm-click-1" class="modal fade" data-backdrop="static" data-keyboard="false" data-header-color="#736086" >
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="glyphicon glyphicon-ok-circle "></i> <?php echo $ui_string['confirmation'];?></h4>
                    </div>
  <div class="modal-body" >
    <div class="confirmation_successful"> <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
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
								<i class="glyphicon glyphicon-ok-circle"></i> <?php echo $ui_string['confirmation'];?>
							</h4>
						</div>
						<!-- //modal-header-->
  <div class="modal-body">
    <div class="confirmation_successful"> <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
      <span id="model_des"><?php echo $ui_string['con_suc'];?></span> </div>
						</div>
						<!-- //modal-body-->
					</div> 

					 <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
        				<div class="modal-header">
        						<button  type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        						
              
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
