<body class="leftMenu nav-collapse in">

		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->

    	<?php
         get_admin_header_menu($language); ?>  	

		<div id="main" class="dashboard">
       
			<div id="content">
		
			
				<section class="panel">
				<header class="panel-heading">
                        <h3><strong><?php if(isset($_GET['id']) && $_GET['id']!=""){echo $ui_string['edit'];}else{echo $ui_string['add'];}?>  <?php echo $ui_string['account'];?></strong> </h3>
                    </header>
<div class="panel-body">
                                        <?php 
                    
                    
                    ?>
						<form name="frm" action="" method="post" onSubmit="return validate1();" >
                         <?php $csrf = new CSRF_Protect(); $csrf->echoInputField();?>				
                   
                                    <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                     <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['account_type'];?> <font color='red'>*</font></label>
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                                 <select  class="selectpicker form-control" name="acc_type" id="acc_type" >
                                    
                                                    
                                                    <option value="smtp"<?php if($get_account['data'][0]['accType']=='smtp'){echo "selected";}?>> smtp </option>
                                                    <option value="sendgrid" <?php if($get_account['data'][0]['accType']=='sendgrid'){echo "selected";}?>> sendgrid </option>
                                                </select> 
                                              <span id="acc_type_err" class="valid_error"></span> </div>
                                                                            <div class="clearfix"></div>
                                     </div>


                                     
  <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['account_name'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="acc_name"  name="acc_name" value="<?php if(!empty( $get_account['data'][0]['accName'])){echo $get_account['data'][0]['accName']; } ?>">
          <span id="acc_name_err" class="valid_error"></span> </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    
                                   
                                          
 			          <div>

									
									 <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo"><?php echo $ui_string['domain'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="acc_domain"  name="acc_domain" value="<?php if(!empty($get_account['data'][0]['domain'])){ echo $get_account['data'][0]['domain']; } ?>">
          <span id="acc_domain_err" class="valid_error"></span> </div>
										<div class="clearfix"></div>
                                    </div>
									
									 <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['username'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="acc_username"  name="acc_username" value="<?php if(!empty($get_account['data'][0]['username'])){echo $get_account['data'][0]['username']; } ?>">
          <span id="acc_username_err" class="valid_error"></span> </div>
										<div class="clearfix"></div>
                                    </div>
									
									<div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['password'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="acc_password"  name="acc_password" value="<?php if(!empty($get_account['data'][0]['password'])){ echo $get_account['data'][0]['password']; } ?>">
          <span id="acc_password_err" class="valid_error"></span> </div>
										<div class="clearfix"></div>
                                    </div>
									
									
									<div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['url'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="acc_url"  name="acc_url" value="<?php  if(!empty($get_account['data'][0]['url'])){echo $get_account['data'][0]['url']; } ?>">
          <span id="acc_url_err" class="valid_error"></span> </div>
											<div class="clearfix"></div>
                                    </div>
									
									<div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['port'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="acc_port"  name="acc_port" value="<?php if(!empty($get_account['data'][0]['port'])){echo $get_account['data'][0]['port'];  }?>">
          <span id="acc_port_err" class="valid_error"></span> </div>
											<div class="clearfix"></div>
                                    </div>

                                     <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['from_name'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="from_name"  name="from_name" value="<?php if(!empty( $get_account['data'][0]['from_name'])){echo $get_account['data'][0]['from_name']; } ?>">
          <span id="from_name_err" class="valid_error"></span> </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-12 col-xs-12" for="inputTwo" ><?php echo $ui_string['from_email'];?> <font color='red'>*</font></label>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                            <input type="text" class="form-control" id="acc_email"  name="acc_email" value="<?php if(!empty($get_account['data'][0]['email'])){echo $get_account['data'][0]['email']; } ?>">
          <span id="acc_email_err" class="valid_error"></span> </div>
                                        <div class="clearfix"></div>
                                    </div>
								
                                </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					            <section class="text-right">
                                <?php  		
                              
							if(isset($_GET['id']))

                            echo'<button type="button" class="btn btn-theme-inverse define_action" onclick="validate1();" name="submit">'.  $ui_string['update'].'</button>';

                            else

                            {
                            echo'<button type="button" class="btn btn-theme-inverse define_action" onclick="validate1()" name="Confirm"> '.  $ui_string['confirm'].'</button>';
							}

                            ?>
      
									</section>
							 </div>         

						</form>
					</div>
					<section>
					
			</div>
		</div>
		<?php get_admin_left_sidebar(); ?>   
        
     <div id="confirm-click-1" class="modal fade" data-backdrop="static" data-keyboard="false" data-header-color="#736086" >
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="glyphicon glyphicon-ok-circle "></i> <?php echo $ui_string['confirmation'];?></h4>
                    </div>
                
                    <div class="modal-body text_alignment" >
    <div class="confirmation_successful"> <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
                                <?php
                                    if(isset($_GET['id']) && $_GET['id']!="")
                                    {
                                        echo $ui_string['su'];
                                    }
                                    else
                                    {
                                        echo $ui_string['sc'];
                                    }
                                ?>
                        </div>
                    </div>
                
                </div>
     

    <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
                        <div class="modal-header">
                                <button  type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                
              
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
