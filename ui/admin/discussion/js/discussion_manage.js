    function discussion_manages()
    {
          var question= document.getElementById("question").value;
              question=question.replace(/&/g , "|!|!");
          

        $.ajax({
                
                            type: "POST",
                            url:  admin_ui_url+"discussion/ajax/discussion_manage.php?action=add_discussion",
                            data: "question="+question,
                            success: function(data) 
                            {
                             
                                if(data=='0')
                                {   
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['discussion_question_not_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);
                                }
                                else
                                {
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['discussion_question_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);
                                }
                            }
                            
                            
                });  
    }

                function addanswer()
                {
                    var answer= document.getElementById("answer").value;
                        answer=answer.replace(/&/g , "|!|!");
                    var questionid= document.getElementById("questionid").value;
                    
                    $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"discussion/ajax/discussion_manage.php?action=edit_discussion",
                            data: "answer="+answer+"&questionid="+questionid,
                            success: function(data) 
                            {
                                
                                if(data=='0')
                                {   
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['discussion_not_success_answer']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);
                                }
                                else
                                {
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['discussion_answer_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);
                                }
                            }
                });   
}
/*
    function discussion_manages(tp)
    {

        switch(tp)
        {
            case "addUser":
              
                var formData = new FormData($('#addUser')[0]);
               
              
                
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"discussion/ajax/discussion_manage.php?action=add_blog&des="+editor,
                            data: formData,
                            async: false,
                            success: function(data) 
							{
							 alert(data);
                                if(data=='0')
				{   
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['discussion_not_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"discussion/discussion.php"; },1000);
                                }
								else
								{
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['discussion_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"discussion/discussion.php"; },1000);
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });  
                
            break;
            
            
            case "editUser":
                
                 var formData = new FormData($('#addUser')[0]);
                 var editor=CKEDITOR.instances.pg_content.getData();
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"discussion/ajax/discussion_manage.php?action=edit_event&des="+editor,
                            data: formData,
                            async: false,
                            success: function(data) 
                            {
                                
                                if(data=='0')
								{   
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['discussion_not_success_update']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"discussion/discussion.php"; },1000);
                                }
								else
								{
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['discussion_update_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"discussion/discussion.php"; },1000);
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });   
            break;
            
        }
       
    }
    */

    function delete_user(id)
    {
        
        var user_id=$("#"+id).attr("data-id");
        $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+user_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_user_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
        $('#sure_to_delete').modal();
        
    }
    
    function delete_user_data(){
        
        var datastring = $('#deleteData').serialize();
        
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"discussion/ajax/discussion_manage.php",
                            data: datastring,
                            success: function(data) {
                               
                                if(data==0)
                                {   
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['discussion_delete_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                                }else{
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['discussion_delete']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"discussion/discussion.php"; },1000);
                                }
                            },
                            error: function(){
                                  alert('error handing here');
                            }
                });   
        
        
    }

function delete_users_temp()                    //multiple delete..
{
    if(allCheckedArrayValues.length)
    {
        var userIds=allCheckedArrayValues.toString();
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_users(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
        jQuery('#sure_to_delete').modal();
    }
    else
    {
        $('#error_head').html(ui_string['error_message']);
        $('#error_body').html(ui_string['select_text_box_error']);
        $('#error_message').modal();
        setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
    }    
}

function delete_multiple_users(userIds)
{
        
    $.ajax({
            url:admin_ui_url+"discussion/ajax/discussion_manage.php",
            data:"data_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {
                        
                        if(suc==1)
                        {
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['discussion_delete']);
                                    jQuery('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"discussion/discussion.php"; },1000);
                        }
                        else
                        {
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['discussion_delete_unsuccess']);
                                    jQuery('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                        }
                    }
        })
}
function go_to(page,att)    //send to the link..
{
 window.location=page+"?"+att; 
}

 /*
 function reset_form_data(form_name){
    $('#'+form_name)[0].reset();
 }

var _URL = window.URL || window.webkitURL;
$('#profile_picture').on("change",function () {

    var fileExtension = ["jpg","JPG","PNG","png","JPEG","jpeg","gif","GIF"];
     
     if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        // alert("Only '.jpeg','.jpg' formats are allowed.");
        //document.getElementById('eprofile_picture').html = "Please select only jpeg/png/gif file";
        //document.getElementById('profile_picture').value="";
        $("#eprofile_picture").html("Please select only jpeg/png/gif file");
        $("#profile_picture").val("");
        $("#user_profile_picture").val("");
      
    }
    else if(this.files[0].size > 8388608)
    {
        //document.getElementById('eprofile_picture').html = "Please upload less than 1mb images";
        //document.getElementById('profile_picture').value="";
        $("#eprofile_picture").html("Please upload less than 8mb images");
        $("#profile_picture").val("");
        $("#user_profile_picture").val("");
   }
   /* 
   else if((file = this.files[0])) 
   {
       
img = new Image();
img.onload = function () {
var w=this.width;
var h=this.height;
var file, img;
var wi = 1280;
var hi = 960;
var ratio =Math.round((1280*h)/960);
if(w < wi)
{
$("#eprofile_picture").html("please select image greater than 1280 * 960");
$("#user_profile_picture").val("");
$("#profile_picture").val("");
}
else if(h < hi)
{

$("#eprofile_picture").html("please select image greater than 1280 * 960");
$("#profile_picture").val("");
$("#user_profile_picture").val("");
}
else if(ratio==w)
{
    $("#eprofile_picture").html("");
    var imed=document.getElementById("profile_picture").value;
    $("#user_profile_picture").val(imed);
}

else
{
$("#eprofile_picture").html("please select image greater than 1280 * 960 ratio");
$("#user_profile_picture").val("");
$("#profile_picture").val("");    

}

};
img.src = _URL.createObjectURL(file);
}
  
   else{
    
   $("#eprofile_picture").html("");
   var imed=document.getElementById("profile_picture").value;
$("#user_profile_picture").val(imed);
    
   }
   
                 
 });
 */
 
function update_status(id)
{
var cstatus=$('#'+id).attr('data-status');
var user_id=$('#'+id).attr('data-id');
var dt='1';
var color='green';
var status ='active';
if(cstatus=='active')
{
status = 'inactive';
color='red';
dt='0'
}
$.ajax({
url:admin_ui_url+"discussion/ajax/reject_status.php",
data:"user_id="+user_id+"&tp="+dt,
type:"POST",
success:function(suc)
{
var msg_head='';
var msg_body='';
if(suc)
{
    $("#model_head").html(ui_string['success']);
    $("#model_des").html(ui_string['discussion_reject_answer_success']);
    $('#success_modal').modal();
    setTimeout(function(){ location.reload(); },1000);
    
}
}
 })
}


function askquestion_pop()                 
{
    
        $('#addquestion').modal();
        //setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
    
}
function askanswer_pop(id)                
{
        
        var uid=id.split("-");
        $('#addanswer').modal();
        $('#questionid').val(uid[1]);
    
}