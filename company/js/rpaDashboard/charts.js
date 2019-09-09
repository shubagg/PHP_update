robot_status();
robot_schedule_time();
robot_run_count();

//draw scheduler timelin chart
google.charts.load('current', {'packages': ['timeline']});
google.charts.setOnLoadCallback(draw_stuff);
function draw_stuff(result) {
    $('#scheduler_chart').removeClass("graph-data-nt-avail");
    if (result.length == 0 || result.length == '')
    {
        $('#scheduler_chart').html("No Data Available");
        $('#scheduler_chart').addClass("graph-data-nt-avail");
    } else
    {
        var final_data = [];
        for (var i = 0; i < result.length; i++) {
            var item = result[i];
            for (var j = 0; j < item[2].length; j++) {
                item[2] = new Date(item[2][0], item[2][1], item[2][2], item[2][3], item[2][4], item[2][5]);

            }
            for (var k = 0; k < item[3].length; k++) {
                item[3] = new Date(item[3][0], item[3][1], item[3][2], item[3][3], item[3][4], item[3][5]);

            }
            final_data.push(item);
        }

        var container = document.getElementById('chart_div');
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();

        dataTable.addColumn({type: 'string', id: 'schedule'});
        dataTable.addColumn({type: 'string', id: 'Name'});
        dataTable.addColumn({type: 'date', id: 'Start'});
        dataTable.addColumn({type: 'date', id: 'End'});
        dataTable.addRows(final_data);

        var options = {
            timeline: {colorByRowLabel: true},
            backgroundColor: '#ffd'
        };
        chart.draw(dataTable, options);

    }

}
var current_count_scheduler = 0;
var prev_count_scheduler = 0;
function robot_schedule_time()
{
    if (user_ids_scheduler == '')
    {
        var user_id = $('#user_machine_Id').val();
    } else
    {
        var user_id = user_ids_scheduler;
    }
    var strt_dates = strt_date_scheduler;
    $.ajax({
        url: admin_ui_url + "rpaDashboard/ajax/rpa_robot_schedule_time.php",
        data: "user_id=" + user_id + "&strt_date=" + strt_dates,
        type: "POST",
        success: function (suc)
        {
            var dat = JSON.parse(suc);
            if (dat == '' || dat['count'] == 0)
            {
                draw_stuff('');
            } else
            {
                current_count_scheduler = dat['count'];
                if (prev_count_scheduler != current_count_scheduler)
                {
                    $('#scheduler_chart').html('<div id="loader_graph"><img src="' + logo_url + '"></div>');
                    current_count_scheduler = dat['count'];
                    setTimeout(function () {
                        $('#scheduler_chart').html('<div id="chart_div" style="width: 100%; height: 250px; overflow: scroll;"></div>');
                        draw_stuff(dat['result']);
                    }, 1000);

                }

            }
        }
    });

}
function open_users_scheduler(argument) {
    $("#md_full_user_scheduler").modal();
}

function open_calendar_scheduler() {
    $("#md_full_calendar_scheduler").modal();
}

var all_checked_array_scheduler = [];
var all_checked_array_values_scheduler = [];
function check_box_user_scheduler(id)
{
    if (document.getElementById(id).checked == false)
    {
        var checkinof_scheduler = all_checked_array_scheduler.indexOf(id);
        all_checked_array_scheduler.splice(checkinof_scheduler, 1);
        all_checked_array_values_scheduler.splice(checkinof_scheduler, 1);


    } else
    {
        all_checked_array_scheduler.push(id);
        all_checked_array_values_scheduler.push($('#' + id).val());
    }
}

function scheduler_chart_data()
{
    setloader();
    var checked_ids_scheduler = [];
    $(".sel_checkbox_scheduler:checked").each(function () {
        checked_ids_scheduler.push($(this).val());
    });
    var strt_date_scheduler = $('#startdate_scheduler').val();
    var user_id_scheduler = checked_ids_scheduler;
    $.ajax({
        url: admin_ui_url + "rpaDashboard/ajax/scheduler_data.php",
        data: "user_id=" + user_id_scheduler + "&strt_date=" + strt_date_scheduler,
        type: "POST",
        success: function (suc)
        {
            window.location.href = '';
        }
    });
}

//for robot donutt chart
var current_count = 0;
var prev_count = 0;
setInterval(function () {
    robot_status();
    robot_schedule_time();
    robot_run_count();
}, 30000);
function robot_status()
{
    if (user_ids == '')
    {
        var user_id = $('#user_machine_Id').val();
    } else
    {
        var user_id = user_ids;
    }
    var strt_dates = strt_date;
    var end_dates = end_date;
    $.ajax({
        url: admin_ui_url + "configuration/ajax/rpa_robot_start_to_stop_time.php",
        data: "user_id=" + user_id + "&strt_date=" + strt_dates + "&end_date=" + end_dates,
        type: "POST",
        success: function (suc)
        {
            var dat = JSON.parse(suc);
            current_count = dat['count'];
            if (prev_count != current_count)
            {
                $('#pie_graph').html('<div id="loader_graph"><img src="' + logo_url + '"></div>');
                prev_count = dat['count'];
                setTimeout(function () {
                    $('#pie_graph').html('<div id="piechart" style="width: 100%; height: 250px;"></div>');
                    draw_donutt_chart(dat['result']);
                }, 1000);

            }
        }
    });

}
//for draw dashboard donutt chart of robot status
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(robot_status);
function draw_donutt_chart(data) {
    var data = google.visualization.arrayToDataTable(data['data']);
    var options = {
        title: 'Robot Status',
        pieHole: 0.4,
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}

//users modal open for dashboard donutt chart of robot status
function open_users(argument) {
    $("#md-full-user").modal();
}

//select start date modal open for dashboard donutt chart of robot status
function open_calendar() {
    $("#md-full-calendar").modal();
    // body...
}

//store checked users in dashboard donutt chart of robot status
var allCheckedArray = [];
var allCheckedArrayValues = [];
function check_box_user(id)
{
    if (document.getElementById(id).checked == false)
    {
        var checkinof = allCheckedArray.indexOf(id);
        allCheckedArray.splice(checkinof, 1);
        allCheckedArrayValues.splice(checkinof, 1);


    } else
    {
        allCheckedArray.push(id);
        allCheckedArrayValues.push($('#' + id).val());
    }
}

//store donutt chart filter in session
function pie_chart_data()
{
    setloader();
    var checked_ids = [];
    $(".sel_checkbox:checked").each(function () {
        checked_ids.push($(this).val());
    });
    var strt_date = $('#startdate').val();
    if (checked_ids == '')
    {
        var user_id = $('#user_machine_Id').val();
    } else
    {
        var user_id = checked_ids;
    }
    $.ajax({
        url: admin_ui_url + "configuration/ajax/rpa_robot_start_to_users.php",
        data: "user_id=" + user_id + "&strt_date=" + strt_date,
        type: "POST",
        success: function (suc)
        {
            window.location.href = '';
        }
    });
}


//open calendar modal in dashboard table chart of task done/fail
function open_calendar_done_task() {
    $("#md_full_calendar_task_done").modal();
}
//open robot modal in dashboard table chart of task done/fail
function open_robot_done_task() {
    $("#md_full_robot_task_done").modal();
}

//store checked robot in dashboard table chart of task done/fail
var allCheckedArraytask_done_robot = [];
var allCheckedArrayValuestask_done_robot = [];
function check_box_robot_task_done(id)
{
    if (document.getElementById(id).checked == false)
    {
        var checkinoftask_done_robot = allCheckedArraytask_done_robot.indexOf(id);
        allCheckedArraytask_done_robot.splice(checkinoftask_done_robot, 1);
        allCheckedArrayValuestask_done_robot.splice(checkinoftask_done_robot, 1);


    } else
    {
        allCheckedArraytask_done_robot.push(id);
        allCheckedArrayValuestask_done_robot.push($('#' + id).val());
    }
}

//store task done/fail chart filter in session
function task_done_chart_data()
{
    setloader();
    var checked_ids_robotid_task_done = [];
    $(".sel_checkbox_robotid_task_done:checked").each(function () {
        checked_ids_robotid_task_done.push($(this).val());
    });
    var strt_date_task_done = $('#startdate_task_done').val();
    var robot_id_task_done = checked_ids_robotid_task_done;
    $.ajax({
        url: admin_ui_url + "rpaDashboard/ajax/task_done_data.php",
        data: "strt_date=" + strt_date_task_done + "&robot_id=" + robot_id_task_done,
        type: "POST",
        success: function (suc)
        {
            window.location.href = '';
        }
    });
}

//export table data of done/fail task
function export_task_done(type)
{
    var user_email = $('#userEmailId').val();
    var strt_dates = strt_date_task_done;
    var robot_id = robot_id_task_done;
    if (user_email != "")
    {
        $.ajax({
            url: admin_ui_url + "rpaDashboard/ajax/export_task_chart.php",
            data: '&strt_date=' + strt_date_task_done + '&robot_id=' + robot_id_task_done + '&user_id=' + user_email + '&type=' + type,
            type: "POST",
            success: function (suc)
            {
                var data = JSON.parse(suc);
                if (data['success'] == 'true')
                {
                    window.location = data['path'];
                } else
                {
                    $('#error_head').html(ui_string['error_message']);
                    $('#error_body').html(ui_string['nodataavilable']);
                    $('#error_message').modal();
                    setTimeout(function () {
                        $('#error_message').modal('toggle');
                    }, 1500);
                }

            },
            error: function () {
                console.log("error handling here");
            }
        })
    } else
    {
        return false;
    }
}

//for robot run count chart user
function open_robot_run_count_user(argument) {
    $("#md_full_user_robot_run_count").modal();
}
//for robot run count chart calendar
function open_robot_run_count_calendar() {
    $("#md_full_calendar_robot_run_count").modal();
}

var all_checked_array_robot_run_count = [];
var all_checked_array_values_robot_run_count = [];
function check_box_user_robot_run_count(id)
{
    if (document.getElementById(id).checked == false)
    {
        var checkinof_robot_run_count = all_checked_array_robot_run_count.indexOf(id);
        all_checked_array_robot_run_count.splice(checkinof_robot_run_count, 1);
        all_checked_array_values_robot_run_count.splice(checkinof_robot_run_count, 1);


    } else
    {
        all_checked_array_robot_run_count.push(id);
        all_checked_array_values_robot_run_count.push($('#' + id).val());
    }
}
function robot_run_count_chart_data()
{
    setloader();
    var checked_ids_robot_run_count = [];
    $(".sel_checkbox_robot_run_count:checked").each(function () {
        checked_ids_robot_run_count.push($(this).val());
    });
    var strt_date_robot_run_count = $('#startdate_robot_run_count').val();
    var user_id_robot_run_count = checked_ids_robot_run_count;
    $.ajax({
        url: admin_ui_url + "rpaDashboard/ajax/robot_run_count_data.php",
        data: "user_id=" + user_id_robot_run_count + "&strt_date=" + strt_date_robot_run_count,
        type: "POST",
        success: function (suc)
        {
            window.location.href = '';
        }
    });
}

//for robot run count chart
var current_robot_run_count = 0;
var prev_robot_run_count = 0;
function robot_run_count()
{
    if (user_ids_robot_run_count == '')
    {
        var user_id_robot_run_count = $('#user_machine_Id').val();
    } else
    {
        var user_id_robot_run_count = user_ids_robot_run_count;
    }
    var strt_dates_robot_run_count = strt_date_robot_run_count;
    $.ajax({
        url: admin_ui_url + "rpaDashboard/ajax/rpa_robot_run_count.php",
        data: "user_id=" + user_id_robot_run_count + "&strt_date=" + strt_dates_robot_run_count,
        type: "POST",
        success: function (suc)
        {
            var dat = JSON.parse(suc);
            if (dat == '' || dat['count'] == 0)
            {
                draw_histogram_chart('', '');
            } else
            {
                current_robot_run_count = dat['count'];
                if (prev_robot_run_count != current_robot_run_count)
                {
                    $('#histogram_graph').html('<div id="loader_graph"><img src="' + logo_url + '"></div>');
                    prev_robot_run_count = dat['count'];
                    setTimeout(function () {
                        $('#histogram_graph').html('<div id="histogram" style="width: 100%; height: 250px; overflow: scroll;"></div>');
                        draw_histogram_chart(dat['result'], dat['count']);
                    }, 1000);

                }

            }
        }
    });

}

google.charts.load("current", {packages: ["corechart"]});
google.charts.setOnLoadCallback(robot_run_count);
function draw_histogram_chart(data, count) {
    $('#histogram_graph').removeClass("graph-data-nt-avail");
    if (count == 1 || count == '')
    {
        $('#histogram_graph').html("No Data Available");
        $('#histogram_graph').addClass("graph-data-nt-avail");
    } else
    {

        var data = google.visualization.arrayToDataTable(data['data']);
        var options = {
            // title: 'Lengths of dinosaurs, in meters',
            legend: {position: 'none'},
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('histogram'));

        chart.draw(data, options);
    }
}