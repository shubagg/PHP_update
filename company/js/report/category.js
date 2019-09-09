function cat_validation_successfull(tp)
{
   // alert(tp);
    switch(tp)
    {
        case "addCategory":
            var datastring = $('#'+tp).serialize();
            $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/category.php",
                        data: datastring,
                        success: function(data) {
                            data=JSON.parse(data);
                            
                            if(data['success']=='true')
                            {
                                $("#model_head").html(resourse['confirm']);
                                $("#model_des").html(resourse['category_success']);
                                $('#success_modal').modal();
                                setTimeout(function(){ window.location=admin_ui_url+"resources/resources.php"; },1000)
                            }
                            else
                            {
                                $("#model_head").html(resourse['notconfirm']);
                                $("#model_des").html(resourse['category_unsuccess']);
                                $('#success_modal').modal();
                                setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                            }
                        },
                        error: function(){
                              alert('error handing here');
                        }
            }); 
        break;
        
       case "updateCategory":
            var datastring = $('#addCategory').serialize();
            $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/category.php",
                        data: datastring,
                        success: function(data) {
                            data=JSON.parse(data);  
                            if(data['success']=='true')
                            {
                                $("#model_head").html(resourse['confirm']);
                                $("#model_des").html(resourse['category_update']);
                                $('#success_modal').modal();
                                setTimeout(function(){ window.location=admin_ui_url+"resources/resources.php"; },1000);
                            }
                            else
                            {
                                $("#model_head").html(resourse['notconfirm']);
                                $("#model_des").html(resourse['category_update_unsuccess']);
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


function open_add_category(tp,id)
{
    //alert(tp);
    if(tp=='add')
    {
       // alert(tp);
        $('#cat_id').val('0');
        $('#cathead').html(resourse['add_category']);
        $('#groupbut').html('<button type=\'button\' class=\'btn btn-theme-inverse btn_width right bottom-gap\' onclick="return validation(\'addCategory\')"><i class=\'glyphicon glyphicon-plus-sign\'></i>'+resourse['confirm']+'</button>');
        document.getElementById('addCategory').reset();
        
    }
    
    if(tp=='update')
    {

        $.ajax({
                type: "POST",
                url:  admin_ui_url+"resources/ajax/category.php",
                data: "catid="+id,
                success: function(data) {
                    
                    var data=JSON.parse(data);
                    var dt=data['data'][0];
                    $('#categoryname').val(dt['title']);
                    $('#category_code').val(dt['code']);
                    $('#cat_id').val(id);                
                    var pcategory=$("#pcategory").val(dt['parent_id']);
                }
        });
        
        $('#cathead').html(resourse['update_category']);
        $('#groupbut').html('<button type=\'button\' class=\'btn btn-theme-inverse btn_width right bottom-gap\' onclick="return validation(\'updateCategory\')"><i class=\'glyphicon glyphicon-plus-sign\'></i>'+resourse['update']+'</button>');
    }
    
    $('#add_category').modal();
    
}


function delete_category(id)
{ 
    $('#deletType').html('<input type=\'hidden\' name=\'cat_data_id\' value='+id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_category_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+resourse['confirm']+'</button>');
    $('#sure_to_delete').modal();       
}
    
    
    
    
function delete_category_data(){
    
    var datastring = $('#deleteData').serialize();
            $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/category.php",
                        data: datastring,
                        success: function(data) {
                            data=JSON.parse(data);
                            if(data['success']=='true')
                            {
                                $("#model_head").html(resourse['confirm']);
                                $("#model_des").html(resourse['category_delete']);
                                $('#success_modal').modal();
                                setTimeout(function(){ location.reload(); },1000)
                            }
                            else
                            {
                                $("#model_head").html(resourse['notconfirm']);
                                $("#model_des").html(resourse['category_delete_unsuccess']);
                                $('#success_modal').modal();
                                setTimeout(function(){ $('#success_modal').modal("toggle"); },2000)
                            }
                        },
                        error: function(){
                              alert('error handing here');
                        }
            });   
    
    
}
    
    
    function get_category_user()
    {
        var cond=[];
        $("input[name='user_category[]']:checked").each( function () {
       
        cond.push($(this).val());
        });
        
        cond=cond.toString();
        get_dataajax_data(cond);
        $('#basic_search').modal("toggle");
        
    }