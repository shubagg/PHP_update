<div id="main">
<?php get_breadcrumb(); ?>
<script>
function checkalldata(){}
</script>
            <div id="content">
                <div class="row">
                
              <div class="col-md-12">
                <section class="panel">
                                                <header class="panel-heading panel-updated">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <h3>Contact Form </h3>
                                                            </div>
                                                         
                                                        </div>
                                                </header>

                                               
                                                <div class="panel-body">
                                                       <form method="post" id="contentform">
                                                <div class="row">
                                                         
                                                    <div class="col-xs-6 r-mrg-bottom">
													<div class="form-group">
															<label>First Name</label>
                                                            <div class="col-md-10 padding-0px">
																<input class="form-control" placeholder="First Name" type="text" name="fname" id="fname">
																<span id="e_fname" class="error"></span>
															</div>
															<!-- <div class="col-md-2">
															<div class="all-buttons">
															<div class="align-xs-right" id="buttons-icon">
															<div class="btn-group tooltip-area1">
															<a href="#" id="fname" onclick="focusField('fname')" class="btn popupNew btn-primary custom-toltip"><i class="fa fa-microphone"></i></a>
															</div>
																
															</div>
															</div>
							</div>  -->     </div>
                                                    </div>
													<div class="col-xs-6 r-mrg-bottom">
													<div class="form-group r-mrg-bottom">
															<label>Last Name</label>
                                                            <div class="col-md-10 padding-0px">
																<input class="form-control" placeholder="Last name" type="text" name="lname" id="lname">
																<span id="e_lname" class="error"></span>
															</div>
															<div class="col-md-2">
															<div class="all-buttons">
															<div class="align-xs-right" id="buttons-icon">
															<div class="btn-group tooltip-area1">
															<a href="#" id="lname" onclick="startrecorder()" class="btn popupNew btn-primary custom-toltip"><i class="fa fa-microphone"></i></a>
															</div>
																
															</div>
															</div>
							</div>      </div>
                                                    </div>
                                                </div>
                                                <div class="row">
													<div class="col-xs-6 r-mrg-bottom">
                                                       <div class="form-group r-mrg-bottom">
															<label>Email</label>
                                                            <div class="col-md-10 padding-0px">
																<input class="form-control" placeholder="Email" type="text" name="email" id="email"><span id="e_email" class="error"></span>
															</div>
															<!-- <div class="col-md-2">
															<div class="all-buttons">
															<div class="align-xs-right" id="buttons-icon">
															<div class="btn-group tooltip-area1">
															<a href="#" id="email" onclick="focusField('email')" class="btn popupNew btn-primary custom-toltip"><i class="fa fa-microphone"></i></a>
															</div>
																
															</div>
															</div>
							</div> -->      </div> 
                                                    </div>
													
													<div class="col-xs-6 r-mrg-bottom">
                                                       <div class="form-group r-mrg-bottom">
															<label>Phone</label>
                                                            <div class="col-md-10 padding-0px">
																<input class="form-control" placeholder="Phone" type="text" name="email" id="Phone"><span id="e_phone" class="error"></span>
															</div>
															<!-- <div class="col-md-2">
															<div class="all-buttons">
															<div class="align-xs-right" id="buttons-icon">
															<div class="btn-group tooltip-area1">
															<a href="#" id="Phone" onclick="focusField('Phone')" class="btn popupNew btn-primary custom-toltip"><i class="fa fa-microphone"></i></a>
															</div>
																
															</div>
															</div>
							</div> -->      </div>  
                                                    </div>
													
													<div class="col-xs-12 r-mrg-bottom">
                                                      <div class="form-group r-mrg-bottom">
															<label>Description</label>
                                                            <div class="col-md-11 padding-0px">
																 <textarea name="message" id="description" class="form-control" rows="10" cols="30" placeholder="Description"></textarea>
															<span id="e_description" class="error"></span>
															</div>
															<!-- <div class="col-md-1">
															<div class="all-buttons">
															<div class="align-xs-right" id="buttons-icon">
															<div class="btn-group tooltip-area1">
															<a href="#" id="description" onclick="focusField('description')" class="btn popupNew btn-primary custom-toltip"><i class="fa fa-microphone"></i></a>
															</div>
																
															</div>
															</div>
							</div>  -->     </div>  
                                                    </div>
													
                                                      </div>
                                                      <div class="text-right">
                                                    <button class="btn btn-default" onclick="$('#contentform')[0].reset();">Cancel</button>
                                                    <button class="btn btn-primary" data-toggle="modal" onclick="submitform();" data-target="#md-normal">Save</button>
                                                 </div>
                                             </form>
                                                </div>
                                                
                                        </section>
              </div>
                    
                </div>
                <!-- //content > row-->
            </div>
            <!-- //content-->
              
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?>

    </div>
<script type="text/javascript">
	function submitform(){
		$(".error").html("");
		var fname=$("#fname").val();
		var lname=$("#lname").val();
		var email=$("#email").val();
		var phone=$("#Phone").val();
		var description=$("#description").val();
		if(fname==""){
			$("#e_fname").html("This Field Is Requried");
			return false;
		}else if(lname==""){
			$("#e_lname").html("This Field Is Requried");
			return false;
		}else if(email==""){
			$("#e_email").html("This Field Is Requried");
			return false;
		}else if(phone==""){
			$("#e_phone").html("This Field Is Requried");
			return false;
		}else if(description==""){
			$("#e_description").html("This Field Is Requried");
			return false;
		}else{
			$("#model_head").html(ui_string['success']);
            $('#success_modal').modal();
            setTimeout(function(){ window.location.reload(); }, 1000);
		}
	}
</script>
	
	<style>
		.padding-0px{
			padding:0px;
		}
		.btn .fa {
    margin: 0px;
    font-size: 18px;
		}
.form-group label {
    margin-top: 0;
    width: 100%;
}
.r-mrg-bottom{
	margin-bottom:20px;
}
#buttons-icon .tooltip-area1 a {
    box-shadow: 0 0 4px #ccc !important;
    -webkit-box-shadow: 0 0 4px #ccc !important;
}
	</style>