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
      url:  admin_ui_url+"cms/ajax/manage_subscribe.php?action=subscribe",
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


function delte_team_popup(id)
{
	$("#md-effect2").modal();
	$("#contactid").val(id);
}

function deletesubscribe()
{
	var id=$("#contactid").val();
	var datastring="id="+id;

	$.ajax({
			url: admin_ui_url+"cms/ajax/manage_subscribe.php?action=subscribe",
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
