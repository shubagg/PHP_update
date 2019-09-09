<!--<div class="chat-box-show icons"><div class="chat-msg"><img src="<?php //echo admin_assets_url()."img/chat.gif";      ?>" class="img-responsive" /></div><span><!--<i class="icon-message fa fa-comments-o"></i><img src="<?php echo admin_assets_url() . "/img/nikky-small.png"; ?>" class="icon-message img-responsive" alt="" /></span></div>-->
<div id="main">
    <style type="text/css">
        .multiselect-container>li>a>label {
            padding: 4px 20px 3px 20px;
        }
    </style>
    <ol class="breadcrumb">
        <li>Admin </li>
        <li class="active">Dashboard </li>
        <div class="pull-right show-user_slide"><i class="fa fa-user" ></i><span id="total_user_count"></span></div>
    </ol>
    <script>
        function checkalldata() {}
    </script>
    <div id="content">
        <div class="row">
            <div id="example" class="gauge col-md-12">
                <div class="horiz-list" id="type-select">
                    <div class="col-md-offset-1 col-md-2 col-sm-6 col-xs-12">
                        <div class=" centerCanvas">
                            <canvas class="canvas_squer" id="select-21"></canvas>                            
                        </div>
                        <div class="text-center"> <span id="firstCanvas">0</span> / <span id="firstCanvasTotal">0</span></div>
                        <span><span class="spanCanvasCurrent">Tasks</span></span>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class=" centerCanvas">
                            <canvas class="canvas_squer"  id="select-2"></canvas>                            
                        </div>
                        <div class="text-center"><span id="secondCanvas">0</span> / <span id="secondCanvasTotal">0</span></div>
                        <span><span class="spanCanvasCurrent">Actions</span></span>
                    </div>
                    <div class="col-md-2 col-md-12 col-xs-12">
                        <div class="graph_center">
                            <canvas class="canvas_meter" id="select-1"></canvas>                            
<!--                            <span id="thirdCanvas" class="spanCanvas spanLeftCanvas">0</span>
                            <span id="fourthCanvas" class="spanCanvas spanrightCanvas">0</span>-->
                        </div>
                        <span class="spanCanvas1 d-block text-center time-elapsed">Time Elapsed <span id="thirdCanvas" class="spanCanvasTime">0</span></span>
                        <span class="spanCanvas1 d-block text-center time-elapsed">Estimated Time <span id="fourthCanvas" class="spanCanvasTime">0</span></span>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class=" centerCanvas">
                            <canvas class="canvas_squer" id="select-3"></canvas>                            
                        </div>
                        <div class="text-center"><span id="fifthCanvas">0</span> / <span id="fifthCanvasTotal">0</span></div>
                        <span><span class="spanCanvasCurrent">Loops</span></span>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class=" centerCanvas">
                            <canvas class="canvas_squer"  id="select-31"></canvas>                            
                        </div>
                        <div class="text-center"> <span id="sixthCanvas">0</span> / <span id="sixthCanvasTotal">0</span></div>
                        <span><span class="spanCanvasCurrent">Loop Actions</span></span>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-12 padding-0 chat_graph_progress">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" style="width:40%">
                        Free Space
                    </div>
                    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:10%">
                        Warning
                    </div>
                    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:20%">
                        Danger
                    </div>
                </div>
            </div>-->
            <div class="col-md-12 mb-5">
                <div class="col-md-4">
                    <div class="mrg_top_3 chat_graph_box">
                        <button type="button" class="btn btn-primary" onclick="open_users_scheduler();">users</button>
                        <button type="button" class="btn btn-primary" onclick="open_calendar_scheduler();">Date</button>
                        <div id="scheduler_chart">
                            <div id="loader_graph" ><img src="<?php echo admin_assets_url() . "/img/loaders.gif"; ?>"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mrg_top_3 chat_graph_box" >
                        <button type="button" class="btn btn-primary" onclick="open_users();">users</button>
                        <button type="button" class="btn btn-primary" onclick="open_calendar();">Date</button>
                        <div id="pie_graph">
                            <div id="loader_graph"><img src="<?php echo admin_assets_url() . "/img/loaders.gif"; ?>"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mrg_top_3 chat_graph_box">
                        <button type="button" class="btn btn-primary" onclick="open_robot_run_count_user();">users</button>
                        <button type="button" class="btn btn-primary" onclick="open_robot_run_count_calendar();">Date</button>
                        <div id="histogram_graph">
                            <div id="loader_graph"><img src="<?php echo admin_assets_url() . "/img/loaders.gif"; ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="userEmailId">
            <input type="hidden" id="user_machine_Id" value="<?php echo $machine_chart_id; ?>">
            <div class="col-md-12 mb-5">
                <div class="panel chat_graph_table" id="projects-status">
                    <div class="panel-heading panel-updated ">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h3>Task Done/Failure</h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <!-- <button type="button" class="btn btn-primary" onclick="open_robot_done_task();">Robot</button>
                                <button type="button" class="btn btn-primary" onclick="open_calendar_done_task();">Date</button> -->
                                <button type="button" class="btn btn-default pull-right" onclick="export_task_done('done-fail');">Export</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" id="task-done-status">
                        <table class="table table-striped dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Action Name</th>
                                    <th>Status</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr><td colspan="4">No Data</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- //content > row-->
        </div>
        <!-- //content-->
        <div class="slidePanel-content" id="user-profilee">
            <div class="list-group" id="list-group-users">

            </div>
        </div>
        <?php /* for user modal of dashboard donutt chart */ ?>
        <div id="md-full-user" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" id ="dismiss" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['user_list']; ?></h4>
            </div>
            <div class="modal-body">
                <div id="orderproduct">
                    <form id="formUser"  method="post" action="" enctype="multipart/form-data">
                        <div id="user_table">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="">
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Checkbox</th>
                                                        <th>user</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($return['success']) && ($return['success'] == 'true')) {
                                                        foreach ($return['data'] as $value) {
                                                            ?>
                                                            <tr>
                                                                <td><input type="checkbox" onclick="check_box_user(this.id)" name="checked_userid[]" id="<?php echo $value['id'] ?>" class="sel_checkbox" value="<?php echo $value['id'] ?>" <?php
                                                                    if (isset($userChecked) && !empty($userChecked)) {
                                                                        if (in_array($value['id'], $userChecked)) {
                                                                            echo "checked";
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                    ?>></td>
                                                                <td><?php echo $value['name'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan='2'>Sorry no records found</td>
                                                        </tr>

                                                    <?php }
                                                    ?>
                                                </tbody></table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="custom_button btn_cu btn btn-default" onclick="pie_chart_data()">Submit</button>
                    <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                </div>
            </div>
        </div>

        <?php /* for user modal of dashboard scheduler chart */ ?>
        <div id="md_full_user_scheduler" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" id ="dismiss_scheduler" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['user_list']; ?></h4>
            </div>
            <div class="modal-body">
                <div id="orderproduct">
                    <form id="form_user_scheduler"  method="post" action="" enctype="multipart/form-data">
                        <div id="user_table_scheduler">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="">
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Checkbox</th>
                                                        <th>user</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($return['success']) && ($return['success'] == 'true')) {
                                                        foreach ($return['data'] as $value) {
                                                            ?>
                                                            <tr>
                                                                <td><input type="checkbox" onclick="check_box_user_scheduler(this.id)" name="checked_userid_scheduler[]" id="<?php echo $value['id'] ?>" class="sel_checkbox_scheduler" value="<?php echo $value['id'] ?>" <?php
                                                                    if (isset($user_checked_scheduler) && !empty($user_checked_scheduler)) {
                                                                        if (in_array($value['id'], $user_checked_scheduler)) {
                                                                            echo "checked";
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                    ?>></td>
                                                                <td><?php echo $value['name'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan='2'>Sorry no records found</td>
                                                        </tr>

                                                    <?php }
                                                    ?>
                                                </tbody></table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="custom_button btn_cu btn btn-default" onclick="scheduler_chart_data()">Submit</button>
                    <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                </div>
            </div>
        </div>
        <?php /* for calendar modal of dashboard donutt chart */ ?>
        <div id="md-full-calendar" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['date']; ?></h4>
            </div>
            <div class="modal-body">
                <form id="form_calendar"  method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <label class="control-label remove_bg col-md-5"><span class="color">Date</span></label>
                        <div class="col-md-7">
                            <input class="form-control required_field booking_date" id="startdate" name="startdate" type="text" placeholder="" data-check-valid="blank" data-error-show-in="estartdate" value="<?php echo isset($strt_date) ? $strt_date : ''; ?>" readonly>
                            <span class="input_arror error" id="estartdate"> </span>
                        </div>
                        <span class="error" id="e_from_date"></span>
                    </div>                
                </form>

            </div>
            <div class="modal-footer">
                <button type="button"  class="custom_button btn_cu btn btn-default" onclick="pie_chart_data()">Submit</button>
                <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                        aria-hidden="true">Cancel</button>
            </div>
        </div>

        <div id="md_full_calendar_scheduler" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['date']; ?></h4>
            </div>
            <div class="modal-body">
                <form id="form_calendar_scheduler"  method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <label class="control-label remove_bg col-md-5"><span class="color">Date</span></label>
                        <div class="col-md-7">
                            <input class="form-control required_field booking_date" id="startdate_scheduler" name="startdate_scheduler" type="text" placeholder="" data-check-valid="blank" data-error-show-in="estartdate" value="<?php echo isset($strt_date_scheduler) ? $strt_date_scheduler : ''; ?>" readonly>
                            <span class="input_arror error" id="estartdate"> </span>
                        </div>
                        <span class="error" id="e_from_date"></span>
                    </div>                

                </form>

            </div>
            <div class="modal-footer">
                <button type="button"  class="custom_button btn_cu btn btn-default" onclick="scheduler_chart_data()">Submit</button>
                <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                        aria-hidden="true">Cancel</button>
            </div>
        </div>

        <?php /* start for dashboard task done table modal */ ?>
        <?php /* for calendar modal of task done/fail */ ?>
        <div id="md_full_calendar_task_done" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['date']; ?></h4>
            </div>
            <div class="modal-body">
                <form id="form_calendar_task_done"  method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <label class="control-label remove_bg col-md-5"><span class="color">Date</span></label>
                        <div class="col-md-7">
                            <input class="form-control required_field booking_date" id="startdate_task_done" name="startdate_scheduler" type="text" placeholder="" data-check-valid="blank" data-error-show-in="estartdate" value="<?php echo isset($strt_date_task_done) ? $strt_date_task_done : ''; ?>" readonly>
                            <span class="input_arror error" id="estartdate"> </span>
                        </div>
                    </div>                
                </form>

            </div>
            <div class="modal-footer">
                <button type="button"  class="custom_button btn_cu btn btn-default" onclick="task_done_chart_data()">Submit</button>
                <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                        aria-hidden="true">Cancel</button>
            </div>
        </div>
        <?php /* for robot modal of task done/fail */ ?>
        <div id="md_full_robot_task_done" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" id ="dismiss_robot_task_done" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['robot_list']; ?></h4>
            </div>
            <div class="modal-body">
                <form id="form_user_robot_task_done"  method="post" action="" enctype="multipart/form-data">
                    <div id="user_table_robot_task_done">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="">
                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">
                                            <thead>
                                                <tr>
                                                    <th>Checkbox</th>
                                                    <th>Robot</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($get_robot['data'] as $robot) { ?>
                                                    <tr>
                                                        <td><input type="checkbox" onclick="check_box_robot_task_done(this.id)" name="checked_robotid_task_done[]" id="<?php echo $robot['id'] ?>" class="sel_checkbox_robotid_task_done" value="<?php echo $robot['id'] ?>" <?php
                                                            if (isset($robot_id_task_done) && !empty($robot_id_task_done)) {
                                                                if ($robot['id'] == $robot_id_task_done) {
                                                                    echo "checked";
                                                                } else {
                                                                    
                                                                }
                                                            }
                                                            ?>></td>
                                                        <td><?php echo $robot['name'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
                <div class="modal-footer">
                    <button type="button"  class="custom_button btn_cu btn btn-default" onclick="task_done_chart_data()">Submit</button>
                    <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                </div>
            </div>
        </div>
        <?php /* for user modal of robot run chart */ ?>
        <div id="md_full_user_robot_run_count" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" id ="dismiss_robot_run_count" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['user_list']; ?></h4>
            </div>
            <div class="modal-body">
                <div id="">
                    <form id="form_user_robot_run_count"  method="post" action="" enctype="multipart/form-data">
                        <div id="user_table_robot_run_count">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="">
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Checkbox</th>
                                                        <th>user</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($return['success']) && ($return['success'] == 'true')) {
                                                        foreach ($return['data'] as $value) {
                                                            ?>
                                                            <tr>
                                                                <td><input type="checkbox" onclick="check_box_user_robot_run_count(this.id)" name="checked_userid_robot_run_count[]" id="<?php echo $value['id'] ?>" class="sel_checkbox_robot_run_count" value="<?php echo $value['id'] ?>" <?php
                                                                    if (isset($user_checked_robot_run_count) && !empty($user_checked_robot_run_count)) {
                                                                        if (in_array($value['id'], $user_checked_robot_run_count)) {
                                                                            echo "checked";
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                    ?>></td>
                                                                <td><?php echo $value['name'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan='2'>Sorry no records found</td>
                                                        </tr>

                                                    <?php }
                                                    ?>
                                                </tbody></table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="custom_button btn_cu btn btn-default" onclick="robot_run_count_chart_data()">Submit</button>
                    <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                </div>
            </div>
        </div>
        <?php /* end user modal of robot run chart */ ?>
        <?php /* for calendar modal of robot run chart */ ?>
        <div id="md_full_calendar_robot_run_count" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['date']; ?></h4>
            </div>
            <div class="modal-body">
                <form id="form_calendar_robot_run_count"  method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <label class="control-label remove_bg col-md-5"><span class="color">Date</span></label>
                        <div class="col-md-7">
                            <input class="form-control required_field booking_date" id="startdate_robot_run_count" name="startdate_robot_run_count" type="text" placeholder="" data-check-valid="blank" data-error-show-in="estartdate" value="<?php echo isset($strt_date_robot_run_count) ? $strt_date_robot_run_count : ''; ?>" readonly>
                            <span class="input_arror error" id="estartdate"> </span>
                        </div>
                    </div>                
                </form>

            </div>
            <div class="modal-footer">
                <button type="button"  class="custom_button btn_cu btn btn-default" onclick="robot_run_count_chart_data()">Submit</button>
                <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                        aria-hidden="true">Cancel</button>
            </div>
        </div>
    </div>
    <?php echo success_fail_message_popup(); ?> 
    <?php echo delete_confirmation_popup(); ?>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

</script>
