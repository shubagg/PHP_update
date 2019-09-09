<?php

/* 
 * Keyboard Handler
 * 2.type on image function
 */
$clicktype=isset($data['data']['clicktype']) ? $data['data']['clicktype'] : '';
$x=isset($data['data']['x_loc']) ? $data['data']['x_loc'] : '0';
$y=isset($data['data']['y_loc']) ? $data['data']['y_loc'] : '0';
$path=isset($data['data']['path']) ? $data['data']['path'] : '';
$value=isset($data['data']['value']) ? $data['data']['value'] : '';
$wait_time=isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action=isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment=isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
?>
<section class="tab-pane" id="<?php echo $classid ?>">
    <h3> Type on Image</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid."[label]"; ?>">  
        </div>
    </div>
    
    <div class="keyboard_typeonimage_<?php echo $classid ?>" id="keyboard_typeonimage_<?php echo $classid ?>">
        <div class="form-group add-select-variable-keyboard-<?php echo $classid ?>">
            <div style="position: absolute;right: 11px;top:10px;z-index: 99;"><span class="pull-right" onclick="add_keyboard_type_on_image_div('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
            <?php   if(empty($clicktype))
            { ?>
            <div id="keyboard-box-0-<?php echo $classid ?>" class="list-st">
                <div class="form-group">
                    <label for="sel1" class="cell-po">Click Type<span style="color:red;">*</span></label>
                    <select class="form-control mandatory_field" style="width: 100%;" name="<?php echo $classid."[clicktype][]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <option value="">Select Click Type</option>
                        <option value="singleclick" <?php echo ($clicktype=="singleclick") ? 'selected' : ''; ?>>Single Click</option>
                        <option value="doubleclick" <?php echo ($clicktype=="doubleclick") ? 'selected' : ''; ?>>Double Click</option>
                    </select>
                </div>
                <div class="row">
                <div class="col-md-12 "id="keyboard-path-box-0-<?php echo $classid ?>">
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1" class="cell-po" style="margin-top:0px !important;">Path</label>
                        <input type="text" class="form-control" style="width:80%;" placeholder="Key" name="<?php echo $classid."[path][]"; ?>" value="<?php echo $path; ?>" id="variablename-path-<?php echo $classid ?>-0">
                        <select class="form-control appendVariable" style="width: 5%;"  data-id="variablename-path-<?php echo $classid ?>-0" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label>
                        <input type="text" class="form-control" style="width:80%;" placeholder="Value" name="<?php echo $classid."[value][]"; ?>" value="<?php echo $value;?>" id="variablename-value-<?php echo $classid ?>-0">
                        <select class="form-control appendVariable" style="width: 5%;"  data-id="variablename-value-<?php echo $classid ?>-0" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                                <option value="">Select Variable</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="col-md-12">
					<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">X-Location</label>
                            <input type="text" value="<?php echo $x; ?>" name="<?php echo $classid."[x_loc][]"; ?>" id="variablename-x-loc-<?php echo $classid ?>-0" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                            <select class="form-control appendVariable" style="width: 10%;" data-id="variablename-x-loc-<?php echo $classid ?>-0" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_loc">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Y-Location</label>
                            <input type="text" value="<?php echo $y; ?>" name="<?php echo $classid."[y_loc][]"; ?>" id="variablename-y-loc-<?php echo $classid ?>-0" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                            <select class="form-control appendVariable" style="width: 10%;" data-id="variablename-y-loc-<?php echo $classid ?>-0" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="y_loc">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div>
				</div>
				</div>
                <input type="hidden" value="xloc_yloc" name="<?php echo $classid."[type_of_action]"; ?>" data-createform-id="<?php echo $classid; ?>"/>
           </div>
            <div class="sortable section-type-on-image-action-<?php echo $classid ?>"></div>
            <?php } else 
            { 
            $k=0;
            $type = $clicktype[0];
            ?>
            <div id="keyboard-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
                <div class="form-group">
                    <label for="sel1" class="cell-po">Click Type<span style="color:red;">*</span></label>
                    <select class="form-control" style="width: 100%;" name="<?php echo $classid."[clicktype][]"; ?>">
                        <option value="">Select Click Type</option>
                        <option value="singleclick" <?php echo ($type=="singleclick") ? 'selected' : ''; ?>>Single Click</option>
                        <option value="doubleclick" <?php echo ($type=="doubleclick") ? 'selected' : ''; ?>>Double Click</option>
                    </select>
                </div>
                <div class="row">
                <div class="col-md-12 " id="keyboard-path-box-<?php echo $k; ?>-<?php echo $classid ?>">
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1" class="cell-po" style="margin-top:0px !important;">Path</label>
                        <input type="text" class="form-control" style="width:80%;" placeholder="Key" name="<?php echo $classid."[path][]"; ?>" value="<?php echo $path[$k]; ?>" id="variablename-path-<?php echo $classid ?>-<?php echo $k; ?>">
                        <select class="form-control appendVariable" style="width: 5%;"  data-id="variablename-path-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path">
                                <option value="">Select Variable</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label>
                        <input type="text" class="form-control" style="width:80%;" placeholder="Value" name="<?php echo $classid."[value][]"; ?>" value="<?php echo $value[$k];?>" id="variablename-value-<?php echo $classid ?>-<?php echo $k; ?>">
                        <select class="form-control appendVariable" style="width: 5%;"  data-id="variablename-value-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                                <option value="">Select Variable</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                                <label for="sel1" class="cell-po">X-Location</label>
                                <input type="text" value="<?php echo $x[$k]; ?>" name="<?php echo $classid."[x_loc][]"; ?>" id="x-variablename-<?php echo $classid ?>-<?php echo $k; ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                <select class="form-control appendVariable" style="width: 10%;" data-id="x-variablename-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_loc">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Y-Location</label>
                            <input type="text" value="<?php echo $y[$k]; ?>" name="<?php echo $classid."[y_loc][]"; ?>" id="y-variablename-<?php echo $classid ?>-<?php echo $k; ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                            <select class="form-control appendVariable" style="width: 10%;" data-id="y-variablename-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="y_loc">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div>
		</div>
                <input type="hidden" value="xloc_yloc" name="<?php echo $classid."[type_of_action]"; ?>" data-createform-id="<?php echo $classid; ?>"/>
            </div>
            <div class="sortable section-type-on-image-action-<?php echo $classid ?>">
            <?php
            $k=1; 
            unset($clicktype[0]);
            foreach($clicktype as $type)
            {
            $ans=$k;?>
            <div id="keyboard-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
                <div style="position: absolute;right: 11px;top:10px;z-index: 99;"><span class="pull-right" onclick="delete_keyboard_type_on_image('<?php echo $k; ?>','<?php echo $classid ?>')"><i id="btn33" class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                <div class="form-group">
                    <label for="sel1" class="cell-po">Click Type<span style="color:red;">*</span></label>
                    <select class="form-control" style="width: 100%;" name="<?php echo $classid."[clicktype][]"; ?>">
                        <option value="">Select Click Type</option>
                        <option value="singleclick" <?php echo ($type=="singleclick") ? 'selected' : ''; ?>>Single Click</option>
                        <option value="doubleclick" <?php echo ($type=="doubleclick") ? 'selected' : ''; ?>>Double Click</option>
                    </select>
                </div>
                <div class="row">
                <div class="col-md-12 " id="keyboard-path-box-<?php echo $k; ?>-<?php echo $classid ?>">
                <div class="row">
                    <div class="col-md-12">
                        <label for="sel1" class="cell-po" style="margin-top:0px !important;">Path</label>
                        <input type="text" class="form-control" style="width:80%;" placeholder="Key" name="<?php echo $classid."[path][]"; ?>" value="<?php echo $path[$k]; ?>" id="variablename-path-<?php echo $classid ?>-<?php echo $k; ?>">
                        <select class="form-control appendVariable" style="width: 5%;"  data-id="variablename-path-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path">
                                <option value="">Select Variable</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label>
                        <input type="text" class="form-control" style="width:80%;" placeholder="Value" name="<?php echo $classid."[value][]"; ?>" value="<?php echo $value[$k];?>" id="variablename-value-<?php echo $classid ?>-<?php echo $k; ?>">
                        <select class="form-control appendVariable" style="width: 5%;"  data-id="variablename-value-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                                <option value="">Select Variable</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                                <label for="sel1" class="cell-po">X-Location</label>
                                <input type="text" value="<?php echo $x[$k]; ?>" name="<?php echo $classid."[x_loc][]"; ?>" id="x-variablename-<?php echo $classid ?>-<?php echo $k; ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                                <select class="form-control appendVariable" style="width: 10%;" data-id="x-variablename-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="x_loc">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sel1" class="cell-po">Y-Location</label>
                            <input type="text" value="<?php echo $y[$k]; ?>" name="<?php echo $classid."[y_loc][]"; ?>" id="y-variablename-<?php echo $classid ?>-<?php echo $k; ?>" style="width: 80%;" class="form-control variablename" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>"/>
                            <select class="form-control appendVariable" style="width: 10%;" data-id="y-variablename-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="y_loc">
                                <option value="">Select Variable</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div>
		</div>
                <input type="hidden" value="xloc_yloc" name="<?php echo $classid."[type_of_action]"; ?>" data-createform-id="<?php echo $classid; ?>"/>
            </div>
            <?php $k++; } ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php if (!isset($validationjsonArr['keyboard'][$type]) || !empty($validationjsonArr['keyboard'][$type]['output'])) { ?>
    <?php include('output.php'); ?>
    <?php } ?>
    <?php include('failure.php'); ?>
    <?php include('advance.php'); ?>
    <button type="button" class="btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
    <div class="demo82 collapse collapse-content">
		<div class="collapse-container">
        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"><?php echo $comment; ?></textarea>
    </div>
    </div>
</section>

