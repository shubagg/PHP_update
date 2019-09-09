


function validate()
{
    
    var id=document.getElementById('id').value;
    if(id=="9")
    {
      id="0";
    } 
    var slug=document.getElementById('slug').value;
    var icon=document.getElementById('icon').value;
    var subtitle=document.getElementById('subtitle').value;
    var title = document.getElementById('title').value;
    var email = document.getElementById('email').value;
    var mobile = document.getElementById('mobile').value;
    var address = document.getElementById('address').value;
    var weburl = document.getElementById('weburl').value;
    var description = CKEDITOR.instances.editorCk.getData();
    $(".valid_error").html("");
    if(slug=="")
    {
        $('#slug_err').html(ui_string['ent_slug']);
        $("#slug").focus();
        return false;
    }
   /* else if(icon=="")
    {
        $('#icon_err').html(ui_string['ent_icon']);
        $("#icon").focus();
        return false;
    }*/
    /*else if(subtitle=="")
    {
        $('#subtitle_err').html(ui_string['ent_title']);
        $("#subtitle").focus();
        return false;
    }*/
    else if(title.trim()=="")
    {
        $('#title_err').html(ui_string['ent_title_heading']);
        $("#title").focus();
        return false;
    }
    else if(email.trim()=="")
    {
        $('#email_err').html("Please enter email id");
        $("#email").focus();
        return false;
    }
    else if(mobile.trim()=="")
    {
        $('#mobile_err').html("please enter mobile number");
        $("#mobile").focus();
        return false;
    }
    else if(weburl.trim()=="")
    {
        $('#weburl_err').html("please enter web url");
        $("#weburl").focus();
        return false;
    }
    else if(address.trim()=="")
    {
        $('#address_err').html("Please enter address");
        $("#address").focus();
        return false;
    }
    /*else if(description=="")
    {
        $('#description_err').html(ui_string['ent_description']);
        $("#description").focus();
        return false;
    }*/
    
    else
    {
        
         var datastring = "slug="+slug+"&icon="+icon+"&subtitle="+subtitle+"&title="+title+"&email="+email+"&mobile="+mobile+"&weburl="+weburl+"&address="+address+"&id="+id+"&description="+encodeURIComponent(description)+"&action=manage_cms";
       
        $.ajax({
            type: "POST",
            url:  admin_ui_url+"cms/ajax/manage_cms.php",
            data: datastring,
            success: function(data) 
            {         
                
                if(data==2)
                { 
                    $('#slug_err').html(ui_string['exist_slug']);
                    $("#slug").focus();
                }else
                {
                    $("#confirm-click-1").modal("toggle");                                 
                    $("#model_head").html("Success");
                    $('#success_modal').modal();                                 
                    setTimeout(function(){ location.reload(); },1000);
                }  
                
            }
            });
    }

}

function delete_cms(id)
{
    var cms_id=id;
    $('#deletType').html('<input type=\'hidden\' name=\'data_id\' value='+cms_id+' ><button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_cms_data();"><i class=\'glyphicon glyphicon-ok\'></i></button>');
    $('#sure_to_delete').modal();
}
    
function delete_cms_data()
{
    
    
    var datastring = $('#deleteData').serialize();
    $.ajax({
        type: "POST",
        url:  admin_ui_url+"cms/ajax/manage_cms.php",
        data: datastring+"&action=cms_delete",
        success: function(data) 
        {
           
            if(data==0)
            {   
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['delete_unsuccess']);
                $('#success_modal').modal();
                 setTimeout(function(){  window.location=cmspath['cms']; }, 1000);
            }
            else
            {
                $("#model_head").html("Success");
                $("#model_des").html("Deleted Successfully");
                $('#success_modal').modal();
                 setTimeout(function(){ window.location=cmspath['cms'];  }, 1000);
            }
        },
        error: function(){
              alert('error handing here');
        }
    });   
}

