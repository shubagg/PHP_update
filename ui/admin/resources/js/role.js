function role_validation_successfull(tp)
{
    switch(tp)
    {
        case "addRole":
            var datastring = $('#'+tp).serialize();
            $('#role_id').val('0');
            $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/role.php",
                        data: datastring,
                        success: function(data) {
                           //alert(data);
                            data=JSON.parse(data);
                           
                           if(data['success']=='true')
                           {
                                $("#model_head").html(ui_string['confirm']);
                                $("#model_des").html(ui_string['role_success']);
                                $('#success_modal').modal();
                                setTimeout(function(){ location.reload(); },1000)
                           }
                           else
                           {
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html(ui_string['role_unsuccess']);
                                $('#success_modal').modal();
                                setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                           }
                           
                        },
                        error: function(){
                              alert('error handing here');
                        }
            }); 
        break;
        
       case "updateRole":
            var datastring = $('#addRole').serialize();
            //alert(JSON.stringify(datastring));
            $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/role.php",
                        data: datastring,
                        success: function(data) {
                             data=JSON.parse(data);
                             
                             if(data['success']=='true')
                             {
                                  $("#model_head").html(ui_string['confirm']);
                                  $("#model_des").html(ui_string['role_update']);
                                  $('#success_modal').modal();
                                  setTimeout(function(){ location.reload(); },1000)
                             }
                             else
                             {
                                  $("#model_head").html(ui_string['notconfirm']);
                                  $("#model_des").html(ui_string['role_update_unsuccess']);
                                  $('#success_modal').modal();
                                  setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                             }                            
                        },
                        error: function(){
                              alert('error handing here');
                        }
            }); 
        break;                 
    }
}

function open_add_roles()
{
  
    $('#rolehead').html(ui_string['role']);
    $('#user_roles').modal();
}

function open_add_role(tp,id)
{
    //alert(tp);
    $('#addRole')[0].reset();
      if(tp=='add')
      {
         // alert(tp);
          $('#role_id').val('');
          $('.ads_Checkbox').removeAttr('checked'); 
          $('#rolehead').html(ui_string['add_role']);
          $('#grouprole').html('<button type=\'button\' class=\'btn btn-theme-inverse btn_width right bottom-gap\' onclick="return validation(\'addRole\')"><i class=\'glyphicon glyphicon-plus-sign\'></i>'+ui_string['confirm']+'</button>');
          document.getElementById('addRole').reset();
      }
      if(tp=='update')
      {
          $('.ads_Checkbox').removeAttr('checked'); 
          var roleid=$('#'+id).attr('data-id');
          //alert(roleid);
          $('#role_id').val(roleid);
          var datastring="roleid="+roleid;
          $.ajax({
                  type: "POST",
                  url:  admin_ui_url+"resources/ajax/role.php",
                  data: datastring,
                  success: function(data) {
                    var data=JSON.parse(data);

                    $('#rolename').val(data['title']);
                    $('#deletable-'+data['deletable']).attr('checked',"checked");
                     $('#specific_to').val(data['specific_to']);
                     if(data['applyToHirarchy']=='1'){ $('#applyToHirarchy').attr('checked',"checked"); }
                     
                    var permission =  data['permission'].toString();
                    var prers = permission.split(",");
                       for(i=0;i<prers.length;i++)
                       {
                        $('#ich-'+prers[i]).attr('checked',"checked");
                       }
                  }   
          });
          
          $('#rolehead').html(ui_string['update_role']);
          $('#grouprole').html('<button type=\'button\' class=\'btn btn-theme-inverse btn_width right bottom-gap\' onclick="return validation(\'updateRole\')"><i class=\'glyphicon glyphicon-plus-sign\'></i> '+ui_string['update']+'</button>');
      }
          $('#add_roles').modal();   
}

function delete_role(id){
      
        var role_id=$("#"+id).attr("data-id");
        $('#deletType').html('<input type=\'hidden\' name=\'role_data_id\' value='+role_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_role_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
        $('#sure_to_delete').modal();
    }
    
function delete_role_data(){
        var datastring = $('#deleteData').serialize();
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"resources/ajax/role.php",
                            data: datastring,
                            success: function(data) {
                               data=JSON.parse(data);
                               if(data['success']=='true')
                               {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['role_delete']);
                                    $('#success_modal').modal();
                                   setTimeout(function(){ location.reload(); },1000)
                               }
                               else
                               {
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['role_delete_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },2000)
                               }  
                            },
                            error: function(){
                                  alert('error handing here');
                            }
                });   
        
        
    }

$(document).ready(function(){
   

    $('#checkrole').change(function() {
        if($(this).is(":checked")) {
           $("input[name='permission[]']").attr('checked','checked');
        }else{
          $("input[name='permission[]']").removeAttr('checked');

        }
     
    });
})

function close_role_model(){

  $('input:checkbox').removeAttr('checked');
  $(".error").html("");
  $('#add_roles').modal("toggle");
}


