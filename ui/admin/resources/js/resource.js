function go_to(page,att)
{
    
 window.location=page+"?id="+att; 
}


function go_to_Old(page,att)
{
    
 window.location=page+"/"+att; 
}

function go_to_roomers(id){
    var att="id="+id;
    go_to('roomers.php',att);
    
}



function export_users1()
{
    $.ajax({
        url:admin_ui_url+"resources/ajax/export_users.php",
        success:function(suc)
                {
                    suc=JSON.parse(suc);
                    window.location=suc['data']['path'];
                }
    })
}

function export_users()
{
   var data='';
    $.ajax({
        url:admin_ui_url+"resources/ajax/export_users.php",
        data:data,
        type:"POST",
        success:function(suc)
                {
                   //alert(suc);
                    suc=JSON.parse(suc);
                    if(suc['success']=='false')
                    {
                        $('#error_body').html('No Data To Export');
                        $('#error_head').html('Error');
                        $('#error_foot').html('');
                        $('#error_message').modal();
                        setTimeout(function(){ $('#error_message').modal('toggle'); },2000);
                    }
                    else
                    {
                        if(suc['error_code']=='201')
                        {
                            var data=suc['data'];
                            var path=suc['path'];
                       setTimeout(function(){ window.location=admin_ui_url+"resources/ajax/zipdownload.php?time="+data+"&path="+path; },1000)
                        }
                        else if(suc['error_code']=='100')
                        {
                         window.location=suc['data']['path'];
                        }

                        else
                        {
                            window.location=suc['data']['path'];
                        }
                        
                    }
                }
    })
}
function export_users_demo()
{

   var data='';
    $.ajax({
        url:admin_ui_url+"resources/ajax/import_users_demo.php",
        data:data,
        type:"POST",
        success:function(suc)
                {
                   //alert(suc);
                        suc=JSON.parse(suc);
                        
                        if(suc['error_code']=='100')
                        {
                         window.location=suc['data'];
                        }

                        else
                        {
                            window.location=suc['data'];
                        }
                }
    })
}

function update_status(id)
{
    setloader();
    var cstatus=$('#'+id).attr('data-status');
    var user_id=$('#'+id).attr('data-id');
    var dt='1';
    var color='green';
    var status ='active';
    if(cstatus=='active')
    {
        status = 'inactive';
        color='red';
        dt='0';
    }
    else if(cstatus=='block')
    {
        status = 'active';
        color='green';
        dt='1';
    }
    else if(cstatus=='lock')
    {
        status = 'active';
        color='green';
        dt='1';
    }
    $.ajax({
        url:admin_ui_url+"resources/ajax/update_user_status.php",
        data:"user_id="+user_id+"&tp="+dt,
        type:"POST",
        success:function(suc)
                {
                    //console.log(suc);
                   // alert(suc);
                    suc=JSON.parse(suc);
                    var msg_head='';
                    var msg_body='';
                    if(suc['success']=='true')
                    {
                        $('#'+id).attr('data-status',status)
                        $('#'+id).css('border-color',color);
                        $('#'+id).css('color',color);
                        msg_head=ui_string['confirm'];
                        msg_body=ui_string['user_status_success'];
                        
                    }
                    else
                    {
                        msg_head=ui_string['notconfirm'];
                        msg_body=ui_string['user_status_unsuccess'];
                    }
                    $("#model_head").html(msg_head);
                    $("#model_des").html(msg_body);
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal('toggle'); },2000);
                     unloading();
                    //location.reload();
                }
    })
}


function resetSearch()
{
    

    $('input:checkbox').removeAttr('checked');

    get_dataajax_data('','data_table_1');
}

function close_popup(name){
    $(".error").html("");
   setTimeout(function(){ $('#'+name).modal('toggle'); },1000);
   
}

function open_role_model(){
  $('#roles').modal();
}


function change_password(id){
    //alert(id);
    $(".error").html("");
    $(".error1").removeClass("parsley-error");  
    $.ajax({
        url:admin_ui_url+"resources/ajax/add_user.php?action=get_user_data",
        data:"id="+id,
        type:"POST",
        success:function(suc){
            //alert(suc);
         suc=JSON.parse(suc);
            $("#uId").val(id);
            $("#uname").val(suc['data'][0]['username'].toString()); 
            $("#pwd").val(suc['data'][0]['password'].toString());
            $('#cng-pwd').html('<button type=\'button\' class=\'btn btn-theme-inverse\' onclick="return validation(\'changePwd\')">'+ui_string['submit']+'</button>');
            $('#editPwd').modal('show'); 


         }
        });  
}
