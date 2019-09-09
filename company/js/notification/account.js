function validate1()
{
    var id=document.getElementById('id').value;
    if(id=="9")
    {
      id="0";
    } 
    $(".valid_error").html('');
    var type = document.getElementById('acc_type').value;
    var name = document.getElementById('acc_name').value;
    var from_name = document.getElementById('from_name').value;
    var _csrf = document.getElementById('_csrf').value;
    //alert(_csrf);
    var domain = document.getElementById('acc_domain').value;
    var username = document.getElementById('acc_username').value;
    var password = document.getElementById('acc_password').value;
    var url = document.getElementById('acc_url').value;
    var email = document.getElementById('acc_email').value;
    var port = document.getElementById('acc_port').value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;   
    var regex1=/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/;
    if(type=="")
    {
        $('#acc_type_err').html(ui_string['sel_type']);
        $("#acc_type").focus();
        return false;
    }
    else if(name=="")
    {
        $('#acc_name_err').html(ui_string['ent_acc_name']);
        document.frm.acc_name.focus();
        return false;
    }  
    else if(!isNaN(name))
    {
        $('#acc_name_err').html(ui_string['ent_vacc_name']);
        document.frm.name.focus();
        return false;
    } 
    else if(domain.trim()=='')
    {
        $('#acc_domain_err').html(ui_string['ent_domain']);
        $("#acc_domain").focus();
        return false;
    }  
    else if(username.trim()=='')
    {
        $('#acc_username_err').html(ui_string['ent_username']);
        $("#acc_username").focus();
        return false;
    }                          
    else if(password.trim()=='')
    {
        $('#acc_password_err').html(ui_string['ent_password']);
        $("#acc_password").focus();
        return false;
    }
    else if(url.trim()=='')
    {
        $('#acc_url_err').html(ui_string['ent_url']);
        $("#acc_url").focus();
        return false;
    }
    else if (!regex1.test(url))
    {
        $('#acc_url_err').html(ui_string['ent_vurl']);
        $("#acc_url").focus();
        return false;
    } 
    else if(port=="")
    {
        $('#acc_port_err').html(ui_string['ent_port']);
        $("#acc_port").focus();
        return false;
    }
    
    else if(isNaN(port))
    {
        $('#acc_port_err').html(ui_string['ent_port_valid']);
        $("#acc_port").focus();
        return false;
    }
    else if(from_name=="")
    {
        $('#from_name_err').html(ui_string['ent_from_name']);
        document.frm.from_name.focus();
        return false;
    }  
    else if(!isNaN(from_name))
    {
        $('#from_name_err').html(ui_string['ent_vfrom_name']);
        document.frm.from_name.focus();
        return false;
    }    
    else if(email.trim()=='')
    {
        $('#acc_email_err').html(ui_string['from_email']);
        $("#acc_email").focus();
        return false;
    }
    else if (!filter.test(email))
    {
        $('#acc_email_err').html(ui_string['ent_vemail']);
        $("#acc_email").focus();
        return false;
    } 
    else
    {
        
        var datastring = "name="+name+"&domain="+domain+"&_csrf="+_csrf+"&id="+id+"&username="+username+"&type="+type+"&password="+password+"&from_name="+from_name+"&email="+email+"&url="+url+"&port="+port+"&action=account_add";
        $.ajax({
            type: "POST",
            url:  ui_url+"notification/ajax/account_manage.php",
            data: datastring,
            success: function(data) 
            {   
                data = JSON.parse(data); 
                //parsedObj = jQuery.parseJSON(data); 
                //alert(parsedObj['success']);
                if(data['error_code']=='201')
                {
                    $("#model_des").html(data['data']);
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal("toggle"); },3000);
                    return false;
                }
                else
                {
                    $("#confirm-click-1").modal("toggle");                                 
                    setTimeout(function(){
                        window.location=site_url+"admin/manageAccount";
                    }, 1000);   
                }
            }
        })
    }
}   

function go_to(page,id)
{
    window.location=page+"?id="+id;
}

function delete_account(id)
{
    var account_id=$("#"+id).attr("data-id");
    $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+account_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_account_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
    $('#sure_to_delete').modal();
}
    
function delete_account_data()
{
    var datastring = $('#deleteData').serialize();
    $.ajax({
        type: "POST",
        url:  ui_url+"notification/ajax/account_manage.php",
        data: datastring+"&action=account_delete",
        success: function(data) {
            //alert(data);
            if(data==0){   
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['account_delete_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function(){ location.reload(); },1000)
            }else{
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['account_delete']);
                $('#success_modal').modal();
                setTimeout(function(){ location.reload(); },1000)
            }
        },
        error: function(){
              alert('error handing here');
        }
    });   
}


function delete_account_temp()
{
    if(allCheckedArrayValues.length)
    {
        var accountIds=allCheckedArrayValues.toString();
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_accounts(\''+accountIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
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

function delete_multiple_accounts(accountIds)
{
   
    $.ajax({
        url:ui_url+"notification/ajax/account_manage.php",
        data:"accountIds="+accountIds+"&action=delete_multiple_account",
        type:"POST",
        success:function(suc)
        {
            if(suc==1 || suc!=1)
            {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['account_delete']);
                $('#success_modal').modal();
                setTimeout(function(){ location.reload(); },1000)
            }
            else
            {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['account_delete_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
            }
        }
    })
}
