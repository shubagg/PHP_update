function validation_successfull(tp)
{

       // alert(tp);
        switch(tp)
        {
        	case "addTimeTrigger":
                var formData = new FormData($('#timetrigger')[0]);
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"notification/ajax/timeTrigger.php?action=timeTrigger",
                            data: formData,
                            async: false,
                            success: function(data) {

                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['ttrigger_success']);
                                    $('#success_modal').modal();
                                   // setTimeout(function(){ window.location=timeTrigger+'/'+id; },1000);
                                    setTimeout(function(){ window.location=site_url+'admin/timeTrigger?id='+id; },1000);
                                }
                                else if(data['error_code']=='201')
                                {
                                    $("#model_des").html(data['data']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },3000);
                                }
                                else
                                {
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['ttrigger_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                    
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

            case "editTimeTrigger":
                 var formData = new FormData($('#timetrigger')[0]);
             
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"notification/ajax/timeTrigger.php?action=timeTrigger",
                            data: formData,
                            async: false,
                            success: function(data) {
                               //alert(data);
                                data=JSON.parse(data);
                                
                                if(data['success']=='true')
                                {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['ttrigger_update_success']);
                                    $('#success_modal').modal();
                                    //setTimeout(function(){ window.location=timeTrigger+'/'+id; },1000);
                                    setTimeout(function(){ window.location=site_url+'admin/timeTrigger?id='+id; },1000);
                                }
                                else if(data['error_code']=='201')
                                {
                                    $("#model_des").html(data['data']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },3000);
                                }
                                else
                                {
                                   
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['ttrigger_update_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                                   
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


function go_to_time_trigger(id,tid)
{
	//window.location.href=manageTimeTrigger+"/"+id+"/"+tid;
    window.location.href=site_url+"admin/manageTimeTrigger?id="+id+"&tid="+tid;
}


function delete_time_trigger_temp(id)
{
   
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');

        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_time_trigger(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        if(allCheckedArrayValues.length)
        {
            var userIds=allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_time_trigger(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
            $('#sure_to_delete').modal();
        }
        else
        {
        
            $('#error_head').html(ui_string['error_message']);
            $('#error_body').html(ui_string['select_text_box_error']);
            $('#error_message').modal();
            setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
        }  
    }  
}

function delete_multiple_time_trigger(userIds)
{

    $.ajax({
            url:  admin_ui_url+"notification/ajax/timeTrigger.php?action=deleteTimeTrigger",
            data:"id="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['ttrigger_delete']);
                                    $('#success_modal').modal();
                                    //setTimeout(function(){ window.location=timeTrigger+'/'+id; },1000);
                                    setTimeout(function(){ window.location=site_url+'admin/timeTrigger?id='+id; },1000);
                        }
                        else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['ttrigger_delete_unsuccess']);
                            $('#success_modal').modal();
                           
                        }
                    }
        })
}