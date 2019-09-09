    function validation_successfull(tp)
    {
        switch(tp)
        {
            case "addUser":
                var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"resources/ajax/add_user.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                data=JSON.parse(data);
                                //alert(data);
                                if(data['success']=='true')
                                {
                                    $("#model_head").html(resourse['confirm']);
                                    $("#model_des").html(resourse['user_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"resources/tresources.php"; },1000);
                                }
                                else
                                {
                                    if(data['errorcode']=='1015')
                                    {   
                                        $("#model_head").html(resourse['notconfirm']);
                                        $("#model_des").html(resourse['already_exist']);
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                    }
                                    if(data['errorcode']=='1017')
                                    {   
                                        $("#model_head").html(resourse['notconfirm']);
                                        $("#model_des").html(resourse['user_unsuccess']);
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                    }
                                    if(data['errorcode']=='116')
                                    {   
                                        $("#model_head").html(resourse['notconfirm']);
                                        $("#model_des").html("error code : 116 "+data['data']);
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                    }
                                }
                                
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });   
            break;
            
            
            case "editUser":

                 var formData = new FormData($('#addUser')[0]);
               
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"resources/ajax/add_user.php",
                            data: formData,
                            async: false,
                            success: function(data) {
                                data=JSON.parse(data);
                                
                                if(data['success']=='true')
                                {
                                    $("#model_head").html( ['confirm']);
                                    $("#model_des").html(resourse['user_update_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"resources/tresources.php"; },1000);
                                }
                                else
                                {
                                    if(data['errorcode']=='116')
                                    {   
                                        $("#model_head").html(resourse['notconfirm']);
                                        $("#model_des").html("error code : 116 "+data['data']);
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                    }
                                    else
                                    {
                                        $("#model_head").html(resourse['notconfirm']);
                                        $("#model_des").html(resourse['user_update_unsuccess']);
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                                    }
                                }
                                
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });   
            break;
            case "updateProfileImage":
                 //alert("fdhfghdg");
                 var formData = new FormData($('#updateProfileImage')[0]);
               
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"resources/ajax/add_user.php?action=update_profile_image",
                            data: formData,
                            async: false,
                            success: function(data) {
                                data=JSON.parse(data);
                                if(data['success']=='true')
                                {
                                    setTimeout(function(){ $('#md-effect1').modal("toggle"); },1000);

                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html(ui_string['user_image_update_success']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"resources/profile.php"; },2000);
                                }
                                else
                                {
                                    if(data['errorcode']=='116')
                                    {   
                                        $("#model_head").html(ui_string['notconfirm']);
                                        $("#model_des").html("error code : 116 "+data['data']);
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                    }
                                    else
                                    {
                                        $("#model_head").html(ui_string['notconfirm']);
                                        $("#model_des").html(ui_string['user_image_unsuccess']);
                                        $('#success_modal').modal();
                                        setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                                    }
                                }
                                
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            error: function(){
                                  alert('error handing here');
                            }
                });   
            break;

           case "addCategory":
           cat_validation_successfull('addCategory');
           break; 
           
           case "updateCategory":
           cat_validation_successfull('updateCategory');
           break;
           
           case "addRole":
           role_validation_successfull('addRole')
           break;
           
           case "updateRole":
           role_validation_successfull('updateRole')
           break;
            
        }
    }
    
    function delete_user_data(){
        
        var datastring = $('#deleteData').serialize();
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"resources/ajax/add_user.php",
                            data: datastring,
                            success: function(data) {
                                //alert(data);
                                if(data==0){   
                                    $("#model_head").html(resourse['notconfirm']);
                                    $("#model_des").html(resourse['user_delete_unsuccess']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ $('#success_modal').modal("toggle"); },1000)
                                }else{
                                    $("#model_head").html(resourse['confirm']);
                                    $("#model_des").html(resourse['user_delete']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"resources/tresources.php"; },1000)
                                }
                            },
                            error: function(){
                                  alert('error handing here');
                            }
                });   
        
        
    }

function delete_users_temp(id)
{
    if(id)
    {
        var userIds=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_users(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+resourse['confirm']+'</button>');
        $('#sure_to_delete').modal();
    }
    else
    {
        if(allCheckedArrayValues.length)
        {
            var userIds=allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_users(\''+userIds+'\')"><i class=\'glyphicon glyphicon-ok\'></i>'+resourse['confirm']+'</button>');
            $('#sure_to_delete').modal();
        }
        else
        {
        
            $('#error_head').html(resourse['error_message']);
            $('#error_body').html(resourse['select_text_box_error']);
            $('#error_message').modal();
            setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
        }  
    }  
}

function delete_multiple_users(userIds)
{
    $.ajax({
            url:admin_ui_url+"resources/ajax/delete_users.php",
            data:"user_ids="+userIds,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html(resourse['confirm']);
                                    $("#model_des").html(resourse['user_delete']);
                                    $('#success_modal').modal();
                                    setTimeout(function(){ window.location=admin_ui_url+"resources/tresources.php"; },1000)
                        }
                        else
                        {
                            if(suc['errorcode']=='116')
                            {
                                $("#model_head").html(resourse['notconfirm']);
                                $("#model_des").html("error code : 116 "+resourse['user_delete_unsuccess']);
                                $('#success_modal').modal();
                            }
                            else
                            {
                                $("#model_head").html(resourse['notconfirm']);
                                $("#model_des").html(resourse['user_delete_unsuccess']);
                                $('#success_modal').modal();
                            }
                        }
                    }
        })
}


$(function() { 
    $('input[type="checkbox"]').bind('click',function() {
        var txt=$(this).next('span').text();
        var ischecked= $(this).is(':checked');
        if(ischecked){
         
            if(txt=='Narrator'){
            $(".narrator").show();
           }
           if(txt=='Writer'){
            $(".writer").show();
           }   
         }
       if(!ischecked){
        if(txt=='Narrator'){
            $(".narrator").hide();
           }
           if(txt=='Writer'){
            $(".writer").hide();
           }  
        }
        
         
   });
});

var _URL = window.URL || window.webkitURL;
$('#profile_picture').on("change",function () {
  
    var fileExtension = ["jpg","JPG","PNG","png","JPEG","jpeg","gif","GIF"];
     
     if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        // alert("Only '.jpeg','.jpg' formats are allowed.");
        //document.getElementById('eprofile_picture').html = "Please select only jpeg/png/gif file";
        //document.getElementById('profile_picture').value="";
        $("#eprofile_picture").html("Please select only jpeg/png/gif file");
        $("#profile_picture").val("");
         $('#blah').attr('src', admin_assets_url+'img/avatar.png');
        
      
    }
    else if(this.files[0].size > 2097152)
    {
        //document.getElementById('eprofile_picture').html = "Please upload less than 1mb images";
        //document.getElementById('profile_picture').value="";
        $("#eprofile_picture").html("Please upload less than 1mb images");
        $("#profile_picture").val("");
         $('#blah').attr('src', admin_assets_url+'img/avatar.png');
   }
   else{
    
   $("#eprofile_picture").html("");
   readURL(this);
    
   }
   
                 
 });


    $('#profile_picture1').on("change",function () {
  
    var fileExtension = ["jpg","JPG","PNG","png","JPEG","jpeg","gif","GIF"];
     
     if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
       
        $("#eprofile_picture").html("Please select only jpeg/png/gif file");
        $("#profile_picture1").val("");
        $("#vprofile_picture").val("");
         
        
      
    }
    else if(this.files[0].size > 2097152)
    {
       
        $("#eprofile_picture").html("Please upload less than 1mb images");
        $("#profile_picture1").val("");
        $("#vprofile_picture").val("");
        
   }
   else{
    
   $("#eprofile_picture").html("");
   $("#vprofile_picture").val("120");
   
  
    
   }
   
                 
 });  
 
 function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function show_childs(id)
{
    var classes = $('#'+id).attr('class');
    if($('.parent-'+id).hasClass('active1'))
    {
        $('#icon-'+id).addClass('fa-plus-square');
        $('#icon-'+id).removeClass('fa-minus-square');
        $('.parent-'+id).removeClass(classes);
        $('.parent-'+id).removeClass('active1');
        $('.parent-'+id).hide();
    }
    else
    {
        $('#icon-'+id).addClass('fa-minus-square');
        $('#icon-'+id).removeClass('fa-plus-square');
        $('.parent-'+id).addClass('active1');
        $('.parent-'+id).addClass(classes);
        $('.parent-'+id).show();
    }
}


function show_roomes(id)
{
    var classes = $('#'+id).attr('class');
    
    if($('.parent1-'+id).hasClass('activen'))
    {
        $('#icon1-'+id).addClass('fa-plus-square');
        $('#icon1-'+id).removeClass('fa-minus-square');
        $('.parent1-'+id).removeClass(classes);
        $('.parent1-'+id).removeClass('activen');
        $('.parent1-'+id).hide();
    }
    else
    {
        $('#icon1-'+id).addClass('fa-minus-square');
        $('#icon1-'+id).removeClass('fa-plus-square');
        $('.parent1-'+id).addClass('activen');
        $('.parent1-'+id).addClass(classes);
        $('.parent1-'+id).show();
    }
}

function check_all_childs(id,name){

     var ischecked= $('#chk-'+id).is(':checked');
        if(ischecked){
           if(name=='narrator'){
                $(".narrator").show();
           }
           if(name=='writter'){
                $(".writer").show();
           }   
     }
       if(!ischecked){
        if(name=='narrator'){
            $(".narrator").hide();
           }
           if(name=='writter'){
            $(".writer").hide();
           }  
        }
    
    
 }
 
 function reset_form_data(form_name){
    $('#'+form_name)[0].reset();
 }
 
 function cancel_user_registration(form_name){
     $('#blah').attr('src', admin_assets_url+'img/avatar.png');
    $(".error").html("");
    $('#'+form_name)[0].reset();
 }
 
 $("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#sign-in").click();
    }
});


