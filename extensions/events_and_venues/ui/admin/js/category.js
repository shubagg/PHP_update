function go_to_popup(PopupId,groupId,id) 
{
    $.ajax({
            url:extensions_ui_url+"ajax/getData.php?action=attributesData",
            data: id+"&groupId="+groupId,
            type:"POST",
            success:function(suc)
                    {   
                         suc=JSON.parse(suc);
                         
                         $("#name").val(suc['title']);
                         $("#id").val(suc['id']);
                         $("#desc").val(suc['description']);
                         $("#showimage1").find('img').attr('src',suc['image']);
                        $("#"+PopupId).modal("show");
                    }

            });
    
}
function go_to(page,att)
{   
 window.location=page+"&"+att; 
}
function resetSearch()
{
    get_dataajax_data();
}

function get_dataajax_data()
{
    var groupId="587f04eca32974a8103c9869";
	$('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"ajax/datatable_ajax_attributes.php?groupId="+groupId,
            "aoColumns":showFields[0]['data_table_1']
        } );
}

function delete_data_temp(id)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_data(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+' confirm'+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        if(allCheckedArrayValues.length)
        {
            var userIds=allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_data(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+' confirm'+'</button>');
            $('#sure_to_delete').modal();
        }
        else
        {
        
            $('#error_head').html('Error Message');
            $('#error_body').html('Please Select At Least One Check Box');
            $('#error_message').modal();
            setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
        }  
    }  
}

function delete_multiple_data(userIds)
{
    
    $.ajax({
            url:extensions_ui_url+"ajax/delete.php?action=category",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html('confirm');
                                    $("#model_des").html(' Deleted');
                                    $('#success_modal').modal();
                                    get_dataajax_data();
                                    setTimeout(function(){ 
                                    	$('#sure_to_delete').modal('toggle');
                                    	$('#success_modal').modal('toggle');
                                    },1000);
                        }
                        else if(suc['errorcode']=='160003'){
                                $("#model_head").html('not confirm');
                                $("#model_des").html(suc['data']);
                                $('#success_modal').modal();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('toggle');
                                        $('#success_modal').modal('toggle');
                                    },1000);
                        }
                        else
                        {
                            
                                $("#model_head").html('not confirm');
                                $("#model_des").html(' delete unsuccess');
                                $('#success_modal').modal();
                                 get_dataajax_data();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('toggle');
                                        $('#success_modal').modal('toggle');
                                    },1000);
                            
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
        dt='0'
    }
    $.ajax({
        url:extensions_ui_url+"ajax/update_status.php",
        data:"user_id="+user_id+"&tp="+dt,
        type:"POST",
        success:function(suc)
                {
                    suc=JSON.parse(suc);
                    var msg_head='';
                    var msg_body='';
                    if(suc['success']=='true')
                    {
                        $('#'+id).attr('data-status',status)
                        $('#'+id).css('border-color',color);
                        $('#'+id).css('color',color);
                        msg_head='confirm';
                        msg_body='status success';
                        
                    }
                    else
                    {
                        msg_head='not confirm';
                        msg_body='status unsuccess';
                    }
                    $("#model_head").html(msg_head);
                    $("#model_des").html(msg_body);
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal('toggle'); },2000);
                     unloading();
                }
    })
}

function validation_successfull(tp)
{
        switch(tp)
        {
            case "categorySubmit":
                var Categoryid=$("#id").val();
                if(Categoryid=='0'){
                   var image= $("#product_image").val();
                   if(image=="")
                   {
                    $("#eshowimage1").html("Please select image");
                    return false;
                   }
                }
                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/categorySubmit.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                    resetformdata();
                                    if(Categoryid=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Department Added Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Category Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    get_dataajax_data();
                                    
                                }
                                else
                                {
                                    $("#model_head").html('notconfirm');
                                    $("#model_des").html('user_unsuccess');
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
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
    $('#categorySubmit')[0].reset();
     $("#showimage1").find('img').attr('src',defaultimage);
     $("#id").val("0");
  }