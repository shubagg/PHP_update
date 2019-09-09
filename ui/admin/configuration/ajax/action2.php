<?php

/* 
 * Custom Actions Handler
 * Action 2
 */
$key = isset($data['data']['key']) ? $data['data']['key'] : '';
$value = isset($data['data']['value']) ? $data['data']['value'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$variable_name1 = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Action 2</h3>
    <div class="show-me12">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="sel1" class="cell-po">Label</label>
                    <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group add-select-variable-custom-action1-<?php echo $classid ?>">
        <?php
        if (empty($key)) {
        ?>
        <div id="div-box-0-<?php echo $classid ?>" class="list-st">
        <div style="position: absolute;right: 10px;z-index: 99;top: 8px;"><span class="pull-right" onclick="add_custom_action1('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span>
    </div>
            <div class="form-group">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Field<span style="color:red;">*</span></label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="<?php echo $classid . "[key][]"; ?>" id="new_var_box_action1_0_<?php echo $classid ?>"  class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $key; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                </div>
                <div class="col-md-6">
                    <select class="form-control appendVariable"  data-id="new_var_box_action1_0_<?php echo $classid ?>"  attr_handler="custom_actions" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="key">
                        <option value="">Select Variable</option>
                    </select>
                </div>
            </div>
            </div>
	    <div class="form-group">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="<?php echo $classid . "[value][]"; ?>" id="new_var_value_action1_0_<?php echo $classid ?>"  class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $value; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                </div>
                <div class="col-md-6">
                    <select class="form-control appendVariable"  data-id="new_var_value_action1_0_<?php echo $classid ?>"  attr_handler="custom_actions" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                        <option value="">Select Variable</option>
                    </select>
                </div>
            </div>
            </div>
        </div>
        <div class="sortable section-action1-action-<?php echo $classid ?>"></div>
        <?php } else {
        $k = 0;
        $box=$key[0];
        ?>
        <div id="div-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
        <div style="position: absolute;right: 10px;z-index: 99;top: 8px;"><span class="pull-right" onclick="add_custom_action1('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span>
    </div>
            <div class="form-group">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Field<span style="color:red;">*</span></label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="<?php echo $classid . "[key][]"; ?>" id="new_var_box_action1_<?php echo $k; ?>_<?php echo $classid ?>" class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $box; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    </div>
	        <div class="col-md-6">
                    <select class="form-control appendVariable" data-id="new_var_box_action1_<?php echo $k; ?>_<?php echo $classid ?>"  attr_handler="custom_actions" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="key">
                        <option value="">Select Variable</option>
                    </select>
		</div>
		</div>
            </div>
            <div class="form-group">
		<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="<?php echo $classid . "[value][]"; ?>" id="new_var_value_action1_<?php echo $k; ?>_<?php echo $classid ?>" class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $value[$k]; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    </div>
	        <div class="col-md-6">
                    <select class="form-control appendVariable" data-id="new_var_value_action1_<?php echo $k; ?>_<?php echo $classid ?>"  attr_handler="custom_actions" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                        <option value="">Select Variable</option>
                    </select>
		</div>
		</div>
            </div>
        </div>
        <div class="sortable section-action1-action-<?php echo $classid ?>">
        <?php 
        $k = 1;
        unset($key[0]);
        foreach ($key as $box) 
        {
        $ans = $k;
        ?>
        <div id="div-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
        <div style="position: absolute;right: 10px;z-index: 99;top: 8px;"><span class="pull-right" onclick="add_custom_action1('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span>
    </div>
            <div class="form-group">
                <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_var_box('<?php echo $k; ?>','<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span>
                </div>
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Field<span style="color:red;">*</span></label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="<?php echo $classid . "[key][]"; ?>" id="new_var_box_action1_<?php echo $k; ?>_<?php echo $classid ?>" class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $box; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    </div>
	        <div class="col-md-6">
                    <select class="form-control appendVariable" data-id="new_var_box_action1_<?php echo $k; ?>_<?php echo $classid ?>"  attr_handler="custom_actions" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="key">
                        <option value="">Select Variable</option>
                    </select>
		</div>
		</div>
            </div>
            <div class="form-group">
		<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="<?php echo $classid . "[value][]"; ?>" id="new_var_value_action1_<?php echo $k; ?>_<?php echo $classid ?>" class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $value[$k]; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    </div>
	        <div class="col-md-6">
                    <select class="form-control appendVariable" data-id="new_var_value_action1_<?php echo $k; ?>_<?php echo $classid ?>"  attr_handler="custom_actions" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                        <option value="">Select Variable</option>
                    </select>
		</div>
		</div>
            </div>
        </div>
        <?php
        $k++;
        } ?>
        </div>
        <?php } ?>
    </div>
	<hr>
    <?php if (!isset($validationjsonArr['custom_actions'][$type]) || !empty($validationjsonArr['custom_actions'][$type]['output'])) { ?>
    <?php include('output.php'); ?>
    <?php } ?>
    <?php include('failure.php'); ?>
    <div class="collapse-box"  data-toggle="collapse" data-target=".demo81">Advanced</div>
    <div class="demo81 collapse collapse-content">
    <div class="collapse-container">
        <div class="wait-poling">Wait <span><input type="text" class="ms-point" value="<?php echo $wait_time; ?>" placeholder="0" name="<?php echo $classid . "[wait]"; ?>"/></span></div>
        <div class="wait-poling">Next action <span><input type="text" class="ms-point" value="<?php echo $next_action; ?>" placeholder="0" name="<?php echo $classid . "[nextAction]"; ?>"/></span> </div>
    </div>
    </div>
    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
    <div class="demo82 collapse collapse-content">
    <div class="collapse-container">
    <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
    </div>
    </div>
</div>


