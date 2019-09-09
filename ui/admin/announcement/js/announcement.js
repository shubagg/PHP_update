
function hideRestBDiv(tp)
{
    if(tp == 'sms' || tp == 'push')
    {
        $("#ckeditor").hide();
        $("#textboxeditor").show();
    }
    else
    {
        $("#textboxeditor").hide();
        $("#ckeditor").show();
    }
}

function show_childs(id)
{
    var classes = $('#'+id).attr('class');
    
    /*if(document.getElementById('chk-'+id).checked==true)
    {
        $('.checkbox-'+id).prop('checked',true);
    }  
    else
    {
        $('.checkbox-'+id).prop('checked',false);
    }  
    */
    
    if($('.parent-'+id).hasClass('active1'))
    {
        $('#icon-'+id).addClass('fa-plus-square');
        $('#icon-'+id).removeClass('fa-minus-square');
        $('.parent-'+id).removeClass(classes);
        $('.parent-'+id).removeClass('active1');
        $('.parent-'+id).hide();
    }
    else
    {
        $('#icon-'+id).addClass('fa-minus-square');
        $('#icon-'+id).removeClass('fa-plus-square');
        $('.parent-'+id).addClass('active1');
        $('.parent-'+id).addClass(classes);
        $('.parent-'+id).show();
    }
}

function getUsersIds(uids,ctgids)
{
    //alert(uids+""+ctgids);
   // console.log(ctgids);
    //console.log(uids);
    var datastring = "uids="+uids+"&ctgids="+ctgids+"&action=getUsers";
    $.ajax({
                url:ui_url+"notification/ajax/trigger_manage.php",
                type:"post",
                data:datastring,
                success:function(suc)
                {   
                   //alert(suc);
                   if(suc.trim()!='')
                   {
                        var jsonarr = [];
                        jsonarr = suc.split(",");
                        var l = jsonarr.length;
                        var str ='';
                        for(i=0;i<l;i++)
                        {
                            str+='<span class="tag label label-default">'+jsonarr[i]+'</span>';
                        }
                        $("#usertaginput").html(str);
                   }
                }
          })
}

function broadcast()
{
    $(".error").html('');
    var type = document.getElementById('type').value; 
    var users=document.getElementById('enrolled_users_from_popup').value; 
    var ctgs=document.getElementById('enrolled_categories_from_popup').value;  
    var title=document.getElementById('title').value.trim(); 
    var date="";
    //var date=document.getElementById('date').value.trim();
    var customerId=document.getElementById('customerId').value.trim(); 
    var mid=document.getElementById('mid').value.trim();
    var smid=document.getElementById('smid').value.trim(); 
    var eid=document.getElementById('eid').value.trim();
    var id=document.getElementById('id').value.trim(); 
    if(type=='email')
    {
        var msg = CKEDITOR.instances.pg_content.getData();
    }
    else
    {
        var msg = document.getElementById('pg_content1').value; 
    }
    if(type == '')
    {
        $('#valid_types').html('<font color=red>'+ui_string['sel_type']+'</font>');
        document.getElementById('type').focus();
        return false;
    }  
    else if(title=='')
    {
        $('#etitle').html('<font color=red>'+ui_string['atitle']+'</font>');
        document.getElementById('title').focus();
        return false;
    }        
    else if(msg.trim() == '')
    {
        if(type=='email')
        {
            $('#valid_msg').html('<font color=red>'+ui_string['ent_msg']+'</font>');
            document.getElementById('msg').focus();
        }
        else
        {
            $('#valid_msg1').html('<font color=red>'+ui_string['ent_msg']+'</font>');
            document.getElementById('msg1').focus();
        }
        
        return false;
    }
    
    /*else if(date=='')
    {
        $('#edate').html('<font color=red>'+ui_string['adate']+'</font>');
        document.getElementById('date').focus();
        return false;
    }*/
    else if(users=='0' && ctgs =='0')
    {
        $('#valid_ctg_id').html('<font color=red>'+ui_string['sel_users']+'</font>');
        document.getElementById('types').focus();
        return false;
    }                                      
    else
    {
        var datastring = "type="+type+"&msg="+msg+"&title="+title+"&users="+users+"&ctgId="+ctgs+"&date="+date+"&customerId="+customerId+"&mid="+mid+"&smid="+smid+"&eid="+eid+"&id="+id+"&action=broadcast";
        $.ajax({
                url:ui_url+"announcement/ajax/announcement_manage.php",
                type:"post",
                data:datastring,
                success:function(suc)
                {   
                    //alert(suc);
                    $("#confirm-click-1").modal("toggle");                                 
                    setTimeout(function(){
                        $("#confirm-click-1").modal("toggle");
                        window.location.href="noticeBoard.php";
                    }, 3000);
                }
          })
    }  
}


function delete_notice_temp(id)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_notice(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+resourse['confirm']+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        if(allCheckedArrayValues.length)
        {
            var userIds=allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_notice(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+resourse['confirm']+'</button>');
            $('#sure_to_delete').modal();
        }
        else
        {
        
            $('#error_head').html(resourse['error_message']);
            $('#error_body').html(resourse['select_text_box_error']);
            $('#error_message').modal();
            setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
        }  
    }  
}

function delete_multiple_notice(userIds)
{
    //alert(userIds);
    $.ajax({
            url:ui_url+"announcement/ajax/delete_notice.php",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html(resourse['confirm']);
                                    $("#model_des").html("Data successfully deleted");
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location="noticeBoard.php"; },1000)
                        }
                        else
                        {
                            if(suc['errorcode']=='116')
                            {
                                $("#model_head").html(resourse['notconfirm']);
                                $("#model_des").html("error code : 116 Data not deleted");
                                $('#success_modal').modal();
                            }
                            else
                            {
                                $("#model_head").html(resourse['notconfirm']);
                                $("#model_des").html("Data not deleted");
                                $('#success_modal').modal();
                            }
                        }
                    }
        })
}


