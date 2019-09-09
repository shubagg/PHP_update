<div id="focustab" style="display: none;"><a href="#" id="anchortag"></a></div>
<div id="afocustab" style="display: none;"><a href="#" id="anchortagans"></a></div>

<!--<section class="panel chat_box">
												<div class="widget-chat">
														<header>
																<div class="chat-box-close"><span style="background:none;"><i class="icon-close fa fa-close"></i></span></div>
																<h4 class="online"> Chat</h4>
														</header>
														<div class="chat-body">
															<span class="chat_b" align="center">how can i help you</span>
																<dl class="chat" id="chatdata">
																				<div class="gallery"></div>														
																		 <dd>
																				<ul class="load-bubble">
																						<li></li>
																						<li></li>
																						<li></li>
																				</ul>
																		</dd> 
																</dl>
														</div>
														<footer>
																<form class="message-input app">
																		<div class="input-single"><input name="message" id="msg" type="text" placeholder="Enter your message"></div>
																		<button id="start-record-btn" type="button" class="btn btn-theme" onclick="speak()"><i class="fa chat-box-send fa-microphone" aria-hidden="true"></i> Send</button>
																		<button class="btn button-attached"><i class="fa chat-box-send fa-paperclip" aria-hidden="true"></i> </button><input type="file" class="custom-file-input" name="myfile" multiple id="gallery-photo-add" />
																		<div class="upload-btn-wrapper"><button type="button" class="btn btn-theme"><i class="fa chat-box-send fa-paperclip" aria-hidden="true"></i> <!--Send/button>
																		<button type="button" id="save-note-btn" style="position: absolute;background-color: transparent !important;border: none;" class="btn btn-theme send-button-z" onclick="sendquestion();"><i onclick="speakreplace();"  class="fa chat-box-send fa-paper-plane" aria-hidden="true"></i> Send</button>
																</form>
														</footer>
												</div>
										</section>-->
										
										<script>
										$(document).ready(function(){
											$("#start-record-btn").click(function(){
												//alert();
												$(".fa-microphone").addClass("fa-microphone-red");
											});
											$("#gallery-photo-add, #save-note-btn").click(function(){
												$(".fa-microphone").removeClass("fa-microphone-red");
											});
										});
										</script>
										<script>
										
											$(function() {
		// Multiple images preview in browser
		var imagesPreview = function(input, placeToInsertImagePreview) {

			if (input.files) {
				var filesAmount = input.files.length;

				for (i = 0; i < filesAmount; i++) {
					var reader = new FileReader();

					reader.onload = function(event) {
						$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
					}

					reader.readAsDataURL(input.files[i]);
				}
			}

		};

		$('#gallery-photo-add').on('change', function() {
			imagesPreview(this, 'div.gallery');
		});
	});
										
										</script>
										
										<script type="text/javascript">
											$(document).ready(() => {
													$('.icon-message').show();
													$('.icon-close').hide();
													$('.chat_box').hide();
													//console.log('Si', $('.icon-message').show());
													$('.icons').click(function() {
													$('.chat_box').slideToggle(700); 
													$('.icon-message').show();	
													});
													
													
													$('.icons').click(function() {
														$('.icons').hide();
														$('.chat-box-close span i').show();
														})
														
														$('.chat-box-close').click(function() {
														$('.chat_box').hide(700);
														$('.icons').show();
														})
												}); 
												
												
										</script>
										
							
										
										<script type="text/javascript">
										
						</script>
						
						<style>
							.message-input{
								display:block !important;
							}
						</style>