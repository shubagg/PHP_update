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
      url: admin_ui_url+"cms/ajax/breaking_news.php?action=delete_bn",
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

function date_popup(date,id,article_id)
{
  
  $("#timelinepup").modal();
  $("#validity_date").val(date);
  $("#breaking_news_id").val(id);
  $("#article_id").val(article_id);
}

function delte_bn_popup(id)
{
  
  $("#md-effect2").modal();
  $("#bn_id").val(id);
}

function deletebn()
{
  var id=$("#bn_id").val();
  var datastring="id="+id;
  
  $.ajax({
      url: admin_ui_url+"cms/ajax/breaking_news.php?action=delete_bn",
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

function update_bn_date()
{
  var validity_date=$("#validity_date").val();
  var breaking_news_id=$("#breaking_news_id").val();
  var article_id=$("#article_id").val();
   var choose_dates = validity_date.replace(/-/g, '/');
   var dateto=new Date(choose_dates);
   var todatemilesecond=(dateto.getFullYear()+"-"+(dateto.getMonth()+1)+"-"+dateto.getDate());


   var currentdate=new Date();
   var todaydate=(currentdate.getFullYear()+"-"+(currentdate.getMonth()+1)+"-"+currentdate.getDate());
   
   if(Date.parse(todatemilesecond) < Date.parse(todaydate))  
   {
         
        $('#date_err').html(ui_string['valid_date']);
        $("#validity_date").focus();
        return false;

   }
   $("date_err").html("");
  var datastring="id="+breaking_news_id+"&article_id="+article_id+"&validity_date="+todatemilesecond;
  
  $.ajax({
      url: admin_ui_url+"cms/ajax/breaking_news.php?action=update_bn",
      data: datastring,
      type: "POST",
      success: function (data)
      {
        $("#timelinepup").modal("hide");
        if(data==1)
        {
             $("#model_head").html("Success");
            $("#model_des").html("Updated successfully");
            $('#success_modal').modal();
            setTimeout(function(){ location.reload(); },1000);
        }
        
      }
    })
}