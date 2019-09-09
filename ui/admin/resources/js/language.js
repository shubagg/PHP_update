function makedefault(stringid) 
{
      var datastring="lang="+stringid+"&id="+userId;

      $.ajax({
            url:site_url+'webservices/manage_user',
            data:datastring, 
            method:'POST',
            success:function(data){

                  if(data['success']=='true')
                  {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['defaultlanguagesetsuccessfuly']);
                                    $('#success_modal').modal(); 
                                    setTimeout(function(){ $('#success_modal').modal('hide');},500);
                  }
                  else
                  {
                        $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['somethingwentwrong']);
                                    $('#success_modal').modal(); 
                                    setTimeout(function(){ $('#success_modal').modal('hide');},500);
                  }
            

            }



      });

}


function change_languages(code)
{
      //alert(code);
      $('#code').val(code);
}
function change_confirm_language()
{
$('#confirmlang_modal').modal(); 

      }
function change_panel_language()
{
     var code= $('#code').val();
      var datastring="lang="+code+"&id="+userId;
      $.ajax({
            url:admin_ui_url+"resources/ajax/add_user.php?action=language",
            data:datastring,
            type:"POST",
            success:function(data)
            {
                  data=JSON.parse(data);
                  if(data['success']=='true')
                  {
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['defaultlanguagesetsuccessfuly']);
                        $('#success_modal').modal(); 
                        setTimeout(function(){ $('#confirmlang_modal').modal("toggle"); },1000)
                        setTimeout(function(){ $('#success_modal').modal('hide');location.reload();},1000);
                  }
                  else
                  {
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['somethingwentwrong']);
                        $('#success_modal').modal(); 
                        setTimeout(function(){ $('#confirmlang_modal').modal("toggle"); },1000)
                        setTimeout(function(){ $('#success_modal').modal('hide');location.reload();},1000);
                  }
                  
            }
      })
}