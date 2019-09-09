function go_to_popup(PopupId,groupId,id) 
{
    $("#"+PopupId).modal("show");
    $("#productid").val(groupId);
    var id=id.split('=');
    $("#id").val(id[1]);
}
function go_to_detail_popup(popid,argument,staus,id) 
{
    $("#commentshow").val(argument);   
    $("#statusdetail").html(staus);   
    $("#"+popid).modal("show");
}
function resetSearch()
{
	document.getElementById("sdt").value = "";
	document.getElementById("edt").value = "";
	get_dataajax_data('');
}
function dateSearch()
{
	var checkValidate = true;
	
	var txt = $('#sdt');
	if (txt.val() == '') {
		 document.getElementById('sdt').style.background = '#ffb2b2';
		 checkValidate = false;
	}else {  document.getElementById('sdt').style.background = '#ffffff'; var sdt = $("#sdt").val(); }
	
	var txt = $('#edt');
	if (txt.val() == '') {
		 document.getElementById('edt').style.background = '#ffb2b2';
		 checkValidate = false;
	}else {  document.getElementById('edt').style.background = '#ffffff'; var edt = $("#edt").val(); }
	
	if ((Date.parse(edt) < Date.parse(sdt))) {
        alert("End date should be greater than Start date");
        document.getElementById("edt").value = "";
		checkValidate = false;
    }	
	if(checkValidate)
	{
		var cond = "st_date="+sdt+",en_date="+edt;
		get_dataajax_data(cond);
	}	
}
function get_dataajax_data(cond)
{
	$('input:checkbox').removeAttr('checked');
    $('#data_table_1').dataTable().fnDestroy();
	
	 if(cond != ''){ var parameters="?filter="+cond; }else{ var parameters = '';}
	
    $('#data_table_1')
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": extensions_ui_url+"ajax/datatable_ajax_venuerequest.php"+parameters,
            "aoColumns":showFields[0]['data_table_1']
        } );
}
function validation_submit(tp,status)
{
            var comment=$("#comment").val();
            $("#eTitle").html("");

            if(comment=="")
            {
                $("#eTitle").html("Please enter comment");
            }
            else
            {
            
                $("#statusaddPopupSubmit").append('<input type="hidden" id="changestatus" name="status" value='+status+'>');
                //$("#statusaddPopupSubmit").append('<input type="hidden" id="smid" name="smid" value="2">');
                //$("#statusaddPopupSubmit").append('<input type="hidden" id="type" name="type" value="1">');
                var formData = new FormData($('#'+tp)[0]);
                $('#changestatus').remove();
                $('#smid').remove();
                $('#type').remove();
                $.ajax({
                            type: "POST",
                            url:  site_url+"webservices/update_venue_request",
                            data: formData,
                            async: false,
                            success: function(data) {
                                
                                
                                if(typeof data != 'object')
                                {
                                    data = JSON.parse(data);
                                }
                                
                                if(data['success']=='true')
                                {
                                    resetformdata();
                                    $("#model_head").html('confirm');
                                    $("#model_des").html('user_success');
                                    $('#success_modal').modal();
                                    get_dataajax_data('');
                                    $("#success_modal").modal('hide');
                                    $("#approveaddPopup").modal('hide');
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
        }
}
      $(".close").click(function(){
        resetformdata();         
    });

  function resetformdata()
  {
     $('#statusaddPopupSubmit')[0].reset();
     $("#productid").val("0");
     $("#id").val("0");
  }