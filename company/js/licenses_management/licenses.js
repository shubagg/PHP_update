function validation_successfull(tp)
{
    switch(tp)
    {
        case "updateServerConfiguration":
            var formData = new FormData($('#updateServerConfiguration')[0]);
            $.ajax({
                type: "POST",
                url: admin_ui_url + "licenses_management/ajax/licenses.php?action=updateServerConfiguration",
                data: formData,
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data['success'] == 'true')
                    {
                        $("#model_head").html(ui_string['confirm']);
                        $("#model_des").html("Expiry date Updated successfully");
                        $('#success_modal').modal();
                        //setTimeout(function(){ window.location=userDetailurl; },1000);
                        setTimeout(function () {
                            location.reload();
                        }, 2000)
                    } else
                    {
                        if (data['error_code'] == '116')
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("error code : 116 " + data['data']);
                            $('#success_modal').modal();
                            setTimeout(function () {
                                location.reload();
                            }, 2000)
                        } else if(data['error_code'] == '55002') {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("No call url found for this company");
                            $('#success_modal').modal();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("Expiry date Request Failed");
                            $('#success_modal').modal();
                            setTimeout(function () {
                                location.reload();
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
        case "ipAddress":
        var formData = new FormData($('#updateIpAddress')[0]);      
        $.ajax({
            type: "POST",
            url:  admin_ui_url+"licenses_management/ajax/licenses.php?action=IPrequest",
            data: formData,
            async: false,
            success: function(data) {

               data=JSON.parse(data);

                if(data['success']=='true')
                {
                    $("#model_head").html(ui_string['confirm']);
                    $("#model_des").html("Ip Address Updated successfully");
                    $('#success_modal').modal();
                    //setTimeout(function(){ window.location=userDetailurl; },1000);
                    setTimeout(function(){ location.reload(); },2000)
                }
                else
                {
                    if(data['error_code']=='116')
                    {   
                        $("#model_head").html(ui_string['notconfirm']);
                        $("#model_des").html("error code : 116 "+data['data']);
                        $('#success_modal').modal();
                        setTimeout(function(){ location.reload(); },2000)
                    }
                    else
                    {
                        $("#model_head").html(ui_string['notconfirm']);
                        $("#model_des").html("Licenses Request Failed");
                        $('#success_modal').modal();
                        setTimeout(function(){location.reload(); },2000);
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
        
        case "startLicenses":
        var formData = new FormData($('#makeLicenses')[0]);
       
        $.ajax({
                    type: "POST",
                    url:  admin_ui_url+"licenses_management/ajax/licenses.php?action=lrequest",
                    data: formData,
                    async: false,
                    success: function(data) {
                       
                       data=JSON.parse(data);
                        
                        if(data['success']=='true')
                        {
                            $("#model_head").html(ui_string['confirm']);
                            $("#model_des").html("Licenses Request Successfully Sended");
                            $('#success_modal').modal();
                            //setTimeout(function(){ window.location=userDetailurl; },1000);
                            setTimeout(function(){ location.reload(); },2000)
                        }
                        else
                        {
                            if(data['error_code']=='116')
                            {   
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html("error code : 116 "+data['data']);
                                $('#success_modal').modal();
                                setTimeout(function(){ location.reload(); },2000)
                            }
                            else
                            {
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html("Licenses Request Failed");
                                $('#success_modal').modal();
                                setTimeout(function(){location.reload(); },2000);
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
        case "po_request_form":
        var formData = new FormData($('#po_request_form')[0]);
       
        $.ajax({
                    type: "POST",
                    url:  admin_ui_url+"licenses_management/ajax/licenses.php?action=po_request",
                    data: formData,
                    async: false,
                    success: function(data) {
                       
                       data=JSON.parse(data);
                        
                        if(data['success']=='true')
                        {
                            $("#model_head").html(ui_string['confirm']);
                            $("#model_des").html("PO Request Successfully Added");
                            $('#success_modal').modal();
                            //setTimeout(function(){ window.location=userDetailurl; },1000);
                            setTimeout(function(){ location.reload(); },2000)
                        }
                        else
                        {
                            if(data['error_code']=='116')
                            {   
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html("error code : 116 "+data['data']);
                                $('#success_modal').modal();
                                setTimeout(function(){ location.reload(); },2000)
                            }
                            else
                            {
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html("PO Request Failed");
                                $('#success_modal').modal();
                                setTimeout(function(){location.reload(); },2000);
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
    }
   
}


function make_licenses(id){      
    $("#id").val(id);
    $('#cng-pwd').html('<button type=\'button\' class=\'btn btn-theme-inverse\' onclick="return validation(\'startLicenses\')">'+ui_string['submit']+'</button>');
    $('#make_licenses').modal('show'); 
}

function update_ip_number(id, ip_address) {
    $("#license_req_id").val(id);
    $('#ip_address').val(ip_address);
    $('#cng-ip').html('<button type=\'button\' class=\'btn btn-theme-inverse\' onclick="return validation(\'ipAddress\')">'+ui_string['submit']+'</button>');
    $('#update_ip_address').modal('show'); 
}

function update_server_license_configuration(id, server_expiry_date) {
    $("#company_id").val(id);
    $('#server_expiry_date').val(server_expiry_date);
    $('#footer_company_server_configuration').html('<button type=\'button\' class=\'btn btn-theme-inverse\' onclick="return validation(\'updateServerConfiguration\')">'+ui_string['submit']+'</button>');
    $('#update_server_configuration').modal('show'); 
}

function assign_license(asid,id)
{
    genericUsersPopup(asid,id);
}

function make_licenses_Status(id)
{
    alert('fdsfs');
        $.ajax({
                    type: "POST",
                    url:  admin_ui_url+"licenses_management/ajax/licenses.php?action=statusupdate",
                    data: "id="+id,
                    success: function(data) {
                       console.log(data);
                       data=JSON.parse(data);
                        
                        if(data['success']=='true')
                        {
                            $("#model_head").html(ui_string['confirm']);
                            $("#model_des").html("Licenses Status Successfully Updated");
                            $('#success_modal').modal();
                            setTimeout(function(){ location.reload(); },2000)
                        }
                        else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("Licenses Status Request Failed");
                            $('#success_modal').modal();
                            setTimeout(function(){location.reload(); },2000);
                        }
                    },
                    error: function(){
                          alert('error handing here');
                    }
        }); 
}

function change_license_status(id)
{
    var statusid = id.split('-');
    statusid = statusid[1];
                $.ajax({
                    type: "POST",
                    url:  admin_ui_url+"licenses_management/ajax/licenses.php?action=licstatusupdate",
                    data: "id="+statusid,
                    success: function(data) {
                       console.log(data);
                       data=JSON.parse(data);
                        
                        if(data['success']=='true')
                        {
                            $("#model_head").html(ui_string['confirm']);
                            $("#model_des").html("Licenses Status Successfully Updated");
                            $('#success_modal').modal();
                            setTimeout(function(){ location.reload(); },2000)
                        }
                        else
                        {
                            $("#model_head").html(ui_string['notconfirm']);
                            $("#model_des").html("Licenses Status Request Failed");
                            $('#success_modal').modal();
                            setTimeout(function(){location.reload(); },2000);  
                        }
                    },
                    error: function(){
                          alert('error handing here');
                    }
                }); 
}

function verify_PO_Number(id,po_number)
{
    var data ="id="+id+"&po_number="+po_number;
    $.ajax({
            type: "POST",
            url:  admin_ui_url+"licenses_management/ajax/licenses.php?action=po_number_verify",
            data: data,
            success: function(data) {
               data=JSON.parse(data);
                if(data['success']=='true')
                {
                    $("#model_head").html(ui_string['confirm']);
                    $("#model_des").html("PO Number Verify Successfully");
                    $('#success_modal').modal();
                    setTimeout(function(){ location.reload(); },2000)
                }
                else
                {
                    $("#model_head").html(ui_string['notconfirm']);
                    $("#model_des").html("Failed");
                    $('#success_modal').modal();
                    setTimeout(function(){location.reload(); },2000);  
                }
            }
     }); 
}