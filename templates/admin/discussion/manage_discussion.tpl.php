<div id="main">
			<div id="content">
				<section class="panel">
					<div class="panel-body">
						<form id="addUser" class="form-horizontal" method="post"  enctype="multipart/form-data" >
                        
                            
                            
							<div class="form-group">
								<label class="control-label remove_bg"><?php echo $ui_string['question'];?></label>
								<div>
									<input type="text" id="title" name="title" data-check-valid="blank" data-error-show-in="etitle" data-error-setting="2" data-error-text="Please enter the title" class="form-control required_field editUser addUser" value="<?php echo $title; ?>"  placeholder="">
                                    
                                    	
                                    	<input type="hidden" name="blog_id" value="<?php echo $id; ?>">
									<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

								    <span id="etitle" class="error"></span>
                                </div>
							</div>
                        	
                            
                            <div class="form-group">
								<label class="control-label remove_bg"><?php echo $ui_string['answer'];?></label>
								<div>
                                <textarea name="description" id="pg_content" data-check-valid="blank" data-valid-blank-error="Please Enter Description" data-error-show-in="e_pg_content" data-error-setting="2" class="form-control required_field ckeditor " ><?php if(count($des)>0) {echo $des;}?></textarea>
								<span id="e_pg_content" class="error"></span>
                                </div>
							</div>

                            
							<button type="reset" class="btn btn-inverse right left-gap" onclick="location.href='<?php echo $admin_ui_url;?>blog/blog.php'">
								<i class="glyphicon glyphicon-chevron-right"></i> <?php echo $ui_string['cancel'];?>
							</button>
                             <?php if($blog_id!==''){?>
							<button  onclick="return validation('editUser')" type="button" class="btn btn-theme-inverse right">
								<i class="glyphicon glyphicon-circle-arrow-right"></i> <?php echo $ui_string['update'];?>
							</button>
                            <?php } else {?>
                            
                            <button  onclick="return validation('addUser')" type="button" class="btn btn-theme-inverse right">
								<i class="glyphicon glyphicon-circle-arrow-right"></i> <?php echo $ui_string['submit'];?>
							</button>
                            
                            <?php } ?>
						</form>
					</div>
					<section>
			</div>
		</div>
	
        
                <div id="success_modal" class="modal fade" data-header-color="#736086">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
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
    
    