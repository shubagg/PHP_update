function validate1()
{
   var id=document.getElementById('id').value;
   if(id=="9")
   {
     id="0";
   }
    $(".valid_error").html('');
    var _csrf = document.getElementById('_csrf').value;
    //alert(_csrf );
    var temp_name = document.getElementById('temp_name').value;
    var event = document.getElementById('event').value;
    var module = document.getElementById('module').value;
    var submodule = document.getElementById('submodule').value;
    var field = document.getElementById('select1').value;
    
    var txt_edit="uu";
    var type = "";
    if(document.getElementById('email').checked==true)
    {
        
        type = 'email';
        
    }
    //if(document.getElementById('sms').checked==true)
    //{
    //    type = 'sms';
    //}
    
   if(temp_name=="")
    {
        $('#name').html("<div>"+ui_string['ent_temp_name']+"</div>");

        document.frm.name.focus();

        return false;
    }
    
    else if(!isNaN(temp_name))
    {
        $('#name').html("<div>"+ui_string['ent_temp_name']+"</div>");

         document.frm.name.focus();  

        return false;
    }
    else if(type=="")
    {
        $('#e_ty').html("<div>"+ui_string['sel_least_one']+"</div>");
 
        return false;
    }
    else if(module.trim()=='')
    {
        $('#module_err').html(ui_string['selc_modu']);
        document.getElementById('module').focus();
        return false;
    } 
    else if(submodule.trim()=='')
    {
        $('#submodule_err').html(ui_string['selc_smodu']);
        document.getElementById('submodule').focus();
        return false;
    }  
    
    else if(event.trim()=='')
    {
        $('#event_err').html(ui_string['selc_event']);
        document.getElementById('event').focus();
        return false;
    }                          
    else
    {  
        for (instance in CKEDITOR.instances) 
        {
            CKEDITOR.instances[instance].updateElement();
        }
        var data= $('#frm').serialize();
        var allData=data+"&action=template_add";
        // var datastring = "temp_name="+temp_name+"&temp_desc="+txt_edit+"&id="+id+"&event_id="+event+"&temp_for="+type+"&module_id="+module+"&field="+field+"&submodule="+submodule+"&action=template_add";


      
        $.ajax({
            type: "POST",
            url:  ui_url+"notification/ajax/template_manage.php",
            data: allData,
            success: function(data) 
            {   
                data = JSON.parse(data);
                //parsedObj = jQuery.parseJSON(data);
                //alert(parsedObj['success']);
                //console.log();
                //alert(data);
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
                        window.location=redirectTempUrl;
                    }, 1000); 
                }
            }
        })
    }
}

function get_events(id)
{
    var str="";
    var e=document.getElementById('module');
    var midevent = e.options[e.selectedIndex].value;
    var pid=$("#module").val();
    if(pid=="")
    {
        str ="<option value=''> Select Event </option>";
        $('#event').html(str);
    }
    else
    {
        var datastring = "module_id="+midevent+"&smidevent="+id+"&action=get_events";
        //alert(datastring);
        $.ajax({
            type: "POST",
            url:  ui_url+"notification/ajax/template_manage.php",
            data: datastring,
            success: function(dt1) 
            {         
                //alert(dt1);
                dt1=JSON.parse(dt1);
                str ="<option value=''> Select Event </option>";
                for(i=0;i<dt1.length;i++)
                {
                    var sel="";
                    if(event_id==dt1[i].eid)
                    {
                        sel='selected';
                    }
                    str +='<option value="'+dt1[i].eid+'" '+sel+'  >'+dt1[i].name+'</option>';
                } 
                $('#event').html(str);
                if(event_id!=0)
                {
                    get_fields();
                }
            }
        })
        
    }
    
}

function get_fields()
{
    var module_id=$("#module").val();
    var event_id=$("#event").val();
    if(event_id=="")
    {
        str ="<option value=''> Select Field </option>";
        $('#select1').html(str);
    }
    else
    {
        var datastring = "module_id="+module_id+"&event_id="+event_id+"&action=get_fields";
        
        $.ajax({
            type: "POST",
            url:  ui_url+"notification/ajax/template_manage.php",
            data: datastring,
            success: function(dt1) 
            {         
                
                dt1=JSON.parse(dt1);
                str ="<option value=''> Select Field </option>";
                
                for(i=0;i<dt1['data'].length;i++)
                {   
                    var sel="";
                    if(field_id==dt1['data'][i].fieldName)
                    {
                        sel='selected';
                    }
                    str +='<option value="'+dt1['data'][i].fieldName+'" '+sel+'  >'+dt1['data'][i].fieldValue+'</option>';
                } 
                $('#select1').html(str);
            }
        })
    }
 
}           

function change(all_val)
{
    var cedit=$("#current_editor").val();
    if(cedit=='en')
    {
        var editor_val='';
    
        editor_val=CKEDITOR.instances.tempDesc_en.getData();

        var find1=/<\/p>/g;

        editor_val=editor_val.replace(find1,"");

        input=editor_val+all_val;

        CKEDITOR.instances.tempDesc_en.setData(input);
    }
    else
    {
        var editor_val='';
    
        editor_val=CKEDITOR.instances.tempDesc_ch.getData();

        var find1=/<\/p>/g;

        editor_val=editor_val.replace(find1,"");

        input=editor_val+all_val;

        CKEDITOR.instances.tempDesc_ch.setData(input);
    }
                 
}

function getlang()
{
    var datastring="";
    $.ajax({
            type: "POST",
            url:  admin_ui_url+"resources/ajax/add_user.php?action=get_lang",
            data: datastring,
            success: function(dt1) 
            {         
                
                dt1=JSON.parse(dt1);
                
            }
        })
}

function chnage_editor(code)
{
    $("#current_editor").val(code);
    get_fields();
}

function go_to(page,id)
{
   // window.location=page+"/"+id;
    window.location=site_url+"admin/"+page+"?id="+id;
}

function delete_template(id)
{
    var template_id=$("#"+id).attr("data-id");
    $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+template_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_template_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
    $('#sure_to_delete').modal();
    //setTimeout(function(){ window.location=site_url+"ui/admin/notification/manage_template.php"; },1000)
}
    
function delete_template_data()
{
    var datastring = $('#deleteData').serialize();
    $.ajax({
        type: "POST",
        url:  ui_url+"notification/ajax/template_manage.php",
        data: datastring+"&action=template_delete",
        success: function(data) {
            //alert(data);
            if(data==0)
            {   
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['template_delete_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function(){ window.location=deleteTempUrl; },1000);
            }else{
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['template_delete']);
                $('#success_modal').modal();
                setTimeout(function(){ window.location=deleteTempUrl; },1000);
            }
        }
    });   
}


function delete_template_temp()
{
    if(allCheckedArrayValues.length)
    {
        var templateIds=allCheckedArrayValues.toString();
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_templates(\''+templateIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
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

function delete_multiple_templates(templateIds)
{
   
    $.ajax({
        url:ui_url+"notification/ajax/template_manage.php",
        data:"templateIds="+templateIds+"&action=delete_multiple_template",
        type:"POST",
        success:function(suc)
        {
            //alert(suc);
            if(suc==1 || suc!=1)
            {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['template_delete']);
                $('#success_modal').modal();
                setTimeout(function(){ window.location=deleteTempUrl; },1000)
            }
            else
            {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['template_delete_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
            }
        }
    })
}

get_events(1);

function get_sub_module(mid)
{
    $("#event").html('<option value=""> Select Event </option>');
    $("#select1").html('<option value=""> Select Field </option>');
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
                if(sub_module_id==submodule[su]['smid'])
                {
                    var smid=$("#submodule").val();
                    if(smid=="")
                    {
                        selected='selected';        
                    }
                    
                }
                str +='<option value='+submodule[su]['smid']+' '+selected+'> '+submodule[su]['name']+'  </option>';
                
            }
        }
    }
    $("#submodule").html(str);

}
