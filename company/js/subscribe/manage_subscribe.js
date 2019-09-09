
function callpop(id)
{
	$("#sure_to_delete").modal();
	$("#contactid").val(id);
}

function deletecontactus()
{
	var datastring = $('#deleteData').serialize();
	

	$.ajax({
			url: admin_ui_url+"subscribe/ajax/manage_subscribe.php?action=contact",
			data: datastring,
			type: "POST",
			success: function (data)
			{
				var rec="";
				if(data==1)
				{
						$("#model_head").html(ui_string['confirm']);
			            $("#model_des").html(ui_string['subscribe_delete']);
			            $('#success_modal').modal();
			           setTimeout(function(){ location.reload(); }, 1000);
				}
				
			}
		})
	
}
function excelexportenquery()
{
	var datastring="";

	$.ajax({
			url: admin_ui_url+"subscribe/ajax/export_subscribe.php",
			data: datastring,
			type: "POST",
			success: function (suc)
			{
				    if(suc!="0")
                    {
                        suc=JSON.parse(suc);
                        window.location=suc['data']['path'];        
                    }
                    else
                    {
                        $('#error_head').html(ui_string['error_message']);
                        $('#error_body').html(ui_string['nodataavilable']);
                        $('#error_message').modal();
                        setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
                    }
				
			}
		})

}

function delete_contact(id)
{
    var contact_id=id;
    $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+contact_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="deletecontactus()"><i class=\'glyphicon glyphicon-ok\'></i>Confirm</button>'); //changed by Ayushi
    //$('#sure_to_delete').modal();
}

function export_dashboard_pdfOld(data)
{
    
    var jsonstring = data;
    var imagelogo = assets_url + "admin/img/logo_white_icon.png";
    downloadPDF(jsonstring,'Subscribe List',imagelogo);
}

function export_dashboard_pdf()
{
	var datastring="layout=2";

	$.ajax({
			url: admin_ui_url+"discount/ajax/export_pdf.php",
			data: datastring,
			type: "POST",
			success: function (suc)
			{
				if(suc!=0)
				{
					
					var pdf = suc;
					window.open(pdf);
				}
				else
				{
					$('#error_head').html(ui_string['error_message']);
                    $('#error_body').html(ui_string['nodataavilable']);
                    $('#error_message').modal();
                    setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
				}
				    	
			}
		});

}