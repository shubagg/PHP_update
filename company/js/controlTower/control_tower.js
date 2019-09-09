/* 
 * Control Tower JS
 */
function copy_robot(robot_id)
{
    $("#robot_id").val(robot_id);
    $('#popupNew25').fadeIn(200);
}
$('[pd-popup-close="popupNew25"]').on("click", function(){
    $('#popupNew25').fadeOut(200);
});
function copydata()
{
    var robot_id=$("#robot_id").val();
    var title=$("#categoryname").val();
    if ($("#categoryname").val() != "") 
    {
        $.ajax({ 
            url: admin_ui_url + "controlTower/ajax/copy_robot.php",
            type:"POST",
            data:{"robot_id":robot_id,"title":title},
            success:function(data)
            {
                var data=JSON.parse(data);
                if(data['success']=='true')
                {
                    $('[pd-popup="popupNew"]').fadeIn(200);
                    setTimeout(function () {
                        window.location = site_url + "admin/controlTower" ;
                    }, 1000);
                }
                else
                {
                    $("#model_head").html(ui_string['unsuccess']);
                    $("#model_des").html(ui_string['nothingtosubmit']);
                    $('[pd-popup="popupNew"]').fadeIn(200);
                    setTimeout(function () {
                        $('[pd-popup="popupNew"]').fadeOut(200);
                    }, 1000);
                }
            }

        });
    }
    else
    {
        $("#categoryname").focus();
        $("#ecategoryname1").html("Please Enter Title");
        return false;
    }
}



