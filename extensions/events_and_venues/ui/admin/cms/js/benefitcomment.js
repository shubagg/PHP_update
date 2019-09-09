function validation_successfull(tp)
{

        switch(tp)
        {
            case "benefitCSubmit":
                var formData = new FormData($('#'+tp)[0]);
                
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"cms/ajax/benefitCSubmit.php",
                            data: formData,
                            success: function(data) { 
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
        $('#benefithead').html('Add Benefit Comment');         
    });

  function resetformdata()
  {
    $(".error").html("");
    $('#benefitCSubmit')[0].reset();
     $("#cid").val("0");
  }
function go_to_popup_comment(message,id,tp) 
{
   $('#benefithead').html('Update Benefit Comment');
    
    $.ajax({
            url:extensions_ui_url+"cms/ajax/benefitGetComment.php",
            data: id,
            type:"POST",
            success:function(suc)
                    { 
                         suc=JSON.parse(suc);
                         $("#comment").val(suc[0]['comment']);
                         $("#cid").val(suc[0]['id']);
                         $("#client").val(suc[0]['cname']);
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
    $.ajax({
            url:extensions_ui_url+"cms/ajax/delete_benefitcomment.php",
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
function resetSearch()
{
    $('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"cms/ajax/datatable_ajax_benefitcomment.php",
            "aoColumns":showFields[0]['data_table_1']
        } );
}