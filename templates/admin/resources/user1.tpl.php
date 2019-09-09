
<div id="main">
			<div id="content">
				<section class="panel">
					<div class="panel-body">
						<form id="addUser" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        
                        
                           
							<div class="form-group">
								<label class="control-label remove_bg"><?php echo $resourse['category'];?></label>
								<div>
                                <?php 
                                    $dat=get_category_tree($all_cats,0);?>
                                <table>
                                 	<?php
                                        show_accordian($dat,'',0,1,'category',$user['category'],$user_id);
                                    ?>
                                </table>    
								    <span id="ecats" class="error"></span>
                                </div>
							</div>
                            
                            
                            
                            <div class="form-group">
									<label class="control-label remove_bg"><?php echo $resourse['role'];?></label>
									<div>
										<ul class="" data-color="red">
                                        <?php  
                                        
                                       
                                         $user_role=explode("|",$user['role']);
                                         //print_r($user_role);
                                        if(!empty($get_roles)){foreach($get_roles as $roles) {

                                                if($roles['id']!='56713bac7c3d68a2293c986a'){
                                            ?>
											<li><input class="ads_Checkbox required_field addUser" data-error-setting='2' data-error-show-in="erole" data-error-text="Please select a role" type="checkbox" id="role-<?php echo $roles['id']; ?>" name="role[]" value="<?php echo $roles['id']; ?>" <?php if($user_id!=''){if(in_array($roles['id'],$user_role)){echo 'checked="checked"';} }?> /> <label><?php echo $roles['title'];?></label></li>
											
										<?php } } }?>
											
										</ul>
                                         <span id="erole" class="error"></span>
									</div>
                                    
							</div>
                            
                        
                            
                            
                           <?php if($user_id!=''){$read='readonly="readonly"';} else {$read="";}?> 
                           
                            <?php 
                           if(in_array('writter',$cat_name)){ $style='style="display: inherit;"';}
                           else{ $style='style="display: none;"';}
                           if(in_array('narrator',$cat_name)){ $style1='style="display: inherit;"';}
                           else{ $style1='style="display: none;"';}
                            ?>
                           
                            <?php echo get_data_field('text',$resourse['name'],'name','name','required_field addUser editUser','data-check-valid="blank,no_special" data-valid-nospecial-error="Please enter valid name" data-error-show-in="ename" data-error-setting="2" data-error-text="Please enter name"',$user['name'],'','',''); ?>
                            
                           
                            
                             <?php  echo get_data_field('text',$resourse['email'],'email','email','required_field addUser editUser','data-check-valid="blank,email" data-valid-email-error="Please enter valid email-id" data-error-show-in="eemail" data-error-setting="2" data-error-text="Please enter email-id" '.$read,$user['email'],'','',''); ?>
                             
                             
                            <?php if($user_id==''){?>
                             
                            <?php  echo get_data_field('password',$resourse['password'],'password','password','required_field addUser editUser','data-check-valid="blank,gt-5" data-valid-gt-error="Password length must be greater than 5" data-error-show-in="epassword" data-error-setting="2" data-error-text="Please enter password"',$password,'','',''); ?>
                            
                            <?php  echo get_data_field('password',$resourse['confirm_password'],'confirm_password','confirm_password','required_field addUser editUser','data-match-with="password" data-valid-match-error="Password Mistmatch" data-check-valid="blank,gt-5,match" data-valid-gt-error="Password length must be greater than 5" data-error-show-in="econfirm_password" data-error-setting="2" data-error-text="Please enter confirm password"','','','',''); ?>
                            <?php } ?>
							
                            <input type="hidden" name="user_add" value="user_add"/>
                            <?php $valueuser=0;if($_GET['id']){$valueuser=$_GET['id'];} ?>
                           	<input type="hidden" name="user_id" value="<?php echo $valueuser; ?>"/>
                            
                           	<input type="hidden" name="login_type" value="<?php echo $login_type;?>"/>
                            
                            
                           
                            <?php  
                            
                            $option_result='<option value="">Select Age</option>';
                            $option_array=range(1,80);
                            $age=$user['age'];
                            foreach($option_array as $v){
                                
                             
                                if($age==$v){
                                $option_result.='<option value="'.$v.'" selected="selected">'.$v.'</option>';
                                }
                                else{
                                 $option_result.='<option value="'.$v.'">'.$v.'</option>';   
                                }
                            }
                            
                            
                            
                            
                            ?> 
                             
                           
                     
                            
                            <?php  echo get_select_box('select','Age','age','age','required_field addUser editUser','data-check-valid="blank" data-error-show-in="eage" data-error-setting="2" data-error-text="Please enter age"',$option_result); ?> 
                            
                            
                           <div class="form-group">
								<label class="control-label remove_bg"><?php echo $resourse['manager'];?></label>
								<div>
                                <?php 
                                $hid=get_hierarchy_id();
                                $umanager="";
                                if($user['manager']!=''){
                                    $umanager=explode("|",$user['manager']);
                                }
                                
                                
                                    $dat=get_category_tree($all_cats,$hid['data'][0]['id'],1);?>
                                <table>
                                 	<?php
                                        show_accordian($dat,'',0,2,'manager',$umanager,$user_id);
                                    ?>
                                </table>    
								    <span id="ecats" class="error"></span>
                                </div>
							</div>
                             
                            
                            
                             <?php 
                                $profile_picture=$user['profile_picture'];
                                if($profile_picture!=''){$profile_pic=site_url().'uploads/users/'.$profile_picture;}
                                else{$profile_pic=admin_assets_url().'img/avatar.png';}
                                ?> 
                            
                            
                             <?php  echo get_data_field_for_img('file',$resourse['profile_picture'],'profile_picture','profile_picture','','',$profile_pic,'','','100','100'); ?>
                            
                             
                            <input  type="hidden" name="user_profile_picture" value="<?php echo $profile_picture;?>"/>	
                            
                            
                            
                            
                            
                            
						

							<button type="reset" class="btn btn-inverse right left-gap" onclick="cancel_user_registration('addUser')" >
								<i class="glyphicon glyphicon-chevron-right"></i> <?php echo $resourse['cancel'];?>
							</button>
                             <?php if($user_id!=''){?>
							<button  onclick="return validation('editUser')" type="button" class="btn btn-theme-inverse right">
								<i class="glyphicon glyphicon-circle-arrow-right"></i> <?php echo $resourse['update'];;?>
							</button>
                            <?php } else {?>
                            
                            <button  onclick="return validation('addUser')" type="button" class="btn btn-theme-inverse right">
								<i class="glyphicon glyphicon-circle-arrow-right"></i> <?php echo $resourse['submit'];;?>
							</button>
                            
                            <?php } ?>
						</form>
					</div>
					<section>
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
								<i class="glyphicon glyphicon-ok-circle"></i> Confirmation
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body text_alignment">
							<div class="confirmation_successful">
								<i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
								<span id="model_des">Confirmation Successful</span>
							</div>
						</div>
						<!-- //modal-body-->
					</div>
        
	</div>
    
    