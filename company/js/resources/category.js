function cat_validation_successfull(tp)
{
   //alert(tp);
    switch(tp)
    {
        case "addCategory":
            var datastring = $('#'+tp).serialize();
            $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/category.php",
                        data: datastring,
                        success: function(data) {
                            //alert(data);
                            data=JSON.parse(data);
                            
                            if(data['success']=='true')
                            {
                                $("#model_head").html(ui_string['confirm']);
                                $("#model_des").html(ui_string['department_success']);
                                $('#success_modal').modal();
                                //setTimeout(function(){ window.location=userDetailurl; },1000);
                                 setTimeout(function(){ location.reload(); },1000)
                            }
                            else
                            {
                                if(data['error_code']=='117')
                                {   
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['code_already_exist']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                }
                                else
                                {
                                     $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['department_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                }
                               
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
                            //alert(data);
                            data=JSON.parse(data);  
                            if(data['success']=='true')
                            {
                                $("#model_head").html(ui_string['confirm']);
                                $("#model_des").html(ui_string['department_update']);
                                $('#success_modal').modal();
                                //setTimeout(function(){ window.location=userDetailurl; },1000);
                                 setTimeout(function(){ location.reload(); },1000)
                            }
                            else
                            {
                                if(data['error_code']=='117')
                                {   
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['code_already_exist']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },2000)
                                }
                                else if(data['error_code']=='118')
                                {   
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['root_parent_category_error']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },2000)
                                }
                                else if(data['errorcode']=='119')
                                {   
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['self_parent_error']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },2000)
                                }
                                else
                                {
                                    $("#model_head").html(ui_string['notconfirm']);
                                    $("#model_des").html(ui_string['department_update_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                }
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
        $('#category_code').removeAttr("readonly");
        $(".error").html("");
        $('#cat_id').val('0');
         $('#root_parent_id').val('');
        $('#cathead').html(ui_string['add_department']);
        $('#groupbut').html('<button type=\'button\' class=\'btn btn-theme-inverse btn_width right bottom-gap\' onclick="return validation(\'addCategory\')">'+ui_string['confirm']+'</button>');
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
                    $('#categoryname').val(dt['title1']);
                    $('#category_code').val(dt['code1']);
                    $('#cat_id').val(id); 
                    $('#root_parent_id').val(dt['parent_id']);                 
                    var pcategory=$("#pcategory").val(dt['parent_id']);
                }
        });
        
        $('#cathead').html(ui_string['update_category']);
        $('#groupbut').html('<button type=\'button\' class=\'btn btn-theme-inverse btn_width right bottom-gap\' onclick="return validation(\'updateCategory\')"><i class=\'glyphicon glyphicon-plus-sign\'></i>'+ui_string['update']+'</button>');
    }
    
    $('#add_category').modal();
    
}


function delete_category(id)
{ 
    $('#deletType').html('<input type=\'hidden\' name=\'cat_data_id\' value='+id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_category_data()"><i class=\'glyphicon glyphicon-ok\'></i>'+ui_string['confirm']+'</button>');
    $('#sure_to_delete').modal();       
}
    
    
    
    
function delete_category_data(){
    
    var datastring = $('#deleteData').serialize();
   
            $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/category.php",
                        data: datastring,
                        success: function(data) {
                            
                           // console.log(data);
                            //alert(data);
                            data=JSON.parse(data);
                            if(data['success']=='true')
                            {
                                $("#model_head").html(ui_string['confirm']);
                                $("#model_des").html(ui_string['department_delete']);
                                $('#success_modal').modal();
                                setTimeout(function(){ location.reload(); },1000)
                            }
                            else
                            {
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html(ui_string['department_delete_unsuccess']);
                                $('#success_modal').modal();
                                setTimeout(function(){ $('#success_modal').modal("toggle"); },2000)
                            }
                        },
                        error: function(){
                              alert('error handing here');
                        }
            });   
    
    
}
    
     function define_hierarchy(id)
    {
        $.ajax({
            type: "POST",
            url:  admin_ui_url+"resources/ajax/define_hierarchy.php",
            data: "id="+id,
            success: function(data) {
                }
        });
    }
    
    function admSelectCheck(nameSelect)
    {
        $('#category_code').removeAttr("readonly");
      
   
     $.ajax({
                        type: "POST",
                        url:  admin_ui_url+"resources/ajax/category.php",
                        data: "pcaid="+nameSelect,
                        success: function(data) {
                          
                            data=JSON.parse(data);
                            if(data['success']=='true')
                            {
                                $('#category_code').val(data['data'][0]['code']);
                                $('#category_code').attr("readonly","readonly");
                            }
                            else
                            {
                                $('#category_code').removeAttr("readonly");
                                 $('#category_code').val('');
                            }
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

        //alert(cond);
       
        get_dataajax_data(cond,'data_table_1');

        $('#basic_search').modal("toggle");
        
    }


    function close_cat_model(){
        
      $(".error").html("");
      $('#add_category').modal("toggle");
    }



parent_cats=parent_cats.split(",");
function get_dataajax_data(cond,table_id){
    $('#'+table_id).dataTable().fnDestroy();
    
    var conds=cond.split(',');
    var mainArray='';
  
    for(i=0;i<parent_cats.length;i++)
    {
        var allar='';
        for(j=0;j<conds.length;j++)
        {
            if($('#chk-'+conds[j]+"-1").hasClass('checkbox-'+parent_cats[i]+'-1'))
            {
                allar+=conds[j]+",";
            }
        }
        mainArray+=allar.slice(0,-1)+"|";
    }    
    
    
    $('#'+table_id)
        .dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": admin_ui_url+"resources/ajax/datatable_ajax.php?cond="+cond,
            "aoColumns":showFields[0][table_id]
        } );
}


function update_category_tab_view(cb,id) {
  if(cb.checked)
  {
    var data="tabView=1&id="+id;
  }
  else
  {
    var data="tabView=0&id="+id;
  }
  $.ajax({
        type: "POST",
        url:  admin_ui_url+"resources/ajax/category.php?action=update_category_tab_view",
        data: data,
        success: function(res) {
            location.reload();

        }
    })
}
