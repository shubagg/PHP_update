function do_action(v)
{
    if(v=='self' || v==0)
    {
        $("#self").show();
        $("#ag").hide();
        $("#im").hide();
    }
    else if(v=='ag')
    {
        $("#self").hide();
        $("#ag").show();
        $("#im").hide();
    }
    else 
    {
        $("#self").hide();
        $("#ag").hide();
        $("#im").show();
    }
}

var t=0;
function on_submit()
{
    $(".error").html('');
    
    var title=document.getElementById('title').value.trim();
    var devicenames=document.getElementById('devicename').value.trim();  
    var desc=document.getElementById('desct').value.trim();
   var deviceid=document.getElementById('deviceid').value.trim();
    
    if(title=='')
    {
        $('#err_title').html('<font color=red>'+ui_string['device_title']+'</font>');
        document.getElementById('title').focus();
       	return false;
    }
    else if(devicenames=='')
    {
        $('#err_devicename').html('<font color=red>'+ui_string['device_name']+'</font>');
        document.getElementById('devicename').focus();
       	return false;
    }
    else if(desc=='')
    {
        $('#err_desc').html('<font color=red>'+ui_string['device_des']+'</font>');
        document.getElementById('desct').focus();
       	return false;
    }
                                              
    else
    {
        var datastring = "title="+title+"&devicenames="+devicenames+"&desc="+desc+"&amid="+amid+"&asmid="+asmid+"&deviceid="+deviceid+"&action=device_add";
        $.ajax({
            url:ui_url+"device/ajax/device_manage.php",
            type:"post",
            data:datastring,
            success:function(data)
            {   
                
             if(data==1)
            {
                   $("#model_head").html(ui_string['confirm']);
                   $("#model_des").html(ui_string['device_add']);
                   jQuery('#success_modal').modal();
                   setTimeout(function(){ window.location=site_url+"ui/admin/device/manage_device.php"; },1000); 
                
            }
            else if(data==2)
            {
                   $("#model_head").html(ui_string['confirm']);
                   $("#model_des").html(ui_string['device_update']);
                   jQuery('#success_modal').modal();
                   setTimeout(function(){ window.location=site_url+"ui/admin/device/manage_device.php"; },1000);
            }
            else
            {
                    
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['device_not_add']);
                jQuery('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/device/manage_device.php"; },1000);
            }
            }
        })
    }
}



function go_to(page,id)
{
    window.location=page+"?"+id;
}

function delete_device(id)
{
    var coupon_id=$("#"+id).attr("data-id");
    $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+coupon_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_device_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
    jQuery('#sure_to_delete').modal();
}
    
function delete_device_data()
{
    var datastring = $('#deleteData').serialize();
    $.ajax({
        type: "POST",
        url:  ui_url+"device/ajax/device_manage.php",
        data: datastring+"&action=device_delete",
        success: function(data) {
            
            if(data==1)
            {   
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['device_delete']);
                jQuery('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/device/manage_device.php"; },1000);
                
            }
            else
            {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['device_delete_unsuccess']);
                jQuery('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/device/manage_device.php"; },1000); 
            }
        },
        error: function(){
              alert('error handing here');
        }
    });   
}


function delete_device_temp()
{
    if(allCheckedArrayValues.length)
    {
        var couponIds=allCheckedArrayValues.toString();
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_device(\''+couponIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
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

function delete_multiple_device(deviceIds)
{
   
    $.ajax({
        url:ui_url+"device/ajax/device_manage.php",
        data:"deviceIds="+deviceIds+"&action=delete_multiple_device",
        type:"POST",
        success:function(data)
        {
            
            if(data==1)
            {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['device_delete']);
                jQuery('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/device/manage_device.php"; },1000);
            }
            else
            {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['device_delete_unsuccess']);
                jQuery('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/device/manage_device.php"; },1000);
            }
        }
    })
}
