
function hideRestBDiv(tp)
{
    if(tp == 'sms' || tp == 'push')
    {
        $("#accDiv").hide();
        $("#subjDiv").hide();
        $("#ckeditor").hide();
        $("#textboxeditor").show();
    }
    else
    {
        $("#accDiv").show();
        $("#subjDiv").show();
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
    if(type=='email')
    {
        var msg = CKEDITOR.instances.pg_content.getData();
    }
    else
    {
        var msg = document.getElementById('pg_content1').value; 
    }
    
    var acc_id=document.getElementById('acc_id').value.trim();
    var subj=document.getElementById('subj').value.trim(); 

    if(type == '')
    {
        $('#valid_types').html('<font color=red>'+ui_string['sel_type']+'</font>');
        document.getElementById('type').focus();
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
    else if(acc_id=='' && type=='email')
    {
        if(a!=0)
        {
            $('#valid_acc_id').html('<font color=red>'+ui_string['sec_acc']+'</font>');
        }
        else
        {
            $('#valid_acc_id').html("<font color='red'>"+ui_string['cre_acc']+"</font>");
        }
        
        document.getElementById('acc_id').focus();
        return false;
    }
    else if(subj=='')
    {
        $('#valid_cnt_name').html('<font color=red>'+ui_string['ent_sub']+'</font>');
        document.getElementById('subj').focus();
        return false;
    }
    else if(users=='0' && ctgs =='0')
    {
        $('#valid_ctg_id').html('<font color=red>'+ui_string['sel_users']+'</font>');
        document.getElementById('types').focus();
        return false;
    }                                      
    else
    {
        var datastring = "type="+type+"&msg="+msg+"&subject="+subj+"&users="+users+"&ctgId="+ctgs+"&accId="+acc_id+"&action=broadcast";
        $.ajax({
                url:ui_url+"notification/ajax/trigger_manage.php",
                type:"post",
                data:datastring,
                success:function(suc)
                {   
                    $("#confirm-click-1").modal("toggle");                                 
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                }
          })
    }  
}


