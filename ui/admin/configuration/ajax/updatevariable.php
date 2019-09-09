<?php

/* Arithmetic Opration
 * Add Update Variable Handler in Arithmetic Opration
 */
$update_type = isset($data['data']['update_type']) ? $data['data']['update_type'] : '';
$value = isset($data['data']['value']) ? $data['data']['value'] : '';
$from = isset($data['data']['from']) ? $data['data']['from'] : '';
$to = isset($data['data']['to']) ? $data['data']['to'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Update Variable</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
        </div>
    </div>
    <div class="updatevariablehandler_<?php echo $classid ?>" id="updatevariablehandler_<?php echo $classid ?>">
        <div  class="form-group add-select-variable-updatevariable-<?php echo $classid ?>">
                <?php
                if (empty($update_type)) {
                ?>
                <div id="updatevariable-box-0-<?php echo $classid ?>">
                    <div class="form-group show-me12">
                        <label for="sel1" class="cell-po">Action<span style="color:red;">*</span></label>
                        <select class="form-control mandatory_field actiontype_<?php echo $classid ?>" style="width: 100%;" name="<?php echo $classid . "[update_type]"; ?>" onclick="actionTypeOnVariable(this.value, '<?php echo $classid ?>','<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                            <option value="increment" <?php echo ($update_type == "increment") ? 'selected' : ''; ?>>Increment</option>
                            <option value="decrement" <?php echo ($update_type == "decrement") ? 'selected' : ''; ?>>Decrement</option>
                            <option value="assign" <?php echo ($update_type == "assign") ? 'selected' : ''; ?>>Assign</option>
                        </select>
                    </div>
                    <div class="show-me12" id="updatevariable-value-box-0_<?php echo $classid ?>">
                    </div>
                    <div class="show-me12" id="updatevariable-from-box-0_<?php echo $classid ?>">
                    </div>
                    <div class="form-group show-me12" id="updatevariable-to-box-0_<?php echo $classid ?>">
                    </div>
                </div>
                <?php } else { ?>
                <div id="updatevariable-box-0-<?php echo $classid ?>">
                    <div class="form-group show-me12">
                        <label for="sel1" class="cell-po">Action<span style="color:red;">*</span></label>
                        <select class="form-control mandatory_field actiontype_<?php echo $classid ?>" style="width: 100%;" name="<?php echo $classid . "[update_type]"; ?>" onclick="actionTypeOnVariable(this.value, '<?php echo $classid ?>','<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                            <option value="increment" <?php echo ($update_type == "increment") ? 'selected' : ''; ?>>Increment</option>
                            <option value="decrement" <?php echo ($update_type == "decrement") ? 'selected' : ''; ?>>Decrement</option>
                            <option value="assign" <?php echo ($update_type == "assign") ? 'selected' : ''; ?>>Assign</option>
                        </select>
                    </div>
                    <?php if ($update_type == "assign") { ?>
                    <div class="form-group show-me12" id="updatevariable-from-box-0_<?php echo $classid ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>From<span style='color:red;'>*</span></label>
                        <input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='from' name="<?php echo $classid . "[from]"; ?>" value="<?php echo $from; ?>" id="variablename-from-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' style='width: 5%;'  data-id="variablename-from-<?php echo $classid; ?>-0" attr_handler="arithmetic_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="from">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>
                    <div class="form-group show-me12" id="updatevariable-to-box-0_<?php echo $classid ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>To<span style='color:red;'>*</span></label>
                        <input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='to' name="<?php echo $classid . "[to]"; ?>" value="<?php echo $to; ?>" id="variablename-to-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' style='width: 5%;'  data-id="variablename-to-<?php echo $classid; ?>-0" attr_handler="arithmetic_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="to">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>
                    <?php } else { ?>
                        <div class="form-group show-me12" id="updatevariable-value-box-0_<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Variable<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value]"; ?>" value="<?php echo $value; ?>" id="variablename-value-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value-<?php echo $classid; ?>-0" attr_handler="arithmetic_operation" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="form-group show-me12" id="updatevariable-value-box-0_<?php echo $classid ?>">
                    </div>
                    <div class="form-group show-me12" id="updatevariable-from-box-0_<?php echo $classid ?>">
                    </div>
                    <div class="form-group show-me12" id="updatevariable-to-box-0_<?php echo $classid ?>">
                    </div>
                </div>
                <?php } ?>
        </div>
    </div>
    <?php if (!isset($validationjsonArr['arithmetic_operation'][$type]) || !empty($validationjsonArr['arithmetic_operation'][$type]['output'])) { ?>
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

