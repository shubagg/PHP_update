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
                            url:  admin_ui_url+"discussion/ajax/discussion_comment.php",
                            data: datastring,
                            success: function(data) {
                               
                                if(data==0)
                                {   
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['comment_delete_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                                }else{
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['comment_delete']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);
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
            url:admin_ui_url+"discussion/ajax/discussion_comment.php",
            data:"data_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {
                        
                        if(suc==1)
                        {
                                    $("#model_head").html(ui_string['success']);
                                    $("#model_des").html(ui_string['comment_delete']);
                                    jQuery('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);
                        }
                        else
                        {
                                    $("#model_head").html(ui_string['unsuccess']);
                                    $("#model_des").html(ui_string['comment_delete_unsuccess']);
                                    jQuery('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                        }
                    }
        })
}