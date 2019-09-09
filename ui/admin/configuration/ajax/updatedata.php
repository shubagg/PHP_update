<?php
/*
* Excel Handler
* 2.Update Data
*/
//Start Update Data in Excel Handler
$actions = isset($data['data']['action']) ? $data['data']['action'] : '';
$cellname = isset($data['data']['cellname']) ? $data['data']['cellname'] : '';
$cellvalue = isset($data['data']['cellvalue']) ? $data['data']['cellvalue'] : '';
$variable = isset($data['data']['variable']) ? $data['data']['variable'] : '';
$formula = isset($data['data']['formula']) ? $data['data']['formula'] : '';
$column_name = isset($data['data']['column_name']) ? $data['data']['column_name'] : '';
$rowname = isset($data['data']['rowname']) ? $data['data']['rowname'] : '';
$rowvalue = isset($data['data']['rowvalue']) ? $data['data']['rowvalue'] : '';
$from = isset($data['data']['from']) ? $data['data']['from'] : '';
$fromvalue = isset($data['data']['fromvalue']) ? $data['data']['fromvalue'] : '';
$columnname = isset($data['data']['columnname']) ? $data['data']['columnname'] : '';
$columnvalue = isset($data['data']['columnvalue']) ? $data['data']['columnvalue'] : '';
if(!empty($data['data']['action'])){
    $update_data_excel = count($data['data']['action']) - 1;
}
else
{
    $update_data_excel = 0;
}
$set_range = isset($data['data']['set_range']) ? $data['data']['set_range'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
$cellname_count=0;
$variable_count=0;
$formula_count=0;
$column_name_count=0;
$rowname_count=0;
$from_count=0;
$set_range_count=0;
$columnname_count=0;
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Update Data</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
        </div>
    </div>
    <div id="updatedata_box_<?php echo $classid ?>" >
        <div  class="form-group add-select-variable-updatedata-<?php echo $classid ?>">
        <div style="position: absolute;right: 10px;top:10px;z-index: 99;"><span class="pull-right" onclick="add_update_data('<?php echo $classid ?>','<?php echo $type; ?>')" data-count="<?php echo $update_data_excel; ?>" id="data-count-<?php echo $classid ?>"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
        <?php
        if (empty($actions)) {
        ?>
        <div id="updatedata-box-0-<?php echo $classid ?>" class="list-st">
        <div class="form-group show-me12">
            <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;"  name="<?php echo $classid . "[action][]"; ?>" id="update-data-action-0-<?php echo $classid ?>" onchange="update_data_action(0, '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="set_cell_value" <?php echo ($action == "set_cell_value") ? 'selected' : ''; ?>>Set Cell Value</option>
                <option value="set_range" <?php echo ($action == "set_range") ? 'selected' : ''; ?>>Set Range</option>
                <option value="append_range" <?php echo ($action == "append_range") ? 'selected' : ''; ?>>Append Range</option>
                <option value="apply_formula" <?php echo ($action == "apply_formula") ? 'selected' : ''; ?>>Apply Formula</option>
            </select>
        </div>
        
        
        <div class="show-me12" id="updatedata-cell-box-0-<?php echo $classid ?>">
        </div>
        <div class="show-me12" id="updatedata-append-range-box-0-<?php echo $classid ?>">
        </div>
        <div class="show-me12" id="updatedata-apply-formula-box-0-<?php echo $classid ?>">
        </div>
        <div class="show-me12" id="updatedata-set-range-box-0-<?php echo $classid ?>">
        </div>
        
        <div class="show-me12" id="updatedata-set-range-select-value-box-0-<?php echo $classid ?>">
        </div>
        </div>
        <div class="sortable section-updatedata-action-<?php echo $classid ?>"></div>
        <?php } 
        else 
        { 
        $k = 0;
        $action=$actions[0];
        ?>
        
        <div id="updatedata-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
        <div class="form-group show-me12">
            <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;"  name="<?php echo $classid . "[action][]"; ?>" id="update-data-action-<?php echo $k; ?>-<?php echo $classid; ?>"  onchange="update_data_action('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="set_cell_value" <?php echo ($action == "set_cell_value") ? 'selected' : ''; ?>>Set Cell Value</option>
                <option value="set_range" <?php echo ($action == "set_range") ? 'selected' : ''; ?>>Set Range</option>
                <option value="append_range" <?php echo ($action == "append_range") ? 'selected' : ''; ?>>Append Range</option>
                <option value="apply_formula" <?php echo ($action == "apply_formula") ? 'selected' : ''; ?>>Apply Formula</option>
            </select>
        </div>
        
        
        <?php if ($action == "set_cell_value") {  ?>
        <div class="show-me12" id="updatedata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <div class="row">
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Cell Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" placeholder="" name="<?php echo $classid . "[cellname][]"; ?>" value="<?php echo $cellname[$cellname_count]; ?>" id="updatedata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="cellname">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" name="<?php echo $classid . "[cellvalue][]"; ?>" value="<?php echo $cellvalue[$cellname_count]; ?>" id="updatedata-cell-value-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-cell-value-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="cellvalue">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $cellname_count++; } else if ($action == "append_range") { ?>
        <div class="show-me12" id="updatedata-append-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[variable][]"; ?>" value="<?php echo $variable[$variable_count]; ?>" id="updatedata-variable-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-variable-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variable">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $variable_count++; } else if ($action == "apply_formula") { ?>
        <div class="show-me12" id="updatedata-apply-formula-box-<?php echo $k; ?>-<?php echo $classid ?>">
           <div class="row">
			<div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Formula<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" placeholder="" name="<?php echo $classid . "[formula][]"; ?>" value="<?php echo $formula[$formula_count]; ?>" id="updatedata-formula-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-formula-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formula">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" name="<?php echo $classid . "[column_name][]"; ?>" value="<?php echo $column_name[$formula_count]; ?>" id="updatedata-column-name-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-column-name-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="column_name">
                    <option value="">Select Variable</option>
                </select>
            </div>
        </div>
        </div>
        <?php $formula_count++; } else if ($action == "set_range") { ?>
        <div class="show-me12" id="updatedata-set-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po">Set Range<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;" id="set_range_select_box_<?php echo $k; ?>_<?php echo $classid ?>" name="<?php echo $classid . "[set_range][]"; ?>" onchange="set_range_action_type('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="row" <?php echo ($set_range[$set_range_count] == "row") ? 'selected' : ''; ?>>Row</option>
                <option value="column" <?php echo ($set_range[$set_range_count] == "column") ? 'selected' : ''; ?>>Column</option>
                <option value="range" <?php echo ($set_range[$set_range_count] == "range") ? 'selected' : ''; ?>>Range</option>
            </select>
        </div>
        <?php if ($set_range[$set_range_count] == 'row') { ?>
                           
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Row Number<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[rowname][]"; ?>" value="<?php echo $rowname[$rowname_count]; ?>" id="updatedata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="rowname">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Row Value<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[rowvalue][]"; ?>" value="<?php echo $rowvalue[$rowname_count]; ?>" id="updatedata-rowvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-rowvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="rowvalue">
                    <option value="">Select Variable</option>
                </select>
            </div> 
            </div> 
        </div>
        <?php $rowname_count++; } else if ($set_range[$set_range_count] == 'column') { ?>
        
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[columnname][]"; ?>" value="<?php echo $columnname[$columnname_count]; ?>" id="updatedata-columnname-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-columnname-<?php echo $set_range_count; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnname">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Value<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[columnvalue][]"; ?>" value="<?php echo $columnvalue[$columnname_count]; ?>" id="updatedata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-columnvalue-<?php echo $set_range_count; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnvalue">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $columnname_count++; } else if ($set_range[$set_range_count] == 'range') { ?>
        
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Start Cell<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[from][]"; ?>" value="<?php echo $from[$from_count]; ?>" id="updatedata-from-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-from-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="from">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[fromvalue][]"; ?>" value="<?php echo $fromvalue[$from_count]; ?>" id="updatedata-fromvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-fromvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="fromvalue">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $from_count++;  } $set_range_count++; } ?>
        <?php if ($action != "append_range") { ?>
        <div class="show-me12" id="updatedata-append-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } if ($action != "apply_formula") { ?>
        <div class="show-me12" id="updatedata-apply-formula-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } if ($action != "set_cell_value") { ?>
        <div class="show-me12" id="updatedata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } if ($action != "set_range") { ?>
        <div class="show-me12" id="updatedata-set-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } ?>  
        </div>
        <div class="sortable section-updatedata-action-<?php echo $classid ?>">
        <?php 
        $k = 1;
        unset($actions[0]);
        foreach ($actions as $action) {
        $ans = $k;
        ?>
        <div id="updatedata-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
        <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_update_variable('<?php echo $k; ?>','<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
        <div class="form-group show-me12">
            <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;"  name="<?php echo $classid . "[action][]"; ?>" id="update-data-action-<?php echo $k; ?>-<?php echo $classid; ?>"  onchange="update_data_action('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="set_cell_value" <?php echo ($action == "set_cell_value") ? 'selected' : ''; ?>>Set Cell Value</option>
                <option value="set_range" <?php echo ($action == "set_range") ? 'selected' : ''; ?>>Set Range</option>
                <option value="append_range" <?php echo ($action == "append_range") ? 'selected' : ''; ?>>Append Range</option>
                <option value="apply_formula" <?php echo ($action == "apply_formula") ? 'selected' : ''; ?>>Apply Formula</option>
            </select>
        </div>
        
        
        <?php if ($action == "set_cell_value") {  ?>
        <div class="show-me12" id="updatedata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <div class="row">
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Cell Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" placeholder="" name="<?php echo $classid . "[cellname][]"; ?>" value="<?php echo $cellname[$cellname_count]; ?>" id="updatedata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="cellname">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" name="<?php echo $classid . "[cellvalue][]"; ?>" value="<?php echo $cellvalue[$cellname_count]; ?>" id="updatedata-cell-value-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-cell-value-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="cellvalue">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $cellname_count++; } else if ($action == "append_range") { ?>
        <div class="show-me12" id="updatedata-append-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[variable][]"; ?>" value="<?php echo $variable[$variable_count]; ?>" id="updatedata-variable-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-variable-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="variable">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $variable_count++; } else if ($action == "apply_formula") { ?>
        <div class="show-me12" id="updatedata-apply-formula-box-<?php echo $k; ?>-<?php echo $classid ?>">
           <div class="row">
			<div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Formula<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" placeholder="" name="<?php echo $classid . "[formula][]"; ?>" value="<?php echo $formula[$formula_count]; ?>" id="updatedata-formula-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-formula-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formula">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:80%;" name="<?php echo $classid . "[column_name][]"; ?>" value="<?php echo $column_name[$formula_count]; ?>" id="updatedata-column-name-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-column-name-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="column_name">
                    <option value="">Select Variable</option>
                </select>
            </div>
        </div>
        </div>
        <?php $formula_count++; } else if ($action == "set_range") { ?>
        <div class="show-me12" id="updatedata-set-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po">Set Range<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;" id="set_range_select_box_<?php echo $k; ?>_<?php echo $classid ?>" name="<?php echo $classid . "[set_range][]"; ?>" onchange="set_range_action_type('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="row" <?php echo ($set_range[$set_range_count] == "row") ? 'selected' : ''; ?>>Row</option>
                <option value="column" <?php echo ($set_range[$set_range_count] == "column") ? 'selected' : ''; ?>>Column</option>
                <option value="range" <?php echo ($set_range[$set_range_count] == "range") ? 'selected' : ''; ?>>Range</option>
            </select>
        </div>
        <?php if ($set_range[$set_range_count] == 'row') { ?>
                           
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Row Number<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[rowname][]"; ?>" value="<?php echo $rowname[$rowname_count]; ?>" id="updatedata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="rowname">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Row Value<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[rowvalue][]"; ?>" value="<?php echo $rowvalue[$rowname_count]; ?>" id="updatedata-rowvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-rowvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="rowvalue">
                    <option value="">Select Variable</option>
                </select>
            </div> 
            </div> 
        </div>
        <?php $rowname_count++; } else if ($set_range[$set_range_count] == 'column') { ?>
        
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[columnname][]"; ?>" value="<?php echo $columnname[$columnname_count]; ?>" id="updatedata-columnname-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-columnname-<?php echo $set_range_count; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnname">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Value<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[columnvalue][]"; ?>" value="<?php echo $columnvalue[$columnname_count]; ?>" id="updatedata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-columnvalue-<?php echo $set_range_count; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnvalue">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $columnname_count++; } else if ($set_range[$set_range_count] == 'range') { ?>
        
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Start Cell<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[from][]"; ?>" value="<?php echo $from[$from_count]; ?>" id="updatedata-from-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-from-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="from">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[fromvalue][]"; ?>" value="<?php echo $fromvalue[$from_count]; ?>" id="updatedata-fromvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="updatedata-fromvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="fromvalue">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $from_count++;  } $set_range_count++; } ?>
        <?php if ($action != "append_range") { ?>
        <div class="show-me12" id="updatedata-append-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } if ($action != "apply_formula") { ?>
        <div class="show-me12" id="updatedata-apply-formula-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } if ($action != "set_cell_value") { ?>
        <div class="show-me12" id="updatedata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } if ($action != "set_range") { ?>
        <div class="show-me12" id="updatedata-set-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        
        <div class="show-me12" id="updatedata-set-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
        </div>
        <?php } ?>  
        </div>
        <?php $k++;}?>
        </div>
        <?php } ?>
        </div>    
    </div>
    <?php if (!isset($validationjsonArr['workbook'][$type]) || !empty($validationjsonArr['workbook'][$type]['output'])) { ?>
    <?php include('output.php'); ?>
    <?php } ?>
    <?php include('failure.php'); ?>
    <?php include('advance.php'); ?>
    <button type="button" class="btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
    <div class="demo82 collapse collapse-content">
    <div class="collapse-container">
        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
    </div>
    </div>
</div>
<!-- End Of Excel Actions in Update Data -->



