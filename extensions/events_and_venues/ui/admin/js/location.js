function go_to_popup(PopupId,countryId,id) 
{
    $.ajax({
            url:extensions_ui_url+"ajax/getData.php?action=location_get_statesData",
            data: id+"&countryId="+countryId,
            type:"POST",
            success:function(suc)
                    {   
                         suc=JSON.parse(suc);
                         $("#id").val(suc['id']);
                         $("#name").val(suc['title']);
                         $("#showimage1").find('img').attr('src',suc['image']);
                         $("#"+PopupId).modal("show");
                    }

            });
    
}
function go_to_city_update_popup(PopupId,stateId,id) 
{
    var id = id.split('=');
	$.ajax({
            url:extensions_ui_url+"ajax/getData.php?action=location_get_cityData",
            data: "id="+id[1]+"&stateId="+stateId,
            type:"POST",
            success:function(suc)
                    {  
						 suc=JSON.parse(suc);
                         $("#cityid").val(suc['id']);
                         $("#stateId").val(suc['stateId']);
                         $("#cityname").val(suc['title']);
						 $("#"+PopupId).modal("show");
                    }

            });
    
}
function go_to_city_popup(PopupId,stateId,id) 
{
    $.ajax({
            url:extensions_ui_url+"ajax/cityPopup.php",
            data: id+"&stateId="+stateId,
            type:"POST",
            success:function(suc)
                    {   
                         $("#stateId").val("");
                         $("#stateId").val(stateId);
                         $("#append_city_data").html(suc);
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
    
	$('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
    $('#data_table_1')
        .dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"ajax/datatable_ajax_location.php",
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
            url:extensions_ui_url+"ajax/delete.php?action=deleteStatelocation",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html('confirm');
                                    $("#model_des").html('State Deleted Successfully');
                                    $('#success_modal').modal();
                                    $('#cityPopup').modal('hide');
                                    $('#sure_to_delete').modal('hide');
                                    $('#success_modal').modal('hide');
                                    get_dataajax_data();
                        }
                        else
                        {
                                $("#model_head").html('not confirm');
                                $("#model_des").html('Delete unsuccess');
                                $('#success_modal').modal();
                                    setTimeout(function(){ 
                                        $('#sure_to_delete').modal('toggle');
                                        $('#success_modal').modal('toggle');
                                    },1800);   
                        }
                    }
        })
}
function delete_data_temp_city(id,stateId)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_data_city(\''+userIds+'\',\''+stateId+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+' confirm'+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        if(allCheckedArrayValues.length)
        {
            var userIds=allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_data_city(\''+userIds+'\',\''+stateId+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+' confirm'+'</button>');
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

function delete_multiple_data_city(userIds,stateId)
{
    $.ajax({
            url:extensions_ui_url+"ajax/delete.php?action=deletecitylocation",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $(".modal").modal('hide');
                                    $("#model_head").html('confirm');
                                    $("#model_des").html('Location Deleted Successfully');
                                    $('#success_modal').modal();
                                    $("#cityaddPopup").modal('hide');
                                    $('#cityPopup').modal('hide');
                                	$('#sure_to_delete').modal('hide');
                                	$('#success_modal').modal('hide');
                                    setTimeout(function(){ go_to_city_popup('cityPopup',stateId,''); },100);

                        }
                        else
                        {
                                $("#model_head").html('not confirm');
                                $("#model_des").html('Delete unsuccess');
                                $('#success_modal').modal();
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
            case "locationSubmit":
            var stateIdshow=$("#id").val();
                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/locationSubmit.php?action=addstate",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                console.log(data);
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                     resetformdata();
                                    if(stateIdshow=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('State Added Successfully');
                                        $('#success_modal').modal();
                                        $("#amenitiesPopup").modal('toggle');
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);

                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('State Updated Successfully');
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
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                             
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
            
              case "cityaddPopupSubmit":
              var cityidshow=$("#cityid").val();
                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/locationSubmit.php?action=addcity",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {

                                    $(".modal").modal('hide');
                                    resetformdataccity();
                                    if(cityidshow=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Location Added Successfully');
                                        $('#success_modal').modal();
                                        $("#cityaddPopup").modal('hide');
                                        $("#cityPopup").modal("hide");
                                        $('#success_modal').modal("hide");
                                        setTimeout(function(){ go_to_city_popup('cityPopup',data['data']['stateId'],''); },100);

                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html('Location Updated Successfully');
                                        $('#success_modal').modal();
                                        $("#cityaddPopup").modal('hide');
                                        $("#cityPopup").modal("hide");
                                        $('#success_modal').modal("hide");
                                        setTimeout(function(){ go_to_city_popup('cityPopup',data['data']['stateId'],''); },100);
                                    }
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

    $(".closestate").click(function(){
        resetformdata();
    });

    $(".closecity").click(function(){
        resetformdataccity();
    });
    function resetformdata()
    {
     $('#locationSubmit')[0].reset();
     $("#id").val("0");
     $("#showimage1").find('img').attr('src',defaultimage);
    }
    function resetformdataccity()
    {
     //$('#cityaddPopupSubmit')[0].reset();
     $("#cityname").val("");
     $("#cityid").val("0");
    }
    