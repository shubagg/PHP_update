var allcheckedvalues = '';
function checkAll(ele) 
{
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
}

function getallcheckedvalues()
{
  allcheckedvalues="";
  $("input:checkbox[class=check_box]:checked").each(function () {

      allcheckedvalues+=$(this).val()+"|";
  });
  
  if(allcheckedvalues != '')
  {
    allcheckedvalues = allcheckedvalues.slice(0, -1);
  }

  if(allcheckedvalues == '')
  {
    $("#model_head").html("Error");
    $("#model_des").html("Please select at least one");
    $('#success_modal').modal();
  }
  else
  {
    $("#md-effect3").modal();
  }
}

function deleteallbn()
{
  var datastring="id="+allcheckedvalues;
  $.ajax({
      url:  admin_ui_url+"cms/ajax/manage_list.php?action=contact",
      data: datastring,
      type: "POST",
      success: function (data)
      {
        if(data==1)
        {
            $("#model_head").html("Success");
            $("#model_des").html("Deleted successfully");
            $('#success_modal').modal();
            setTimeout(function(){ location.reload(); },1000);
        }
        
      }
    })
}

function callpop(id)
{
	$("#md-effect2").modal();
	$("#contactid").val(id);
}

function deletecontactus()
{
	var id=$("#contactid").val();
	var datastring="id="+id;

	$.ajax({
			url: admin_ui_url+"cms/ajax/manage_list.php?action=contact",
			data: datastring,
			type: "POST",
			success: function (data)
			{
				var rec="";
				if(data==1)
				{
						$("#model_head").html("Success");
                      	$("#model_des").html("Deleted successfully");
                      	$('#success_modal').modal();
                      	setTimeout(function(){ location.reload(); },1000);
				}
				
			}
		})
	
}
function excelexportenquery()
{
	var datastring="";

	$.ajax({
			url: admin_ui_url+"cms/ajax/export_contact.php",
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


function callenquerypop(id)
{
	

	$.ajax({
			url: admin_ui_url+"cms/ajax/manage_list.php?action=getcontact",
			data: 'id='+id,
			type: "POST",
			success: function (suc)
			{
				   $("#enquerylist").modal();
                   suc=JSON.parse(suc);
                   var msg=suc['data'][0]['info'];
                   $("#appenddatac").html(msg);
				
			}
		})
}
