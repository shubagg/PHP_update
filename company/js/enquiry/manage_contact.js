
function callpop(id)
{
	$("#sure_to_delete").modal();
	$("#contactid").val(id);
}
function delete_contact(id)
{  
    //var id=$("#contactid").val();
    
//alert(id);

    $('#deletType').html('<button type="button" onclick="deletecontactus_del(\''+id+'\')" class="btn btn-theme-inverse"> Ok</button>');
    //$('#sure_to_delete').modal();
}
function deletecontactus_del(delid) {
$.ajax({
            url: admin_ui_url+"enquiry/ajax/manage_contact.php?action=contact",
            data: delid,
            type: "POST",
            success: function (data)
            {
                var rec="";
                if(data==1)
                {
                     $("#model_head").html('confirm');
                        $("#model_des").html('Enquiry Deleted Successfully');
                        $('#success_modal').modal();
                        location.reload();
                }
                
            }
        });
} 
/*function deletecontactus()
{

	var id=$("#contactid").val();
	
	var datastring="id="+id;

	$.ajax({
			url: admin_ui_url+"enquiry/ajax/manage_contact.php?action=contact",
			data: datastring,
			type: "POST",
			success: function (data)
			{
				var rec="";
				if(data==1)
				{
						location.reload();
				}
				
			}
		})
	
}*/
function excelexportenquery()
{
	var datastring="";

	$.ajax({
			url: admin_ui_url+"enquiry/ajax/export_contact.php",
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

function export_dashboard_pdf()
{
    var datastring="layout=5";

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


