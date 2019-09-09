function get_dataajax_data_sup(type)
{
    
    $('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"cms/ajax/datatable_ajax_support.php?type="+type,
            "aoColumns":showFields[0]['data_table_1']
        } );
}
function get_dataajax_data_organizer()
{
    $('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"cms/ajax/datatable_ajax_organizer.php",
            "aoColumns":showFields[0]['data_table_1']
        } );
}
function get_dataajax_data_partner()
{
    $('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"cms/ajax/datatable_ajax_partner.php",
            "aoColumns":showFields[0]['data_table_1']
        } );
}
function validate()
{
    
    var id=document.getElementById('id').value;
    if(id=="9")
    {
      id="0";
    } 
    var slug=document.getElementById('slug').value;
    var icon=document.getElementById('icon').value;
    var subtitle=document.getElementById('subtitle').value;
    var title = document.getElementById('title').value;
    var description = CKEDITOR.instances.editorCk.getData();
    $(".valid_error").html("");
    if(slug=="")
    {
        $('#slug_err').html(ui_string['ent_slug']);
        $("#slug").focus();
        return false;
    }
   /* else if(icon=="")
    {
        $('#icon_err').html(ui_string['ent_icon']);
        $("#icon").focus();
        return false;
    }*/
    else if(subtitle=="")
    {
        $('#subtitle_err').html(ui_string['ent_title']);
        $("#subtitle").focus();
        return false;
    }
    else if(title.trim()=="")
    {
        $('#title_err').html(ui_string['ent_title_heading']);
        $("#title").focus();
        return false;
    }
    
    else if(description=="")
    {
        $('#description_err').html(ui_string['ent_description']);
        $("#description").focus();
        return false;
    }
    
    else
    {
        
         var datastring = "slug="+slug+"&icon="+icon+"&subtitle="+subtitle+"&title="+title+"&id="+id+"&description="+encodeURIComponent(description)+"&action=manage_cms";
       
        $.ajax({
            type: "POST",
            url:  extensions_ui_url+"cms/ajax/manage_cms.php",
            data: datastring,
            success: function(data) 
            {         
                
                if(data==2)
                { 
                    $('#slug_err').html(ui_string['exist_slug']);
                    $("#slug").focus();
                }else
                {
                    $("#confirm-click-1").modal("toggle");                                 
                    $("#model_head").html("Success");
                    $('#success_modal').modal();                                 
                    setTimeout(function(){ location.reload(); },1000);
                }  
                
            }
            });
    }

}

function delete_cms(id)
{
    var cms_id=id;
    $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+cms_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_cms_data();"><i class=\'glyphicon glyphicon-ok\'></i></button>');
    $('#sure_to_delete').modal();
}
    
function delete_cms_data()
{
    
    
    var datastring = $('#deleteData').serialize();
    $.ajax({
        type: "POST",
        url:  extensions_ui_url+"cms/ajax/manage_cms.php",
        data: datastring+"&action=cms_delete",
        success: function(data) 
        {
           
            if(data==0)
            {   
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['delete_unsuccess']);
                $('#success_modal').modal();
                 setTimeout(function(){  window.location=cmspath['cms']; }, 1000);
            }
            else
            {
                $("#model_head").html("Success");
                $("#model_des").html("Deleted Successfully");
                $('#success_modal').modal();
                 setTimeout(function(){ window.location=cmspath['cms'];  }, 1000);
            }
        },
        error: function(){
              alert('error handing here');
        }
    });   
}

function validation_successfull(tp)
{

        switch(tp)
        {
            case "benefitSubmit":
                //var benefitid=$("#id").val();
                var formData = new FormData($('#'+tp)[0]);
                
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"cms/ajax/benefitSubmit.php",
                            data: formData,
                            async: false,
                            success: function(data) { console.log(data);
                              data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                        $('#md-message').modal("toggle");
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Benefits Added Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                       
                                        setTimeout(function(){  window.location.reload(); },1000)


                               }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Benefits Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                        //setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)

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
            case "benefitCSubmit":
                var formData = new FormData($('#'+tp)[0]);
                
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"cms/ajax/benefitCSubmit.php",
                            data: formData,
                            async: false,
                            success: function(data) { console.log(data);
                              data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                        $('#md-message').modal("toggle");
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Benefits Added Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                       
                                        setTimeout(function(){  window.location.reload(); },1000)


                               }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Benefits Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                        //setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)

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
      $(".close").click(function(){
        resetformdata();         
    });

  function resetformdata()
  {
    $('#benefitSubmit')[0].reset();
     $("#benefitsid").val("0");
  }

function go_to_popup(message,id,tp) 
{
   $('#benefithead').html('Update Benefit');
    
    $.ajax({
            url:extensions_ui_url+"cms/ajax/benefitGet.php",
            data: id,
            type:"POST",
            success:function(suc)
                    { 

                         suc=JSON.parse(suc);
                         

                         $("#name").val(suc['title']);
                         $("#benefitsid").val(suc['id']);
                         $("#description").val(suc['description']);
                         $("#showimage1").find('img').attr('src',suc['image']);
                         //$('#benefithead').html('Update Benefit');
                         //$('#benefitbut').html('<button type=\'button\' class=\'btn btn-theme-inverse btn_width right bottom-gap\' onclick="return validation(\'addbenefit\')"><i class=\'glyphicon glyphicon-plus-sign\'></i>'+ui_string['update']+'</button>');
                         $("#"+message).modal("show");
                        
                    }



            });

     

}

function delete_data_temp(id)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_benefit(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
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
function delete_benefit(userIds)
{
    //alert(userIds);
    $.ajax({
            url:extensions_ui_url+"cms/ajax/delete_benefit.php",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['user_delete']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);


                                   // setTimeout(function(){ window.location=extensions_ui_url+"cms/benefit"; },1000)
                        }
                        else
                        {
                           $('#model_des').html('Error Code '+suc['error_code']);
                        $('#success_modal').modal();
                        setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
                        }
                    }
        })
}
function delete_data_record(id)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_record(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
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
function delete_record(userIds)
{
    
    $.ajax({
            url:extensions_ui_url+"cms/ajax/delete.php",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['user_delete']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ location.reload(); },1000);


                                   // setTimeout(function(){ window.location=extensions_ui_url+"cms/benefit"; },1000)
                        }
                        else
                        {
                           $('#model_des').html('Error Code '+suc['error_code']);
                        $('#success_modal').modal();
                        setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
                        }
                    }
        })
}
