function validation_successfull(tp)
{
    //alert(tp);
    switch (tp)
    {
        case "addUser":
            //alert(tp);
            var role = [];

            $(".check_box_role:checked").each(function () {
                role.push($(this).val());
            });
            var type = $("input[name='type']:checked").val();
            $('#eattender').html('');
            if (type == '' || type == undefined)
            {
                $('#eattender').html(ui_string['type_error']);
                return false;
            } else if (type == 'attender')
            {
                var machine = [];
                $(".ads_Checkbox_machine:checked").each(function () {
                    machine.push($(this).val());
                });
                if (machine == '')
                {
                    $('#eattender').html(ui_string['machine_error']);
                    return false;
                } else {
                }
            } else {
            }
            var formData = new FormData($('#addUser')[0]);
            formData.append('role', role);
            if (machine != '' && machine != undefined)
            {
                formData.append('machine', machine);
            }
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php",
                data: formData,
                async: false,
                success: function (data) {
                    //alert(data);
                    data = JSON.parse(data);
                    //alert(data);
                    if (data['success'] == 'true')
                    {
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['user_success']);
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=userDetailurl; },1000);
                        setTimeout(function () {
                            window.location = site_url + 'admin/userDetail';
                        }, 1000);
                    } else
                    {
                        if (data['error_code'] == '1015')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['already_exist']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000);
                        } else if (data['error_code'] == '116')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("error code : 116 " + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000);
                        } else if (data['error_code'] == '201')
                        {
                            $("#model_des").html(data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000);

                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['user_unsuccess']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000);
                        }
                    }

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
            break;


        case "editUser":
            var role = [];
            $(".check_box_role:checked").each(function () {
                role.push($(this).val());
            });
            var type = $("input[name='type']:checked").val();
            $('#eattender').html('');
            if (type == '' || type == undefined)
            {
                $('#eattender').html(ui_string['type_error']);
                return false;
            } else if (type == 'attender')
            {
                var machine = [];
                $(".ads_Checkbox_machine:checked").each(function () {
                    machine.push($(this).val());
                });

                if (machine == '' || machine == undefined)
                {
                    $('#eattender').html(ui_string['machine_error']);
                    return false;
                } else {
                }
            } else {
            }
            var formData = new FormData($('#addUser')[0]);
            formData.append('role', role);
            if (machine != '' && machine != undefined)
            {
                formData.append('machine', machine);
            }
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php",
                data: formData,
                async: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data['success'] == 'true')
                    {
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['user_update_success']);
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=userDetailurl; },1000);
                        setTimeout(function () {
                            window.location = site_url + 'admin/userDetail';
                        }, 1000);
                    } else
                    {
                        if (data['error_code'] == '116')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("error code : 116 " + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000)
                        } else if (data['error_code'] == '201')
                        {
                            $("#model_des").html(data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000);

                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['user_update_unsuccess'] + " <br/>" + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000);
                        }

                    }

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
        break;

        case "changePassword":
            var formData = new FormData($('#changePassword')[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=change_password",
                data: formData,
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data['success'] == 'true')
                    {
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['passwordchaneSuccess']);
                        $('#success_modal').modal();
                        setTimeout(function () {
                            window.location = site_url + "admin";
                        }, 2000)
                    } else
                    {
                        if (data['errorcode'] == '120')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['wrongCode']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 2000);
                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['passwordnotUpdate']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 2000);
                        }
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
            break;

        case "modifyUser":
            var formData = new FormData($('#addUser')[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=modify_user",
                data: formData,
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data['success'] == 'true')
                    {
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['profileUpdate']);
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=profile; },1000)
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    } else
                    {
                        if (data['error_code'] == '201')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000);
                            return;
                        }
                        if (data['errorcode'] == '116')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("error code : 116 " + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000)
                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['profileUpdateNot']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000);
                        }
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
            break;
            case "updateProfileImage":
            var formData = new FormData($('#updateProfileImage')[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=update_profile_image",
                data: formData,
                async: false,
                success: function (data) {
                    //alert(data);
                    data = JSON.parse(data);
                    if (data['success'] == 'true') {
                        setTimeout(function () {
                            $('#md-effect1').modal("toggle");
                        }, 1000);
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['user_image_update_success']);
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=profile; },1000)
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    } else
                    {
                        if (data['errorcode'] == '116')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("error code : 116 " + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000)
                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['user_image_unsuccess']);
                            $("#model_des").html(data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000);
                        }
                    }

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
            case "form-signin":
                //var datastring = $('#addUser').serialize();
                 setloader();
                 var formData = new FormData($('#'+tp)[0]);
                $.ajax({
                            type: "POST",
                            url:  admin_ui_url+"resources/ajax/add_user.php?action=admin_login",
                            data: formData,
                            async: false,
                            success: function(data) {
                                data=JSON.parse(data);
                                var dt=data['data']['data'];
                                var checkType=typeof data['data']['data'];
                                if(checkType=='object'){ dt=JSON.stringify(data['data']['data']); }
                                            if (data['success'] == 'true')
                                {
                                    $("#captcha_code").val("");
                                    $("#captcha-div").hide();
                                    $("#ecaptcha_code").html("");
                                    $("#eusername").html("");
                                    setTimeout(function () {
                                        window.location = dashboardUrl;
                                    }, 1000)
                                } else
                                {
                                    unloading();
                                    $("#captcha_code").val("");
                                    $("#captcha-div").show();
                                    $("#captcha_code").addClass("required_field");
                                    if (data['data']['failed_login_attempt'] >= 1)
                                    {

                                    }
                                    if (data['error_code'] == '201') {
                                        data = data['data'];
                                        $("#eusername").html(data);
                                        $("#ecaptcha_code").html("");

                                        return;
                                    }

                                    if (data['error_code'] == '1600')
                                    {
                                        $("#captcha").html(data['data']['captcha_code']);
                                        $("#eusername").html(ui_string['1600']);
                                        $("#ecaptcha_code").html("");

                                    } else if (data['error_code'] == '116')
                                    {  // $("#captcha").html(data['data']);
                                        $("#eusername").html(data['data'] + " N/A");
                                        $("#ecaptcha_code").html("");
                                    } else if (data['error_code'] == '1602')
                                    {
                                        $("#captcha").html(data['data']['captcha_code']);
                                        $("#eusername").html(ui_string['1602']);
                                        $("#ecaptcha_code").html("");
                                    } else if (data['error_code'] == '1603')
                                    {
                                        $("#captcha").html(data['data']['captcha_code']);
                                        $("#eusername").html(ui_string['1603']);
                                        $("#ecaptcha_code").html("");
                                    } else if (data['error_code'] == '100')
                                    {
                                        $("#captcha").html(data['data']['captcha_code']);
                                        $("#ecaptcha_code").html(ui_string['100']);
                                        $("#eusername").html("");

                                    } else if (data['error_code'] == '1500')
                                    {
                                        $("#captcha").html(data['data']['captcha_code']);
                                        $("#ecaptcha_code").html("No License Available");
                                        $("#eusername").html("");

                                    } else
                                    {
                                        $("#captcha").html(data['data']['captcha_code']);
                                        if(data['data']['data']['message']) {
                                            $("#eusername").html(data['data']['data']['message']);
                                        } else {
                                            $("#eusername").html(ui_string['1036']);
                                        }
                                        $("#ecaptcha_code").html("");
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


        case "updatePassword":
            var formData = new FormData($('#updatePassword')[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=pwd_change",
                data: formData,
                async: false,
                success: function (data) {
                    // alert(data);
                    data = JSON.parse(data);
                    if (data['success'] == 'true')
                    {

                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['passwordUpdat']);
                        $('#success_modal').modal();
                        setTimeout(function () {
                            $('#success_modal').modal("toggle");
                        }, 1000);
                        setTimeout(function () {
                            $('#md-effect').modal("toggle");
                        }, 1000);


                    } else
                    {

                        if (data['errorcode'] == '116')
                        {

                            $("#eold_password").html(ui_string['passwordUpdatNot']);
                        } else if (data['errorcode'] == '2')
                        {

                            $("#eold_password").html(ui_string['wrong_pwd']);
                        } else
                        {

                            //$("#eold_password").html(ui_string['passwordUpdatNot']);
                            //$("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 3000);
                            return;
                        }
                    }

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
            break;


        case "changePwd":

            var formData = new FormData($('#changePwd')[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=change_user_password",
                data: formData,
                async: false,
                success: function (data) {
                    //alert(data);
                    data = JSON.parse(data);

                    if (data['success'] == 'true')
                    {
                        setTimeout(function () {
                            $('#editPwd').modal("toggle");
                        }, 1000);

                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['user_password_update_success']);
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=changePassword; },2000);
                        setTimeout(function () {
                            location.reload();
                        }, 1000)

                    } else
                    {
                        if (data['errorcode'] == '116')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("error code : 116 " + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000)
                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['user_password_unsuccess']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000);
                        }
                    }

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
            break;


        case "urgency":

            var formData = new FormData($('#urgencyForm')[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=update_urgency",
                data: formData,
                async: false,
                success: function (data) {
                    //alert(data);
                    data = JSON.parse(data);

                    if (data['success'] == 'true')
                    {
                        setTimeout(function () {
                            $('#urgencyModal').modal("toggle");
                        }, 1000);

                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html(ui_string['12071']);
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=urgencyUrl; },2000);
                        setTimeout(function () {
                            location.reload();
                        }, 1000)

                    } else
                    {
                        if (data['errorcode'] == '116')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("error code : 116 " + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000)
                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html(ui_string['12072']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                $('#success_modal').modal("toggle");
                            }, 1000);
                        }
                    }

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    alert('error handing here');
                }
            });
            break;

        case "form-forgot":
            var formData = $("#form-forgot").serialize();
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=forgot_password",
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data['success'] == 'true')
                    {
                        $('#eemail').css('color', 'green');
                        $("#eemail").html(ui_string['12078']);
                        setTimeout(function () {
                            $("#eemail").html("");
                        }, 3000);

                    } else
                    {
                        if (data['error_code'] == '1798')
                        {
                            $("#eemail").html(ui_string['1798']);
                        } else
                        {
                            $("#eemail").html(ui_string['12079']);
                        }
                        $('#eemail').css('color', 'red');
                        setTimeout(function () {
                            $("#eemail").html("");
                        }, 3000);
                    }
                    $('#email').val('');
                },

            });

            break;
        case "importuser":

            var formData = new FormData($('#' + tp)[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "resources/ajax/add_user.php?action=fileimport",
                data: formData,
                async: false,
                success: function (data) {
                    //alert(data);
                    data = JSON.parse(data);

                    if (data['success'] == 'true')
                    {
                        setTimeout(function () {
                            $('#import_modal').modal("toggle");
                        }, 2000);

                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html('user import successfully');
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=userDetail; },2000);
                        setTimeout(function () {
                            location.reload();
                        }, 1000)

                    } else
                    {

                        $("#model_head").html(ui_string['notconfirm']);
                        $("#model_des").html(data['data']);
                        $('#success_modal').modal();
                        setTimeout(function () {
                            $('#success_modal').modal("toggle");
                        }, 3000);

                    }

                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
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


function delete_user_data() {

    var datastring = $('#deleteData').serialize();
    $.ajax({
        type: "POST",
        url: admin_ui_url + "resources/ajax/add_user.php",
        data: datastring,
        success: function (data) {
            //alert(data);
            if (data == 0) {
                $("#model_head").html(ui_string['notconfirm']);
                $("#model_des").html(ui_string['user_delete_unsuccess']);
                $('#success_modal').modal();
                setTimeout(function () {
                    $('#success_modal').modal("toggle");
                }, 1000)
            } else {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['user_delete']);
                $('#success_modal').modal();
                setTimeout(function () {
                    window.location = admin_ui_url + "resources/resources.php";
                }, 1000)
            }
        },
        error: function () {
            alert('error handing here');
        }
    });


}

function delete_users_temp(id)
{
    if (id)
    {
        var userIds = $('#' + id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_users(\'' + userIds + '\')"><i class=\'glyphicon glyphicon-ok\'></i>' + ui_string['confirm'] + '</button>');
        $('#sure_to_delete').modal();
    } else
    {
        if (allCheckedArrayValues.length)
        {
            var userIds = allCheckedArrayValues.toString();
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_multiple_users(\'' + userIds + '\')"><i class=\'glyphicon glyphicon-ok\'></i>' + ui_string['confirm'] + '</button>');
            $('#sure_to_delete').modal();
        } else
        {

            $('#error_head').html(ui_string['error_message']);
            $('#error_body').html(ui_string['select_text_box_error']);
            $('#error_message').modal();
            setTimeout(function () {
                $('#error_message').modal('toggle');
            }, 1500);
        }
    }
}

function delete_multiple_users(userIds)
{
    //alert(userIds);
    $.ajax({
        url: admin_ui_url + "resources/ajax/delete_users.php",
        data: "user_ids=" + userIds+"&_csrf="+$('#_csrf').val(),
        type: "POST",
        success: function (suc)
        {
            //alert(suc);
            suc = JSON.parse(suc);
            if (suc['success'] == 'true')
            {
                $("#model_head").html(ui_string['confirm']);
                $("#model_des").html(ui_string['user_delete']);
                $('#success_modal').modal();
                //setTimeout(function(){ window.location=userDetailurl; },1000);
                setTimeout(function () {
                    location.reload();
                }, 1000)
            } else
            {
                if (suc['errorcode'] == '116')
                {
                    $("#model_head").html(ui_string['notconfirm']);
                    $("#model_des").html("error code : 116 " + ui_string['user_delete_unsuccess']);
                    $('#success_modal').modal();
                } else
                {
                    $("#model_head").html(ui_string['notconfirm']);
                    $("#model_des").html(ui_string['user_delete_unsuccess']);
                    $('#success_modal').modal();
                }
            }
        }
    })
}


$(function () {
    $('input[type="checkbox"]').bind('click', function () {
        var txt = $(this).next('span').text();
        var ischecked = $(this).is(':checked');
        if (ischecked) {

            if (txt == 'Narrator') {
                $(".narrator").show();
            }
            if (txt == 'Writer') {
                $(".writer").show();
            }
        }
        if (!ischecked) {
            if (txt == 'Narrator') {
                $(".narrator").hide();
            }
            if (txt == 'Writer') {
                $(".writer").hide();
            }
        }


    });
});

var _URL = window.URL || window.webkitURL;
$('#profile_picture').on("change", function () {

    var fileExtension = ["jpg", "JPG", "PNG", "png", "JPEG", "jpeg", "gif", "GIF"];

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        // alert("Only '.jpeg','.jpg' formats are allowed.");
        //document.getElementById('eprofile_picture').html = "Please select only jpeg/png/gif file";
        //document.getElementById('profile_picture').value="";
        $("#eprofile_picture").html("Please select only jpeg/png/gif file");
        $("#profile_picture").val("");
        $('#blah').attr('src', admin_assets_url + 'img/avatar.png');


    } else if (this.files[0].size > 2097152)
    {
        //document.getElementById('eprofile_picture').html = "Please upload less than 1mb images";
        //document.getElementById('profile_picture').value="";
        $("#eprofile_picture").html("Please upload less than 1mb images");
        $("#profile_picture").val("");
        $('#blah').attr('src', admin_assets_url + 'img/avatar.png');
    }
    /*    else if((file = this.files[0])) {  
     if (this.files && this.files[0]) 
     {
     var FR= new FileReader();
     FR.onload = function(e) {
     
     imagebaseType= e.target.result;
     };       
     FR.readAsDataURL( this.files[0] );
     
     imageType=this.files[0].type;
     }   
     
     img = new Image();
     img.onload = function ()
     {
     var w=this.width;
     var h=this.height;
     
     var file, img;
     if(w!=h)
     {
     $("#profile_picture").val("");
     $("#eprofile_picture").html("Please Select A Image Of Same Width And Height ");
     $('#blah').attr('src', admin_assets_url+'img/addg.png');
     
     }
     else
     {
     $('#blah').attr('src',imagebaseType);
     }
     
     };
     img.src = _URL.createObjectURL(file);
     }*/
    else {

        $("#eprofile_picture").html("");
        readURL(this);

    }


});


$('#profile_picture1').on("change", function () {

    var fileExtension = ["jpg", "JPG", "PNG", "png", "JPEG", "jpeg", "gif", "GIF"];

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {

        $("#eprofile_picture").html("Please select only jpeg/png/gif file");
        $("#profile_picture1").val("");
        $("#vprofile_picture").val("");



    } else if (this.files[0].size > 2097152)
    {

        $("#eprofile_picture").html("Please upload less than 1mb images");
        $("#profile_picture1").val("");
        $("#vprofile_picture").val("");

    } else {

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
    var classes = $('#' + id).attr('class');

    /*if(document.getElementById('chk-'+id).checked==true)
     {
     $('.checkbox-'+id).prop('checked',true);
     }  
     else
     {
     $('.checkbox-'+id).prop('checked',false);
     }  
     */

    if ($('.parent-' + id).hasClass('active1'))
    {
        $('#icon-' + id).addClass('fa-plus-square');
        $('#icon-' + id).removeClass('fa-minus-square');
        $('.parent-' + id).removeClass(classes);
        $('.parent-' + id).removeClass('active1');
        $('.parent-' + id).hide();
    } else
    {
        $('#icon-' + id).addClass('fa-minus-square');
        $('#icon-' + id).removeClass('fa-plus-square');
        $('.parent-' + id).addClass('active1');
        $('.parent-' + id).addClass(classes);
        $('.parent-' + id).show();
    }
}


function show_roomes(id)
{
    var classes = $('#' + id).attr('class');

    /*if(document.getElementById('chk-'+id).checked==true)
     {
     $('.checkbox-'+id).prop('checked',true);
     }  
     else
     {
     $('.checkbox-'+id).prop('checked',false);
     }  
     */

    if ($('.parent1-' + id).hasClass('activen'))
    {
        $('#icon1-' + id).addClass('fa-plus-square');
        $('#icon1-' + id).removeClass('fa-minus-square');
        $('.parent1-' + id).removeClass(classes);
        $('.parent1-' + id).removeClass('activen');
        $('.parent1-' + id).hide();
    } else
    {
        $('#icon1-' + id).addClass('fa-minus-square');
        $('#icon1-' + id).removeClass('fa-plus-square');
        $('.parent1-' + id).addClass('activen');
        $('.parent1-' + id).addClass(classes);
        $('.parent1-' + id).show();
    }
}

function check_all_childs(id, name) {

    //alert(name);
    var ischecked = $('#chk-' + id).is(':checked');
    if (ischecked) {
        if (name == 'narrator') {
            // alert(name);
            $(".narrator").show();
        }
        if (name == 'writter') {
            // alert(name);
            $(".writer").show();
        }
    }
    if (!ischecked) {
        if (name == 'narrator') {
            //alert(name);
            $(".narrator").hide();
        }
        if (name == 'writter') {
            // alert(name);
            $(".writer").hide();
        }
    }


}

function reset_form_data(form_name) {
    $('#' + form_name)[0].reset();
}

function cancel_user_registration(form_name) {
    setTimeout(function () {
        window.location = userDetailurl;
    }, 1000);
}

$("input").keypress(function (event) {
    if (event.which == 13) {
        event.preventDefault();
        if ($("#current_process").val() == '2')
        {
            $("#forgot-submit").click();
        } else
        {
            $("#sign-in").click();
        }
    }
});


function get_urgency(id)
{
    var userIds = $('#' + id).attr('data-id');
    $(".error").html("");
    $(".error1").removeClass("parsley-error");
    $.ajax({
        url: admin_ui_url + "resources/ajax/add_user.php?action=get_urgency_data",
        data: "id=" + userIds,
        type: "POST",
        success: function (suc) {
            suc = JSON.parse(suc);
            $("#uId").val(userIds);
            $("#model-title").html(suc['data'][0]['type']);
            $("#type").val(suc['data'][0]['type']);
            $("#no_of_notification").val(suc['data'][0]['no_of_notification']);
            $("#notification_send_after_time").val(suc['data'][0]['notification_send_after_time']);
            $('#cng-pwd').html('<button type=\'button\' class=\'btn btn-theme-inverse\' onclick="return validation(\'urgency\')">' + ui_string['submit'] + '</button>');
            $('#urgencyModal').modal('show');


        }
    });
}
function import_users() {

    $('#import_modal').modal();
    $('#xls_file').val('');
    $('#media_file').val('');
    $('#emedia_file').html('');
    $('#exls_file').html('');
}
$('#xls_file').on("change", function () {
    $("#xls_file1").val("");
    var fileExtension = ["xls", "xlsx"];

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        // alert("Only '.jpeg','.jpg' formats are allowed.");
        //document.getElementById('eprofile_picture').html = "Please select only jpeg/png/gif file";
        //document.getElementById('profile_picture').value="";
        $("#exls_file").html("Please select only xls/xlsx file");
        $("#xls_file").val("");


    } else if (this.files[0].size > 2097152)
    {

        $("#exls_file").html("Please upload less than 2mb file");
        $("#xls_file").val("");

    } else {

        $("#exls_file").html("");
        $("#xls_file1").val("1");
    }


});
$('#media_file').on("change", function () {
    $("#media_file1").val("");
    var fileExtension = ["zip"];

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        // alert("Only '.jpeg','.jpg' formats are allowed.");
        //document.getElementById('eprofile_picture').html = "Please select only jpeg/png/gif file";
        //document.getElementById('profile_picture').value="";
        $("#emedia_file").html("Please upload only zip file");
        $("#media_file").val("");


    } else if (this.files[0].size > 2097152)
    {

        $("#emedia_file").html("Please upload less than 2mb file");
        $("#media_file").val("");

    } else {

        $("#emedia_file").html("");
        $("#media_file1").val("1");
    }


});


function getLogsData()
{
    var starttime = $("#starttime").val();
    var endtime = $("#endtime").val();
    var mid = $("#mid").val();
    var smid = $("#smid").val();
    var type = $("#type").val();
    var data = "starttime=" + starttime + "&endtime=" + endtime + "&mid=" + mid + "&smid=" + smid + "&type=" + type;
    $.ajax({
        url: site_url + "templates/admin/resources/logsDetailsAjax.tpl.php",
        data: data,
        type: "POST",
        success: function (suc)
        {
            $("#logsDetails").html(suc);

        }
    });

}
function get_category_users_table(id)
{
    var data = "cond=" + id;
    $.ajax({
        url: site_url + "templates/admin/resources/all_user_info.tpl.php",
        data: data,
        type: "POST",
        success: function (suc)
        {
            $("#panel_" + id).html(suc);

        }
    });
}
//for in add user panel view password
$(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
function select_user_type(val, type, role)
{
    if (type == 'superadmin')
    {
        if (val == '5cf4c668518be4001e000032')
        {
            $('#attender_div').hide();
            $('#machine_div').show();
            $('#machine').attr('checked', 'checked');
            $('#selected_role').html(role);
            $('#roles_mdal_cancel').click();
        } else
        {
            $('#machine_div').hide();
            $('#attender_div').show();
            $('#selected_role').html(role);
            $('#roles_mdal_cancel').click();
            $('#attender').click();
        }
    }
}

