function go_to(page,att)
{   
    window.location=page+"?"+att; 
}
function resetSearch()
{
    get_dataajax_data('','data_table_1');
}



function get_dataajax_data(cond,table_id)
{
    var parameters='';
	
	$('input:checkbox').removeAttr('checked');
	
    $('#'+table_id).dataTable().fnDestroy();
	
    if(cond){ parameters="?"+cond; }
    
    $('#'+table_id)
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"ajax/datatable_ajax.php"+parameters,
            "aoColumns":showFields[0][table_id]
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
function change_status(id,stat)
{
	var idArr = id.split('-');
	var hotelId = idArr[1];
	//alert(extensions_ui_url+"ajax/update_status.php");
	$.ajax({
            url:extensions_ui_url+"ajax/update_status.php",
            data:"id="+hotelId+"&s="+stat,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                       	{
							
							if(stat=='1')
							{
								$("#data_table_state-"+hotelId).html('Active');
								$("#data_table_state-"+hotelId).attr('onclick','change_status(this.id,\'2\')');
							}else{
								$("#data_table_state-"+hotelId).html('Inactive');
								$("#data_table_state-"+hotelId).attr('onclick','change_status(this.id,\'1\')');
							}							
							
						}
						else
						{
						
							alert("There is some error.");
							
						}
                    }
        })
	
}

function delete_multiple_data(userIds)
{
    
    $.ajax({
            url:extensions_ui_url+"ajax/delete.php?action=deleteeventvenue",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                            $("#model_head").html('confirm');
                            $("#model_des").html(' delete');
                            $('#success_modal').modal();
                            get_dataajax_data('','data_table_1');
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
                            
                        }
                    }
        })
}
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function validation_successfull(tp)
{
    //var type=$("#type").val();
	var type="Hotel";
	
        type=capitalizeFirstLetter(type);
		
    var id=$("#eventsId").val();
        switch(tp)
        {
            case "add_event_data":

                var formData = new FormData($('#'+tp)[0]);
				var checkHotel = $("#chekcHotel").val();
				if(checkHotel == 'hotel')
				{
					var redirectUrl = site_url+"admin/hotel/manage_venue";
				}else
				{
					var redirectUrl = site_url+"admin/hotel";
				}
				
                $.ajax({
                            type: "POST",
                            url:  extensions_ui_url+"ajax/addAllData.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                console.log(data);
                                data=JSON.parse(data);

                                if(data['success']=='true')
                                {
                                    if(id=='0')
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html(type+' Added Successfully');
                                        $('#success_modal').modal();
                                        setTimeout(function(){ window.location=redirectUrl; },1000);
                                    }
                                    else
                                    {
                                        $("#model_head").html('confirm');
                                        $("#model_des").html(type+' Updated Successfully');
                                        $('#success_modal').modal();
                                        setTimeout(function(){ window.location=redirectUrl; },1000);
                                    }
                                }
                                else
                                {
                                        $("#model_head").html('Email Already Exist');
                                        $("#model_des").html("error ");
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

function getLocation(check,thisid) 
{
    if(check!='1')
    {
        var id=thisid[thisid.selectedIndex].id;
    }
    else
    {
        var getid=thisid.split('|');
        var cityid=getid[0];
        var id=getid[1];
    }
    $.ajax({
        url:extensions_ui_url+"ajax/getData.php?action=location_get_cityData_by_stateid",
        data: "id="+id,
        type:"POST",
        success:function(suc)
                {   
                     suc=JSON.parse(suc);

                     var htmldata ="<option value=''>Select Location</option>";
                     for(var i=0;i<suc.length;i++)
                    {   var Selected="";
                        if(suc[i]['id']==cityid){
                            Selected="selected";
                        }
                        htmldata+='<option value="'+suc[i]['id']+'" '+Selected+'>'+suc[i]['title']+'</option>';
                    }
                    $("#city").html(htmldata);
                }

        });
}
function GetLatLng()
{
    var address=$("#address").val();
    if(address!=""){

            var datasend={'address':address};
             $.ajax({
                url:extensions_ui_url+"ajax/getData.php?action=location_Latlng",
                data: datasend,
                type:"POST",
                success:function(suc)
                        {   
                             suc=JSON.parse(suc);
                             $("#lat").val(suc['data']['lat']);
                             $("#lng").val(suc['data']['lng']);

                        }
                    });
    }
}

function get_banners()
{

    $('#bannerPopup').modal();
    var iid=$("#eventsId").val();
    var mediaurl=media_url+'images/';
    if(iid!=""){
        $.ajax({
            url:extensions_ui_url+"ajax/getData.php?action=getmedia",
            data:"iid="+iid,
            type:"POST",
            success:function(suc)
                    {
                        
                        var data=JSON.parse(suc);
                            data=data['media'][1][iid];
                            if(data.length>0)
                            {
                                $('#bannerNotAvailable').hide();
                                for (var i = 0; i < data.length; i++) {
                                    var mediaurls=mediaurl+data[i]['mediaName'];
                                    var mediaid=data[i]['id'];
                                    var bannerHtml='';
                                    bannerHtml+='<tr id="data-'+mediaid+'" class="bannertab">';
                                    bannerHtml+='<td><img src="'+mediaurls+'" width="200" height="100" / ></td>';
                                    bannerHtml+='<td><a data-original-title="Delete" onclick="deletepre(this.id)" id="'+mediaid+'" class="btn btn-default btn-sm deleteprevious" title=""><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
                                    bannerHtml+='</tr>';
                                    $("#imagesdata").append('<input type="hidden" name="mediaid[]" value="'+mediaid.trim()+'" id=""  />');
                                    $('.bannerTable').append(bannerHtml);
                                }
                            }
                    }
        })
    }
    $('#bannerPopup').modal();
}
function show_banner(imageData)
{
    var newdata=new Array();
    newdata=imageData;
    var mediaid="";    
    mediaid=manage_banners('bannerManage');
    
    $('#bannerNotAvailable').hide();
    var bannerHtml='';
    bannerHtml+='<tr id="newbanner-'+mediaid+'" class="newbanner">';
        bannerHtml+='<td><img src="'+imageData['showImg']+'" width="200" height="100" / ></td>';
        bannerHtml+='<td><a data-original-title="Delete" onclick="removenewbanner(this.id)" id="'+mediaid+'" class="btn btn-default btn-sm" title=""><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
    bannerHtml+='</tr>';
    $("#imagesdata").append('<input type="hidden" name="mediaid[]" value="'+mediaid.trim()+'" id="newdata-'+mediaid+'"  />');
    $('.bannerTable').append(bannerHtml);
}

function manage_banners(tp)
{
    
    var formData = new FormData($('#'+tp)[0]);
    var returnData="";
    $.ajax({
                type: "POST",
                url:  site_url+"extensions/events_and_venues/ui/admin/ajax/addBanner.php",
                data: formData,
                async: false,
                success: function(data) {
                    
                    data=JSON.parse(data);
                    returnData = data['data'];

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function(){
                      alert('error handing here');
                }
            }); 
        return returnData;
}

function deletepre(id) {
$.ajax({
        type: "POST",
        url:  site_url+"webservices/delete_media",
        data: "id="+id,
        success: function(data) {
        $("#data-"+id).remove();
        if($(".bannertab").length==0){
        $("#bannerNotAvailable").html("<td colspan='3'>Banners not available</td>");
        $("#bannerNotAvailable").show();
        }
        }
    });
}
function removenewbanner(id){ 
        $("#newbanner-"+id).remove();
        $("#newdata-"+id).remove();
        if($(".newbanner").length==0){
        $("#bannerNotAvailable").html("<td colspan='3'>Banners not available</td>");
        $("#bannerNotAvailable").show(); }
    }
