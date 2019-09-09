function train_request_send(id, taskid, user_id) {
    //setloader();
    if (taskid != "" && taskid != undefined) {
        $(".checkclass").removeClass("active");
        $("#" + taskid).addClass("active");
    }
    $("#userEmailId").val(id);
    $("#user_machine_Id").val(user_id);
    $.ajax({
        url: admin_ui_url + "rpaDashboard/ajax/dashboard_data.php?action=graphdata",
        data: {"id": id},
        type: "POST",
        success: function suc(suc_data) {
            robot_status();
            robot_schedule_time();
            robot_run_count();
            var suc_data = JSON.parse(suc_data);
            if (suc_data['success'] == "true") {
                if (suc_data['data'].length > 0) {
                    let actions_completed = suc_data['data'][0].action_completed.toString();
                    let total_actions = suc_data['data'][0].total_actions.toString();
                    let estimated_time = suc_data['data'][0].estimated_time.toString();
                    let time_elapsed = suc_data['data'][0].time_elapsed.toString();
                    let total_loops = suc_data['data'][0].total_loops.toString();
                    let loops_completed = suc_data['data'][0].loop_action_count.toString();
                    let total_action_loops = suc_data['data'][0].loop_action_count.toString();
                    //let loop_action_completed = suc_data['data'][0].loops_data[loops_completed-1].action_count.toString();
                    let task_count = 1;
                    let total_task_count = 1;
                    let action_size = suc_data['data'][0].actions_completed.length;
                    var done_task_html = '<table class="table table-striped"><thead><tr><th>S.No</th><th>Action Name</th><th>Status</th><th>Message</th></tr></thead><tbody>';
                    let failure_task_size = suc_data['data'][0].failure_details.length;
                    //var failure_task_html = '<table class="table table-striped"><thead><tr><th>S.No</th><th>Action Name</th><th>Failure Action</th><th>Message</th></tr></thead><tbody>';
                    if (typeof prev_task_count == 'undefined') {
                        prev_task_count = 0;
                    }
                    if (task_count != "" && task_count != prev_task_count) {
                        prev_task_count = task_count;
                        /* For first tab.. task.. */
                        selectGaguge21 = new Donut(document.getElementById("select-21"));
                        selectGaguge21.maxValue = 1;
                        selectGaguge21.set(task_count);
                        $("#firstCanvas").text(task_count);
                        $("#firstCanvasTotal").text(total_task_count);
                    }
                    if (typeof prev_actions_completed == 'undefined') {
                        prev_actions_completed = 0;
                    }
                    if (total_actions != "" && actions_completed != "" && (actions_completed != prev_actions_completed)) {
                        prev_actions_completed = actions_completed;
                        /* For Second tab.. action */
                        selectGaguge2 = new Donut(document.getElementById("select-2"));
                        selectGaguge2.maxValue = total_actions;
                        selectGaguge2.set(actions_completed);
                        $("#secondCanvas").text(actions_completed);
                        $("#secondCanvasTotal").text(total_actions);
                    }
                    if (typeof prev_time_elapsed == 'undefined') {
                        prev_time_elapsed = 0;
                    }
                    if (estimated_time != "" && time_elapsed != "" && (time_elapsed != prev_time_elapsed)) {
                        prev_time_elapsed = time_elapsed;
                        /* For third tab.. eta */
                        selectGaguge1 = new Gauge(document.getElementById("select-1"));
                        selectGaguge1.maxValue = estimated_time;
                        selectGaguge1.set(time_elapsed);
                        $("#thirdCanvas").text(time_elapsed);
                        $("#fourthCanvas").text(estimated_time);
                    }
                    if (typeof prev_loops_completed == 'undefined') {
                        prev_loops_completed = 0;
                    }
                    if (total_loops != "" && loops_completed != "" && (loops_completed != prev_loops_completed)) {
                        prev_loops_completed = loops_completed;
                        /* For Four tab.. totalloop */
                        selectGaguge3 = new Donut(document.getElementById("select-3"));
                        selectGaguge3.maxValue = total_loops;
                        selectGaguge3.set(total_loops);
                        $("#fifthCanvas").text(loops_completed);
                        $("#fifthCanvasTotal").text(total_loops);
                    }
                    if (typeof prev_loop_action_completed == 'undefined') {
                        prev_loop_action_completed = 0;
                    }
                    /* if (total_action_loops != "" && loop_action_completed != "" && (loop_action_completed != prev_loop_action_completed)) {
                     prev_loop_action_completed = loop_action_completed;
                     selectGaguge31 = new Donut(document.getElementById("select-31"));
                     selectGaguge31.maxValue = total_loops;
                     selectGaguge31.set(loops_completed);
                     $("#sixthCanvas").text(loop_action_completed);
                     $("#sixthCanvasTotal").text(total_action_loops);
                     }*/
                    let index = 1;
                    if (action_size > 0) {
                        for (var i = 0; i < action_size; i++) {
                            if(suc_data['data'][0].failure_occured==false)
                            {
                            done_task_html += '<tr><td>' + index + '</td><td>' + suc_data['data'][0].actions_completed[i]['action_type'] + '</td><td><span class="badge badge-primary">Success</span></td><td>' + suc_data['data'][0].actions_completed[i]['action_handling_message'] +'</td></tr>';
                            }
                            else
                            {
                            done_task_html += '<tr><td>' + index + '</td><td>' + suc_data['data'][0].actions_completed[i]['action_type'] + '</td><td><span class="badge badge-danger">Failure</span></td><td>' + suc_data['data'][0].failure_details[i]['message'] +'</td></tr>';   
                            }
                            index = index + 1;
                            index = index + 1;
                        }
                    }
                    if (failure_task_size > 0) {
                        for (var i = 0; i < failure_task_size; i++) {
                            done_task_html += '<tr><td>' + index + '</td><td>' + suc_data['data'][0].failure_details[i]['action_type'] + '</td><td></td><td>' + suc_data['data'][0].failure_details[i]['action_handling_message'] + '</td></tr>';
                            index = index + 1;
                        }
                    }
                    if (failure_task_size <= 0 && action_size <= 0)
                    {
                        done_task_html += '<tr><td colspan="4">No Data</td></tr>';
                    }
                    done_task_html += '</tbody></table>';
                    $("#task-done-status").html(done_task_html);
                }
            } else {
            }
        }
    });

}
function get_tab_data() {
    $.ajax({
        url: admin_ui_url + "rpaDashboard/ajax/dashboard_userlist.php",
        data: {},
        type: "POST",
        success: function suc(suc_data) {
            var suc_data = JSON.parse(suc_data);
            if (suc_data['data'] != "" && suc_data['id'] != "") {
                $("#list-group-users").html(suc_data['data']);
                $("#total_user_count").html(suc_data['userCount']);
                train_request_send(suc_data['id'], "", suc_data['user_id']);
            }

        }
    });
}
get_tab_data(); //create tab
setInterval(function () {
    get_tab_data();
}, 60000);