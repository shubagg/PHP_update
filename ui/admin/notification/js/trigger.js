var t=0;
var mailtype="";
function on_submit()
{
    var id=document.getElementById('id').value; 
    if(id=="9")
    {
       
        id="0";
        
    }
    var _csrf = document.getElementById('_csrf').value;
    //alert(_csrf);
    var modulenamecheck=$("#module").find(":selected").text();
    var event_id=document.getElementById('event').value; 
    var submoduletri=document.getElementById('submoduletri').value; 
    var module_id=document.getElementById('module').value; 
        
    var temp_id=document.getElementById('temp_id').value;
    
    var acc_id=document.getElementById('acc_id').value.trim();
    
    var subj=document.getElementById('subj').value.trim();     
    
    var types="";//jQuery('input[type=radio][name=types]:checked').val();
    
    var typeofchoose=document.getElementById("types").value;
    var smsmsg=document.getElementById('smstxt').value;
    var other="";
    var types = ""; 
    var ctg_ids = "";   
      
    var x = document.getElementById("types");
    
    for (var i = 0; i < x.options.length; ++i) 
    {
        if(x.options[i].selected ==true )
        {
            if(x.options[i].value!="")
            {
                types += x.options[i].value + ",";
            }
        }
    }  
    types = types.slice(0,-1);
    
    /*
    var y = document.getElementById("ctg_id");
    
    for (var i = 0; i < y.options.length; ++i) 
    {
        if(y.options[i].selected ==true )
        {
            if(y.options[i].value!="")
            {
                ctg_ids += y.options[i].value + ",";
            }
        }
    }  
    ctg_ids = ctg_ids.slice(0,-1);
     */        
    $(".error").html('');
   
   
    var mtemp=$("#mtemp").val();
   
    
    if(module_id=='')
    {
        $('#valid_module_id').html('<font color=red>'+ui_string['sec_module']+'</font>');
        document.getElementById('module').focus();
        return false;
    }          
    else if(submoduletri=="")
    {
        $('#valid_submoduletri').html(ui_string['selc_smodu']);
        document.getElementById('submoduletri').focus();
        return false;
    }
    else if(event_id=='')
    {
        $('#valid_event_id').html('<font color=red>'+ui_string['sec_eve']+'</font>');
        document.getElementById('event').focus();
        return false;
    }
    else if(types=='')
    {
        $('#valid_types').html('<font color=red>'+ui_string['chos_least']+'</font>');
        document.getElementById('types').focus();
        return false;
    }
    if(typeofchoose=="email")
    {
        if(modulenamecheck=="news")
        {
             
            if($("#mailtypechoose").val()=="")
            {
                $("#valid_mailtype_id").html(ui_string['selectone']);
                return false;
            }
            
        }
        if(mailtype!="")
        {
            if(mailtype=="day")
            {
               var houeto= $("#to_hour").val();
               var minto= $("#to_min").val();
               if(houeto=="")
               {
                 $("#valid_choose_id").html(ui_string['penterhour']);
                 return false;
               }
               else if(minto=="")
               {
                 $("#valid_choose_id").html(ui_string['pentermin']);
                 return false;
               }
            }
            else if(mailtype=="weekly")
            {
                var addweek= $("#addweek").val();
                 
                     if(addweek=="")
                     {
                         $("#valid_choose_id").html(ui_string['penterdate']);
                        return false;
                     }
            }
            else if(mailtype=="month")
            {
                    var datefrom= $("#notifromdate").val();
                    if(datefrom=="")
                     {
                         $("#valid_choose_id").html(ui_string['penterweek']);
                         return false;
                     }
            }
        }
         if(temp_id.trim()=='')
        {
            if(t==1)
            {
                $('#valid_temp_id').html('<font color=red>'+ui_string['sec_temp']+'</font>');
            }
            else
            {
                $('#valid_temp_id').html("<font color='red'>"+ui_string['cre_temp']+"</font>");
            }
            document.getElementById('temp_id').focus();
            return false;
         }
        else if(acc_id=='')
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
        /*else if(subj=='')
        {
            $('#valid_cnt_name').html('<font color=red>'+ui_string['ent_sub']+'</font>');
            document.getElementById('subj').focus();
            return false;
        }*/
       else if(id=="0")
        {
            var newstab="";
            var mailtypevalue="";
           if(modulenamecheck=="news")
           {
                if(mailtype=="day")
                {
                    newstab=houeto+":"+minto;
                    
                }
                else if(mailtype=="weekly")
                {
                    newstab=addweek;
                }
                else if(mailtype=="month")
                {
                     newstab=datefrom;
                }
             mailtypevalue=$('input[name=mailtype]:checked').val();
            }

            smsmsg="";
            var datastring = "eid="+event_id+"&types="+types+"&mid="+module_id+"&smid="+submoduletri+"&action=trigger_check_type";
            $.ajax({
                url:ui_url+"notification/ajax/trigger_manage.php",
                type:"post",
                data:datastring,
                success:function(suc)
                {  
                    data = JSON.parse(suc); 
                    //parsedObj = jQuery.parseJSON(suc); 
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
                        if(suc==1)
                        {
                            var data= $('#frm').serialize();
                            var allData=data+"&ctgId="+ctg_ids+"&mtempId="+mtemp+"&mailInterval="+newstab+"&mailType="+mailtypevalue+"&action=trigger_add";
                           
                            /*var datastring = "event_id="+event_id+"&temp_id="+temp_id+"&subject="+subj+"&types="+types+"&id="+id+"&acc_id="+acc_id+"&module_id="+module_id+'&ctg_id='+ctg_ids+"&mtemp_id="+mtemp+"&submoduletri="+submoduletri+"&smsmsg="+smsmsg+"&newstab="+newstab+"&mailtypevalue="+mailtypevalue+"&action=trigger_add";*/
                        

                            $.ajax({
                                    url:ui_url+"notification/ajax/trigger_manage.php",
                                    type:"post",
                                    data:allData,
                                    success:function(suc)
                                    {   
                                        
                                        $("#confirm-click-1").modal("toggle");                                 
                                        setTimeout(function(){
                                            window.location=redirectManageTriggerUrl;
                                        }, 1000);
                                    }
                              })
                        }
                        else
                        {

                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['trigger_already_exist']);
                            $('#success_modal').modal();
                            setTimeout(function(){ $('#success_modal').modal("hide"); },2000);

                        }
                    }
                }
            })
        }
        else
        {
                var newstab="";
                var mailtypevalue="";
               if(modulenamecheck=="news")
               {
                    if(mailtype=="day")
                    {
                        newstab=houeto+":"+minto;
                        
                    }
                    else if(mailtype=="weekly")
                    {
                        newstab=addweek;
                    }
                    else if(mailtype=="month")
                    {
                         newstab=datefrom;
                    }
                 mailtypevalue=$('input[name=mailtype]:checked').val();
                }
                var data= $('#frm').serialize();
                var allData=data+"&ctgId="+ctg_ids+"&mtempId="+mtemp+"&mailInterval="+newstab+"&mailType="+mailtypevalue+"&action=trigger_add";

                /*var datastring = "event_id="+event_id+"&temp_id="+temp_id+"&subject="+subj+"&types="+types+"&id="+id+"&acc_id="+acc_id+"&module_id="+module_id+'&ctg_id='+ctg_ids+"&mtemp_id="+mtemp+"&submoduletri="+submoduletri+"&smsmsg="+smsmsg+"&newstab="+newstab+"&mailtypevalue="+mailtypevalue+"&action=trigger_add";*/
               
                $.ajax({
                        url:ui_url+"notification/ajax/trigger_manage.php",
                        type:"post",
                        data:allData,
                        success:function(suc)
                        {   
                            
                            $("#confirm-click-1").modal("toggle");                                 
                            setTimeout(function(){
                                window.location=redirectManageTriggerUrl;
                            }, 1000);
                        }
                  })
        }
    }
    if(typeofchoose=="sms" || typeofchoose=="push")
    {
       
      /* if(smsmsg=="")
       {
            $('#valid_sms_name').html(ui_string['ent_sms']);
            document.getElementById('smstxt').focus();
            return false;
       }*/
      if(id=="0")
       {
        
        var datastring = "eid="+event_id+"&types="+types+"&mid="+module_id+"&smid="+submoduletri+"&action=trigger_check_type";
            $.ajax({
                url:ui_url+"notification/ajax/trigger_manage.php",
                type:"post",
                data:datastring,
                success:function(suc)
                {   
                   
                    if(suc==1)
                    {
                        
                        temp_id="";
                        acc_id="";
                        subj="";
                        var data= $('#frm').serialize();
                        var allData=data+"&ctgId="+ctg_ids+"&mtempId="+mtemp+"&mailInterval="+newstab+"&mailType="+mailtypevalue+"&action=trigger_add";
                       
                        /*var datastring = "event_id="+event_id+"&temp_id="+temp_id+"&subject="+subj+"&types="+types+"&id="+id+"&acc_id="+acc_id+"&module_id="+module_id+'&ctg_id='+ctg_ids+"&mtemp_id="+mtemp+"&submoduletri="+submoduletri+"&smsmsg="+smsmsg+"&action=trigger_add";*/
                        
                       $.ajax({
                                url:ui_url+"notification/ajax/trigger_manage.php",
                                type:"post",
                                data:allData,
                                success:function(suc)
                                {   
                                    
                                    $("#confirm-click-1").modal("toggle");                                 
                                    setTimeout(function(){
                                        window.location=redirectManageTriggerUrl;
                                    }, 1000);
                                }
                          });

                    }
                    else
                    {

                        $("#model_head").html(ui_string['notconfirm']);
                        $("#model_des").html(ui_string['trigger_already_exist']);
                        $('#success_modal').modal();
                        setTimeout(function(){ $('#success_modal').modal("hide"); },2000);

                    }
                 }
             })

       }
       else
       {
        var data= $('#frm').serialize();
        var allData=data+"&ctgId="+ctg_ids+"&mtempId="+mtemp+"&mailInterval="+newstab+"&mailType="+mailtypevalue+"&action=trigger_add";
        /*var datastring = "event_id="+event_id+"&temp_id="+temp_id+"&subject="+subj+"&types="+types+"&id="+id+"&acc_id="+acc_id+"&module_id="+module_id+'&ctg_id='+ctg_ids+"&mtemp_id="+mtemp+"&submoduletri="+submoduletri+"&smsmsg="+smsmsg+"&action=trigger_add";*/
       
            $.ajax({
                    url:ui_url+"notification/ajax/trigger_manage.php",
                    type:"post",
                    data:allData,
                    success:function(suc)
                    {   
                        
                        $("#confirm-click-1").modal("toggle");                                 
                        setTimeout(function(){
                            window.location=redirectManageTriggerUrl;
                        }, 1000);
                    }
              })
       }
    }
                                        
    
}

function get_events_triger(id)
{
    var str="";
    var mid=$("#module").val();
    if(mid=="")
    {
        str ="<option value=''> Select Event </option>";
        $('#event').html(str);
    }
    else
    {
        var datastring = "module_id="+mid+"&smidevent="+id+"&action=get_events";
        $.ajax({
            type: "POST",
            url:  ui_url+"notification/ajax/trigger_manage.php",
            data: datastring,
            success: function(dt1) 
            {         
                dt1=JSON.parse(dt1);
                str ="<option value=''> Select Event </option>";
                for(i=0;i<dt1.length;i++)
                {
                    var sel="";
                    if(eventid==dt1[i].eid) 
                    {
                        sel='selected';
                    }
                    str +='<option value="'+dt1[i].eid+'" '+sel+'  >'+dt1[i].name+'</option>';
                } 
                $('#event').html(str);
                if(eventid!=0)
                {
                    get_templates();
                }
            }
        })
    }
}

function checktype()
{
    get_templates();
    hideRestDiv();
}

function get_templates()
{
    var module_id=$("#module").val();
    var event_id=$("#event").val();
    var smid=$("#submoduletri").val();
    if(event_id=="")
    {
        str ="<option value=''> Select Template </option>";
        $('#select1').html(str);
    }
    else
    {
        var datastring = "module_id="+module_id+"&smidtemp="+smid+"&event_id="+event_id+"&action=get_me_templates";
        $.ajax({
            type: "POST",
            url:  ui_url+"notification/ajax/trigger_manage.php",
            data: datastring,
            success: function(dt1) 
            {         
                dt1=JSON.parse(dt1);
                str ="<option value=''> Select Template </option>";
                str1 ="<option value=''> Select Template </option>";
                for(i=0;i<dt1.length;i++)
                {
                    t=1;
                    var sel="";
                    if(temp_id==dt1[i].id)
                    {
                        sel='selected';
                    }
                    
                    var sel1="";
                    if(mtemp_id==dt1[i].id)
                    {
                        sel1='selected';
                    }
                    str +='<option value="'+dt1[i].id+'" '+sel+'  >'+dt1[i].tempName+'</option>';
                    str1 +='<option value="'+dt1[i].id+'" '+sel1+'  >'+dt1[i].tempName+'</option>';
                } 
                $('#temp_id').html(str);
                $('#mtemp').html(str1);
            }
        })
    }
 
}           

function showtempdiv()
{
    var y = document.getElementById("ctg_id");
    var ctg_ids = "";   
    for (var i = 0; i < y.options.length; ++i) 
    {
        if(y.options[i].selected ==true )
        {
            if(y.options[i].value!="")
            {
                ctg_ids += y.options[i].value + ",";
            }
        }
    }  
    ctg_ids = ctg_ids.slice(0,-1);
    if(ctg_ids=="")
    {
        $("#tempdiv").hide();
    }
    else
    {
        $("#tempdiv").show();
    }
    
}

function go_to(page,id)
{
    //window.location=page+"/"+id;
    window.location=site_url+"admin/"+page+"?id="+id;
}

function delete_trigger(id)
{
    var trigger_id=$("#"+id).attr("data-id");
    $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+trigger_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_trigger_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
    $('#sure_to_delete').modal();
}
    
function delete_trigger_data()
{
    var datastring = $('#deleteData').serialize();
    $.ajax({
        type: "POST",
        url:  ui_url+"notification/ajax/trigger_manage.php",
        data: datastring+"&action=trigger_delete",
        success: function(data) {
            
            if(data==0)
            {   

                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['trigger_delete_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function(){ location.reload(); },1000)
            }else{
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['trigger_delete']);
                $('#success_modal').modal();
                setTimeout(function(){ location.reload(); },1000)
            }
        },
        error: function(){
              alert('error handing here');
        }
    });   
}


function delete_trigger_temp()
{
    if(allCheckedArrayValues.length)
    {
        var triggerIds=allCheckedArrayValues.toString();
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_triggers(\''+triggerIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        $('#error_head').html(ui_string['error_message']);
        $('#error_body').html(ui_string['select_text_box_error']);
        $('#error_message').modal();
        setTimeout(function(){ location.reload(); },1500);
    }    
}

function delete_multiple_triggers(triggerIds)
{
   
    $.ajax({
        url:ui_url+"notification/ajax/trigger_manage.php",
        data:"triggerIds="+triggerIds+"&action=delete_multiple_trigger",
        type:"POST",
        success:function(suc)
        {
            if(suc==1 || suc!=1)
            {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['trigger_delete']);
                $('#success_modal').modal();
                setTimeout(function(){ location.reload(); },1000)
            }
            else
            {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['trigger_delete_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function(){ location.reload(); },1000)
            }
        }
    })
}

get_events_triger(1);

function get_submodule_triger(mid)
{
    //$("#event").html('<option value=""> Select Event </option>');
    
    var jsonres= JSON.parse(module_res);
     var str ="<option value=''> Select Sub-Module </option>";
     
    for(var i=0;i<jsonres.length;i++)
    {
        if(jsonres[i]['id']==mid)
        {
            var submodule=jsonres[i]['submodule']
            for (var su =0; su<submodule.length;su++)
            {
                var selected="";
                if(smidtri==submodule[su]['smid'])
                {
                   
                   
                    selected='selected';        
                                       
                } 
                str +='<option value='+submodule[su]['smid']+' '+selected+'> '+submodule[su]['name']+'  </option>';
                
            }
        }
    }
    $("#submoduletri").html(str);

}
function hideRestDiv()
{
    var type=$("#types").val();
    var modulename=$("#module").find(":selected").text();
    //var submodulename=$("#submoduletri").val();
    //var eventname=$("#event").val();

    if(type=="sms" || type=="push")
    {
        $("#tempDiv").hide();
        $("#smsDiv").show();
        $("#accDiv").hide();
        $("#subjDiv").hide();
        $("#mailtype").hide(); 

    }
    else
    {
        $("#tempDiv").show();
        $("#smsDiv").hide();
        $("#accDiv").show();
        $("#subjDiv").show();
        
        if(modulename=="news")
         {
            $("#mailtype").show(); 
         }
         if(mailTypeget!="0")
        {
            show_mail_type(mailTypeget);    
        }
        
    }

}
function show_mail_type(timeinterval)
{
    
    $("#show_time").hide();
    $("#show_calendar").hide();
    $("#show_week").hide();
   
    mailtype=timeinterval;    
    var staric="<font color='red'>*</font>";
    if(timeinterval=="day")
    {
        $("#timeinterval").show();
        $("#time_name").html(ui_string['time']+staric);
        $("#show_time").show();
        $("#show_calendar").hide();
        $("#show_week").hide();

    }
    else if(timeinterval=="month")
    {
        $("#timeinterval").show();
        $("#time_name").html(ui_string['date']+staric);
        $("#show_time").hide();
        $("#show_calendar").show();
        $("#show_week").hide();
    }
    else if(timeinterval=="weekly")
    {
        $("#timeinterval").show();
        $("#time_name").html(ui_string['day']+staric);
        $("#show_time").hide();
        $("#show_calendar").hide();
        $("#show_week").show();
    }
}