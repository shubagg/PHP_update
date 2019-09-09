function go_to(page,id)
{
    window.location=page+"?"+id;
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
        url:  ui_url+"cms/ajax/newsletter_manage.php",
        data: datastring+"&action=newsletter_delete",
        success: function(data) {
            //alert(data);
            if(data==0){   
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html("Newsletter deletion failed");
                $('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/cms/manage_newsletter.php"; },1000)
            }else{
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html("Newsletter deleted successfully");
                $('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/cms/manage_newsletter.php"; },1000)
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
        url:ui_url+"cms/ajax/newsletter_manage.php",
        data:"accountIds="+accountIds+"&action=delete_multiple_newsletter",
        type:"POST",
        success:function(suc)
        {
            if(suc==1 || suc!=1)
            {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html("Newsletter deleted successfully");
                $('#success_modal').modal();
                setTimeout(function(){ window.location=site_url+"ui/admin/cms/manage_newsletter.php"; },1000)
            }
            else
            {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html("Newsletter deleted successfully");
                $('#success_modal').modal();
                setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
            }
        }
    })
}
