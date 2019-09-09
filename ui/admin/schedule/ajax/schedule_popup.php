<?php
include_once '../../../../global.php';
$currentUser = $_SESSION['user']['user_id'];
$tmp_data = select_mongo('user', array('_id' => new MongoId($currentUser)), array('machine', 'type'));
$return_user = add_id($tmp_data, "id");
if(!empty($return_user['type']) && $return_user['type'] == 'attender') {
    $user_machine = array();
    if(!empty($return_user[0]['machine'])) {
        foreach($return_user[0]['machine'] as $val) {
            $user_machine[] = new MongoId($val);
        }
    }
    $where = array('type' => 'machine', 'status' => '1', '_id' => array('$in' => $user_machine));
} else {
    $userInfo = get_user_hirarchy(array('userId' => $currentUser, 'mongoObject' => true));
    $where = array('type' => 'machine', 'status' => '1', '_id' => array('$in' => $userInfo['data']));
}
$tmp = select_mongo('user', $where, array('email', 'machine'));
$return = add_id($tmp, "id");
$scheduleid = $_REQUEST['id'];
if (isset($scheduleid) && $scheduleid !== '') {
    $query = array('schedule_id' => $scheduleid);
    $scheduleData = select_mongo('schedule', $query);

    $scheduleDataInfo = add_id($scheduleData, "id");
    $scheduleDataInfo = $scheduleDataInfo[0];
    if (isset($scheduleDataInfo['robot']) && $scheduleDataInfo['robot'] != '') {
        $query1 = array();
        $query1['userId'] = $scheduleDataInfo['user'];
        $robotdata = select_mongo('robotlistAssociate', $query1);
        $robot = add_id($robotdata, "id");
    }
}
$checked = "";
if (isset($scheduleDataInfo['addtoqueue']) && $scheduleDataInfo['addtoqueue'] != '' && $scheduleDataInfo['addtoqueue'] == '1') {
    $checked = "checked";
} else {
    $checked = "";
}
?>
<input type="hidden" name="user_id" id="user_id" value="<?php echo $currentUser; ?>">
<input type="hidden" name="run_user_id" id="run_user_id" value="<?php echo $currentUser; ?>">
<input type="hidden" name="run_by" id="run_by" value="<?php echo $_SESSION['user']['email']; ?>">
<input type="hidden" name="id"  value="<?php echo isset($scheduleid) ? $scheduleid : '0'; ?>">
<div class="row">
    <div class="col-md-12">
        <div class="">
            <label class="control-label remove_bg col-md-5"><span class="color">User</span></label>
            <div class="col-md-7">
                <select class="form-control required_field createschedule selectschedule" data-check-valid="blank" data-error-show-in="user_error" data-error-text="Please Select User" id="user"  name="user" onchange="selectRobot()">
                    <option value="">Select a option</option>
<?php
foreach ($return as $value) {
    ?>
                        <option value="<?php echo $value['id']; ?>" <?php if ($scheduleDataInfo['user'] == $value['id']) {
        echo "selected";
    } ?>><?php echo $value['email']; ?></option>
                    <?php } ?>
                </select> 
                <span class="input_arror error" id="user_error"> </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="">
            <label class="control-label remove_bg col-md-5"><span class="color">Robot</span></label>
            <div class="col-md-7">

<?php if (isset($scheduleDataInfo['robot']) && $scheduleDataInfo['robot'] != '') { ?>

                    <select class="form-control required_field createschedule" data-check-valid="blank" data-error-show-in="robot_error" data-error-text="Please Select Robot" id="robot_option" name="robot">

                    <?php if (!empty($robot)) {
                        foreach ($robot as $ro) { ?>
                                <option value="<?php echo $ro['asid'] . '-' . $ro['id']; ?>" <?php echo ($scheduleDataInfo['robot'] == $ro['asid'] . '-' . $ro['id']) ? 'selected' : ''; ?>><?php echo $ro['name']; ?></option>
                            <?php }
                        } ?>

                    </select> 
                    <span class="input_arror error" id="robot_error"> </span>
<?php } else { ?>
                    <select class="form-control required_field createschedule" data-check-valid="blank" data-error-show-in="robot_error" data-error-text="Please Select Robot" id="robot_option" name="robot">
                        <option value="">Select a Robot</option>

                    </select> 
                    <span class="input_arror error" id="robot_error"> </span>
<?php } ?>

            </div>
        </div>
    </div>
</div>
<!--  <div class="row">
  <div class="col-md-12">
    <div class="">
      <label class="control-label remove_bg col-md-5"><span class="color">Bot Name</span></label>
      <div class="col-md-7">
         <input class="form-control required_field createschedule" id="bot" name="bot" type="text" placeholder="Bot Name" data-check-valid="blank" data-error-show-in="ebot" value="<?php echo isset($scheduleDataInfo['bot']) ? $scheduleDataInfo['bot'] : ''; ?>">
       <span class="input_arror error" id="ebot"> </span>
      </div>
    </div>
    </div>
    </div> -->
<div class="row">
    <div class="col-md-12">
        <div class="">
            <label class="control-label remove_bg col-md-5"><span class="color">Bot Description</span></label>
            <div class="col-md-7">
                <input class="form-control  createschedule" id="bot_desc" name="bot_desc" type="text" placeholder="Bot Description" data-check-valid="blank" data-error-show-in="ebot_desc" value="<?php echo isset($scheduleDataInfo['bot_desc']) ? $scheduleDataInfo['bot_desc'] : ''; ?>">
                <span class="input_arror error" id="ebot_desc"> </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="">
            <label class="control-label remove_bg col-md-5"><span class="color">Quick Schedule</span></label>
            <div class="col-md-7">
                <select class="form-control required_field createschedule selectscheduletype" data-check-valid="blank" data-error-show-in="quick_error" data-error-text="Please Select Schedule Type" id="scheduletype"  name="scheduletype" onchange="selectSchedule()">
                    <option value="">Select a Schedule Type</option>
                    <option value="1-Hourly" <?= $scheduleDataInfo['scheduletype'] == '1-Hourly' ? ' selected="selected"' : ''; ?>>Hourly</option>
                    <option value="2-Daily" <?= $scheduleDataInfo['scheduletype'] == '2-Daily' ? ' selected="selected"' : ''; ?>>Daily</option>
                    <option value="3-Weekly" <?= $scheduleDataInfo['scheduletype'] == '3-Weekly' ? ' selected="selected"' : ''; ?>>Weekly</option>
                    <option value="4-Monthly" <?= $scheduleDataInfo['scheduletype'] == '4-Monthly' ? ' selected="selected"' : ''; ?>>Monthly</option>
                    <option value="5-Yearly" <?= $scheduleDataInfo['scheduletype'] == '5-Yearly' ? ' selected="selected"' : ''; ?>>Yearly</option>
                    <option value="6-One Time" <?= $scheduleDataInfo['scheduletype'] == '6-One Time' ? ' selected="selected"' : ''; ?>>One Time</option>
                </select> 
                <span class="input_arror error" id="quick_error"> </span>
            </div>
        </div>
    </div>
</div>
<?php if (isset($scheduleDataInfo['starttime']) && $scheduleDataInfo['starttime'] != '' && $scheduleDataInfo['scheduletype'] == '1-Hourly') { ?>              
    <!--<div class="row">
    <div class="col-md-12">
      <div class="" id="noofschedule">
      <label class="control-label remove_bg col-md-5"><span class="color">Start Time</span></label>
      <div class="col-md-7">
      <input class="form-control required_field createschedule timepicker" id="starttime" name="starttime" type="text" placeholder="" data-check-valid="blank" data-error-show-in="estarttime" value="<?php echo isset($scheduleDataInfo['starttime']) ? $scheduleDataInfo['starttime'] : ''; ?>">
       <span class="input_arror error" id="estarttime"> </span>
        </div>
      </div>
      </div>
      </div>-->

    <!--clockpicker-->
    <div class="row">
        <div class="col-md-12">
            <div class="" id="noofschedule">
                <label class="control-label remove_bg col-md-5"><span class="color">Start Time</span></label>
                <div class="col-md-7">
                    <div class="input-group clockpicker">
                        <input type="text" class="form-control required_field createschedule" id="starttime" name="starttime" data-check-valid="blank" data-error-show-in="estarttime" value="<?php echo isset($scheduleDataInfo['starttime']) ? $scheduleDataInfo['starttime'] : ''; ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                        <span class="input_arror error" id="estarttime"> </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="" id="every-div">
                <label class="control-label remove_bg col-md-5"><span class="color">Every</span></label>
                <div class="col-md-7">
                    <input class="form-control required_field createschedule" id="every" name="every" min="1" type="number" placeholder="" data-check-valid="blank" data-error-show-in="everyerror" value="<?php echo isset($scheduleDataInfo['every']) ? $scheduleDataInfo['every'] : ''; ?>">
                    <span class="input_arror error" id="everyerror"> </span>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="" id="noofschedule">

            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="" id="every-div">

            </div>
        </div>
    </div>
    </div>
<?php } ?>
<?php if (isset($scheduleDataInfo['startdate']) && $scheduleDataInfo['startdate'] != '' && $scheduleDataInfo['scheduletype'] != '1-Hourly') { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="" id="noofschedule">
                <label class="control-label remove_bg col-md-5"><span class="color">Start Time</span></label>
                <div class="col-md-7">
                    <div class="input-group clockpicker">
                        <input type="text" class="form-control required_field createschedule" id="starttime" name="starttime" data-check-valid="blank" data-error-show-in="estarttime" value="<?php echo isset($scheduleDataInfo['starttime']) ? $scheduleDataInfo['starttime'] : ''; ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                        <span class="input_arror error" id="estarttime"> </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="" id="noofschedule1">
                <label class="control-label remove_bg col-md-5"><span class="color">Start Date</span></label>
                <div class="col-md-7">
                    <input class="form-control required_field createschedule" id="startdate" name="startdate" type="text" placeholder="" data-check-valid="blank" data-error-show-in="estartdate" value="<?php echo isset($scheduleDataInfo['startdate']) ? $scheduleDataInfo['startdate'] : ''; ?>">
                    <span class="input_arror error" id="estartdate"> </span>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="" id="noofschedule1">

            </div>
        </div>
    </div>
    </div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="" id="starttime">
            <div class="input-group clockpicker">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="">
            <label class="control-label remove_bg col-md-5"><span class="color">Add TO Queue</span></label>
            <div class="col-md-7">
                <input type="checkbox" class="createschedule" name="addtoqueue" id="addtoqueue" value="1" <?php echo $checked; ?>> 
            </div>
        </div>
    </div>
</div>
<div id="success_modal" class="modal fade"
     data-header-color="#736086">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"
                aria-hidden="true">
            <i class="fa fa-times"></i>
        </button>
        <h4 class="modal-title" id="model_head">
            <i class="glyphicon glyphicon-ok-circle"></i> <?php echo $ui_string['confirmation']; ?>
        </h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="confirmation_successful"> <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
            <span id="model_des"><?php echo $ui_string['con_suc']; ?></span> </div>
    </div>
    <!-- //modal-body-->
</div> 
<script>
    $(document).ready(function () {
        /*$('.timepicker').timepicker({
         timeFormat: 'h:mm p',
         interval: 60,
         minTime: '10',
         maxTime: '6:00pm',
         defaultTime: '11',
         startTime: '10:00',
         dynamic: false,
         dropdown: true,
         scrollbar: true
         });
         
         $('input.timepicker').timepicker({});*/
        $(function () {
            $("#startdate").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    });
    $('.clockpicker').clockpicker();
</script>
<script>
    $(document).ready(function () {
        $("#md-full-width1").draggable();
    });
</script>