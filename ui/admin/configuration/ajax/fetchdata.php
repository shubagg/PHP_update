<?php
/*
* Excel Handler
* 3.Fetch Data
*/
//Start Fetch Data in Excel Handler
$actions = isset($data['data']['action']) ? $data['data']['action'] : '';
$value = isset($data['data']['value']) ? $data['data']['value'] : '';
$rowname = isset($data['data']['rowname']) ? $data['data']['rowname'] : '';
$from = isset($data['data']['from']) ? $data['data']['from'] : '';
$to = isset($data['data']['to']) ? $data['data']['to'] : '';
$columnname = isset($data['data']['columnname']) ? $data['data']['columnname'] : '';
$columnvalue = isset($data['data']['columnvalue']) ? $data['data']['columnvalue'] : '';
$get_range = isset($data['data']['get_range']) ? $data['data']['get_range'] : '';
if(!empty($data['data']['action'])){
    $fetch_data_excel = count($data['data']['action']) - 1;
}
else
{
    $fetch_data_excel = 0;
}
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
$value_count=0;
$rowname_count=0;
$columnvalue_count=0;
$from_count=0;
$get_range_count=0;
$columnname_count=0;
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Fetch Data</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
        </div>
    </div>
    <div id="fetchdata_box_<?php echo $classid ?>">
        <div  class="form-group add-select-variable-fetchdata-<?php echo $classid ?>">
        <div style="position: absolute;right: 10px;top:10px;z-index: 99;"><span class="pull-right" onclick="add_fetch_data('<?php echo $classid ?>','<?php echo $type; ?>')" data-count="<?php echo $fetch_data_excel; ?>" id="data-count-<?php echo $classid ?>"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
        <?php
        if (empty($actions)) {
        ?>
        <div id="fetchdata-box-0-<?php echo $classid ?>" class="list-st">
            <div class="form-group show-me12">
                <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
                <select class="form-control mandatory_field" style="width: 100%;"  name="<?php echo $classid . "[action][]"; ?>" id="fetch-data-action-0-<?php echo $classid ?>" onchange="fetch_data_action(0, '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <option value="">Select Action Type</option>
                    <option value="get_cell_value" <?php echo ($action == "get_cell_value") ? 'selected' : ''; ?>>Get Cell Value</option>
                    <option value="get_range" <?php echo ($action == "get_range") ? 'selected' : ''; ?>>Get Range</option>
                </select>
            </div>
            
            
            <div class="show-me12" id="fetchdata-cell-box-0-<?php echo $classid ?>">
            </div>
            <div class="show-me12" id="fetchdata-get-range-box-0-<?php echo $classid ?>">
            </div>
            
            <div class="show-me12" id="fetchdata-get-range-select-value-box-0-<?php echo $classid ?>">
            </div>
            <div class="show-me12" id="fetchdata-get-range-select-column-value-box-0-<?php echo $classid ?>">
            </div>
        </div>
        <div class="sortable section-fetch-data-action-<?php echo $classid ?>"></div>
        <?php } else {
        $k = 0;
        $action = $actions[0];
        ?> 
        <div id="fetchdata-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
        <div class="form-group show-me12">
            <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;"  name="<?php echo $classid . "[action][]"; ?>" id="update-data-action-<?php echo $k; ?>-<?php echo $classid ?>"  onchange="fetch_data_action('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="get_cell_value" <?php echo ($action == "get_cell_value") ? 'selected' : ''; ?>>Get Cell Value</option>
                <option value="get_range" <?php echo ($action == "get_range") ? 'selected' : ''; ?>>Get Range</option>
            </select>
        </div>
        
        
        <?php if ($action == "get_cell_value") {  ?>
        <div class="show-me12" id="fetchdata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Cell Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field variablename" style="width:90%;" placeholder="" name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[$value_count]; ?>" id="fetchdata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $value_count++; } else if ($action == "get_range") { ?>
        <div class="show-me12" id="fetchdata-get-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po">Get Range<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;" id="get_range_select_box_<?php echo $k; ?>_<?php echo $classid ?>" name="<?php echo $classid . "[get_range][]"; ?>" onchange="get_range_action_type('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="row" <?php echo ($get_range[$get_range_count] == "row") ? 'selected' : ''; ?>>Row</option>
                <option value="column" <?php echo ($get_range[$get_range_count] == "column") ? 'selected' : ''; ?>>Column</option>
                <option value="range" <?php echo ($get_range[$get_range_count] == "range") ? 'selected' : ''; ?>>Range</option>
            </select>
        </div>
        <?php if ($get_range[$get_range_count] == 'row') { ?>
                           
        <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Row Number<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[rowname][]"; ?>" value="<?php echo $rowname[$rowname_count]; ?>" id="fetchdata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="rowname">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $rowname_count++; } else if ($get_range[$get_range_count] == 'column') { ?>
        
        <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Name<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;" id="columnname_select_box_<?php echo $k; ?>_<?php echo $classid ?>" name="<?php echo $classid . "[columnname][]"; ?>" onchange="get_column_value('<?php echo $k; ?>', '<?php echo $classid ?>', this.value)"  data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Column Name</option>
                <option value="get_by_column" <?php echo ($columnname[$columnname_count] == "get_by_column") ? 'selected' : ''; ?>>Get By Column</option>
                <option value="get_by_name" <?php echo ($columnname[$columnname_count] == "get_by_name") ? 'selected' : ''; ?>>Get By Name</option>
            </select>
        </div>
        <?php if ($columnname[$columnname_count] == 'get_by_column') { ?>
        <div class="show-me12" id="fetchdata-get-range-select-column-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[columnvalue][]"; ?>" value="<?php echo $columnvalue[$columnvalue_count]; ?>" id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnvalue">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $columnvalue_count++; } else { ?>
           <div class="show-me12" id="fetchdata-get-range-select-column-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[columnvalue][]"; ?>" value="<?php echo $columnvalue[$columnvalue_count]; ?>" id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnvalue">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $columnvalue_count++; } $columnname_count++; } else if ($get_range[$get_range_count] == 'range') { ?>
        
        <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Start Cell<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[from][]"; ?>" value="<?php echo $from[$from_count]; ?>" id="fetchdata-from-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-from-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="from">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Stop Cell<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[to][]"; ?>" value="<?php echo $to[$from_count]; ?>" id="fetchdata-to-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-to-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="to">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $from_count++; } $get_range_count++; } 
        if ($action != "get_cell_value") { ?>
            <div class="show-me12" id="fetchdata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
        <?php }
        if ($action != "get_range") { ?>
            <div class="show-me12" id="fetchdata-get-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
            
            <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
            <div class="show-me12" id="fetchdata-get-range-select-column-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
        <?php } ?>   
        </div>
        <div class="sortable section-fetch-data-action-<?php echo $classid ?>">
        <?php 
        $k = 1;
        unset($actions[0]);
        foreach ($actions as $action) {
        $ans = $k;
        ?>
        <div id="fetchdata-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
        <div class="row">
        <div class="col-md-12">
        <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_fetch_variable('<?php echo $k; ?>','<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
        </div>
        </div>
        
        <div class="form-group show-me12">
            <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;"  name="<?php echo $classid . "[action][]"; ?>" id="update-data-action-<?php echo $k; ?>-<?php echo $classid ?>"  onchange="fetch_data_action('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="get_cell_value" <?php echo ($action == "get_cell_value") ? 'selected' : ''; ?>>Get Cell Value</option>
                <option value="get_range" <?php echo ($action == "get_range") ? 'selected' : ''; ?>>Get Range</option>
            </select>
        </div>
        
        
        <?php if ($action == "get_cell_value") {  ?>
        <div class="show-me12" id="fetchdata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
        <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Cell Name<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field variablename" style="width:90%;" placeholder="" name="<?php echo $classid . "[value][]"; ?>" value="<?php echo $value[$value_count]; ?>" id="fetchdata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-cell-name-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $value_count++; } else if ($action == "get_range") { ?>
        <div class="show-me12" id="fetchdata-get-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po">Get Range<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;" id="get_range_select_box_<?php echo $k; ?>_<?php echo $classid ?>" name="<?php echo $classid . "[get_range][]"; ?>" onchange="get_range_action_type('<?php echo $k; ?>', '<?php echo $classid ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Action Type</option>
                <option value="row" <?php echo ($get_range[$get_range_count] == "row") ? 'selected' : ''; ?>>Row</option>
                <option value="column" <?php echo ($get_range[$get_range_count] == "column") ? 'selected' : ''; ?>>Column</option>
                <option value="range" <?php echo ($get_range[$get_range_count] == "range") ? 'selected' : ''; ?>>Range</option>
            </select>
        </div>
        <?php if ($get_range[$get_range_count] == 'row') { ?>
                           
        <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Row Number<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[rowname][]"; ?>" value="<?php echo $rowname[$rowname_count]; ?>" id="fetchdata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-rowname-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="rowname">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $rowname_count++; } else if ($get_range[$get_range_count] == 'column') { ?>
        
        <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Column Name<span style="color:red;">*</span></label>
            <select class="form-control mandatory_field" style="width: 100%;" id="columnname_select_box_<?php echo $k; ?>_<?php echo $classid ?>" name="<?php echo $classid . "[columnname][]"; ?>" onchange="get_column_value('<?php echo $k; ?>', '<?php echo $classid ?>', this.value)"  data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Column Name</option>
                <option value="get_by_column" <?php echo ($columnname[$columnname_count] == "get_by_column") ? 'selected' : ''; ?>>Get By Column</option>
                <option value="get_by_name" <?php echo ($columnname[$columnname_count] == "get_by_name") ? 'selected' : ''; ?>>Get By Name</option>
            </select>
        </div>
        <?php if ($columnname[$columnname_count] == 'get_by_column') { ?>
        <div class="show-me12" id="fetchdata-get-range-select-column-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[columnvalue][]"; ?>" value="<?php echo $columnvalue[$columnvalue_count]; ?>" id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnvalue">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $columnvalue_count++; } else { ?>
           <div class="show-me12" id="fetchdata-get-range-select-column-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <label for="sel1" class="cell-po" style="margin-top:0px !important;">Value<span style="color:red;">*</span></label>
            <input type="text" class="form-control yes-var mandatory_field" style="width:90%;" placeholder="" name="<?php echo $classid . "[columnvalue][]"; ?>" value="<?php echo $columnvalue[$columnvalue_count]; ?>" id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-columnvalue-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="columnvalue">
                <option value="">Select Variable</option>
            </select>
        </div>
        <?php $columnvalue_count++; } $columnname_count++; } else if ($get_range[$get_range_count] == 'range') { ?>
        
        <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <div class="row"><div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Start Cell<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[from][]"; ?>" value="<?php echo $from[$from_count]; ?>" id="fetchdata-from-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-from-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="from">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="sel1" class="cell-po" style="margin-top:0px !important;">Stop Cell<span style="color:red;">*</span></label>
                <input type="text" class="form-control yes-var mandatory_field" style="width:85%;" placeholder="" name="<?php echo $classid . "[to][]"; ?>" value="<?php echo $to[$from_count]; ?>" id="fetchdata-to-<?php echo $k; ?>-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                <select class="form-control appendVariable" style="width: 5%;"  data-id="fetchdata-to-<?php echo $k; ?>-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="to">
                    <option value="">Select Variable</option>
                </select>
            </div>
            </div>
        </div>
        <?php $from_count++; } $get_range_count++; } 
        if ($action != "get_cell_value") { ?>
            <div class="show-me12" id="fetchdata-cell-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
        <?php }
        if ($action != "get_range") { ?>
            <div class="show-me12" id="fetchdata-get-range-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
            
            <div class="show-me12" id="fetchdata-get-range-select-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
            <div class="show-me12" id="fetchdata-get-range-select-column-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            </div>
        <?php } ?>   
        </div>
        <?php $k++;} ?>
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
<!-- End Of Excel Actions in Fetch Data -->
