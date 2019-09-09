<div id="main">
<?php get_breadcrumb(); ?>
<script>
function checkalldata(){}
</script>
            <div id="content">
                <div class="row">
                
              <div class="col-md-12">
                <div class="col-md-5">
					<div class="chatbot-left">
						<div class="panel-updated">
							<h3>Chat Bot Training Panel</h3>
						</div>
						
						<form class="chat-bot-form" id="SubmitBotTraining" method="post" >
						
							<div class="form-group padding-0px col-md-12  margin-bottom">
                                <div class="col-md-10 padding-0px">
								<input class="form-control" placeholder="Question" type="text" name="question" id="question">
                                <span id="error_que" class="error"></span>
                                <input type="hidden" name="id" id="question_id" value="0">
                                <input type="hidden" id="by_fileupload_id" value="">
                            </div>
							<div class="col-md-2">
								<div class="all-buttons">
							<div class="align-xs-right" id="buttons-icon">
								
								<div class="btn-group tooltip-area1">
								<a href="#" onclick="focusField('question')" class="btn popupNew btn-primary custom-toltip"><i class="fa fa-microphone"></i></a>
								</div>
								
							</div>
							</div>
							</div>
							</div>
							<div class="form-group padding-0px col-md-12  margin-bottom">
							<div class="col-md-10 padding-0px">
                                <input class="form-control" placeholder="Answer" id="answer" type="text" placeholder="Enter your message" name="answer">
                                <span id="error_ans" class="error"></span>
								</div>
								<div class="col-md-2">
									<div class="all-buttons">
							<div class="align-xs-right" id="buttons-icon">
								<div class="btn-group tooltip-area1">
								<a href="#"  class="btn popupNew btn-primary custom-toltip" onclick="focusField('answer')"><i class="fa fa-microphone"></i></a>
								</div>
							</div>
							</div>
								</div>
                            </div>
							<div class="form-group padding-0px col-md-12 margin-bottom">
                               <!--  <select class="form-control" name="tag" id="tag">
								<option value="">Select Tag</option>
                                <option value="1">Tag -1</option>
                                <option value="2">Tag -2</option>
                                <option value="3">Tag -3</option>
                                <option value="4">Tag -4</option>
								<option value="5">Tag -5</option>
                                </select> -->
                                <input class="form-control" placeholder="Tag" type="text" name="tag" id="tag">
                                <span id="error_tag" class="error"></span>
                            </div>
							<div class="text-right">
                                <input type="button" class="btn btn-default" onclick="return submit_form();" value="Next">
                                <input type="button" class="btn btn-primary" onclick="return train_request_send();" value="Train">
                            </div>
						</form>
					</div>
				</div> 
                
                <div class="col-md-7">
					<div class="chatbot-right simplebar" id="chatbot-right">
					<form class="bot-attached" id="upload_media">
				<button class="btn btn-primary button-attached"><i class="fa chat-box-send fa-paperclip" aria-hidden="true"></i> </button>
                    <input type="file" name="fileInput" id="fileInput" />
					
                </form>
				
					<div class="chat-bot-form" id="appendQuestion">
						<!-- <div class="form-group">
								<input class="form-control chat-bot-min" type="text">
							</div> -->
					</div>
					</div>
				</div> 
                 
              </div>
                    
                </div>
                <!-- //content > row-->
            </div>
            <!-- //content-->
              
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?>

				 <style>
				 .bot-attached{
					 float:right;
				 }
				 .mrg-b{
					margin-bottom{
						margin-bottom:20px;
					}
				 }
.padding-0px{
	padding:0px;
}
.btn .fa {
    margin: 0px;
	font-size: 18px;
}

.simplebar, [data-simplebar-direction] {
    position: relative;
    overflow: hidden;
    -webkit-overflow-scrolling: touch; /* Trigger native scrolling for mobile, if not supported, plugin is used. */
}

.simplebar .simplebar-scroll-content,
[data-simplebar-direction] .simplebar-scroll-content {
    overflow-y: scroll;
    overflow-x: auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    -ms-overflow-style: none; /* hide browser scrollbar on IE10+ */
}

/* hide browser scrollbar on Webkit (Safari & Chrome) */
.simplebar-scroll-content::-webkit-scrollbar {
    display: none;
}

[data-simplebar-direction="horizontal"] .simplebar-scroll-content,
.simplebar.horizontal .simplebar-scroll-content {
    overflow-x: scroll;
    overflow-y: auto;
}

.simplebar-track {
    z-index: 99;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 11px;
}

.simplebar-track .simplebar-scrollbar {
    position: absolute;
    right: 2px;
    -webkit-border-radius: 7px;
    -moz-border-radius: 7px;
    border-radius: 7px;
    min-height: 10px;
    width: 7px;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    opacity: 0;
    -webkit-transition: opacity 0.2s linear;
    -moz-transition: opacity 0.2s linear;
    -o-transition: opacity 0.2s linear;
    -ms-transition: opacity 0.2s linear;
    transition: opacity 0.2s linear;
    background: #6c6e71;
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
}

.simplebar-track:hover .simplebar-scrollbar {
    /* When hovered, remove all transitions from drag handle */
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
    opacity: 0.7;
    -webkit-transition: opacity 0 linear;
    -moz-transition: opacity 0 linear;
    -o-transition: opacity 0 linear;
    -ms-transition: opacity 0 linear;
    transition: opacity 0 linear;
}

.simplebar-track .simplebar-scrollbar.visible {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
    opacity: 0.7;
}

[data-simplebar-direction="horizontal"] .simplebar-track,
.simplebar.horizontal .simplebar-track {
    top: auto;
    left: 0;
    width: auto;
    height: 11px;
}

[data-simplebar-direction="horizontal"] .simplebar-track .simplebar-scrollbar,
.simplebar.horizontal .simplebar-track .simplebar-scrollbar {
    right: auto;
    top: 2px;
    height: 7px;
    min-height: 0;
    min-width: 10px;
    width: auto;
}
#chatbot-right{
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
	color:#333;
}
#buttons-icon .tooltip-area1 a {
    box-shadow: 0 0 4px #ccc !important;
    -webkit-box-shadow: 0 0 4px #ccc !important;
}
.loader {
    margin: 300px auto;
}
input::placeholder {
  color: ccc !important;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    cursor: pointer;
}
</style>
</div>
