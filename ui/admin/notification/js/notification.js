function clearall(userId)
{  //alert("userId="+userId+"&action=clear_notification");
    $.ajax({
        url:ui_url+"/notification/ajax/notification_manage.php",
        data:"userId="+userId+"&action=clear_notification",
        type:"post",
        success:function(suc)
        {
            //alert(suc);
            window.location.reload();
        }
    })
}

$(function(){
    var lastscroll = 10 ;
    $('#nscroll').on('scroll', function() {
        buffer = 40 // # of pixels from bottom of scroll to fire your function. Can be 0
        if ($("#nscroll").prop('scrollHeight') - $("#nscroll").scrollTop() <= $("#nscroll").height() + buffer ) 
        {
            lastscroll++;
            get_next_notification(lastscroll);
        }
    })
      
});

function get_next_notification(lastscroll)
{
    var data="userId="+userId+"&action=get_notification&index="+lastscroll;
    //alert(data);
    $.ajax({
        url:ui_url+"/notification/ajax/notification_manage.php",
        data:"userId="+userId+"&action=get_notification&index="+lastscroll,
        type:"post",
        success:function(suc)
        {
            var a=JSON.parse(suc);
            var l = a['data'].length;
            var str1 ="";
    
            for(i=0;i<l;i++)
            {
                //var nottxt=ui_string['eid'+a['data'][i].eventid];
                var p=window.btoa(a['data'][i].url1);
                var nid = a['data'][i].id;
                var bg ='';
                if(a['data'][i].seen == 0)
                {
                    bg = 'style="background:#F7F7F7"';
                }
                str1 +='<li style="cursor:pointer">';
                str1 +='<section class="thumbnail-in" onclick="gotopage(\''+nid+'\',\''+p+'\','+l+','+l+');" '+bg+'>';
                str1 +='<div class="widget-im-tools tooltip-area pull-right"><span>';
                str1 +='<time class="timeago" datetime="10:10:10T12:12:12">'+a['data'][i].timeago+'</time>';                 
                str1 +='</span></div><h4> '+a['data'][i].t+'</h4>';                                
                str1 +='<div class="pre-text"> '+ui_string['urlGo']+' '+a['data'][i].url1+' </div>';                                                    
                str1 +='</section></li>';           
            }
            $("#appendNTFC").append(str1);
        }
    })
}




function delete_notification_temp(id)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_notification(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        if(allCheckedArrayValues.length)
        {
            var userIds=allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_notification(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
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

function delete_multiple_notification(userIds)
{
    //alert(userIds);
    var data="userIds="+userIds+"&action=delete_notification";
    //alert(data);
    $.ajax({
            url:admin_ui_url+"notification/ajax/notification_manage.php",
            data:data,
            type:"POST",
            success:function(suc)
                    {   
                       // alert(suc);
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['notification_delete']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=notificationUrl; },1000);
                        }
                        else
                        {
                            if(suc['errorcode']=='116')
                            {
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html("error code : 116 "+ui_string['notification_delete_unsuccess']);
                                $('#success_modal').modal();
                            }
                            else
                            {
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html(ui_string['notification_delete_unsuccess']);
                                $('#success_modal').modal();
                            }
                        }
                    }
        })
}


function go_to_notification(gourl,id)
{
    
    var data="id="+id+"&action=update_notification";
    $.ajax({
        url:admin_ui_url+"notification/ajax/notification_manage.php",
        data:data,
        type:"POST",
        success:function(suc)
        {
            window.location.href=site_url+"admin/"+gourl;
            
        }
    });
}


function getCronStatusData()
{
    var starttime=$("#starttime").val();
    var endtime=$("#endtime").val();
    var data="starttime="+starttime+"&endtime="+endtime;
    $.ajax({
        url:site_url+"templates/admin/notification/cronStatusByAjax.tpl.php",
        data:data,
        type:"POST",
        success:function(suc)
        {
            //alert(suc);
            $("#crondata").html(suc);
            
        }
    });

}

function start_cron(cronId,page)
{
    var data="cronId="+cronId+"&action=cron_start";
    //alert(data);
    $.ajax({
        url:site_url+page,
        data:data,
        type:"POST",
        success:function(suc)
        {
            $("#model_head").html(ui_string['confirm']);
            $("#model_des").html(ui_string['cron_message_start']);
            $('#success_modal').modal();
            setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
            
        }
    });
}

function stop_cron(cronId,page)
{
    var data="cronId="+cronId+"&action=cron_stop";
    //alert(data);
    $.ajax({
        url:site_url+page,
        data:data,
        type:"POST",
        success:function(suc)
        {
            $("#model_head").html(ui_string['confirm']);
            $("#model_des").html(ui_string['cron_message_stop']);
            $('#success_modal').modal();
            setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
            
        }
    });
}
