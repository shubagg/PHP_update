<?php

/* 
 * OCR Handler
 * 3. Fetch OCR Data
 */
$path = isset($data['data']['path']) ? $data['data']['path'] : '';
$variable_box = isset($data['data']['variable_box']) ? $data['data']['variable_box'] : '';
$text_box = isset($data['data']['text_box']) ? $data['data']['text_box'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$variable_name1 = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Fetch OCR Data</h3>
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
    <div class="form-group">
    <div class="row">
		<div class="col-md-12">
        <label for="sel1">Path<span style="color:red;">*</span></label>
        <input type="text" name="<?php echo $classid . "[path]"; ?>" class="form-control width-100 mandatory_field" placeholder="Path" data-check="blank" value="<?php echo $path; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
		</div>
    </div>
    </div>
	<hr>
    
    <div class="form-group add-select-variable-ocr-<?php echo $classid ?>">
        <?php
        if (empty($variable_box)) {
        ?>
        <div id="div-box-0-<?php echo $classid ?>" class="list-st">
        <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_fetch_ocr_data('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
            <div class="form-group">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Field<span style="color:red;">*</span></label>
                <div class="row"><div class="col-md-6"><input type="text" name="<?php echo $classid . "[variable_box][]"; ?>" id="new_var_box_0_<?php echo $classid ?>"  class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $variable_box; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>"></div>
				<div class="col-md-6">
                <select class="form-control appendVariable"  data-id="new_var_box_0_<?php echo $classid ?>"  attr_handler="ocr" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variablebox">
                    <option value="">Select Field</option>
                </select>
				</div>
				</div>
            </div>
			<div class="form-group">
            <div class="row">
				<div class="col-sm-12">
                <label for="sel1">Label<span style="color:red;">*</span></label>
                <input type="text" name="<?php echo $classid . "[text_box][]"; ?>" class="form-control width-100 mandatory_field" placeholder="" data-check="blank" value="<?php echo $text_box; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            </div>
				</div>
			</div>
        </div>
        <div class="sortable section-fetch-ocr-action-<?php echo $classid ?>"></div>
        <?php } else {
        $k = 0;
        $box = $variable_box[0];
        ?>
        <div id="div-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
        <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_fetch_ocr_data('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
            <div class="form-group">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Field<span style="color:red;">*</span></label>
                <div class="row"><div class="col-md-6"><input type="text" name="<?php echo $classid . "[variable_box][]"; ?>" id="new_var_box_<?php echo $k; ?>_<?php echo $classid ?>" class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $box; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>"></div>
				<div class="col-md-6">
                <select class="form-control appendVariable" data-id="new_var_box_<?php echo $k; ?>_<?php echo $classid ?>"  attr_handler="ocr" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variablebox">
                    <option value="">Select Field</option>
                </select>
				</div>
				</div>
            </div>
			<div class="form-group">
			<div class="row">
            <div class="col-sm-12">
                <label for="sel1">Label<span style="color:red;">*</span></label>
                <input type="text" name="<?php echo $classid . "[text_box][]"; ?>" class="form-control width-100 mandatory_field" placeholder="" data-check="blank" value="<?php echo $text_box[$k]; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            </div>
			</div>
			</div>
        </div>
        <div class="sortable section-fetch-ocr-action-<?php echo $classid ?>">
        <?php
        $k = 1;
        unset($variable_box[0]);
        foreach ($variable_box as $box) 
        {
        $ans = $k;
        ?>
        <div id="div-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
            <div class="form-group">
                <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_var_box('<?php echo $k; ?>','<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Field<span style="color:red;">*</span></label>
                <div class="row"><div class="col-md-6"><input type="text" name="<?php echo $classid . "[variable_box][]"; ?>" id="new_var_box_<?php echo $k; ?>_<?php echo $classid ?>" class="form-control mandatory_field" placeholder="" data-check="blank" value="<?php echo $box; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>"></div>
				<div class="col-md-6">
                <select class="form-control appendVariable" data-id="new_var_box_<?php echo $k; ?>_<?php echo $classid ?>"  attr_handler="ocr" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variablebox">
                    <option value="">Select Field</option>
                </select>
				</div>
				</div>
            </div>
			<div class="form-group">
			<div class="row">
            <div class="col-sm-12">
                <label for="sel1">Label<span style="color:red;">*</span></label>
                <input type="text" name="<?php echo $classid . "[text_box][]"; ?>" class="form-control width-100 mandatory_field" placeholder="" data-check="blank" value="<?php echo $text_box[$k]; ?>" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
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

