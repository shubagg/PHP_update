<?php
include_once ('../../../../global.php');
$classid = $_REQUEST['type'];
$taskId = '';
if (isset($_POST['taskId']) && $_POST['taskId'] != "") {
    $taskId = $_REQUEST['taskId'];
}
$type = explode("-", $_REQUEST['type']);
$variable_box_josn = "";
$total_variable_box = 0;
$total_key_action1 = 0;
$cmd = 0;
$keybordvar = 0;
$keybord_keystroke = 0;
$string2_text = 0;
$listvar = 0;
$listvarInsert = 0;
$positionDelete = 0;
$list_index = 0;
$url_key_total = 0;
$header_key_total = 0;
$form_key_total = 0;
$fetch_dropdown_key=0;
$fetch_list = 0;
$table_append_list = 0;
$table_insert_list = 0;
$table_delete_position = 0;
//receive mail handler variable
$receive_list = 0;
$intends = 0;
$intends_callback = 0;
$delete_keys = 0;
$appendDictionary = 0;
if (isset($_POST['index']) && $_POST['index'] != "" && isset($_POST['taskId']) && $_POST['taskId'] != "") {
    $robotlistData = select_mongo('robotlist', array('_id' => new MongoId($_POST['taskId'])), array('robot'));
    $robotlistInfo = add_id($robotlistData, "id");
    $actionData = $robotlistInfo[0]['robot'][0]['tasklist'][0]['actionlist'][$_POST['index']];
    if (sizeof($actionData) > 0) {
        if (isset($actionData['data']['cmd']) && !empty($actionData['data']['cmd'])) {
            $cmd = count($actionData['data']['cmd']) - 1;
        }
        if (isset($actionData['action']) && $actionData['action'] == 'keystroke') {
            if (isset($actionData['data']['action']) && !empty($actionData['data']['action'])) {
                $keybord_keystroke = count($actionData['data']['action']) - 1;
            }
        }
        if (isset($actionData['action']) && $actionData['action'] == 'string_concatenate') {
            if (isset($actionData['data']['string2']) && !empty($actionData['data']['string2'])) {
                $string2_text = count($actionData['data']['string2']) - 1;
            }
        }
        if (isset($actionData['action']) && $actionData['action'] == 'keystroke') {
            if (isset($actionData['data']['clicktype']) && !empty($actionData['data']['clicktype'])) {
                $keybordvar = count($actionData['data']['clicktype']) - 1;
            }
        }
        if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'append') {
            if (isset($actionData['data']['value']) && !empty($actionData['data']['value'])) {
                $listvar = count($actionData['data']['value']) - 1;
            }
        }
        if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'insert') {
            if (isset($actionData['data']['value']) && !empty($actionData['data']['value'])) {
                $listvarInsert = count($actionData['data']['value']) - 1;
            }
        }
        if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'delete') {
            if (isset($actionData['data']['position']) && !empty($actionData['data']['position'])) {
                $positionDelete = count($actionData['data']['position']) - 1;
            }
        }
        if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'fetch') {
            if (isset($actionData['data']['index']) && !empty($actionData['data']['index'])) {
                $list_index = count($actionData['data']['index']) - 1;
            }
        }

        if (isset($actionData['action']) && $actionData['action'] == 'dictionary_operations') {
            if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'append') {
                if (isset($actionData['data']['fetch_list']) && !empty($actionData['data']['fetch_list'])) {
                    $fetch_list = count($actionData['data']['fetch_list']) - 1;
                }
                if (isset($actionData['data']['dictionary']) && !empty($actionData['data']['dictionary'])) {
                    $appendDictionary = count($actionData['data']['dictionary']) - 1;
                }
            } else if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'delete') {
                if (isset($actionData['data']['keys']) && !empty($actionData['data']['keys'])) {
                    $delete_keys = count($actionData['data']['keys']) - 1;
                }
            }
        }

        if (isset($actionData['action']) && $actionData['action'] == 'table_operations') {
            if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'append') {
                if (isset($actionData['data']['list']) && !empty($actionData['data']['list'])) {
                    $table_append_list = count($actionData['data']['list']) - 1;
                }
            }
            if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'insert') {
                if (isset($actionData['data']['list']) && !empty($actionData['data']['list'])) {
                    $table_insert_list = count($actionData['data']['list']) - 1;
                }
            }
            if (isset($actionData['data']['type']) && $actionData['data']['type'] == 'delete') {
                if (isset($actionData['data']['position']) && !empty($actionData['data']['position'])) {
                    $table_delete_position = count($actionData['data']['position']) - 1;
                }
            }
        }
        if (isset($actionData['action']) && $actionData['action'] == 'receive_mail') {
            if (isset($actionData['data']['search_criteria']) && !empty($actionData['data']['search_criteria'])) {
                $receive_list = count($actionData['data']['search_criteria']) - 1;
            }
            if (isset($actionData['data']['intends']) && !empty($actionData['data']['intends'])) {
                $intends = count($actionData['data']['intends']) - 1;
            }
            if (isset($actionData['data']['intends_callback']) && !empty($actionData['data']['intends_callback'])) {
                $intends_callback = count($actionData['data']['intends_callback']) - 1;
            }
        }

        if (isset($actionData['data']['url_key']) && !empty($actionData['data']['url_key'])) {
            $url_key_total = count($actionData['data']['url_key']) - 1;
        }

        if (isset($actionData['data']['header_key']) && !empty($actionData['data']['header_key'])) {
            $header_key_total = count($actionData['data']['header_key']) - 1;
        }
        if (isset($actionData['data']['form_key']) && !empty($actionData['data']['form_key'])) {
            $form_key_total = count($actionData['data']['form_key']) - 1;
        }
        if (isset($actionData['data']['variable_box']) && !empty($actionData['data']['variable_box'])) {
            $variable_box_josn = json_encode($actionData['data']['variable_box']);
            $total_variable_box = count($actionData['data']['variable_box']) - 1;
        }
        if (isset($actionData['action']) && $actionData['action'] == 'action1') {
                if (isset($actionData['data']['key']) && !empty($actionData['data']['key'])) {
                    $total_key_action1 = count($actionData['data']['key']) - 1;
                }
            }
        if (isset($actionData['action']) && $actionData['action'] == 'action2') 
            {
                if (isset($actionData['data']['key']) && !empty($actionData['data']['key'])) {
                    $total_key_action1 = count($actionData['data']['key']) - 1;
                }
            }
        if (isset($actionData['action']) && $actionData['action'] == 'action3') 
            {
                if (isset($actionData['data']['key']) && !empty($actionData['data']['key'])) {
                    $total_key_action1 = count($actionData['data']['key']) - 1;
                }
            }
        if (isset($actionData['action']) && $actionData['action'] == 'action4') 
        {
            if (isset($actionData['data']['key']) && !empty($actionData['data']['key'])) {
                $total_key_action1 = count($actionData['data']['key']) - 1;
            }
        }
        if (isset($actionData['action']) && $actionData['action'] == 'table_operations') 
        {
            if (isset($actionData['data']['fetch_type']) && !empty($actionData['data']['fetch_type'])) {
                $fetch_dropdown_key = count($actionData['data']['fetch_type']) - 1;
            }
        }           
        create_html($type[0], $actionData, $classid);
    }
} else {
    create_html($type[0], array(), $classid);
}

//returntype array
function create_html($type, $data, $classid) {
    $returntype = array("none" => "none", "number" => "number", "float" => "float", "json_response" => "json response", "text" => "text", "byte_text" => "byte text", "json" => "json", "list" => "list", "table" => "table", "message_box" => "message box");
    $failure_returntype = array("next_action" => "Next Action", "wait_time" => "Wait Time", "retry" => "Retry", "search_on_windows" => "Search On Windows", "message_box" => "Message Box");
    $label = $data['data']['label'];
    /* Get All Validation Json */
    $validationjsonArr = select_mongo("actionValidations", array());
    $validationjsonArr = add_id($validationjsonArr, "id");
    $validationjsonArr = $validationjsonArr[0];
    switch ($type) {
        case 'launchapplication':
            $path = $data['data']['path'];
            $wait_time = $data['on_success']['next']['wait_time'];
            $next_action = $data['on_success']['next']['next_action'];
            $comment = $data['nm'];
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>Launch Application</h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    </div> </div>
                    </div>
                </div>  
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Path<span style="color:red;">*</span></label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-launchapplication1-<?php echo $classid ?>"  class="form-control variablename"/>
                            </div>
                            <div class="col-md-6">
                                <select attr_handler="application" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path" class="form-control appendVariable handlerVariableType"  data-id="variablename-launchapplication1-<?php echo $classid ?>">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['application'][$type]) || !empty($validationjsonArr['application'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container"> <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea></div>
                </div>
            </div>
            <?php
            break;
            ?>
        <?php
        case 'getwindowname':
            $return_type = $data['on_success']['return_type'];
            $wait_time = $data['on_success']['next']['wait_time'];
            $next_action = $data['on_success']['next']['next_action'];
            $variable_name = $data['on_success']['save'][0]['var'];
            $comment = $data['nm'];
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>Get Window Name </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['application'][$type]) || !empty($validationjsonArr['application'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>    
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container"> <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea></div>
                </div>
            </div>
            <?php
            break;
            ?>          

        <?php
        //start window opeartions
        case 'windowoperations':
            $action_type = isset($data['data']['action_type']) ? $data['data']['action_type'] : '';
            $side = isset($data['data']['side']) ? $data['data']['side'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>  Window Operations </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                    </div>
                </div>
                <div class="row"><div class="col-md-12">
                        <label for="sel1">Action<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field action_to_window_<?php echo $classid ?>" name="<?php echo $classid . "[action_type]"; ?>" data-check="blank" data-error="This field is required" onchange="select_move_to(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="minimize" <?php echo ($action_type == "minimize") ? 'selected' : ''; ?>>Minimize</option>
                            <option value="maximize" <?php echo ($action_type == "maximize") ? 'selected' : ''; ?>>Maximize</option>
                            <option value="close" <?php echo ($action_type == "close") ? 'selected' : ''; ?>>Close</option>
                            <option value="restore" <?php echo ($action_type == "restore") ? 'selected' : ''; ?>>Restore</option>
                            <option value="move" <?php echo ($action_type == "move") ? 'selected' : ''; ?>>Move</option>                  
                        </select>
                    </div></div>
                <div class="row"><div class="col-md-12" id="move_to_<?php echo $classid ?>" style="display:none">
                        <label for="sel1">Move To<span style="color:red;">*</span></label>
                        <select class="form-control width-100 move_to_<?php echo $classid ?>" name="<?php echo $classid . "[side]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                            <option value="" >Select Move To</option>
                            <option value="left" <?php echo ($side == "left") ? 'selected' : ''; ?>>Left</option>
                            <option value="right" <?php echo ($side == "right") ? 'selected' : ''; ?>>Right</option>
                            <option value="up" <?php echo ($side == "up") ? 'selected' : ''; ?>>Up</option>
                            <option value="down" <?php echo ($side == "down") ? 'selected' : ''; ?>>Down</option>
                        </select>
                    </div></div>
                <hr>
                <?php if (!isset($validationjsonArr['application'][$type]) || !empty($validationjsonArr['application'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>  
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container"><textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea></div>
                </div>
            </div>
            </div>
            <?php
            break;
            //end window opeartions
            ?>
            break;
            ?>
        <?php
        case 'wait':
            $time = isset($data['data']['time']) ? $data['data']['time'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>

            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>Wait</h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                    </div>
                </div>

                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Time<span style="color:red;">*</span></label>
                        <input type="text" value="<?php echo $time; ?>" name="<?php echo $classid . "[time]"; ?>" id="variablename-wait1-<?php echo $classid ?>"  class="form-control variablename"/>
                        <select class="form-control appendVariable" attr_handler="wait" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="time"
                                data-id="variablename-wait1-<?php echo $classid ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                </div>
                <?php if (!isset($validationjsonArr['wait'][$type]) || !empty($validationjsonArr['wait'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>
            <?php
            break;
            ?><?php
        case 'waitforimage':
            $path = isset($data['data']['path']) ? $data['data']['path'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            $return_type = $data['on_success']['return_type'];
            $variable_name = $data['on_success']['save'][0]['var'];
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>Wait For Image</h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                    </div>
                </div>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Image Path<span style="color:red;">*</span></label>
                        <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-waitforimage1-<?php echo $classid ?>"  class="form-control variablename"/>
                        <select class="form-control appendVariable" attr_handler="wait" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="image_path"  data-id="variablename-waitforimage1-<?php echo $classid ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                </div>
                <?php if (!isset($validationjsonArr['wait'][$type]) || !empty($validationjsonArr['wait'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>  
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div> 
            <?php
            break;
            ?>

        <?php
        case 'copyfromvariable':

            $copy_value_time = isset($data['data']['value']) ? $data['data']['value'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3> Copy From Variable</h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Variable<span style="color:red;">*</span></label>
                    <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                    <option value="">Select Variable</option>
                    </select> -->

                    <div class="row"><div class="col-md-6"><input type="text" value="<?php echo $copy_value_time; ?>" name="<?php echo $classid . "[value]"; ?>" id="variablename-<?php echo $classid ?>"  class="form-control no-var variablename mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                        <div class="col-md-6">
                            <select class="form-control appendVariable" attr_handler="clipboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variable"  data-id="variablename-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['clipboard'][$type]) || !empty($validationjsonArr['clipboard'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>   
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                </div>
            </div>

            <?php
            break;
            ?>  

        <?php
        case 'pastetovariable':

            $paste_value_time = isset($data['data']['value']) ? $data['data']['value'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3> Paste to Variable</h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"> </div> </div>   
                    </div>
                </div>
                <div class="form-group">
                    <label>Variable<span style="color:red;">*</span></label>
                    <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                    <option value="">Select Variable</option>
                    </select> -->

                    <div class="row"><div class="col-md-6"><input type="text" value="<?php echo $paste_value_time; ?>" name="<?php echo $classid . "[value]"; ?>" id="variablename-<?php echo $classid ?>"  class="form-control no-var variablename mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                        <div class="col-md-6">
                            <select class="form-control appendVariable" attr_handler="clipboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variable"  data-id="variablename-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['clipboard'][$type]) || !empty($validationjsonArr['clipboard'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>   
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>

            <?php
            break;
            ?>              

        <?php
        case 'openterminal':

            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>    Open Terminal </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                    </div>
                </div>
                <?php if (!isset($validationjsonArr['terminal'][$type]) || !empty($validationjsonArr['terminal'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>

            <?php
            break;
            ?>
        <?php
        case 'executecommand':

            $cmd = isset($data['data']['cmd']) ? $data['data']['cmd'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            $return_type = $data['on_success']['return_type'];
            $variable_name = $data['on_success']['save'][0]['var'];
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>    Execute Command </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                    </div>
                </div>
                <div class="show-me12 parent_command_section ">
                    
                    <div class="form-group add-select-variable-cmd">
                        <?php if (empty($cmd)) {
                            ?>
                            <div class="list-st"> <div class="col-md-12" id="div-box-0">
                            <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_command_div('<?php echo $classid; ?>','<?php echo $type ?>', $(this))"><i id="btn8" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                    <label for="sel1" class="cell-po">Command<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo htmlspecialchars($cmd); ?>" name="<?php echo $classid . "[cmd][]"; ?>" id="variablename-executecommand1-<?php echo $classid ?>-0"  class="form-control variablename"/>
                                    <select class="form-control appendVariable" attr_handler="terminal" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="command"
                                            data-id="variablename-executecommand1-<?php echo $classid ?>-0">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sortable section-execute-command-action-<?php echo $classid ?>"></div>
                            <?php
                        } else {
                            $k = 0;
                            $cm=$cmd[0];
                            ?>
                            <div class="list-st parent_row_section"><div class="col-md-12" id="div-box-<?php echo $k; ?>">
                                            <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_command_div('<?php echo $classid; ?>','<?php echo $type ?>', $(this))"><i id="btn8" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                        <label for="sel1" class="cell-po">Command<span style="color:red;">*</span></label>
                                        <input type="text" value="<?php echo htmlspecialchars($cm); ?>" name="<?php echo $classid . "[cmd][]"; ?>" id="variablename-executecommand1-<?php echo $classid ?>-<?php echo $k; ?>"  class="form-control variablename"/>
                                        <select class="form-control appendVariable" attr_handler="terminal" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="command" data-id="variablename-executecommand1-<?php echo $classid ?>-<?php echo $k; ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sortable section-execute-command-action-<?php echo $classid ?>">
                            <?php
                            $k = 1;
                            unset($cmd[0]);
                            foreach ($cmd as $cm) {
                                $ans = $k;
                                ?>
                                <div class="list-st parent_row_section"><div class="col-md-12" id="div-box-<?php echo $k; ?>">
                                            <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_execute_cmd('<?php echo $k; ?>', $(this))"><i id="btn8" class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                        <label for="sel1" class="cell-po">Command<span style="color:red;">*</span></label>
                                        <input type="text" value="<?php echo htmlspecialchars($cm); ?>" name="<?php echo $classid . "[cmd][]"; ?>" id="variablename-executecommand1-<?php echo $classid ?>-<?php echo $k; ?>"  class="form-control variablename"/>
                                        <select class="form-control appendVariable" attr_handler="terminal" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="command" data-id="variablename-executecommand1-<?php echo $classid ?>-<?php echo $k; ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                $k++;
                            }?>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>

                <?php if (!isset($validationjsonArr['command'][$type]) || !empty($validationjsonArr['command'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>   
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>

            <?php
            break;
            ?>
        <?php
        case 'stop':

            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>    Stop  </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"> </div>   
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['execute_control'][$type]) || !empty($validationjsonArr['execute_control'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>  
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>
            <?php
            break;
            ?>
        <?php
        case 'pause':

            $push_waittime = isset($data['data']['waittime']) ? $data['data']['waittime'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>Pause  </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"> </div>   
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Time<span style="color:red;">*</span></label>
                    <div class="row"><div class="col-md-12"><input type="text" class="form-control width-100 mandatory_field" value="<?php echo $push_waittime; ?>" name="<?php echo $classid . "[waittime]"; ?>" placeholder="time" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"></div>

                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['execute_control'][$type]) || !empty($validationjsonArr['execute_control'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>  
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>
            <?php
            break;
            ?>
        <?php
        //strt mouse handler case
        //for mouse click

        case 'click':
            $target = isset($data['data']['target']) ? $data['data']['target'] : '';
            $path = isset($data['data']['path']) ? $data['data']['path'] : '';
            $x_loc = isset($data['data']['x_loc']) ? $data['data']['x_loc'] : '0';
            $y_loc = isset($data['data']['y_loc']) ? $data['data']['y_loc'] : '0';
            $button = isset($data['data']['button']) ? $data['data']['button'] : '';
            $click_type = isset($data['data']['type']) ? $data['data']['type'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>  Click </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1">Target<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field targetClass-<?php echo $classid; ?>" name="<?php echo $classid . "[target]"; ?>" data-check="blank" data-error="This field is required" onchange="selecetTarget(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="image" <?php echo ($target == "image") ? 'selected' : ''; ?>>Image</option>
                            <option value="position" <?php echo ($target == "position") ? 'selected' : ''; ?>>Position</option>                   
                        </select>
                    </div>
                </div>
                <div class="form-group"  id="clickPath-<?php echo $classid ?>">
                    <label>Path<span style="color:red;">*</span></label>
                    <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-path-<?php echo $classid ?>-0"  class="form-control mandatory_field variablename clickPath-<?php echo $classid ?>" placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <select attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path" class="form-control appendVariable handlerVariableType"  data-id="variablename-path-<?php echo $classid ?>-0">
                        <option value="">Select Variable</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">X-Location</label>
                                    <input type="text" value="<?php echo $x_loc; ?>" name="<?php echo $classid . "[x_loc]"; ?>" id="x_loc-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                    <input type="hidden" value="xloc_yloc" name="<?php echo $classid . "[type_of_action]"; ?>" data-createform-id="<?php echo $classid; ?>"/>
                                    <select attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_location" class="form-control appendVariable handlerVariableType" style="width: 10%;" data-id="x_loc-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Y-Location</label>
                                    <input type="text" value="<?php echo $y_loc; ?>" name="<?php echo $classid . "[y_loc]"; ?>" id="y_loc-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                    <select attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="y_location" class="form-control appendVariable handlerVariableType" style="width: 10%;" data-id="y_loc-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="sel1">Button<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[button]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                            <option value="left_button" <?php echo ($button == "left_button") ? 'selected' : ''; ?>>Left</option>
                            <option value="right_button" <?php echo ($button == "right_button") ? 'selected' : ''; ?>>Right</option>
                            <option value="middle_button" <?php echo ($button == "middle_button") ? 'selected' : ''; ?>>Middle</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="sel1">Type<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[type]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                            <option value="single_click" <?php echo ($click_type == "single_click") ? 'selected' : ''; ?>>Single</option>
                            <option value="double_click" <?php echo ($click_type == "double_click") ? 'selected' : ''; ?>>Double</option>
                            <option value="triple_click" <?php echo ($click_type == "triple_click") ? 'selected' : ''; ?>>Triple</option>
                            <option value="hold_down" <?php echo ($click_type == "hold_down") ? 'selected' : ''; ?>>Hold Down</option>
                            <option value="release" <?php echo ($click_type == "release") ? 'selected' : ''; ?>>Release</option>    
                        </select>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['mouse'][$type]) || !empty($validationjsonArr['mouse'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?> 
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>                    
            <?php
            break;
            //end mouse click
            ?>
        <?php
        //for mouse move
        case 'move':
            $target = isset($data['data']['target']) ? $data['data']['target'] : '';
            $path = isset($data['data']['path']) ? $data['data']['path'] : '';
            $x_loc = isset($data['data']['x_loc']) ? $data['data']['x_loc'] : '0';
            $y_loc = isset($data['data']['y_loc']) ? $data['data']['y_loc'] : '0';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>  Move </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1">Target<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field target_class_click_move_<?php echo $classid; ?>" name="<?php echo $classid . "[target]"; ?>" data-check="blank" data-error="This field is required" onchange="select_target_click_move(this.value, '<?php echo $classid; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="image" <?php echo ($target == "image") ? 'selected' : ''; ?>>Image</option>
                            <option value="position" <?php echo ($target == "position") ? 'selected' : ''; ?>>Position</option>                   
                        </select>
                    </div>
                </div>
                <div class="form-group"  id="click_path_move_<?php echo $classid ?>">
                    <label>Path<span style="color:red;">*</span></label>
                    <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-path-<?php echo $classid ?>-0"  class="form-control mandatory_field variablename click_path_move_<?php echo $classid ?>" placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path"  data-id="variablename-path-<?php echo $classid ?>-0">
                        <option value="">Select Variable</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">X-Location</label>
                                    <input type="text" value="<?php echo $x_loc; ?>" name="<?php echo $classid . "[x_loc]"; ?>" id="x_loc-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                    <input type="hidden" value="xloc_yloc" name="<?php echo $classid . "[type_of_action]"; ?>" data-createform-id="<?php echo $classid; ?>"/>
                                    <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_location" style="width: 10%;" data-id="x_loc-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Y-Location</label>
                                    <input type="text" value="<?php echo $y_loc; ?>" name="<?php echo $classid . "[y_loc]"; ?>" id="y_loc-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                    <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_location" style="width: 10%;" data-id="y_loc-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['mouse'][$type]) || !empty($validationjsonArr['mouse'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?> 
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>        
            <?php
            break;
            //end mouse move
            ?>
        <?php
        //for mouse drag
        case 'drag':
            $target = isset($data['data']['target']) ? $data['data']['target'] : '';
            $path_from = isset($data['data']['path'][0]) ? $data['data']['path'][0] : '';
            $path_to = isset($data['data']['path'][1]) ? $data['data']['path'][1] : '';
            $x_loc_from = isset($data['data']['x_loc'][0]) ? $data['data']['x_loc'][0] : 0;
            $x_loc_to = isset($data['data']['x_loc'][1]) ? $data['data']['x_loc'][1] : 0;
            $y_loc_from = isset($data['data']['y_loc'][0]) ? $data['data']['y_loc'][0] : 0;
            $y_loc_to = isset($data['data']['y_loc'][1]) ? $data['data']['y_loc'][1] : 0;
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>  Drag </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1">Target<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field target_class_click_drag_<?php echo $classid; ?>" name="<?php echo $classid . "[target]"; ?>" data-check="blank" data-error="This field is required" onchange="select_target_click_drag(this.value, '<?php echo $classid; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="image" <?php echo ($target == "image") ? 'selected' : ''; ?>>Image</option>
                            <option value="position" <?php echo ($target == "position") ? 'selected' : ''; ?>>Position</option>                   
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-group">Drag From</label>

                    <div class="form-group"  id="click_path_from_drag_<?php echo $classid ?>">
                        <label>Path<span style="color:red;">*</span></label>
                        <input type="text" value="<?php echo $path_from; ?>" name="<?php echo $classid . "[path_from]"; ?>" id="variablename-path_from-<?php echo $classid ?>-0"  class="form-control mandatory_field variablename click_path_from_drag_<?php echo $classid ?>" placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path"  data-id="variablename-path_from-<?php echo $classid ?>-0">
                            <option value="">Select Variable</option>
                        </select>
                    </div>  

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sel1" class="cell-po">X-Location</label>
                                        <input type="text" value="<?php echo $x_loc_from; ?>" name="<?php echo $classid . "[x_loc_from]"; ?>" id="x_loc_from-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                        <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_location" style="width: 10%;" data-id="x_loc_from-variablename-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sel1" class="cell-po">Y-Location</label>
                                        <input type="text" value="<?php echo $y_loc_from; ?>" name="<?php echo $classid . "[y_loc_from]"; ?>" id="y_loc_from-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                        <select class="form-control appendVariable" style="width: 10%;" data-id="y_loc_from-variablename-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="form-group">
                    <label class="form-group">Drag To</label>

                    <div class="form-group"  id="click_path_to_drag_<?php echo $classid ?>">
                        <label>Path<span style="color:red;">*</span></label>
                        <input type="text" value="<?php echo $path_to; ?>" name="<?php echo $classid . "[path_to]"; ?>" id="variablename-path_to-<?php echo $classid ?>-0"  class="form-control mandatory_field variablename click_path_to_drag_<?php echo $classid ?> " placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable handlerVariableType"  data-id="variablename-path_to-<?php echo $classid ?>-0">
                            <option value="">Select Variable</option>
                        </select>
                    </div>      
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sel1" class="cell-po">X-Location</label>
                                        <input type="text" value="<?php echo $x_loc_to; ?>" name="<?php echo $classid . "[x_loc_to]"; ?>" id="x_loc_to-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                        <select class="form-control appendVariable handlerVariableType" style="width: 10%;" data-id="x_loc_to-variablename-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sel1" class="cell-po">Y-Location</label>
                                        <input type="text" value="<?php echo $y_loc_to; ?>" name="<?php echo $classid . "[y_loc_to]"; ?>" id="y_loc_to-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                        <select class="form-control appendVariable handlerVariableType" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="y_location" style="width: 10%;" data-id="y_loc_to-variablename-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['mouse'][$type]) || !empty($validationjsonArr['mouse'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>   
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>

            <?php
            break;

            //end mouse drag
            ?>
        <?php
        //for mouse scroll

        case 'scroll':
            $target = isset($data['data']['target']) ? $data['data']['target'] : '';
            $path = isset($data['data']['path']) ? $data['data']['path'] : '';
            $x_loc = isset($data['data']['x_loc']) ? $data['data']['x_loc'] : '0';
            $y_loc = isset($data['data']['y_loc']) ? $data['data']['y_loc'] : '0';
            $scroll_dir = isset($data['data']['scroll_dir']) ? $data['data']['scroll_dir'] : '';
            $lines = isset($data['data']['lines']) ? $data['data']['lines'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>  Scroll </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1">Target<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field target_class_click_scroll_<?php echo $classid ?>" name="<?php echo $classid . "[target]"; ?>" data-check="blank" data-error="This field is required" onchange="select_target_click_scroll(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="image" <?php echo ($target == "image") ? 'selected' : ''; ?>>image</option>
                            <option value="position" <?php echo ($target == "position") ? 'selected' : ''; ?>>Position</option>                   
                        </select>
                    </div>
                </div>

                <div class="form-group"  id="click_path_to_scroll_<?php echo $classid ?>">
                    <label>Path<span style="color:red;">*</span></label>
                    <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-path-<?php echo $classid ?>-0"  class="form-control mandatory_field variablename click_path_to_scroll_<?php echo $classid ?>" placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path"  data-id="variablename-path-<?php echo $classid ?>-0">
                        <option value="">Select Variable</option>
                    </select>
                </div>  

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">X-Location</label>
                                    <input type="text" value="<?php echo $x_loc; ?>" name="<?php echo $classid . "[x_loc]"; ?>" id="x_loc-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                    <input type="hidden" value="xloc_yloc" name="<?php echo $classid . "[type_of_action]"; ?>" data-createform-id="<?php echo $classid; ?>"/>
                                    <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_location" style="width: 10%;" data-id="x_loc-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Y-Location</label>
                                    <input type="text" value="<?php echo $y_loc; ?>" name="<?php echo $classid . "[y_loc]"; ?>" id="y_loc-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                    <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="y_location" style="width: 10%;" data-id="y_loc-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1">Scroll Direction<span style="color:red;">*</span></label>
                        <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[scroll_dir]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                            <option value="up" <?php echo ($scroll_dir == "up") ? 'selected' : ''; ?>>Up</option>
                            <option value="down" <?php echo ($scroll_dir == "down") ? 'selected' : ''; ?>>Down</option>
                            <option value="left" <?php echo ($scroll_dir == "left") ? 'selected' : ''; ?>>Left</option>
                            <option value="right" <?php echo ($scroll_dir == "right") ? 'selected' : ''; ?>>Right</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Lines<span style="color:red;">*</span></label>
                    <input type="text" value="<?php echo $lines; ?>" name="<?php echo $classid . "[lines]"; ?>" id="variablename-lines-<?php echo $classid ?>-0"  class="form-control variablename"/>
                    <select class="form-control appendVariable" attr_handler="mouse" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="lines"  data-id="variablename-lines-<?php echo $classid ?>-0">
                        <option value="">Select Variable</option>
                    </select>
                </div>  
                <hr>
                <?php if (!isset($validationjsonArr['mouse'][$type]) || !empty($validationjsonArr['mouse'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?> 
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>

            <?php
            break;

            //end mouse scroll
            //end mouse handler controll
            ?>
        <?php
        /* Start of keyboard keystroke */
        case 'keystroke':
            include('keystroke.php');
            break;
            /* End of keyboard keystroke */
            ?>
        <?php
        //Start of type on image function
        case 'typeonimage':
            include('typeonimage.php');
            break;
            //End of type on image function
            ?>
        <?php
        case 'ifelse':

            $ifelse_value1 = isset($data['data']['value1']) ? $data['data']['value1'] : '';
            $ifelse_value2 = isset($data['data']['value2']) ? $data['data']['value2'] : '';
            $then = isset($data['data']['then']) ? $data['data']['then'] : '';
            $condition = isset($data['data']['condition']) ? $data['data']['condition'] : '';
            $else = isset($data['data']['else']) ? $data['data']['else'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>"> 
                <h3> If-else  </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  </div></div>  
                    </div>
                </div>
                <!-- <div class="col-md-6">
                <label for="sel1">Value1<span style="color:red;">*</span></label>
                        <input type="text" name="<?php echo $classid . "[Value1]"; ?>" class="form-control width-100 mandatory_field" placeholder="Value1" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                </div>
                <div class="col-md-6">
                <label for="sel1">Value2<span style="color:red;">*</span></label>
                        <input type="text" name="<?php echo $classid . "[Value2]"; ?>" class="form-control width-100 mandatory_field" placeholder="Value2" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                </div> -->

                <div class="form-group">
                    <label for="sel1" class="cell-po" >Perform the nested actions if: <span style="color:red;">*</span></label>
                    <div class="form-group">
                    <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                    </select> -->
                        <div class="row"><div class="col-md-6"><input type="text" value="<?php echo $ifelse_value1; ?>" name="<?php echo $classid . "[value1]"; ?>" id="variablename-<?php echo $classid ?>"  class="form-control variablename mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable" attr_handler="condition" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"  data-id="variablename-<?php echo $classid ?>">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[condition]"; ?>" onchange="condition_val(this.value,'<?php echo $classid ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                    <option value="eqls" <?php echo ($condition == "eqls") ? 'selected' : ''; ?>>equals (=) </option>
                                    <option value="not_eqls" <?php echo ($condition == "not_eqls") ? 'selected' : ''; ?>>not equals (!=)</option>
                                    <option value="grt_than" <?php echo ($condition == "grt_than") ? 'selected' : ''; ?>>greater than (>)</option>
                                    <option value="grt_than_and_eqls" <?php echo ($condition == "grt_than_and_eqls") ? 'selected' : ''; ?>>greater than or equals (>=) </option>
                                    <option value="less_than" <?php echo ($condition == "less_than") ? 'selected' : ''; ?>>less than (<) </option>
                                    <option value="less_than_and_eqls" <?php echo ($condition == "less_than_and_eqls") ? 'selected' : ''; ?>>less than or equals (<=)  </option>
                                    <option value="contains" <?php echo ($condition == "contains") ? 'selected' : ''; ?>>contains  </option>
                                    <option value="not_contains" <?php echo ($condition == "not_contains") ? 'selected' : ''; ?>>not contains  </option>
                                    <option value="is_empty" <?php echo ($condition == "is_empty") ? 'selected' : ''; ?>> is empty  </option>
                                    <option value="is_not_empty" <?php echo ($condition == "is_not_empty") ? 'selected' : ''; ?>> is not empty  </option>
                                    <option value="image_on_screen" <?php echo ($condition == "image_on_screen") ? "selected" : ''; ?>> Image On Screen </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                    </select> -->
                        <?php if($condition=='is_empty' || $condition=='is_not_empty' ||$condition=='image_on_screen'){ ?>
                        <div class="row" id="val2-<?php echo $classid ?>" style="display:none;">
                        <?php } else { ?>
                        <div class="row" id="val2-<?php echo $classid ?>" style="display:block;">
                        <?php } ?>
                            <div class="col-md-6"><input type="text" value="<?php echo $ifelse_value2; ?>" name="<?php echo $classid . "[value2]"; ?>" id="variablename-ifelse-<?php echo $classid ?>"  class="form-control variablename" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable" attr_handler="condition" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"  data-id="variablename-ifelse-<?php echo $classid ?>">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sel1">Then<span style="color:red;">*</span></label>
                    <div class="col-md-12">
                        <div class="row">
                            <input type="text" class="form-control width-100 mandatory_field" placeholder="action number" name="<?php echo $classid . "[then]"; ?>" data-check="blank" data-error="This field is required" value="<?php echo $then; ?>" data-createform-id="<?php echo $classid ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sel1">Else<span style="color:red;">*</span></label>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control width-100 mandatory_field" placeholder="action number" name="<?php echo $classid . "[else]"; ?>" data-check="blank" value="<?php echo $else; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['condition'][$type]) || !empty($validationjsonArr['condition'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment"  name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div> 
            <?php
            break;
            ?>
        <?php
        case 'while':

            $while_value1 = isset($data['data']['value1']) ? $data['data']['value1'] : '';
            $while_value2 = isset($data['data']['value2']) ? $data['data']['value2'] : '';
            $while_condition = isset($data['data']['condition']) ? $data['data']['condition'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3> While </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                    <label for="sel1" class="cell-po" >Perform the nested actions if: <span style="color:red;">*</span></label>
                    <div class="form-group">
                    <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                    </select> -->
                        <div class="row"><div class="col-md-6"><input type="text" value="<?php echo $while_value1; ?>" name="<?php echo $classid . "[value1]"; ?>" id="variablename-1-<?php echo $classid ?>"  class="form-control variablename mandatory_field no-var" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable" attr_handler="loop" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"  data-id="variablename-1-<?php echo $classid ?>">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control width-100 mandatory_field whilecondition" name="<?php echo $classid . "[condition]"; ?>" onchange="condition_val(this.value,'<?php echo $classid ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                    <option value="eqls" <?php echo ($while_condition == "eqls") ? "selected" : ''; ?>>equals (=) </option>
                                    <option value="not_eqls" <?php echo ($while_condition == "not_eqls") ? "selected" : ''; ?>>not equals (!=)</option>
                                    <option value="grt_than" <?php echo ($while_condition == "grt_than") ? "selected" : ''; ?>>greater than (>)</option>
                                    <option value="grt_than_and_eqls" <?php echo ($while_condition == "grt_than_and_eqls") ? "selected" : ''; ?>>greater than or equals (>=) </option>
                                    <option value="less_than" <?php echo ($while_condition == "less_than") ? "selected" : ''; ?>>less than (<) </option>
                                    <option value="less_than_and_eqls" <?php echo ($while_condition == "less_than_and_eqls") ? "selected" : ''; ?>>less than or equals (<=)  </option>
                                    <option value="contains" <?php echo ($while_condition == "contains") ? "selected" : ''; ?>>contains  </option>
                                    <option value="not_contains" <?php echo ($while_condition == "not_contains") ? "selected" : ''; ?>>not contains  </option>
                                    <option value="is_empty" <?php echo ($while_condition == "is_empty") ? "selected" : ''; ?>> is empty  </option>
                                    <option value="is_not_empty" <?php echo ($while_condition == "is_not_empty") ? "selected" : ''; ?>> is not empty  </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                    </select> -->
                        <?php if($while_condition=='is_empty' || $while_condition=='is_not_empty'){ ?>
                        <div class="row" id="val2-<?php echo $classid ?>" style="display:none;">
                        <?php } else { ?>
                        <div class="row" id="val2-<?php echo $classid ?>" style="display:block;">
                        <?php } ?>
                        <div class="col-md-6"><input type="text" value="<?php echo $while_value2; ?>" name="<?php echo $classid . "[value2]"; ?>" id="variablename-2-<?php echo $classid ?>"  class="form-control variablename  no-var" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable" attr_handler="loop" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"  data-id="variablename-2-<?php echo $classid ?>">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                <label for="sel1">Then</label>
                        <input type="text" class="form-control width-100" placeholder="action number" name="<?php echo $classid . "[then]"; ?>" data-check="blank" data-error="This field is required" value="<?php echo $then; ?>" data-createform-id="<?php echo $classid ?>">
                </div>
                <div class="col-md-6">
                <label for="sel1">Else<span style="color:red;">*</span></label>
                        <input type="text" class="form-control width-100 mandatory_field" placeholder="action number" name="<?php echo $classid . "[else]"; ?>" data-check="blank"  value="<?php echo $else; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                </div> -->
                <hr>
                <?php if (!isset($validationjsonArr['loop'][$type]) || !empty($validationjsonArr['loop'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?> 
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>
            <?php
            break;
            ?>
        <?php
        case 'foreach':

            $while_value1 = isset($data['data']['value1']) ? $data['data']['value1'] : '';
            $while_value2 = isset($data['data']['value2']) ? $data['data']['value2'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3> Foreach </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label for="sel1" class="cell-po" >Perform the nested actions if: <span style="color:red;">*</span></label>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" value="<?php echo $while_value1; ?>" name="<?php echo $classid . "[value1]"; ?>" id="variablename-1-<?php echo $classid ?>"  class="form-control variablename mandatory_field no-var" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                                        <div class="col-md-6">
                                            <select class="form-control appendVariable" attr_handler="loop" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"  data-id="variablename-1-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        IN
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" value="<?php echo $while_value2; ?>" name="<?php echo $classid . "[value2]"; ?>" id="variablename-2-<?php echo $classid ?>"  class="form-control variablename mandatory_field no-var" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                                        <div class="col-md-6">
                                            <select class="form-control appendVariable" attr_handler="loop" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"  data-id="variablename-2-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['loop'][$type]) || !empty($validationjsonArr['loop'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?> 
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>
            <?php
            break;
            ?>
        <?php
        /* Start of Get Content Location */
        case 'getcontentlocation':
        include('get_content_location.php');
        break;
        /* End of Get Content Location */
        ?> 
        <?php
        case 'openbrowser':

            $open_browser = isset($data['data']['browser']) ? $data['data']['browser'] : '';
            $open_url = isset($data['data']['url']) ? $data['data']['url'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3> Open Browser</h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                    </div>
                </div>

                <div class="form-group">
                    <label for="sel1" class="cell-po" >Browser<span style="color:red;">*</span></label>
                    <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[browser]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <option value="chrome" <?php echo ($open_browser == "chrome") ? 'selected' : ''; ?>>Chrome</option>
                        <option value="firefox" <?php echo ($open_browser == "firefox") ? 'selected' : ''; ?>>Firefox</option>
                        <option value="internetexplorer" <?php echo ($open_browser == "internetexplorer") ? 'selected' : ''; ?>>Internet Explorer</option>
                        <option value="background_chrome" <?php echo ($open_browser == "background_chrome") ? 'selected' : ''; ?>>Background Chrome</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Url<span style="color:red;">*</span></label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" value="<?php echo htmlspecialchars($open_url); ?>" class="form-control width-100 mandatory_field" placeholder="http://" id="open_browser_url_<?php echo $classid ?>" name="<?php echo $classid . "[url]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        </div>
                        <div class="col-md-6">
                            <select class="form-control appendVariable"  data-id="open_browser_url_<?php echo $classid ?>"  attr_handler="web" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url">
                    <option value="">Select Variable</option>
                </select>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (!isset($validationjsonArr['web'][$type]) || !empty($validationjsonArr['web'][$type]['output'])) { ?>
                    <?php include('output.php'); ?>
                <?php } ?>   
                <?php include('failure.php'); ?>
                <?php include('advance.php'); ?>
                <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                <div class="demo82 collapse collapse-content">
                    <div class="collapse-container">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>
            </div>

            <?php
            break;
            ?>

        <?php
        case 'webelement':
            $xpath_getvalue = isset($data['data']['location']) ? $data['data']['location'] : '';
            $mode_getvalue = isset($data['data']['task']) ? $data['data']['task'] : '';
            $mode = isset($data['data']['mode']) ? $data['data']['mode'] : '';
            $button = isset($data['data']['button']) ? $data['data']['button'] : '';
            $checkdefault = "";
            if ($mode_getvalue == "") {
                $checkdefault = "checked";
            }
            $variablename_xpath = isset($data['data']['value']) ? $data['data']['value'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            $variable_name = $data['on_success']['save'][0]['var'];
            $return_type = $data['on_success']['return_type'];
            ?>
            <div class="tab-pane" id="<?php echo $classid ?>">
                <h3>Web element  </h3>
                <div class="show-me12">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Label</label>
                        <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                    </div>
                </div>
                <!-- <div class="collapse-box" style="margin-top:0px;" data-toggle="collapse" data-target=".demo83">Mode</div> -->
                <div class="web-id" class="radio mrg-bottom-15">

                    <input class="webelement_radio" data-id="copy_data-<?php echo $classid ?>" data-class="webelementClass-<?php echo $classid ?>" name="<?php echo $classid . "[task]"; ?>" value="copy_data" type="radio"  <?php echo ($mode_getvalue == "copy_data") ? 'checked' : ''; ?> <?php echo $checkdefault; ?>/>Get Value 
                    <input class="webelement_radio" data-id="set_value-<?php echo $classid ?>" data-class="webelementClass-<?php echo $classid ?>" name="<?php echo $classid . "[task]"; ?>" value="set_value" type="radio" style="margin-left:15px;" <?php echo ($mode_getvalue == "set_value") ? 'checked' : ''; ?> /> Set Value
                    <input class="webelement_radio" data-id="click-<?php echo $classid ?>" data-class="webelementClass-<?php echo $classid ?>" name="<?php echo $classid . "[task]"; ?>" value="click" type="radio" style="margin-left:15px;" <?php echo ($mode_getvalue == "click") ? 'checked' : ''; ?> /> Click
                </div>
                <div id="copy_data-<?php echo $classid ?>" <?php
                if ($checkdefault != "checked") {
                    echo ($mode_getvalue == "copy_data") ? '' : 'style=display:none';
                }
                ?> class="webelementClass-<?php echo $classid ?>">
                    <!-- <div class="collapse-box" data-toggle="collapse" data-target=".demo84">Options</div> -->
                    <!-- <div class="demo84 collapse collapse-content"> -->

                    <div class="form-group">
                        <label for="sel1" class="cell-po" >Mode</label>
                        <select class="form-control width-100" name="<?php echo $classid . "[copy_data-mode]"; ?>" data-id="mode-<?php echo $classid ?>"  data-class="mode-options-<?php echo $classid ?>">
                            <option value="">Please Select Mode </option>
                            <option value="id" <?= $mode == 'id' ? ' selected="selected"' : ''; ?>>ID</option>
                            <option value="name" <?= $mode == 'name' ? 'selected="selected"' : ''; ?>>Name</option>
                            <option value="xpath" <?= $mode == 'xpath' ? 'selected="selected"' : ''; ?>>X Path</option>
                            <option value="class" <?= $mode == 'class' ? 'selected="selected"' : ''; ?>>Class Name</option>
                            <option value="css" <?= $mode == 'css' ? 'selected="selected"' : ''; ?>>CSS Selector</option>
                        </select>   
                    </div>
                    <div class="form-group"> 
                        <label>Location of the element</label>
                        <?php
                        $cpy_value = "";
                        if ($mode_getvalue == "copy_data") {
                            $cpy_value = htmlspecialchars($xpath_getvalue, ENT_QUOTES, 'UTF-8');
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control width-100" name="<?php echo $classid . "[location_getvalue]"; ?>" value="<?php echo $cpy_value; ?>" placeholder="" id="location_getvalue_<?php echo $classid ?>">
                            </div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable"  data-id="location_getvalue_<?php echo $classid ?>"  attr_handler="web" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="location_getvalue">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="set_value-<?php echo $classid ?>" class="webelementClass-<?php echo $classid ?>" <?php echo ($mode_getvalue == "set_value") ? '' : 'style=display:none'; ?>> 
                    <div class="form-group">
                        <label for="sel1" class="cell-po" >Value</label>
                        <input type="text" name="<?php echo $classid . "[value]"; ?>" id="variablename-xpath-<?php echo $classid ?>" value="<?php echo $variablename_xpath; ?>"  class="form-control variablename"/>
                        <select class="form-control appendVariable"  data-id="variablename-xpath-<?php echo $classid ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="cell-po" >Mode</label>
                        <select class="form-control width-100" name="<?php echo $classid . "[set_value-mode]"; ?>" data-id="mode-<?php echo $classid ?>"  data-class="mode-options-<?php echo $classid ?>">
                            <option value="">Please Select Mode </option>
                            <option value="id" <?= $mode == 'id' ? ' selected="selected"' : ''; ?>>ID</option>
                            <option value="name" <?= $mode == 'name' ? 'selected="selected"' : ''; ?>>Name</option>
                            <option value="xpath" <?= $mode == 'xpath' ? 'selected="selected"' : ''; ?>>X Path</option>
                            <option value="class" <?= $mode == 'class' ? 'selected="selected"' : ''; ?>>Class Name</option>
                            <option value="css" <?= $mode == 'css' ? 'selected="selected"' : ''; ?>>CSS Selector</option>
                        </select>   
                    </div>
                    <div class="form-group">
                        <?php
                        $cpy_set_value_xpath = "";
                        if ($mode_getvalue == "set_value") {
                            $cpy_set_value_xpath = htmlspecialchars($xpath_getvalue, ENT_QUOTES, 'UTF-8');
                        }
                        ?>
                        <label>Location of the element</label>
                        <div class="row">
                            <div class="col-md-6">
                                 <input type="text" class="form-control width-100" placeholder="" value="<?php echo $cpy_set_value_xpath; ?>" name="<?php echo $classid . "[location_set_value]"; ?>" id="location_set_value_<?php echo $classid ?>">
                            </div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable"  data-id="location_set_value_<?php echo $classid ?>"  attr_handler="web" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="location_set_value">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="click-<?php echo $classid ?>" class="webelementClass-<?php echo $classid ?>" <?php echo ($mode_getvalue == "click") ? '' : 'style=display:none'; ?>
                     <div class="form-group">
                        <label for="sel1" class="cell-po" >Mode</label>
                        <select class="form-control width-100" name="<?php echo $classid . "[click-mode]"; ?>" data-id="mode-<?php echo $classid ?>"  data-class="mode-options-<?php echo $classid ?>">
                            <option value="">Please Select Mode </option>
                            <option value="id" <?= $mode == 'id' ? ' selected="selected"' : ''; ?>>ID</option>
                            <option value="name" <?= $mode == 'name' ? 'selected="selected"' : ''; ?>>Name</option>
                            <option value="xpath" <?= $mode == 'xpath' ? 'selected="selected"' : ''; ?>>X Path</option>
                            <option value="class" <?= $mode == 'class' ? 'selected="selected"' : ''; ?>>Class Name</option>
                            <option value="css" <?= $mode == 'css' ? 'selected="selected"' : ''; ?>>CSS Selector</option>
                        </select>  
                        <div class="form-group">
                            <?php
                            $cpy_click_xpath = "";
                            if ($mode_getvalue == "click") {
                                $cpy_click_xpath = htmlspecialchars($xpath_getvalue, ENT_QUOTES, 'UTF-8');
                            }
                            ?>
                            <label>Location of the element</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control width-100" value="<?php echo $cpy_click_xpath; ?>" placeholder="" name="<?php echo $classid . "[location_click]"; ?>" id="location_click_<?php echo $classid ?>">                                           </div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable"  data-id="location_click_<?php echo $classid ?>"  attr_handler="web" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="location_click">
                                        <option value="">Select Variable</option>
                                    </select>
                            </div>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label>Button</label>
                            <select class="form-control width-100" name="<?php echo $classid . "[button]"; ?>">
                                <option value="left" <?php echo $button == 'left' ? ' selected="selected"' : ''; ?>>Left</option>
                                <option value="right" <?php echo $button == 'right' ? ' selected="selected"' : ''; ?>>Right</option>
                            </select>
                        </div>
                    </div>   
                    <?php if (!isset($validationjsonArr['web'][$type]) || !empty($validationjsonArr['web'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?> 
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target="#demo82">Comments</div>
                    <div id="demo82" class="collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>
            <?php
            case 'closebrowser':

                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Close Browser</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <hr>
                    <?php if (!isset($validationjsonArr['web'][$type]) || !empty($validationjsonArr['web'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>


                <?php
                break;
                ?>
            <?php
            case 'tabaction':

                $web_url = isset($data['data']['url']) ? $data['data']['url'] : '';
                $modetab=isset($data['data']['mode']) ? $data['data']['mode'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $return_type = $data['on_success']['return_type'];
                $variable_name = $data['on_success']['save'][0]['var'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Tab Action</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="cell-po" >Tab Action<span style="color:red;">*</span></label>
                        <select class="form-control width-100 webactionmode" name="<?php echo $classid . "[mode]"; ?>" data-class="url-options-<?php echo $classid ?>">
                            <option value="new_tab" <?php echo ($modetab == "new_tab") ? 'selected' : ''; ?>>New Tab</option>
                            <option value="change_url" <?php echo ($modetab == "change_url") ? 'selected' : ''; ?>>Change Url</option>
                            <option value="next_tab" <?php echo ($modetab == "next_tab") ? 'selected' : ''; ?>>Next Tab</option>
                            <option value="previous_tab" <?php echo ($modetab == "previous_tab") ? 'selected' : ''; ?>>Previous Tab</option>
                        </select>   
                    </div>
                    <div class="show-me12 url-options-<?php echo $classid ?>">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Url<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo $web_url; ?>" name="<?php echo $classid . "[url]"; ?>" id="variablename-urls1-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="web" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url"
                                    data-id="variablename-urls1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <?php if (!isset($validationjsonArr['web'][$type]) || !empty($validationjsonArr['web'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>

                <?php
                break;
                ?>
            <?php
            case 'assign':
                $value_first = isset($data['data']['value1']) ? $data['data']['value1'] : '';
                $value_second = isset($data['data']['value2']) ? $data['data']['value2'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Assign</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  </div>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Value1<span style="color:red;">*</span></label>
                        <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                                        <option value="">Select Variable</option>
                                                        </select> -->
                        <div class="col-md-6"><input type="text" value="<?php echo $value_first; ?>" name="<?php echo $classid . "[value1]"; ?>" id="variablename-assign1-<?php echo $classid ?>"  class="form-control variablename mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                        <div class="col-md-6">
                            <select class="form-control appendVariable"  data-id="variablename-assign1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sel1">Variable<span style="color:red;">*</span></label>
                        <!-- <select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid . "[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                                        <option value="">Select Variable</option>
                                                        </select> -->
                        <div class="col-md-6"><input type="text" value="<?php echo $value_second; ?>" name="<?php echo $classid . "[value2]"; ?>" id="variablename-assign2-<?php echo $classid ?>"  class="form-control variablename mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                        <div class="col-md-6">
                            <select class="form-control appendVariable"  data-id="variablename-assign2-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <?php if (!isset($validationjsonArr['excel'][$type]) || !empty($validationjsonArr['excel'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>

                <?php
                break;
                ?>
            <?php
            case 'power':

                $value_first = isset($data['data']['value1']) ? $data['data']['value1'] : '';
                $value_second = isset($data['data']['value2']) ? $data['data']['value2'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Power</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Base<span style="color:red;">*</span></label>
                        <div class="col-md-6"><input type="text" value="<?php echo $value_first; ?>" name="<?php echo $classid . "[value1]"; ?>" id="variablename-power1-<?php echo $classid ?>"  class="form-control variablename mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                        <div class="col-md-6">
                            <select class="form-control appendVariable"  data-id="variablename-power1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sel1">Exponent<span style="color:red;">*</span></label>
                        <div class="col-md-6"><input type="text" value="<?php echo $value_second; ?>" name="<?php echo $classid . "[value2]"; ?>" id="variablename-power2-<?php echo $classid ?>"  class="form-control variablename mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/></div>
                        <div class="col-md-6">
                            <select class="form-control appendVariable"  data-id="variablename-power2-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <?php if (!isset($validationjsonArr['excel'][$type]) || !empty($validationjsonArr['excel'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                    </div>
                </div>

                <?php
                break;
                ?>
            <?php
            case 'readtextfromimage':
                $user_id_block = $_SESSION['user']["user_id"];
                if (isset($user_id_block) && !empty($user_id_block)) {
                    $query1 = array();
                    $query1['userId'] = $user_id_block;
                    $robotdata = select_mongo('ocrtemplate', $query1);
                    $robotdataval = add_id($robotdata, "id");
                }
                $path = isset($data['data']['path']) ? $data['data']['path'] : '';
                //$filename=isset($data['data']['filename']) ? $data['data']['filename'] : '';
                $block_distance = isset($data['data']['template_name']) ? $data['data']['template_name'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                $disable = "";
                $checked = "";
                if (sizeof($robotdataval) == '0') {
                    $disable = "disabled";
                    $checked = "checked";
                } else {
                    $disable = "";
                    $checked = "";
                }
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Read Text From Image</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="sel1" class="cell-po">Label</label>
                                <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="sel1">File Path<span style="color:red;">*</span></label>
                            <input type="text" name="<?php echo $classid . "[path]"; ?>" class="form-control width-100 mandatory_field" placeholder="Path" data-check="blank" value="<?php echo $path; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        </div>
                    </div>

                    <!--    <div class="col-md-6">
                                    <label for="sel1">File Name<span style="color:red;">*</span></label>
                                    <input type="text" name="<?php echo $classid . "[filename]"; ?>" class="form-control width-100 mandatory_field" placeholder="File Name" data-check="blank" value="<?php echo $filename; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                            </div> -->
                    <div class="form-group">
                        <div class="col-md-12"> 
                            <div id="newtemplateid">
                                <label for="">New</label>
                                <input type="checkbox" onchange = "use_template(this,'<?php echo $classid ?>')" class="checkbox_newtemp_<?php echo $classid ?>" name="new" id="new" value="1" <?php
                                echo $checked;
                                echo " ";
                                echo $disable;
                                ?>>
                            </div>
                        </div>	
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">                        
                            <label for="sel1">Templates<span style="color:red;">*</span></label>

                            <div class="" id="newtemp_<?php echo $classid ?>">
                            </div>
                            <?php if (!empty($robotdataval) && (count($robotdataval) > 0)) {
                                ?>
                                <div class="" id="newtempselect_<?php echo $classid ?>">
                                    <select class="form-control width-100 mandatory_field" data-check="blank" data-error-show-in="user_error" data-error="Please Select Template" id="template"  name="<?php echo $classid . "[template_name]"; ?>" data-createform-id="<?php echo $classid ?>">
                                        <?php
                                        if (!empty($robotdataval)) {
                                            foreach ($robotdataval as $ro) {
                                                ?>
                                                <option value="<?php echo $ro['template_name']; ?>"<?= $data['data']['template_name'] == $ro['template_name'] ? ' selected="selected"' : ''; ?>><?php echo $ro['template_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select> 
                                    <span class="input_arror error" id="user_error"> </span>
                                    <input type="hidden" name="<?php echo $classid . "[new]"; ?>" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="0" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                </div>

                                <?php
                            } else {
                                $new_block_distance = "";
                                if ($block_distance == '') {
                                    $new_block_distance = $block_distance;
                                }
                                ?>
                                <div class="" id="newtempfirst_<?php echo $classid ?>">
                                    <input type="text" name="<?php echo $classid . "[template_name]"; ?>" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="<?php echo $new_block_distance; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                    <input type="hidden" name="<?php echo $classid . "[new]"; ?>" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="1" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                    <hr>
                    <?php if (!isset($validationjsonArr['ocr'][$type]) || !empty($validationjsonArr['ocr'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>

                <?php
                break;
                ?>      

            <?php
            case 'readtextfrompdf':

                $user_id_block = $_SESSION['user']["user_id"];
                if (isset($user_id_block) && !empty($user_id_block)) {
                    $query1 = array();
                    $query1['userId'] = $user_id_block;
                    $robotdata = select_mongo('ocrtemplate', $query1);
                    $robotdataval = add_id($robotdata, "id");
                }
                $path = isset($data['data']['path']) ? $data['data']['path'] : '';
                //$filename=isset($data['data']['filename']) ? $data['data']['filename'] : '';
                $block_distance = isset($data['data']['template_name']) ? $data['data']['template_name'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                $disable = "";
                $checked = "";
                if (sizeof($robotdataval) == '0') {
                    $disable = "disabled";
                    $checked = "checked";
                } else {
                    $disable = "";
                    $checked = "";
                }
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Read Text From Pdf </h3>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="sel1">File Path<span style="color:red;">*</span></label>
                            <input type="text" name="<?php echo $classid . "[path]"; ?>" class="form-control width-100 mandatory_field" placeholder="Path" data-check="blank" value="<?php echo $path; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        </div>
                    </div>

                    <!--<div class="col-md-6">
                            <label for="sel1">File Name<span style="color:red;">*</span></label>
                            <input type="text" name="<?php echo $classid . "[filename]"; ?>" class="form-control width-100 mandatory_field" placeholder="File Name" data-check="blank" value="<?php echo $filename; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    </div> -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <div id="newtemplateid">
                                <label for="">New</label>
                                <input type="checkbox" onchange = "use_template(this,'<?php echo $classid ?>')"  class="checkbox_newtemp_<?php echo $classid ?>" name="new" id="new_<?php echo $classid ?>" value="1" <?php
                                echo $checked;
                                echo " ";
                                echo $disable;
                                ?>>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">                        
                            <label for="sel1">Templates<span style="color:red;">*</span></label>

                            <div class="" id="newtemp_<?php echo $classid ?>">
                            </div>
                            <?php if (!empty($robotdataval) && (count($robotdataval) > 0)) {
                                ?>
                                <div class="" id="newtempselect_<?php echo $classid ?>">
                                    <select class="form-control width-100 mandatory_field" data-check="blank" data-error-show-in="user_error" data-error="Please Select Template" id="template"  name="<?php echo $classid . "[template_name]"; ?>" data-createform-id="<?php echo $classid ?>">
                                        <?php
                                        if (!empty($robotdataval)) {
                                            foreach ($robotdataval as $ro) {
                                                ?>
                                                <option value="<?php echo $ro['template_name']; ?>" <?= $data['data']['template_name'] == $ro['template_name'] ? ' selected="selected"' : ''; ?>><?php echo $ro['template_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select> 
                                    <span class="input_arror error" id="user_error"> </span>
                                    <input type="hidden" name="<?php echo $classid . "[new]"; ?>" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="0" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                </div>

                                <?php
                            } else {
                                $new_block_distance = "";
                                if ($block_distance == '') {
                                    $new_block_distance = $block_distance;
                                }
                                ?>
                                <div class="" id="newtempfirst_<?php echo $classid ?>">
                                    <input type="text" name="<?php echo $classid . "[template_name]"; ?>" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="<?php echo $new_block_distance; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                    <input type="hidden" name="<?php echo $classid . "[new]"; ?>" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="1" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <hr>
                    <?php if (!isset($validationjsonArr['ocr'][$type]) || !empty($validationjsonArr['ocr'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>
            <?php
            /* Start of Fetch OCR Data */
            case 'fetchocrdata':
                include('fetchocrdata.php');
                break;
                /* End of Fetch OCR Data */
                ?>
                <!--Find Text On Screen -->
            <?php
            case 'findtextonscreen':

                $accuracy_level = isset($data['data']['accuracy_level']) ? $data['data']['accuracy_level'] : '';
                $neighbour = isset($data['data']['neighbour']) ? $data['data']['neighbour'] : '';
                $click_type = isset($data['data']['click_type']) ? $data['data']['click_type'] : '';
                $x = isset($data['data']['x']) ? $data['data']['x'] : '0';
                $y = isset($data['data']['y']) ? $data['data']['y'] : '0';
                $variable_box = isset($data['data']['variable_box']) ? $data['data']['variable_box'] : '';
                $word_to_be_searched = isset($data['data']['word_to_be_searched']) ? $data['data']['word_to_be_searched'] : '';
                //$datalist=isset($data['data']['datalist']) ? $data['data']['datalist'] : '';

                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $variable_name1 = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">

                    <h3>Find Text On Screen</h3>
                    <div class="show-me12">
                        <div class="form-group">							
                            <label for="sel1" class="cell-po">Label</label>
                            <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">						
                        <label for="sel1" class="cell-po" >Accuracy Level<span style="color:red;">*</span></label>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[accuracy_level]"; ?>" data-id="accuracy_level-<?php echo $classid ?>"  data-class="accuracy_level-options-<?php echo $classid ?>" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>">
                                    <option value="">Please Select Accuracy Level </option>
                                    <option value="1" <?= $accuracy_level == '1' ? ' selected="selected"' : ''; ?>>1</option>
                                    <option value="2" <?= $accuracy_level == '2' ? 'selected="selected"' : ''; ?>>2</option>
                                    <option value="3" <?= $accuracy_level == '3' ? 'selected="selected"' : ''; ?>>3</option>
                                    <option value="4" <?= $accuracy_level == '4' ? 'selected="selected"' : ''; ?>>4</option>
                                    <option value="5" <?= $accuracy_level == '5' ? 'selected="selected"' : ''; ?>>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Word to be searched<span style="color:red;">*</span></label>
                            <div class="row"><div class="col-md-6"><input type="text" value="<?php echo $word_to_be_searched; ?>" name="<?php echo $classid . "[word_to_be_searched]"; ?>" id="word_to_be_searched-variablename-<?php echo $classid ?>" class="form-control variablename mandatory_field no-var" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/></div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable" data-id="word_to_be_searched-variablename-<?php echo $classid ?>" attr_handler="ocr" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="word_to_be_searched">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Neighbour<span style="color:red;">*</span></label>
                            <div class="row"><div class="col-md-6"><input type="text" value="<?php echo $neighbour; ?>" name="<?php echo $classid . "[neighbour]"; ?>" id="neighbour-variablename-<?php echo $classid ?>" class="form-control variablename mandatory_field no-var" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/></div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable" data-id="neighbour-variablename-<?php echo $classid ?>" attr_handler="ocr" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="neighbour">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sel1" class="cell-po" >Click Type<span style="color:red;">*</span></label>
                        <div class="row">                        
                            <div class="col-md-12">                        
                                <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[click_type]"; ?>" data-id="click_type-<?php echo $classid ?>"  data-class="accuracy_level-options-<?php echo $classid ?>" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>">
                                    <option value="">Please Select Click Type </option>
                                    <option value="left_click" <?= $click_type == 'left_click' ? ' selected="selected"' : ''; ?>>Left Click</option>
                                    <option value="right_click" <?= $click_type == 'right_click' ? 'selected="selected"' : ''; ?>>Right Click</option>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="cell-po">X-Location</label>
                        <div class="row"><div class="col-md-6"> <input type="text" value="<?php echo $x; ?>" name="<?php echo $classid . "[x]"; ?>" id="x-variablename-<?php echo $classid ?>" class="form-control variablename no-var" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/></div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable" data-id="x-variablename-<?php echo $classid ?>" attr_handler="ocr" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Y-Location</label>
                        <div class="row"><div class="col-md-6"><input type="text" value="<?php echo $y; ?>" name="<?php echo $classid . "[y]"; ?>" id="y-variablename-<?php echo $classid ?>" class="form-control variablename no-var" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/></div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable" data-id="y-variablename-<?php echo $classid ?>" attr_handler="ocr" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="y">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                        </div>
                    </div>   
                    <hr>
                    <?php if (!isset($validationjsonArr['ocr'][$type]) || !empty($validationjsonArr['ocr'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>
            <?php
            case 'textconcatenate':
                $string1 = isset($data['data']['string1']) ? $data['data']['string1'] : '';
                $string2 = isset($data['data']['string2']) ? $data['data']['string2'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Text Concatenate </h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>

                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string1); ?>" name="<?php echo $classid . "[string1]"; ?>" id="variablename-string1-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"
                                    data-id="variablename-string1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="list-st string2_class_<?php echo $classid ?>" id="string2_class_<?php echo $classid ?>">
                        <div  class="form-group sortable add-select-variable-string2-<?php echo $classid ?>">
                            <?php if(empty($string2)){ ?>
                             <div style="position: absolute;z-index: 99;right: 2px;top: 3px;"><span class="pull-right" onclick="add_string2_text('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                            <div id="string2-textbox-0-<?php echo $classid ?>" class="list-st">
                                <label for="sel1" class="cell-po">String to be appended<span style="color:red;">*</span></label>
                                <input type="text" value="<?php echo htmlspecialchars($string2); ?>" name="<?php echo $classid . "[string2][]"; ?>" id="variablename-string2-<?php echo $classid ?>-0"  class="form-control variablename"/>
                                <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"  data-id="variablename-string2-<?php echo $classid ?>-0">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                            <?php } else { 
                                foreach($string2 as $str2val){
                                if($k!=0){
                                $stringlabel="String to be appended";
                                }
                                else
                                {
                                $stringlabel="String to be appended";   
                                }
                                ?>
                             <?php if($k==0){ ?>
                             <div style="position: absolute;z-index: 99;right: 2px;top: 3px;"><span class="pull-right" onclick="add_string2_text('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                             <?php } ?>
                            <div id="string2-textbox-<?php echo $k ?>-<?php echo $classid ?>" class="list-st">
                            <?php if($k!=0){ ?>
                            <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_string2_textbox('<?php echo $k; ?>','<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                            <?php } ?>
                                <label for="sel1" class="cell-po"><?php echo $stringlabel; ?><span style="color:red;">*</span></label>
                                <input type="text" value="<?php echo htmlspecialchars($str2val); ?>" name="<?php echo $classid . "[string2][]"; ?>" id="variablename-string2-<?php echo $classid ?>-<?php echo $k; ?>"  class="form-control variablename"/>
                                <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"  data-id="variablename-string2-<?php echo $classid ?>-<?php echo $k; ?>">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                            <?php $k++; } }?>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>

                <?php
                break;
                ?>  
            <?php
            case 'textlength':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Text Length </h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-textlength-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"  data-id="variablename-textlength-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>  
            <?php
            case 'convertcase':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $case = isset($data['data']['case']) ? $data['data']['case'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Convert Case </h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>

                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-convertcase-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable"  data-id="variablename-convertcase-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="sel1">Case<span style="color:red;">*</span></label>
                            <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[case]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                <option value="">Select Case</option>
                                <option value="upper" <?php echo (!empty($case) && $case == 'upper') ? 'selected="selected"' : '' ?>>UPPER</option>
                                <option value="lower" <?php echo (!empty($case) && $case == 'lower') ? 'selected="selected"' : '' ?>>lower</option>
                                <option value="capitalize" <?php echo (!empty($case) && $case == 'capitalize') ? 'selected="selected"' : '' ?>>Capitalize Each Word</option>
                                <option value="sentence" <?php echo (!empty($case) && $case == 'sentence') ? 'selected="selected"' : '' ?>>Sentence case</option>
                                <option value="toggle" <?php echo (!empty($case) && $case == 'toggle') ? 'selected="selected"' : '' ?>>ToGgLe</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>  
            <?php
            case 'textsplit':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $custom = isset($data['data']['custom']) ? $data['data']['custom'] : '';
                $customcheck=isset($data['data']['custom_check']) ? $data['data']['custom_check'] : '0';
                if($customcheck=="0")
                {
                    $symbol = isset($data['data']['symbol']) ? $data['data']['symbol'] : '';
                }
                else
                {
                   $symbol = "custom"; 
                }
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3> Text Split </h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>

                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-textsplit-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"  data-id="variablename-textsplit-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="sel1">Split By<span style="color:red;">*</span></label>
                            <input type="hidden" value="<?php echo $symbol;  ?>" name="<?php echo $classid . "[symbol]"; ?>" class="variablename-splitby1-<?php echo $classid ?>" class="form-control variablename"/>
                            <select class="form-control appendVariableSplitby" data-id="variablename-splitby1-<?php echo $classid ?>" data-class="<?php echo $classid ?>">
                                <option value="">Select Option</option>
                                <option value="space" <?php echo ($symbol == 'space' ? 'selected="selected"' : ''); ?>>Space</option>
                                <option value="enter" <?php echo ($symbol == 'enter' ? 'selected="selected"' : ''); ?>>Enter</option>
                                <option value="tab" <?php echo ($symbol == 'tab' ? 'selected="selected"' : ''); ?>>Tab</option>
                                <option value="custom" <?php echo ($symbol == 'custom' ? 'selected="<?php echo $customselected; ?>"' : ''); ?>>custom</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" value="<?php echo $customcheck;  ?>" name="<?php echo $classid . "[custom_check]"; ?>" class="custom_check-<?php echo $classid ?>" id="custom_check-<?php echo $classid ?>"/>
                    <?php if($symbol=='custom'){ ?>
                    <div class="show-me12" id="split-variable-splitby1-<?php echo $classid ?>" style="display:block">                  <?php } else { ?>
                    <div class="show-me12" id="split-variable-splitby1-<?php echo $classid ?>" style="display:none">                 <?php } ?>
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Custom<span style="color:red;">*</span></label>
                            <input type="text" name="<?php echo $classid . "[custom]"; ?>" value="<?php echo htmlspecialchars($custom); ?>" id="variablename-custom-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variable"  data-id="variablename-custom-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>
            <?php
            case 'textslice':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $from_index = isset($data['data']['from_index']) ? $data['data']['from_index'] : '';
                $to_index = isset($data['data']['to_index']) ? $data['data']['to_index'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Text Slice</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-textslice-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"
                                    data-id="variablename-textslice-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">From Index<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($from_index); ?>" name="<?php echo $classid . "[from_index]"; ?>" id="variablename-from_index-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="index"
                                    data-id="variablename-from_index-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">To Index<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($to_index); ?>" name="<?php echo $classid . "[to_index]"; ?>" id="variablename-to_index-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="index"
                                    data-id="variablename-to_index-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>      
            <?php
            case 'textremove':
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Text Remove</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                </div>
                <?php
                break;
                ?>
            <?php
            case 'substring':
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Substring</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>
            <?php
            case 'replacesubstringintext':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $substring_to_be_replaced = isset($data['data']['substring_to_be_replaced']) ? $data['data']['substring_to_be_replaced'] : '';
                $replaced_by = isset($data['data']['replaced_by']) ? $data['data']['replaced_by'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Replace Substring in Text</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>

                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-replacesubstringintext-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"
                                    data-id="variablename-replacesubstringintext-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String To Be Replaced<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($substring_to_be_replaced); ?>" name="<?php echo $classid . "[substring_to_be_replaced]"; ?>" id="variablename-replacesubstringintext1-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string_to_be"
                                    data-id="variablename-replacesubstringintext1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Replaced By<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($replaced_by); ?>" name="<?php echo $classid . "[replaced_by]"; ?>" id="variablename-replacesubstringintext2-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="replaced_by"
                                    data-id="variablename-replacesubstringintext2-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>
            <?php
            case 'findtextindex':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $substring_to_be_searched = isset($data['data']['substring_to_be_searched']) ? $data['data']['substring_to_be_searched'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Find Text</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>

                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-findtextindex1-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"
                                    data-id="variablename-findtextindex1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String To Be Searched<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($substring_to_be_searched); ?>" name="<?php echo $classid . "[substring_to_be_searched]"; ?>" id="variablename-findtextindex2-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string_to_be_search"
                                    data-id="variablename-findtextindex2-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>  
            <?php
            case 'texttrim':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $string_to_be_trimed = isset($data['data']['string_to_be_trimed']) ? $data['data']['string_to_be_trimed'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Text Trim</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-texttrim-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"
                                    data-id="variablename-texttrim-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String To Be Trimmed<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string_to_be_trimed); ?>" name="<?php echo $classid . "[string_to_be_trimed]"; ?>" id="variablename-texttrim1-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string_to_be_trimed"
                                    data-id="variablename-texttrim1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>  
            <?php
            case 'stringexistence':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $string_to_be_search = isset($data['data']['string_to_be_search']) ? $data['data']['string_to_be_search'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>String Existence</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-stringoccurence1-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"
                                    data-id="variablename-stringoccurence1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String To Be Searched<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string_to_be_search); ?>" name="<?php echo $classid . "[string_to_be_search]"; ?>" id="variablename-stringoccurence2-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string_to_be_search"
                                    data-id="variablename-stringoccurence2-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php
                break;
                ?>  
            <?php
            case 'textbetweentext':
                $string = isset($data['data']['string']) ? $data['data']['string'] : '';
                $string_after = isset($data['data']['string_after']) ? $data['data']['string_after'] : '';
                $string_before = isset($data['data']['string_before']) ? $data['data']['string_before'] : '';
                $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                $comment = isset($data['nm']) ? $data['nm'] : '';
                $variable_name = $data['on_success']['save'][0]['var'];
                $return_type = $data['on_success']['return_type'];
                ?>
                <div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Text Between Text</h3>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Label</label>
                            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                        </div>
                    </div>

                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string); ?>" name="<?php echo $classid . "[string]"; ?>" id="variablename-textbetweentext1-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string"
                                    data-id="variablename-textbetweentext1-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String after<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string_after); ?>" name="<?php echo $classid . "[string_after]"; ?>" id="variablename-textbetweentext2-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable"  data-id="variablename-textbetweentext2-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="show-me12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">String before<span style="color:red;">*</span></label>
                            <input type="text" value="<?php echo htmlspecialchars($string_before); ?>" name="<?php echo $classid . "[string_before]"; ?>" id="variablename-textbetweentext3-<?php echo $classid ?>"  class="form-control variablename"/>
                            <select class="form-control appendVariable" attr_handler="text_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="string_after"
                                    data-id="variablename-textbetweentext3-<?php echo $classid ?>">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php if (!isset($validationjsonArr['text_operation'][$type]) || !empty($validationjsonArr['text_operation'][$type]['output'])) { ?>
                        <?php include('output.php'); ?>
                    <?php } ?>    
                    <?php include('failure.php'); ?>
                    <?php include('advance.php'); ?>
                    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                    <div class="demo82 collapse collapse-content">
                        <div class="collapse-container">
                            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                        </div>
                    </div>
                    <?php
                    break;
                    ?>
                <?php
                case 'tasklist':
                    ?>
                    <div class="tab-pane" id="<?php echo $classid ?>">
                        <input type="hidden" name="<?php echo $classid . "[tasklist]"; ?>" value="<?php echo $type[1]; ?>">

                        <?php
                        break;
                        ?>      

                    <?php
                    case 'generatedataset':

                        $path = isset($data['data']['path']) ? $data['data']['path'] : '';
                        $name=isset($data['data']['name']) ? $data['data']['name'] : '';
                        $no_of_images = isset($data['data']['no_of_images']) ? $data['data']['no_of_images'] : '';
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Generate Dataset </h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Path<span class="red">*</span></label>
                                <div class="row"><div class="col-md-12"><input type="text" name="<?php echo $classid . "[path]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
                                                                               data-error="This field is required" value="<?php echo $path; ?>" data-createform-id="<?php echo $classid ?>" placeholder="path" /></div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                            <label for="email">Name<span class="red">*</span></label>
                            <input type="text" name="<?php echo $classid . "[name]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
                            data-error="This field is required" value="<?php echo $name; ?>" data-createform-id="<?php echo $classid ?>" placeholder="name" />
                            </div>
                            <div class="form-group width-600">
                                <label for="email">No of images<span class="red">*</span></label>
                                <div class="row"><div class="col-md-12"><input type="text" name="<?php echo $classid . "[no_of_images]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
                                                                               data-error="This field is required" value="<?php echo $no_of_images; ?>" data-createform-id="<?php echo $classid ?>" placeholder="No of images" /></div>
                                </div>
                            </div>
                            <hr>
                            <?php if (!isset($validationjsonArr['face_recognition'][$type]) || !empty($validationjsonArr['face_recognition'][$type]['output'])) { ?>
                                <?php include('output.php'); ?>
                            <?php } ?>  
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <?php
                        break;
                        ?>
                    <?php
                    case 'starttraining':
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Start Training</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <div class="row"><div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"> </div>   
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php if (!isset($validationjsonArr['face_recognition'][$type]) || !empty($validationjsonArr['face_recognition'][$type]['output'])) { ?>
                                <?php include('output.php'); ?>
                            <?php } ?> 
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>

                        </div>

                        <?php
                        break;
                        ?>
                    <?php
                    case 'startrecognizing':

                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Start Recognizing</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <div class="row"><div class="col-md-12"> <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">   </div> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php if (!isset($validationjsonArr['face_recognition'][$type]) || !empty($validationjsonArr['face_recognition'][$type]['output'])) { ?>
                                <?php include('output.php'); ?>
                            <?php } ?> 
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>

                        </div>

                        <?php
                        break;
                        ?>      
                    <?php
                    case 'list':

                        $index = isset($data['data']['index']) ? $data['data']['index'] : '';
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Variable List</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Index<span class="red">*</span></label>
                                <input type="text" name="<?php echo $classid . "[index]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
                                       data-error="This field is required" value="<?php echo $index; ?>"  data-createform-id="<?php echo $classid ?>" placeholder="index" />
                            </div>
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                            </div>

                        </div>

                        <?php
                        break;
                        ?>
                    <?php
                    case 'table':

                        $row = isset($data['data']['row']) ? $data['data']['row'] : '';
                        $column = isset($data['data']['column']) ? $data['data']['column'] : '';
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Variable List</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Row<span class="red">*</span></label>
                                <input type="text" name="<?php echo $classid . "[row]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
                                       data-error="This field is required" value="<?php echo $row; ?>" data-createform-id="<?php echo $classid ?>" placeholder="row" />
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Column<span class="red">*</span></label>
                                <input type="text" name="<?php echo $classid . "[column]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
                                       data-error="This field is required" value="<?php echo $column; ?>" data-createform-id="<?php echo $classid ?>" placeholder="column" />
                            </div>
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                            </div>

                        </div>

                        <?php
                        break;
                        ?>
                    <?php
                    case 'sendmail':

                        $user_id = isset($data['data']['user_id']) ? $data['data']['user_id'] : '';
                        $password = isset($data['data']['password']) ? $data['data']['password'] : '';
                        $to = isset($data['data']['to']) ? $data['data']['to'] : '';
                        $message = isset($data['data']['message']) ? $data['data']['message'] : '';
                        $subject = isset($data['data']['subject']) ? $data['data']['subject'] : '';
                        $smtp_ssl = isset($data['data']['smtp_ssl']) ? $data['data']['smtp_ssl'] : '';
                        $attachment_path = isset($data['data']['attachment_path']) ? $data['data']['attachment_path'] : '';
                        $attachment_type = isset($data['data']['attachment_type']) ? $data['data']['attachment_type'] : '';
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';

                        $check_box_check = isset($data['data']['check_box']) ? $data['data']['check_box'] : '';
                        $checkbox_checked = "";
                        if ($check_box_check != "" && $check_box_check == "true") {
                            $checkbox_checked = "checked";
                        }
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Send Mail Information</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <div class="row">
                                        <div class="col-md-12"><input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"></div></div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Email ID<span class="red">*</span></label>
                                <div class="row"><div class="col-md-6"><input type="text" id="email-<?php echo $classid ?>" name="<?php echo $classid . "[user_id]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $user_id; ?>" data-createform-id="<?php echo $classid ?>" placeholder="User ID" /></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="email_id"  data-id="email-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Password<span class="red">*</span></label>
                                <div class="row"><div class="col-md-6"><input type="password" id="password-<?php echo $classid ?>" name="<?php echo $classid . "[password]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $password; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Password" /></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="password"  data-id="password-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">To<span class="red">*</span></label>
                                <div class="row"><div class="col-md-6"><input type="text" id="to-<?php echo $classid ?>" name="<?php echo $classid . "[to]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $to; ?>" data-createform-id="<?php echo $classid ?>" placeholder="To" /></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="to"  data-id="to-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Message<span class="red">*</span></label>
                                <div class="row"><div class="col-md-6"><input type="text" id="message-<?php echo $classid ?>" name="<?php echo $classid . "[message]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $message; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Message" /></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"  data-id="message-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div></div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Subject<span class="red">*</span></label>
                                <div class="row"><div class="col-md-6"><input type="text" id="subject-<?php echo $classid ?>" name="<?php echo $classid . "[subject]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $subject; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Message" /></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="subject"  data-id="subject-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">SMTP Server/Host<span class="red">*</span></label>
                                <div class="row"><div class="col-md-6"><input type="text" id="smtp_ssl-<?php echo $classid ?>" name="<?php echo $classid . "[smtp_ssl]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $smtp_ssl; ?>" data-createform-id="<?php echo $classid ?>" placeholder="smtp.gmail.com" /></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="smtp_server"  data-id="smtp_ssl-<?php echo $classid ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group width-600">
                                <label for="email">Attachment</label>
                                <div class="row"><div class="col-md-12"><input type="checkbox" class="attachent_checkbox" <?php echo $checkbox_checked; ?> data-show-id="attachment_sendmail-<?php echo $classid ?>" data-id="attachent-<?php echo $classid ?>" id="attachent_checkbox-<?php echo $classid ?>" style="box-shadow:none;"/></div></div>
                                <input type="hidden" name="<?php echo $classid . "[check_box]"; ?>" value="false" id="attachent-<?php echo $classid ?>" class="form-control"/>
                            </div>
                            <div id="attachment_sendmail-<?php echo $classid ?>"  <?php echo ($checkbox_checked == "") ? 'style="display:none"' : ''; ?>>
                                <div class="form-group width-600">
                                    <label for="email">Attachment Path<span class="red">*</span></label>
                                    <div class="row"><div class="col-md-6"><input type="text" id="attachment_path-<?php echo $classid ?>" name="<?php echo $classid . "[attachment_path]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $attachment_path; ?>" data-createform-id="<?php echo $classid ?>"  placeholder="Attachment Path" /></div>
                                        <div class="col-md-6">
                                            <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="attachment_path"  data-id="attachment_path-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="form-group width-600">
                            <label for="email">Attachment Type<span class="red">*</span></label>
                            <input type="text" name="<?php echo $classid . "[attachment_type]"; ?>" class="form-control width-100" data-check="blank"
                            data-error="This field is required" value="<?php echo $attachment_type; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Attachment Path" />
                            </div></div>-->
                            <hr>
                            <?php if (!isset($validationjsonArr['mail'][$type]) || !empty($validationjsonArr['mail'][$type]['output'])) { ?>
                                <?php include('output.php'); ?>
                            <?php } ?> 
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    /* Start of Receive Mail function */
                    case 'receivemail':
                        include('receivemail.php');
                        break;
                        /* End of Receive Mail function */
                        ?>               
                    <?php
                    case 'fetchfromlist':
                        $cell_name = $data['data']['cell_name'];
                        $cell_value = $data['data']['list'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Fatch From List</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>

                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">List<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $cell_value; ?>" name="<?php echo $classid . "[list]"; ?>" id="list-variablename-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="list-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Index<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $cell_value; ?>" name="<?php echo $classid . "[index]"; ?>" id="index-variablename-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="index-variablename-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
                                <?php include('output.php'); ?>
                            <?php } ?>    
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'fetchfromtable':

                        $table_name = $data['data']['table'];
                        $column_value = $data['data']['column'];
                        $row_value = $data['data']['row'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Fatch From List</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>              
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Table<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $table_name; ?>" name="<?php echo $classid . "[table]"; ?>" id="variablename-table-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-table-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Column<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $column_value; ?>" name="<?php echo $classid . "[column]"; ?>" id="variablename-column-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-column-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Row<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $row_value; ?>" name="<?php echo $classid . "[row]"; ?>" id="variablename-row-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-row-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
                                <?php include('output.php'); ?>
                            <?php } ?>    
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'fetchfromdictionary':

                        $keylist_name = $data['data']['keylist'];
                        $dictionary_path_value = $data['data']['dictionary_path'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Fatch From Dictionary</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>              
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Key List<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $keylist_name; ?>" name="<?php echo $classid . "[keylist]"; ?>" id="variablename-keylist-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-keylist-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Dictionary<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $dictionary_path_value; ?>" name="<?php echo $classid . "[dictionary_path]"; ?>" id="variablename-dictionary_path-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-dictionary_path-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
                                <?php include('output.php'); ?>
                            <?php } ?>    
                            <?php include('failure.php'); ?>
                            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'listoperations':
                        $operation_type = isset($data['data']['type']) ? $data['data']['type'] : '';
                        $data_list = isset($data['data']['data']) ? $data['data']['data'] : '';
                        $data_list2 = isset($data['data']['data2']) ? $data['data']['data2'] : '';
                        $value = isset($data['data']['value']) ? $data['data']['value'] : '';
                        $reverse = isset($data['data']['reverse']) ? $data['data']['reverse'] : '';
                        $elements = isset($data['data']['elements']) ? $data['data']['elements'] : '';
                        $index = isset($data['data']['index']) ? $data['data']['index'] : '';
                        $initial_index = isset($data['data']['initial_index']) ? $data['data']['initial_index'] : '';
                        $final_index = isset($data['data']['final_index']) ? $data['data']['final_index'] : '';
                        if ($operation_type == 'delete') {
                            $position1 = isset($data['data']['position']) ? $data['data']['position'] : '';
                        } else {
                            $position = isset($data['data']['position']) ? $data['data']['position'] : '';
                        }
                        $select_operation_type=isset($data['data']['operation_type']) ? $data['data']['operation_type'] : '';
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        $return_type = $data['on_success']['return_type'];
                        $variable_name = $data['on_success']['save'][0]['var'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>List Operations</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                                </div>
                            </div>


                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Type<span style="color:red;">*</span></label>
                                    <select class="form-control width-100 mandatory_field listoperations_dropdown_<?php echo $classid ?>" name="<?php echo $classid . "[type]"; ?>" data-check="blank" data-error="This field is required" onchange="select_list_opt_type(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                                        <option value="">Select Type</option>
                                        <option value="append" <?php echo $operation_type == 'append' ? ' selected="selected"' : ''; ?>>Append</option>
                                        <option value="clear" <?php echo $operation_type == 'clear' ? ' selected="selected"' : ''; ?>>Clear</option>
                                        <option value="insert" <?php echo $operation_type == 'insert' ? ' selected="selected"' : ''; ?>>Insert</option>
                                        <option value="delete" <?php echo $operation_type == 'delete' ? ' selected="selected"' : ''; ?>>Delete</option>
                                        <option value="length" <?php echo $operation_type == 'length' ? ' selected="selected"' : ''; ?>>Length</option>
                                        <option value="delete_empty_fields" <?php echo $operation_type == 'delete_empty_fields' ? ' selected="selected"' : ''; ?>>Delete Empty Fields</option>
                                        <option value="sort" <?php echo $operation_type == 'sort' ? ' selected="selected"' : ''; ?>>Sort</option>
                                        <option value="fetch" <?php echo $operation_type == 'fetch' ? ' selected="selected"' : ''; ?>>Fetch</option>
                                        <option value="reverse" <?php echo $operation_type == 'reverse' ? ' selected="selected"' : ''; ?>>Reverse</option>
                                        <option value="set_operation" <?php echo $operation_type == 'set_operation' ? ' selected="selected"' : ''; ?>>Set Operations</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group show-me12">
                                <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List<span style='color:red;'>*</span></label>
                                <input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='List' name="<?php echo $classid . "[data]"; ?>" value="<?php echo $data_list; ?>" id="variablename-data1-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="list" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-data1-<?php echo $classid; ?>-0">
                                    <option value=''>Select Variable</option>
                                </select>
                            </div>
                            <?php if($operation_type=="set_operation"){?>
                            <div class="form-group show-me12" id="list2_<?php echo $classid; ?>" style="display:block;"><?php } else { ?>
                            <div class="form-group show-me12" id="list2_<?php echo $classid; ?>" style="display:none;"><?php } ?>
                                <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List 2<span style='color:red;'>*</span></label>
                                <input type='text' class='form-control mandatory_field list2_data_<?php echo $classid ?>' style='width:85%;' placeholder='List2' name="<?php echo $classid . "[data2]"; ?>" value="<?php echo $data_list2; ?>" id="variablename-list2-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="list2" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-list2-<?php echo $classid; ?>-0">
                                    <option value=''>Select Variable</option>
                                </select>
                            </div>
                            <div id="valuelistAppend_<?php echo $classid ?>" style="display:none">
                                <div  class="form-group add-select-variable-valuList_<?php echo $classid ?>">
                                    
                                    <?php
                                    if (empty($value)) {
                                        ?>
                                        <div id="valuList-box-0_<?php echo $classid ?>" class="list-st">
                                        <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_value_listopt('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                            <div class="form-group show-me12" id="valuList-value-box-0_<?php echo $classid ?>">
                                                <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                                                <input type='text' class='form-control valuelistAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[0]; ?>" id="variablename-value1-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value" style='width: 5%;'  data-id="variablename-value1-<?php echo $classid; ?>-0">
                                                    <option value=''>Select Variable</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="sortable section-add-value-listopt-action-<?php echo $classid ?>"></div>
                                    <?php } else { ?>
                                        <?php
                                        $k = 0;
                                        $type = $value[0];
                                        ?>
            <div id="valuList-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                                            <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_value_listopt('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="valuList-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control valuelistAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[$k]; ?>" id="variablename-value1-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value1-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>

                                                </div>

                                            </div>
                                        <div class="sortable section-add-value-listopt-action-<?php echo $classid ?>">
                                        <?php
                                        $k = 1;
                                        if($operation_type == 'append'){
                                        unset($value[0]);
                                        }
                                        foreach ($value as $type) {
                                            $ans = $k;
                                            ?>
                                            <div id="valuList-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                                                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_value_listopt('<?php echo $k; ?>', '<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="valuList-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control valuelistAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[$k]; ?>" id="variablename-value1-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value1-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>

                                                </div>

                                            </div>
                                            <?php
                                            $k++;
                                        }
                                        ?>
                                        </div>
            <?php } ?>

                                </div>
                            </div>

                            <div id="valuelistInsert_<?php echo $classid; ?>" style="display:none">
                                <div class="form-group show-me12" id="position-value-box-0_<?php echo $classid ?>">
                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label>
                                    <input type='text' class='form-control valuelistInsert_<?php echo $classid; ?> valuelistInsertPosition_<?php echo $classid; ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position1]"; ?>" value="<?php echo $position; ?>"id="variablename-position1-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="position" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-position1-<?php echo $classid; ?>-0">
                                        <option value=''>Select Variable</option>
                                    </select>
                                </div>
                                <div  class="form-group add-select-variable-valuelistInsert_<?php echo $classid; ?>">
                                    
                                    <?php
                                    if (empty($value)) {
                                        ?>
                                        <div id="valuelistInsert-box-0_<?php echo $classid; ?>" class="list-st">
                                        <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_insert_listopt('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                            <div class="form-group show-me12" id="valuelistInsert-value-box-0_<?php echo $classid; ?>">
                                                <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                                                <input type='text' class='form-control valuelistInsert_<?php echo $classid; ?> valuelistInsertValue_<?php echo $classid; ?>' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[0]; ?>" id="variablename-value2-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value2-<?php echo $classid; ?>-0">
                                                    <option value=''>Select Variable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sortable section-add-insert-listopt-action-<?php echo $classid ?>"></div>
                                    <?php } else { ?>
                                        <?php
                                        $k = 0;
                                        $type = $value[0];
                                        ?>
                                        <div id="valuelistInsert-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                                            <div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="add_insert_listopt('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="valuelistInsert-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control valuelistInsert_<?php echo $classid; ?>' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[$k]; ?>" id="variablename-value2-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value2-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <div class="sortable section-add-insert-listopt-action-<?php echo $classid ?>">
                                        <?php
                                        $k = 1;
                                        if($operation_type == 'insert'){
                                        unset($value[0]);
                                        }
                                        foreach ($value as $type) {
                                            $ans = $k;
                                            ?>
                                            <div id="valuelistInsert-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                                                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_insert_listopt('<?php echo $k; ?>', '<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="valuelistInsert-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control valuelistInsert_<?php echo $classid; ?>' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[$k]; ?>" id="variablename-value2-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value2-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php
                                            $k++;
                                        }
                                        ?>
                                        </div>
            <?php } ?>

                                </div>
                            </div>


                            <div id="valuelistDelete_<?php echo $classid ?>" style="display:none">
                                <div  class="form-group add-select-variable-valuelistDelete_<?php echo $classid ?>">
                                    
                                    <?php
                                    if (empty($position1)) {
                                        ?>
                                        <div id="valuelistDelete-box-0_<?php echo $classid ?>" class="list-st">
                                        <div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="add_position('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                            <div class="form-group show-me12" id="valuelistDelete-value-box-0_<?php echo $classid ?>">
                                                <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label>
                                                <input type='text' class='form-control valuelistDelete_<?php echo $classid ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position][]"; ?>" value="<?php echo $position[0]; ?>" id="variablename-position-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="position" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-position-<?php echo $classid; ?>-0">
                                                    <option value=''>Select Variable</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="sortable section-add-position-action-<?php echo $classid ?>"></div>
                                    <?php } else { ?>
                                        <?php
                                        $k = 0;
                                        $type = $position1[0];
                                        ?>
                                        <div id="valuelistDelete-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                                                <div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="add_position('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="valuelistDelete-position-box-<?php echo $k; ?>_<?php echo $classid ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control valuelistDelete_<?php echo $classid ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position][]"; ?>" value="<?php echo $position1[$k]; ?>" id="variablename-position-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="position" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-position-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>

                                                </div>

                                            </div>
                                        <div class="sortable section-add-position-action-<?php echo $classid ?>">
                                        <?php 
                                        $k = 1;
                                        if($operation_type == 'delete'){
                                        unset($position1[0]);
                                        }
                                        foreach ($position1 as $type) {
                                            $ans = $k;
                                            ?>
                                            <div id="valuelistDelete-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                                                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_position('<?php echo $k; ?>','<?php echo $classid; ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="valuelistDelete-position-box-<?php echo $k; ?>_<?php echo $classid ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control valuelistDelete_<?php echo $classid ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position][]"; ?>" value="<?php echo $position1[$k]; ?>" id="variablename-position-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="position" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-position-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>

                                                </div>

                                            </div>
                                            <?php
                                            $k++;
                                        }
                                        ?>
                                        </div>
            <?php } ?>

                                </div>
                            </div>

                            <div class="show-me12" id="fetchList_<?php echo $classid ?>" style="display:none">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Fetch<span style="color:red;">*</span></label>
                                    <select class="form-control width-100 mandatory_field fetchList_<?php echo $classid ?>" name="<?php echo $classid . "[elements]"; ?>" data-check="blank" data-error="This field is required" onchange="selectFetchType(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                                        <option value="">Select Type</option>
                                        <option value="list" <?php echo $elements == 'list' ? ' selected="selected"' : ''; ?>>Element</option>
                                        <option value="slice" <?php echo $elements == 'slice' ? ' selected="selected"' : ''; ?>>Slice</option>
                                    </select>
                                </div>
                            </div>

                            <div id="listIndex_<?php echo $classid ?>" style="display:none">
                                <div  class="form-group add-select-variable-listIndex_<?php echo $classid ?>">
                                    
            <?php
            if (empty($index)) {
                ?>
                                        <div id="listIndex-box-0_<?php echo $classid ?>" class="list-st">
                                        <div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="add_list_index('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                            <div class="form-group show-me12" id="listIndex-value-box-0_<?php echo $classid ?>">
                                                <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Index<span style='color:red;'>*</span></label>
                                                <input type='text' class='form-control listIndex_<?php echo $classid ?>' style='width:85%;' placeholder='Index' name="<?php echo $classid . "[index][]"; ?>" value="<?php echo $index[0]; ?>" id="variablename-index-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="index" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-index-<?php echo $classid; ?>-0">
                                                    <option value=''>Select Variable</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="sortable section-add-list-index-action-<?php echo $classid ?>"></div>
                                    <?php } else { ?>
                                        <?php
                                        $k = 0;
                                        $type = $index[0];
                                        ?>
                                        <div id="listIndex-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                                                <div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="add_list_index('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="listIndex-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Index<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control listIndex_<?php echo $classid ?>' style='width:85%;' placeholder='Index' name="<?php echo $classid . "[index][]"; ?>" value="<?php echo $index[$k]; ?>" id="variablename-index-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="index" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-index-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>

                                                </div>

                                            </div>
                                        <div class="sortable section-add-list-index-action-<?php echo $classid ?>">
                                        <?php
                                        $k = 1;
                                        if($operation_type == 'fetch'){
                                        unset($index[0]);
                                        }
                                        foreach ($index as $type) {
                                            $ans = $k;
                                            ?>
                                            <div id="listIndex-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                                                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_list_index('<?php echo $k; ?>', '<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                                <div class="form-group show-me12" id="listIndex-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                                                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Index<span style='color:red;'>*</span></label>
                                                    <input type='text' class='form-control listIndex_<?php echo $classid ?>' style='width:85%;' placeholder='Index' name="<?php echo $classid . "[index][]"; ?>" value="<?php echo $index[$k]; ?>" id="variablename-index-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                                                    <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="index" class='form-control appendVariable' style='width: 5%;'  data-id="variablename-index-<?php echo $classid; ?>-<?php echo $k; ?>">
                                                        <option value=''>Select Variable</option>
                                                    </select>

                                                </div>

                                            </div>
                                            <?php
                                            $k++;
                                        }
                                        ?>
                                        </div>
            <?php } ?>

                                </div>
                            </div>

                            <div class="row" id="fetchSlice_<?php echo $classid ?>" style="display: none">
                                <div class="col-md-12" id="fetchSlice_<?php echo $classid ?>" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sel1" class="cell-po">Start-Index</label>
                                                <input type="text" value="<?php echo $initial_index; ?>" name="<?php echo $classid . "[initial_index]"; ?>" id="initial_index-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename fetchSlice" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                                <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="index" class="form-control appendVariable" style="width: 10%;" data-id="initial_index-variablename-<?php echo $classid ?>">
                                                    <option value="">Select Variable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sel1" class="cell-po">Stop-Index</label>
                                                <input type="text" value="<?php echo $final_index; ?>" name="<?php echo $classid . "[final_index]"; ?>" id="final_index-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename fetchSlice" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                                <select attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="index" class="form-control appendVariable" style="width: 10%;" data-id="final_index-variablename-<?php echo $classid ?>">
                                                    <option value="">Select Variable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="show-me12 listoperations_reverse_position-<?php echo $classid ?>" id="listoperations_reverse_position_<?php echo $classid ?>"style="display:none">
                                <div class="form-group">
                                    <input type="checkbox" value="True" name="<?php echo $classid . "[reverse]"; ?>" <?php echo $reverse == 'True' ? ' checked="checked"' : ''; ?> class="listoperations_reverse_position_<?php echo $classid ?>"/> <label for="sel1" class="cell-po">    Reverse</label>
                                </div>
                            </div>
                            <?php if($operation_type=="set_operation"){?>
                            <div class="show-me12" id="opration_type_<?php echo $classid ?>" style="display:block;"><?php } else {?>
                                        <div class="show-me12" id="opration_type_<?php echo $classid ?>" style="display:none;"><?php } ?>
                                            <div class="form-group">
                                                <label for="sel1" class="cell-po">Operation Type<span style="color:red;">*</span></label>
                                                <select class="form-control width-100  operation_type_drop_<?php echo $classid ?>" name="<?php echo $classid . "[operation_type]"; ?>" data-check="blank" data-error="This field is required" onchange="select_operation_type(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                                                    <option value="">Select Type</option>
                                                    <option value="union" <?php echo $select_operation_type == 'union' ? ' selected="selected"' : ''; ?>>Union</option>
                                                    <option value="intersection" <?php echo $select_operation_type == 'intersection' ? ' selected="selected"' : ''; ?>>Intersection</option>
                                                    <option value="difference" <?php echo $select_operation_type == 'difference' ? ' selected="selected"' : ''; ?>>Difference</option>
                                                    <option value="subset" <?php echo $select_operation_type == 'subset' ? ' selected="selected"' : ''; ?>>Subset</option>
                                                </select>
                                            </div>
                                        </div>
            <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?>
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'tableoperations':

                        include('table_operation.php');
                        break;
                    case 'tableoperations1':

                        $list_name = $data['data']['list'];
                        $list_type = $data['data']['type'];
                        $table_value = $data['data']['table'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>List Operations</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>              
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Table<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $table_value; ?>" name="<?php echo $classid . "[table]"; ?>" id="variablename-var1-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-var1-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Type<span style="color:red;">*</span></label>
                                    <select class="form-control table_dropdown" name="<?php echo $classid . "[type]"; ?>" style="width: 100%;" data-id="<?php echo $classid ?>">
                                        <option value="">Select Type</option>
                                        <option value="append" <?php echo $list_type == 'append' ? ' selected="selected"' : ''; ?>>Append</option>
                                        <option value="clear" <?php echo $list_type == 'clear' ? ' selected="selected"' : ''; ?>>Clear</option>
                                        <option value="insert" <?php echo $list_type == 'insert' ? ' selected="selected"' : ''; ?>>Insert</option>
                                        <option value="delete" <?php echo $list_type == 'delete' ? ' selected="selected"' : ''; ?>>Delete</option>
                                        <option value="length" <?php echo $list_type == 'length' ? ' selected="selected"' : ''; ?>>Length</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12 show-position-<?php echo $classid ?>" style="display:none">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Position<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $table_value; ?>" name="<?php echo $classid . "[position]"; ?>" id="variablename-position-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-position-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>

                            <div class="show-me12 show-list-position-<?php echo $classid ?>" style="display:none">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">List<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $list_name; ?>" name="<?php echo $classid . "[list]"; ?>" id="variablename-var2-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-var2-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
            <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?>    
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'appendtodictionary':
                        $keylist_name = $data['data']['keylist'];
                        $dictionary_path_value = $data['data']['dictionary_path'];
                        $valuelist_value = $data['data']['valuelist'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>List Operations</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>              

                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Key List<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $keylist_name; ?>" name="<?php echo $classid . "[keylist]"; ?>" id="variablename-var1-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-var1-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Value List<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $valuelist_value; ?>" name="<?php echo $classid . "[valuelist]"; ?>" id="variablename-var2-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-var2-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Dictionary Path<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo $dictionary_path_value; ?>" name="<?php echo $classid . "[dictionary_path]"; ?>" id="variablename-var3-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable"  data-id="variablename-var3-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
            <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?>    
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'message':
                        $mode = $data['data']['mode'];
                        $message = $data['data']['message'];
                        $valuelist_value = $data['data']['valuelist'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Message</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Mode<span style="color:red;">*</span></label>
                                    <select class="form-control mandatory_field"  name="<?php echo $classid . "[mode]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                        <option value="">Select Mode</option>
                                        <option value="message" <?php echo ($mode == "message") ? 'selected' : ''; ?>>Message</option>
                                        <option value="success" <?php echo ($mode == "success") ? 'selected' : ''; ?>>Success</option>
                                        <option value="error" <?php echo ($mode == "error") ? 'selected' : ''; ?>>Error</option>
                                        <option value="warning" <?php echo ($mode == "warning") ? 'selected' : ''; ?>>Warning</option>
                                    </select>
                                </div>
                            </div>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Message<span style="color:red;">*</span></label>
                                    <input type="text" value="<?php echo htmlspecialchars($message); ?>" name="<?php echo $classid . "[message]"; ?>" id="variablename-message1-<?php echo $classid ?>"  class="form-control variablename"/>
                                    <select class="form-control appendVariable" attr_handler="popup" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"
                                            data-id="variablename-message1-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
            <?php if (!isset($validationjsonArr['popup'][$type]) || !empty($validationjsonArr['popup'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?> 
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'inputbox':

                        $mode = $data['data']['mode'];
                        $message = $data['data']['message'];
                        $valuelist_value = $data['data']['valuelist'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        $return_type = $data['on_success']['return_type'];
                        $variable_name = $data['on_success']['save'][0]['var'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Input Box</h3>
                            <div class="show-me12"  >
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>              
                            <input type="hidden" value="<?php echo $mode; ?>" id="inputbox-mode-<?php echo $classid; ?>"  name="<?php echo $classid . "[mode]"; ?>" class="form-control"/>  
                            <div id="message-msgbox-<?php echo $classid; ?>">
                                 <?php if (empty($message)) { ?>
                                    <div class="show-me12 list-st">
                                    <div class="input-group pull-right" style="position:absolute;right:11px;z-index:2;"><i class="add-element-button fa fa-plus" onclick="add_message_fields('<?php echo $classid; ?>', '1', '<?php echo $type; ?>'); return false;"></i></div>					
                                        <div class="form-group">
                                            <label for="sel1" class="cell-po message_field_count_<?php echo $classid; ?>">Field-1<span style="color:red;">*</span></label>
                                            <input type="text" value="<?php echo $message_value; ?>" name="<?php echo $classid . "[message][]"; ?>" id="variablename-message1-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename"/>
                                            <select class="form-control appendVariable" attr_handler="popup" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"  data-id="variablename-message1-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sortable section-input-box-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
                                    <?php 
                                    $k = 0;
                                    $new_k = $k + 1;
                                    $message_value = $message[0];
                                    ?>
                                    <div class="show-me12 list-st" id="message_field_count_<?php echo $classid; ?>">
                    <div class="input-group pull-right" style="position:absolute;right:11px;z-index:2;"><i class="add-element-button fa fa-plus" onclick="add_message_fields('<?php echo $classid; ?>', '1', '<?php echo $type; ?>'); return false;"></i></div>
                                        <div class="form-group">
                                            <label for="sel1" class="cell-po message_field_count_<?php echo $classid; ?>">Field-<?php echo $new_k; ?><span style="color:red;">*</span></label>
                                            <input type="text" value="<?php echo $message_value; ?>" name="<?php echo $classid . "[message][]"; ?>" id="variablename-message1-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename"/>
                                            <select class="form-control appendVariable" attr_handler="popup" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"
                                                    data-id="variablename-message1-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sortable section-input-box-action-<?php echo $classid ?>">
                                    <?php 
                                    $k = 1;
                                    unset($message[0]);
                                    foreach ($message as $message_value) {
                                        $new_k = $k + 1; ?>
                                    <div class="show-me12 list-st" id="message_field_count_<?php echo $classid; ?>">
                                            <div class="pull-right"><i class="add-element-button fa fa-minus remove_message_box" data-id="message_field_count_<?php echo $classid; ?>" data-class="<?php echo $classid; ?>"></i></div>
                                        <div class="form-group">
                                            <label for="sel1" class="cell-po message_field_count_<?php echo $classid; ?>">Field-<?php echo $new_k; ?><span style="color:red;">*</span></label>
                                            <input type="text" value="<?php echo $message_value; ?>" name="<?php echo $classid . "[message][]"; ?>" id="variablename-message1-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename"/>
                                            <select class="form-control appendVariable" attr_handler="popup" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"
                                                    data-id="variablename-message1-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                <?php $k++;
                }?></div> 
            <?php } ?>
                            </div>
                            <hr>
            <?php if (!isset($validationjsonArr['popup'][$type]) || !empty($validationjsonArr['popup'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?> 
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    case 'choicebox':

                        $mode = $data['data']['mode'];
                        $message = $data['data']['message'];
                        $valuelist_value = $data['data']['valuelist'];
                        $wait_time = $data['on_success']['next']['wait_time'];
                        $next_action = $data['on_success']['next']['next_action'];
                        $comment = $data['nm'];
                        $return_type = $data['on_success']['return_type'];
                        $variable_name = $data['on_success']['save'][0]['var'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>Choice Box</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>              
                            <input type="hidden" value="<?php echo $mode; ?>" id="choicebox-mode-<?php echo $classid; ?>"  name="<?php echo $classid . "[mode]"; ?>" class="form-control"/> 
                            <div id="message-msgbox-<?php echo $classid; ?>" >
                            <?php if (empty($message)) { ?>
                                    <div class="show-me12 list-st">
                                    <div class="input-group pull-right" style="position:absolute;right:11px;z-index:2;"><i class="add-element-button fa fa-plus" onclick="add_message_fields('<?php echo $classid; ?>', '2', '<?php echo $type; ?>'); return false;"></i></div>
                                        <div class="form-group">
                                            <label for="sel1" class="cell-po message_field_count_<?php echo $classid; ?>">Field-1<span style="color:red;">*</span></label>
                                            <input type="text" name="<?php echo $classid . "[message][]"; ?>" id="variablename-message1-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename"/>
                                            <select class="form-control appendVariable" attr_handler="popup" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"  data-id="variablename-message1-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="sortable section-input-box-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
            <?php
            $k = 0;
            $new_k = $k + 1;
            $message_value=$message[0];
            ?>
            <div class="show-me12 list-st" id="message_field_count_<?php echo $classid; ?>">
                                        <div class="input-group pull-right" style="position:absolute;right:11px;z-index:2;"><i class="add-element-button fa fa-plus" onclick="add_message_fields('<?php echo $classid; ?>', '2', '<?php echo $type; ?>'); return false;"></i></div>
                                   
                                        <div class="form-group">
                                            <label for="sel1" class="cell-po message_field_count_<?php echo $classid; ?>">Field-<?php echo $new_k; ?><span style="color:red;">*</span></label>
                                            <input type="text" value="<?php echo $message_value; ?>" name="<?php echo $classid . "[message][]"; ?>" id="variablename-message1-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename"/>
                                            <select class="form-control appendVariable" attr_handler="popup" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"  data-id="variablename-message1-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
            </div>
            <div class="sortable section-input-box-action-<?php echo $classid ?>">
            <?php
            $k = 1;
            unset($message[0]);
            foreach ($message as $message_value) {
                $new_k = $k + 1;
                ?>
                                    <div class="show-me12 list-st" id="message_field_count_<?php echo $classid; ?>">
                                            <div class="pull-right" style="position:absolute;right:11px;z-index:2;"style="position:absolute;right:11px;z-index:2;"><i class="add-element-button fa fa-minus remove_message_box" data-id="message_field_count_<?php echo $classid; ?>" data-class="<?php echo $classid; ?>"></i></div>				
                                        <div class="form-group">
                                            <label for="sel1" class="cell-po message_field_count_<?php echo $classid; ?>">Field-<?php echo $new_k; ?><span style="color:red;">*</span></label>
                                            <input type="text" value="<?php echo $message_value; ?>" name="<?php echo $classid . "[message][]"; ?>" id="variablename-message1-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename"/>
                                            <select class="form-control appendVariable" attr_handler="popup" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="message"  data-id="variablename-message1-<?php echo $classid ?>">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php $k++;
                                } ?>
            </div>
            <?php } ?>
                            </div>
            <?php if (!isset($validationjsonArr['popup'][$type]) || !empty($validationjsonArr['popup'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?>    
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
        <?php
        case 'fileexplorer':

            $wait_time = $data['on_success']['next']['wait_time'];
            $next_action = $data['on_success']['next']['next_action'];
            $comment = $data['nm'];
            $return_type = $data['on_success']['return_type'];
            $variable_name = $data['on_success']['save'][0]['var'];
            ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>File Explorer</h3>
                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
                                </div>
                            </div>     
            <?php if (!isset($validationjsonArr['popup'][$type]) || !empty($validationjsonArr['popup'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?>
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        ?>
                    <?php
                    /* Start of Api Handler  get function */
                    case 'get':
                        include('get.php');
                        break;
                        /* End of Api Handler  get function */
                        ?>
                    <?php
                    //strt file actions
                    case 'fileactions':

                        $action = isset($data['data']['action']) ? $data['data']['action'] : '';
                        $path = isset($data['data']['path']) ? $data['data']['path'] : '';
                        $source_path = isset($data['data']['source_path']) ? $data['data']['source_path'] : '';
                        $destination_path = isset($data['data']['destination_path']) ? $data['data']['destination_path'] : '';
                        $content = isset($data['data']['content']) ? $data['data']['content'] : '';
                        $mode = isset($data['data']['mode']) ? $data['data']['mode'] : '';
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        $return_type = $data['on_success']['return_type'];
                        $variable_name = $data['on_success']['save'][0]['var'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>  File Actions</h3>

                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="sel1">Action<span style="color:red;">*</span></label>
                                    <select class="form-control width-100 mandatory_field file_action_<?php echo $classid ?>" name="<?php echo $classid . "[action]"; ?>" data-check="blank" data-error="This field is required" onchange="select_dropdown_file(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                                        <option value="create" <?php echo ($action == "create") ? 'selected' : ''; ?>>Create</option>
                                        <option value="open" <?php echo ($action == "open") ? 'selected' : ''; ?>>Open</option>
                                        <option value="write" <?php echo ($action == "write") ? 'selected' : ''; ?>>Write</option>
                                        <option value="copy" <?php echo ($action == "copy") ? 'selected' : ''; ?>>Copy</option>
                                        <option value="read" <?php echo ($action == "read") ? 'selected' : ''; ?>>Read</option>
                                        <option value="delete" <?php echo ($action == "delete") ? 'selected' : ''; ?>>Delete</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="mode_option_<?php echo $classid ?>" style="display:none">
                                    <label for="sel1">Mode<span style="color:red;">*</span></label>
                                    <select class="form-control width-100 mode_option_<?php echo $classid ?>" name="<?php echo $classid . "[mode]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                        <option value="" >Select Mode</option>
                                        <option value="overwrite" <?php echo ($mode == "overwrite") ? 'selected' : ''; ?>>Overwrite</option>
                                        <option value="append" <?php echo ($mode == "append") ? 'selected' : ''; ?>>Append</option>                           
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"  id="content_var_file_<?php echo $classid ?>" style="display:none">
                                <label>Content<span style="color:red;">*</span></label>
                                <input type="text" value="<?php echo $content; ?>" name="<?php echo $classid . "[content]"; ?>" id="variablename-content-<?php echo $classid ?>-0"  class="form-control variablename content_var_file_<?php echo $classid ?>" placeholder="Content" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="content"  data-id="variablename-content-<?php echo $classid ?>-0">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>  

                            <div class="form-group"  id="path_var_file_<?php echo $classid ?>">
                                <label>Path<span style="color:red;">*</span></label>
                                <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-path-<?php echo $classid ?>-0"  class="form-control mandatory_field variablename path_var_file_<?php echo $classid ?>" placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path"  data-id="variablename-path-<?php echo $classid ?>-0">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>  

                            <div class="row"><div class="col-md-12" id="path_option_file_<?php echo $classid ?>" style="display:none">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sel1" class="cell-po">Source Path</label>
                                                <input type="text" value="<?php echo $source_path; ?>" name="<?php echo $classid . "[source_path]"; ?>" id="source_path-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename path_option_file_<?php echo $classid ?>" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path" style="width: 10%;" data-id="source_path-variablename-<?php echo $classid ?>">
                                                    <option value="">Select Variable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sel1" class="cell-po">Destination Path</label>
                                                <input type="text" value="<?php echo $destination_path; ?>" name="<?php echo $classid . "[destination_path]"; ?>" id="destination_path-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename path_option_file_<?php echo $classid ?>" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path" style="width: 10%;" data-id="dest_path-variablename-<?php echo $classid ?>">
                                                    <option value="">Select Variable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
            <?php if (!isset($validationjsonArr['file_folder'][$type]) || !empty($validationjsonArr['file_folder'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?> 
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <?php
                        break;
                        //end file actions
                        ?>

                    <?php
                    //strt folder actions
                    case 'folderactions':

                        $action = isset($data['data']['action']) ? $data['data']['action'] : '';
                        $path = isset($data['data']['path']) ? $data['data']['path'] : '';
                        $source_path = isset($data['data']['source_path']) ? $data['data']['source_path'] : '';
                        $destination_path = isset($data['data']['destination_path']) ? $data['data']['destination_path'] : '';
                        $name = isset($data['data']['name']) ? $data['data']['name'] : '';
                        $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
                        $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
                        $comment = isset($data['nm']) ? $data['nm'] : '';
                        $return_type = $data['on_success']['return_type'];
                        $variable_name = $data['on_success']['save'][0]['var'];
                        ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>  Folder Actions</h3>

                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="sel1">Action<span style="color:red;">*</span></label>
                                    <select class="form-control width-100 mandatory_field folder_action_<?php echo $classid ?>" name="<?php echo $classid . "[action]"; ?>" data-check="blank" data-error="This field is required" onchange="select_dropdown_folder(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                                        <option value="create" <?php echo ($action == "create") ? 'selected' : ''; ?>>Create</option>
                                        <option value="open" <?php echo ($action == "open") ? 'selected' : ''; ?>>Open</option>
                                        <option value="copy" <?php echo ($action == "copy") ? 'selected' : ''; ?>>Copy</option>
                                        <option value="get contents" <?php echo ($action == "get contents") ? 'selected' : ''; ?>>Get Contents </option>
                                        <option value="delete" <?php echo ($action == "delete") ? 'selected' : ''; ?>>Delete</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"  id="name_var_folder_<?php echo $classid ?>" >
                                <label>Name<span style="color:red;">*</span></label>
                                <input type="text" value="<?php echo $name; ?>" name="<?php echo $classid . "[name]"; ?>" id="variablename-name-<?php echo $classid ?>-0"  class="form-control variablename name_var_folder_<?php echo $classid ?> mandatory_field" placeholder="Content" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="name"  data-id="variablename-name-<?php echo $classid ?>-0">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>  

                            <div class="form-group"  id="path_var_folder_<?php echo $classid ?>">
                                <label>Path<span style="color:red;">*</span></label>
                                <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-path-<?php echo $classid ?>-0"  class="form-control mandatory_field variablename path_var_folder_<?php echo $classid ?>" placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path"  data-id="variablename-path-<?php echo $classid ?>-0">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>  

                            <div class="row" ><div class="col-md-12" id="path_option_folder_<?php echo $classid ?>" style="display:none">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sel1" class="cell-po">Source Path</label>
                                                <input type="text" value="<?php echo $source_path; ?>" name="<?php echo $classid . "[source_path]"; ?>" id="source_path-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename path_option_folder_<?php echo $classid ?>" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path" style="width: 10%;" data-id="source_path-variablename-<?php echo $classid ?>">
                                                    <option value="">Select Variable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sel1" class="cell-po">Destination Path</label>
                                                <input type="text" value="<?php echo $destination_path; ?>" name="<?php echo $classid . "[destination_path]"; ?>" id="destination_path-variablename-<?php echo $classid ?>" style="width: 80%;" class="form-control variablename path_option_folder_<?php echo $classid ?>" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                                <select class="form-control appendVariable" attr_handler="file_folder" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path" style="width: 10%;" data-id="dest_path-variablename-<?php echo $classid ?>">
                                                    <option value="">Select Variable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php if (!isset($validationjsonArr['file_folder'][$type]) || !empty($validationjsonArr['file_folder'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?> 
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <?php
                        break;
                        //end folder actions
                        ?>

        <?php
        //strt folder actions
        case 'datetime':
            $type_data = isset($data['data']['type']) ? $data['data']['type'] : '';
            $wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
            $next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
            $comment = isset($data['nm']) ? $data['nm'] : '';
            $return_type = $data['on_success']['return_type'];
            $variable_name = $data['on_success']['save'][0]['var'];
            ?>
                        <div class="tab-pane" id="<?php echo $classid ?>">
                            <h3>  Date Time</h3>

                            <div class="show-me12">
                                <div class="form-group">
                                    <label for="sel1" class="cell-po">Label</label>
                                    <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="sel1">Type<span style="color:red;">*</span></label>
                                    <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[type]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                        <option value="date" <?php echo ($type_data == "date") ? 'selected' : ''; ?>>Date</option>
                                        <option value="time" <?php echo ($type_data == "time") ? 'selected' : ''; ?>>Time</option>
                                        <option value="datetime" <?php echo ($type_data == "datetime") ? 'selected' : ''; ?>>Datetime</option>
                                        <option value="complete_datetime" <?php echo ($type_data == "complete_datetime") ? 'selected' : ''; ?>>Complete Datetime </option>
                                        <option value="day" <?php echo ($type_data == "day") ? 'selected' : ''; ?>>Day</option>
                                        <option value="year" <?php echo ($type_data == "year") ? 'selected' : ''; ?>>Year</option>
                                        <option value="month" <?php echo ($type_data == "month") ? 'selected' : ''; ?>>Month</option>
                                        <option value="timestamp" <?php echo ($type_data == "timestamp") ? 'selected' : ''; ?>>timestamp</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
            <?php if (!isset($validationjsonArr['date_handler'][$type]) || !empty($validationjsonArr['date_handler'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
            <?php } ?>  
            <?php include('failure.php'); ?>
            <?php include('advance.php'); ?>
                            <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
                            <div class="demo82 collapse collapse-content">
                                <div class="collapse-container">
                                    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                        //end folder actions
                        ?>
                    <?php
                    //Start of Post data function
                    case 'post':
                        include('post.php');
                        break;
                        //End of Post data function
                        ?>
                    <?php
                    /* Add New Update Variable Handler in Arithmetic Opration */
                    case 'updatevariable':
                        include('updatevariable.php');
                        break;
                        /* End of Add New Update Variable Handler in Arithmetic Opration */
                        ?>  
                    <?php
                    /* variable dictionary handler */
                    case 'dictionaryoperations':
                        include('dictionary_operation.php');
                        break;
                        ?> 
                    <?php
                    /* Add New Arithmetic Equation Handler in Arithmetic Opration */
                    case 'arithmeticequation':
                        include('arithmeticequation.php');
                        break;
                        /* End ofAdd New Arithmetic Equation Handler in Arithmetic Opration */
                        ?>
                    <?php
                    //Start of excel_actions
                    case 'excelactions':
                        include('excel_actions.php');
                        break;
                        //End of excel_actions
                        ?>
                    <?php
                    //Start of update data function
                    case 'updatedata':
                        include('updatedata.php');
                        break;
                        //End of update data function
                        ?>
                    <?php
                    //Start of Fetch data function
                    case 'fetchdata':
                        include('fetchdata.php');
                        break;
                        //End of Fetch data function
                        ?>
                    <?php
                    //Start of Delete data function
                    case 'deletedata':
                        include('deletedata.php');
                        break;
                        //End of Delete data function
                        ?>
                    <?php
                    //Start of Custom Actions Handler  action1
                    case 'action1':
                    include('action1.php');
                    break;
                    //Custom Actions Handler  action1
                    ?>
                    <?php
                    //Start of Custom Actions Handler  action2
                    case 'action2':
                    include('action2.php');
                    break;
                    //Custom Actions Handler  action2
                    ?>
                    <?php
                    //Start of Custom Actions Handler  action3
                    case 'action3':
                    include('action3.php');
                    break;
                    //Custom Actions Handler  action3
                    ?>
                    <?php
                    //Start of Custom Actions Handler  action4
                    case 'action4':
                    include('action4.php');
                    break;
                    //Custom Actions Handler  action4
                    ?>
        <?php
        default:

            break;
    }
}
?>

            <script>
                function use_template(element,createform) {
                    if (element.checked) {
                        var name = "<?php echo $classid . "[template_name]"; ?>";
                        var newtempname = "<?php echo $classid . "[new]"; ?>";
                        var value = "<?php echo $new_block_distance; ?>";
                        var newval = "1";
                        //var createform = classidcheck;
                        var newtemp = '<input type="text" name="' + name + '" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="' + value + '" data-error="This field is required" data-createform-id="' + createform + '">';
                        newtemp += '<input type="hidden" name="' + newtempname + '" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="' + newval + '" data-error="This field is required" data-createform-id="' + createform + '">';

                        $('#newtemp_'+createform).html(newtemp);
                        $('#newtemp_'+createform).show();
                        $('#newtempselect_'+createform).html("");
                        $('#newtempselect_'+createform).hide();
                        $('#newtempfirst_').html("");
                        $('#newtempfirst_').hide();
                    } else {
                        $('#newtemp_'+createform).hide();
                        $('#newtempselect_'+createform).show();
                        $('#newtemp_'+createform).html("");
                        $('#newtempfirst_').html("");
                        $('#newtempfirst_').hide();
                        tempselect();
                    }
                }

                function tempselect()
                {
                    var classid = "<?php echo $classid; ?>";
                    $.ajax({
                        url: admin_ui_url + 'configuration/ajax/getselecthtml.php',
                        type: 'post',
                        data: "classid=" + classid,
                        async: false,
                        success: function (suc)
                        {
                            $("#newtempselect_"+classid).html(suc);
                        }
                    });
                }
                var variable_box_josn = '<?php echo $variable_box_josn; ?>';
                var total_variable_box = '<?php echo $total_variable_box; ?>';
                var total_key_action1 = '<?php echo $total_key_action1; ?>';
                var cmd = '<?php echo $cmd; ?>';
                var classidcheck = '<?php echo $classid; ?>';
                var url_key_total = '<?php echo $url_key_total; ?>';      
                var header_key_total = '<?php echo $header_key_total; ?>';
                var form_key_total = '<?php echo $form_key_total; ?>';
                var fetch_dropdown_key = '<?php echo $fetch_dropdown_key; ?>';
                var keybordvar = '<?php echo $keybordvar; ?>';
                var keybord_keystroke = '<?php echo $keybord_keystroke; ?>';
                var string2_text = '<?php echo $string2_text; ?>';
                var listvar = '<?php echo $listvar; ?>';
                var listvarInsert = '<?php echo $listvarInsert; ?>';
                var positionDelete = '<?php echo $positionDelete; ?>';
                var list_index = '<?php echo $list_index; ?>';
                var fetch_list = '<?php echo $fetch_list; ?>';
                var table_append_list = '<?php echo $table_append_list; ?>';
                var table_insert_list = '<?php echo $table_insert_list; ?>';
                var receive_list = '<?php echo $receive_list; ?>';
                var intends = '<?php echo $intends; ?>';
                var intends_callback = '<?php echo $intends_callback; ?>';
                var table_delete_position = '<?php echo $table_delete_position; ?>';
                var taskId = '<?php echo $taskId; ?>';
                var delete_keys = '<?php echo $delete_keys; ?>';
                var appendDictionary = '<?php echo $appendDictionary; ?>';
            </script>
            <script src="<?php echo site_url() . "company/" ?>js/configuration/handler_edit.js"></script>
