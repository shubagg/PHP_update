function go_to_popup(PopupId,groupId,id) 
{
    $.ajax({
            url:extensions_ui_url+"ajax/getData.php?action=attributesData",
            data: id+"&groupId="+groupId,
            type:"POST",
            success:function(suc)
                    {   
                         suc=JSON.parse(suc);
                         $("#id").val(suc['id']);
                         $("#name").val(suc['title']);
                         $("#desc").val(suc['description']);
                         $("#showimage1").find('img').attr('src',suc['image']);
                         $("#product_image").removeClass('required_field');
                        $("#"+PopupId).modal("show");
                    }

            });
    
}
function resetSearch()
{
    get_dataajax_data();
}

function get_dataajax_data()
{
    var groupId="587f0295a3297480103c9869";
	$('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable({
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
            url:extensions_ui_url+"ajax/delete.php",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html('confirm');
                                    $("#model_des").html(' delete');
                                   // $('#success_modal').modal();
                                    get_dataajax_data();
                                    setTimeout(function(){ 
                                    	$('#sure_to_delete').modal('toggle');
                                    	$('#success_modal').modal('toggle');
                                    },1000);
                        }
                        else
                        {
                                $("#model_head").html('not confirm');
                                $("#model_des").html(' delete unsuccess');
                                //$('#success_modal').modal();
                                get_dataajax_data();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('toggle');
                                        $('#success_modal').modal('toggle');
                                    },1000);   
                        }
                    }
        })
}
function validation_successfull(tp)
{
        switch(tp)
        {
            case "amenitiesSubmit":
            var amenitiesid=$("#id").val();

                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/amenitiesSubmit.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                    resetformdata();
                                    if(amenitiesid=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Amenities Added Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Amenities Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    get_dataajax_data();
                                }
                                else
                                {
                                    $("#model_head").html('notconfirm');
                                    $("#model_des").html("Error try again");
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
        $(".error").html("");
        $('#amenitiesSubmit')[0].reset();
        $("#showimage1").find('img').attr('src',defaultimage);
        $("#product_image").addClass('required_field');
        $("#id").val("0");
    }