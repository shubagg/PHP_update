<?php
/*Check User Permission*/
if(check_user_permission('rpa', 'allprocess', 'all') != '1' || check_user_permission('rpa', 'allprocess', 'view') != '1') {
    header("location:".site_url()."admin/404");
}
include('../../../global.php');
$userId = is_user_logged_in();
check_user_permission_with_redirect("rpa", "allprocess");
$getuserip = $_SESSION['user']['email'];
get_admin_header();
get_admin_header_menu();
get_admin_left_sidebar();
$checkhighlight = "0";
if (isset($_GET['id']) && $_GET['id'] != "") {
    $checkhighlight = "1";
}
?>
<?php
include_once(include_admin_template("controlTower", "controlTower"));
?>
<style>
.popup {
	width: 100%;
	height: 100%;
	display: none;
	position: fixed;
	top: 0px;
	left: 0px;
	background: rgba(0, 0, 0, 0.75);
	z-index: 9;
}
.popup {
	text-align: center;
}
.popup:before {
	content: '';
	display: inline-block;
	height: 100%;
	margin-right: -4px;
	vertical-align: middle;
}
.popup-inner {
	display: inline-block;
	text-align: left;
	vertical-align: middle;
	position: relative;
	max-width: 500px;
	width: 100%;
	box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
	border-radius: 0px;
	background: #fff;
}
.model-headeer {
	border-bottom: 1px solid;
	border-color: #e5e5e5;
	padding: 13px 20px;
}
.popup-inner h1 {
	font-size: 18px;
}
.popup-inner p {
	font-size: 24px;
	font-weight: 400;
}
.model-bodyy {
	padding: 20px;
	text-align: center;
}
.popup-close {
	width: 34px;
	height: 34px;
	padding-top: 4px;
	display: inline-block;
	position: absolute;
	top: 30px;
	right: 20px;
	-webkit-transform: translate(50%, -50%);
	transform: translate(50%, -50%);
	background: transparent;
	color: #000;
	text-shadow: 0 1px 0 #fff;
	opacity: .2;
}
.popup-close:after, .popup-close:before {
	content: "";
	position: absolute;
	top: 11px;
	left: 5px;
	height: 4px;
	width: 16px;
	border-radius: 30px;
	background: #808080;
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
}
.popup-close:after {
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
}
.popup-close:hover {
	color: #000;
	text-shadow: 0 1px 0 #fff;
	opacity: 1;
}
.popup-close:hover:after, .popup-close:hover:before {}
.tooltip-area1 .fa-plus-circle {
	position: absolute;
	right: -5px;
	top: -11%;
	color: #6cc282;
}
</style>
<script src="<?php echo site_url() . "company/" ?>js/controlTower/control_tower.js"></script>
<script>
    var userId = '<?php echo $userId; ?>';
    var useripaddress = '<?php echo $getuserip; ?>';
    var checkhighlight = "<?php echo $checkhighlight ?>";
    function checkalldata() {}
    function load_page(type, tab_name)
    {
        $.ajaxSetup({
            cache: false
        });
        var loadUrl = site_url + "admin/controller/index.php?type=" + type + "&class=" + tab_name;
        $(".tab-pane").html('');
        $("#" + tab_name).load(loadUrl, function () {
            setTimeout(function () {
                refresh_custom_dt();

                setTimeout(function () {
                    if (checkhighlight == "1") {
                        $("#highlight-<?php echo $_GET['id']; ?>").parent().siblings().css('background-color', '#CD5C5C');
                        $("#highlight-<?php echo $_GET['id']; ?>").parent().css('background-color', '#CD5C5C');
                    }
                }, 1000);

            }, 500);
        });
    }
    load_page('viewlist', 'view');

    function open_configuration()
    {
        var page = "configuration";
        window.location = page;
    }
    
    function configuration_temp(asid, id,count) {
        var machine = $('#highlight-' + asid).parents('tr').find('#machine_select').val();
        var machine_id=$('#highlight-' + asid).parents('tr').find('option:selected').attr('id');
        var ip = useripaddress;
        var run_by = ip;
        if (machine != '' && machine != undefined)
        {
            ip = machine;
        }
        $.ajax({
            type: "POST",
            url: admin_ui_url + "view/ajax/manage.php?action=senddata",
            data: {"id": asid, "ip": ip, "c_id": id, "userId": userId, "run_by": run_by,"count":count,'run_user_id':userId,'machine_id':machine_id},
            success: function (result) {
                $("#model_head").html(ui_string['success']);
                $("#model_des").html("Run Robot.");
                $('#success_modal').modal();
                setTimeout(function () {
                    $('#success_modal').modal("toggle");
                }, 1000);
                refresh_custom_dt();
            }
        });
    }
    function configuration_temp_multiple(asid, id,count) {
        var machine = $('#highlight-' + asid).parents('tr').find('#machine_select').val();
        var machine_id=$('#highlight-' + asid).parents('tr').find('option:selected').attr('id');
        var ip = useripaddress;
        var run_by = ip;
        if (machine != '' && machine != undefined)
        {
            ip = machine;
        }
        $.ajax({
            type: "POST",
            url: admin_ui_url + "view/ajax/manage.php?action=senddata",
            data: {"id": asid, "ip": ip, "c_id": id, "userId": userId, "run_by": run_by,"count":count,'run_user_id':userId,'machine_id':machine_id},
            success: function (result) {
                
            }
        });
    }
    
    function configuration_temp_assign(ids) {
        var useripaddress = $(ids).attr("data-info");
        var id = $(ids).attr("data-id");
        var asid = $(ids).attr("data-asid");
        $.ajax({
            type: "POST",
            url: admin_ui_url + "view/ajax/manage.php?action=senddata",
            data: {"id": asid, "ip": useripaddress, "c_id": id},
            success: function (result) {
                $("#model_head").html(ui_string['success']);
                $("#model_des").html("Run Robot.");
                $('#success_modal').modal();
                setTimeout(function () {
                    $('#success_modal').modal("toggle");
                }, 1000);
                refresh_custom_dt();
            }});
    }
    function assign_robot(asid, id) {
        genericUsersPopup(asid, id);
    }
    function assign_template(userid, id) {
        genericUsersPopupTemplate(userid, id);
    }
    function delete_robot_task(asid, id) {
        $.ajax({
            type: "POST",
            url: admin_ui_url + "view/ajax/manage.php?action=delete_robot",
            data: {"id": id, "asid": asid},
            success: function (result) {
                $("#model_head").html(ui_string['success']);
                $("#model_des").html("Delete Robot.");
                $('#success_modal').modal();
                setTimeout(function () {
                    location.reload();
                }, 1000);
                refresh_custom_dt();
            }});
    }
    function delete_template_data(id) {
        $.ajax({
            type: "POST",
            url: admin_ui_url + "view/ajax/manage.php?action=delete_template",
            data: {"id": id},
            success: function (result) {
                $("#model_head").html(ui_string['success']);
                $("#model_des").html("Delete Template.");
                $('#success_modal').modal();
                setTimeout(function () {
                    $('#success_modal').modal('hide');
                    $('#sure_to_delete').modal('hide');
                    load_page('draftlist','draft');
                }, 1000);
                refresh_custom_dt();
            }});
    }
    function edit_robot(asid, id) {
        window.location = site_url + "admin/configuration?id=" + asid;
    }
    function delete_robot(asid, id)
    {
        if (id)
        {
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_robot_task(\'' + asid + '\',\'' + id + '\')"><i class=\'glyphicon glyphicon-ok\'></i>' + ui_string['confirm'] + '</button>');
            $('#sure_to_delete').modal();
        }
    }
    function delete_template(id)
    {
      if (id)
        {
            $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_template_data(\'' + id + '\')"><i class=\'glyphicon glyphicon-ok\'></i>' + ui_string['confirm'] + '</button>');
            $('#sure_to_delete').modal();
        }
    }
    function update_run_status(id)
    {
        setloader();
        var cstatus=$('#'+id).attr('data-status');
        var user_id=$('#'+id).attr('data-id');
        if(cstatus=='inactive')
        {
            var status = 'active';
            var color='red';
            var dt='1';
        }
        else
        {
            unloading();
            location.reload();
        }
        $.ajax({
            url:admin_ui_url+"controlTower/ajax/update_run_status.php",
            data:"asid="+user_id+"&tp="+dt,
            type:"POST",
            success:function(suc)
                    {
                        suc=JSON.parse(suc);
                        var msg_head='';
                        var msg_body='';
                        if(suc['success']=='true')
                    {
                        $('#'+id).attr('data-status',status)
                        $('#'+id).css('border-color',color);
                        $('#'+id).css('color',color);
                        msg_head=ui_string['confirm'];
                        msg_body="Status Updated";
                        
                    }
                    else
                    {
                        msg_head=ui_string['notconfirm'];
                        if(suc['error_code'] == '1020') {
                            msg_body = ui_string['license_limit_exceeds'];
                        } else {
                            msg_body ="Error";
                        }
                    }
                    $("#model_head").html(msg_head);
                    $("#model_des").html(msg_body);
                    $('#success_modal').modal();
                    setTimeout(function(){ $('#success_modal').modal('toggle'); },2000);
                     unloading();
                        
                    }
        })
    }
   $(document).ready(function(){
       $('#categoryname').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            copydata();
            return false;
        }
    }); 
   });
   
   // start of multiple robot run checkbox function
    var allCheckedArray=[]; 
    var allCheckedArray1=[];
    var allCheckedArray2=[];
    var allCheckedArrayValues=[];
    var allCheckedArrayValues1=[];
    var allCheckedArrayValues2=[];
    function checkBoxCheckedMultiple(asid,id,count)
    {
        if(document.getElementById(asid).checked==false)
        {
            var checkinof=allCheckedArray.indexOf(asid);
            var checkinof1=allCheckedArray1.indexOf(id);
            var checkinof2=allCheckedArray2.indexOf(count);
            allCheckedArray.splice(checkinof,1);
            allCheckedArray1.splice(checkinof1,1);
            allCheckedArray2.splice(checkinof2,1);
            allCheckedArrayValues.splice(checkinof,1);
            allCheckedArrayValues1.splice(checkinof1,1);
            allCheckedArrayValues2.splice(checkinof2,1);
        }
        else
        {
            allCheckedArray.push(asid);
            allCheckedArray1.push(id);
            allCheckedArray2.push(count);
            allCheckedArrayValues.push($('#'+asid).val());
            allCheckedArrayValues1.push($('#'+id).val());
            allCheckedArrayValues2.push($('#'+count).val());
        } 
    }
    // End of multiple robot run checkbox function
    //start of multiple robot run function
    function multi_robot_run()
    {
        if(allCheckedArray.length>0)
        {
            $.each(allCheckedArray, function( i, asidval ){
                var asidvalarray = asidval.split("_");
                var asid = asidvalarray[1];
                configuration_temp_multiple(asid, allCheckedArray1[i],allCheckedArray2[i]);
            });
            allCheckedArray=[];
            allCheckedArray1=[];
            allCheckedArray2=[];
            $("#model_head").html(ui_string['success']);
            $("#model_des").html("Run Robot.");
            $('#success_modal').modal();
            setTimeout(function () {
                $('#success_modal').modal("toggle");
            }, 3000);
            refresh_custom_dt();
        }
        else
        {
            $("#error_head").html(ui_string['error']);
            $("#error_body").html("Please Select atleast one robot to run");
            $("#error_message").modal();
            setTimeout(function () {
                $('#error_message').modal("toggle");
            }, 3000);
        }
    }
    //End of multiple robot run function
</script>

<?php get_enroll_users_popup_rpa('', $all_cats, 'enroll-user', '1', array('mid' => '50', 'smid' => '1')); ?> 
<?php
get_admin_footer();
?>