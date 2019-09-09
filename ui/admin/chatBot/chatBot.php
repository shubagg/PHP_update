<?php 
include_once("../../../global.php");
is_user_logged_in();
check_user_permission_with_redirect("rpa","chatbot");
$companyData=get_company_data();

?>

<?php get_admin_header(); ?>

<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php include_once(include_admin_template("chatBot","chatBot")); ?>



<script>
var ui_url='<?php echo ui_url();?>';
var admin_ui_url='<?php echo admin_ui_url();?>';
var panelId     ='<?php echo $_SESSION['user']['user_id'];?>';

</script>  
<script>
	var fileuploadCounter=0;
	function submit_form(){

		var question=$("#question").val();
		var answer=$("#answer").val();
		var tag=$("#tag").val();
		var question_id=$("#question_id").val();
		var by_fileupload=$("#by_fileupload_id").val();
		$(".error").html("");
		if(question==""){
			$("#error_que").html("Please Enter Question");
		}else if(answer==""){
			$("#error_ans").html("Please Enter Answer");
		}/*else if(tag==""){
			$("#error_tag").html("Please Select Tag");
		}*/else{ setloader();
			$.ajax({
	                type: "POST",
	                url:  admin_ui_url+"chatBot/ajax/manage_training_panel.php?type=submitquestion",
	                data: {"patterns":question,"responses":answer,"tag":tag,"id":question_id},
	                success: function(data) 
	                { 
	                   unloading();
	                   var resp=JSON.parse(data);
	                   if(resp['success']=="true"){
	                   		var id=resp['data']['id'];
	                   		if(by_fileupload!=""){
	                   				$("#sub_que_"+by_fileupload).val(resp['data']['patterns']);
									$("#sub_ans_"+by_fileupload).val(resp['data']['responses']);
									$("#sub_tag_"+by_fileupload).val(resp['data']['tag']);
									$("#sub_id_"+by_fileupload).val(resp['data']['id']);

	                   		}
	                   		else if($("#final_data_"+id).length==0){
	                   			var appendhtml='<div class="form-group" id="final_data_'+id+'" data-id="'+id+'" onclick="append_question(this)">';
			                   	    appendhtml +='<input class="form-control chat-bot-min question_hide" id="sub_que_'+id+'" type="text" value="'+resp['data']['patterns']+'">';
			                   	    appendhtml +='<input type="hidden" id="sub_id_'+id+'" value="'+resp['data']['id']+'">';
			                   	    appendhtml +='<input type="hidden" id="sub_ans_'+id+'" value="'+resp['data']['responses']+'">';
			                   	    appendhtml +='<input type="hidden" id="sub_tag_'+id+'" value="'+resp['data']['tag']+'">';
			                   	    appendhtml +='</div>';
			                   		$("#appendQuestion").append(appendhtml);	
			                   			
	                   		}
	                   		else
	                   		{
			                   	    $("#sub_que_"+id).val(resp['data']['patterns']);
									$("#sub_ans_"+id).val(resp['data']['responses']);
									$("#sub_tag_"+id).val(resp['data']['tag']);
									$("#sub_id_"+id).val(resp['data']['id']);
			                   		
	                   		}
	                   		$("#SubmitBotTraining")[0].reset();	
	                   		$(".question_hide").prop("readonly", true);
	                   }
	                }
	    		});
		}
		  
	}
function append_question(id){
		var data_id=$(id).attr("data-id");
		if($(id)[0].hasAttribute("data-file")){
			$("#by_fileupload_id").val(data_id);
		}else{
			$("#by_fileupload_id").val("");
		}
		var question=$("#sub_que_"+data_id).val();
		var answer=$("#sub_ans_"+data_id).val();
		var tag=$("#sub_tag_"+data_id).val();
		var question_id=$("#sub_id_"+data_id).val();

		$("#question").val(question);
		$("#answer").val(answer);
		$("#tag").val(tag);
		$("#question_id").val(question_id);
}
function train_request_send(){
	setloader();
	$.ajax({

		url: admin_ui_url+"chatBot/ajax/manage_training_panel.php?type=train_request_send",
		data:{},
		type:"POST",
		success:function suc(data){
				unloading();
			if(data){
				$("#model_head").html(ui_string['success']);
                $("#model_des").html(ui_string['train_request_success']);
                $('#success_modal').modal();
                setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				$("#model_head").html(ui_string['unsuccess']);
                $("#model_des").html(ui_string['train_request_not_success']);
                $('#success_modal').modal();
			}
		}
	});
}
$(function(){
    $('input[type=file]').on('change', fileUpload);
});

function fileUpload(event){
    //notify user about the file upload status
    $("#dropBox").html(event.target.value+" uploading...");   
    //get selected file
    files = event.target.files;
    
    //form data check the above bullet for what it is  
    var data = new FormData();                                   

    //file data is presented as an array
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if(!file.type.match('text.*')) {              
            //check file type
            $("#dropBox").html("Please choose an txt file.");
        }else if(file.size > 1048576){
            //check file size (in bytes)
            $("#dropBox").html("Sorry, your file is too large (>1 MB)");
        }else{
            //append the uploadable file to FormData object
            data.append('file', file, file.name);
            
            //create a new XMLHttpRequest
            var xhr = new XMLHttpRequest();     
            
            //post file data for upload
            xhr.open('POST', admin_ui_url+'chatBot/upload.php', true);  
            xhr.send(data);
            xhr.onload = function () {
                //get response and show the uploading status
                var response = JSON.parse(xhr.responseText);
                if(xhr.status === 200 && response.status == 'ok'){
                	var appendhtml="";
                	for (var i = 0 ; i < response.data.length; i++) {
                		if(response.data[i]!=""){
                			fileuploadCounter=i;
                			appendhtml +='<div class="form-group" id="final_data_'+fileuploadCounter+'" data-file="'+fileuploadCounter+'" data-id="'+fileuploadCounter+'" onclick="append_question(this)">';
	                   	    appendhtml +='<input class="form-control chat-bot-min question_hide" id="sub_que_'+fileuploadCounter+'" type="text" value="'+response.data[i]+'">';
	                   	    appendhtml +='<input type="hidden" id="sub_id_'+fileuploadCounter+'" value="0">';
	                   	    appendhtml +='<input type="hidden" id="sub_ans_'+fileuploadCounter+'" value="">';
	                   	    appendhtml +='<input type="hidden" id="sub_tag_'+fileuploadCounter+'" value="">';
	                   	    appendhtml +='</div>';
	                   	    
                		}
                	}
                	$("#appendQuestion").append(appendhtml);
                	$("#upload_media")[0].reset();	
                    $("#dropBox").html("File has been uploaded successfully");
                }else if(response.status == 'type_err'){
                    $("#dropBox").html("Please choose an images file. Click to upload another.");
                }else{
                    $("#dropBox").html("Some problem occured, please try again.");
                }
            };
        }
    }
}
</script>
<script type="text/javascript" src="<?php echo site_url()."company/".$companyData['cid']."/"; ?>assets/js/chat-bot.js"></script>
<script type="text/javascript" src="<?php echo site_url()."company/".$companyData['cid']."/"; ?>assets/js/chat-bot-scroll.js"></script>
 <?php get_admin_footer(); ?> 