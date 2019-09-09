<?php

/* 
 * Excel Handler
 * 1.Excel Actions
 */
//Start Excel Actions in Excel Handler
$actions=isset($data['data']['action']) ? $data['data']['action'] : '';
$work_on=isset($data['data']['work_on']) ? $data['data']['work_on'] : '';
$worksheet_name=isset($data['data']['worksheet_name']) ? $data['data']['worksheet_name'] : '';
$workbook_name = isset($data['data']['workbook_name']) ? $data['data']['workbook_name'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$return_type = $data['on_success']['return_type'];
$variable_name = $data['on_success']['save'][0]['var'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
<h3>Excel Actions</h3>
<div class="show-me12">
    <div class="form-group">
        <label for="sel1" class="cell-po">Label</label>
        <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
    </div>
</div>

<div class="excelactionshandler-<?php echo $classid ?>" id="excelactionshandler-<?php echo $classid ?>">
<div  class="form-group add-select-variable-excelactions-<?php echo $classid ?>"> 
<div id="excelactions-workon-box-0-<?php echo $classid ?>">
    <div class="form-group show-me12">
        <label for="sel1" class="cell-po">Work On<span style="color:red;">*</span></label>
        <select class="form-control mandatory_field" style="width: 100%;" name="<?php echo $classid . "[work_on]"; ?>" onchange="WorkOnType('<?php echo $classid;?>',this.value)" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
        <option value="">Select Work On</option>
        <option value="workbook" <?php echo ($work_on == "workbook") ? 'selected' : ''; ?>>Workbook</option>
        <option value="worksheet" <?php echo ($work_on == "worksheet") ? 'selected' : ''; ?>>Worksheet</option>
        </select>
    </div>
    <input type="hidden" id="worktype-<?php echo $classid ?>" name="worktype" value="<?php echo $work_on; ?>" />
    <?php if($actions==''){ ?>
    <div class="form-group show-me12" id="excelactions-workbook-box-0-<?php echo $classid ?>" style="display:none;">
        <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
        <select class="form-control mandatory_field" style="width: 100%;" id="action_workbook_<?php echo $classid;?>" name="<?php echo $classid . "[action]"; ?>" onchange="actions_type('<?php echo $classid ?>',this.value)" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
        <option value="">Select Actions</option>
        <option value="create" <?php echo ($actions == "create") ? 'selected' : ''; ?>>Create</option>
        <option value="open" <?php echo ($actions == "open") ? 'selected' : ''; ?>>Open</option>
        <option value="save" <?php echo ($actions == "save") ? 'selected' : ''; ?>>Save</option>
        <option value="getsheetnames" <?php echo ($actions == "getsheetnames") ? 'selected' : ''; ?>>Get Sheet Names</option>
        <option value="delete" <?php echo ($actions == "delete") ? 'selected' : ''; ?>>Delete</option>
        <option value="fetch_sheet" <?php echo ($actions == "fetch_sheet") ? 'selected' : ''; ?>>Fetch Sheet</option>
        </select>
    </div>
    <?php } else {  ?>
    <div class="form-group show-me12" id="excelactions-workbook-box-0-<?php echo $classid ?>" style="display:block;">
        <label for="sel1" class="cell-po">Actions<span style="color:red;">*</span></label>
        <select class="form-control mandatory_field" style="width: 100%;" id="action_workbook_<?php echo $classid;?>" name="<?php echo $classid . "[action]"; ?>" onchange="actions_type('<?php echo $classid ?>',this.value)" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
        <option value="">Select Actions</option>
        <option value="create" <?php echo ($actions == "create") ? 'selected' : ''; ?>>Create</option>
        <option value="open" <?php echo ($actions == "open") ? 'selected' : ''; ?>>Open</option>
        <?php if($work_on == "workbook"){ ?>
        <option value="save" <?php echo ($actions == "save") ? 'selected' : ''; ?>>Save</option>
        <option value="getsheetnames" <?php echo ($actions == "getsheetnames") ? 'selected' : ''; ?>>Get Sheet Names</option>
        <?php } else {?>
        <option value="delete" <?php echo ($actions == "delete") ? 'selected' : ''; ?>>Delete</option>
        <option value="fetch_sheet" <?php echo ($actions == "fetch_sheet") ? 'selected' : ''; ?>>Fetch Sheet</option>
        <?php } ?>
        </select>
    </div>
    <?php } if($workbook_name==''){ ?>
    <div class="show-me12" id="workbook_path_<?php echo $classid;?>" style="display:none;">
        <div class="form-group">
            <label for="sel1" class="cell-po">Path<span style="color:red;">*</span></label>
            <input type="text" value="<?php echo $workbook_name; ?>" name="<?php echo $classid . "[workbook_name]"; ?>" id="variablename-workbook_name1-<?php echo $classid ?>" style="width: 90%;" class="form-control variablename" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/>
            <select class="form-control appendVariable" style="width: 9%;" data-id="variablename-workbook_name1-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="workbook_name">
                <option value="">Select Variable</option>
            </select>
        </div>
    </div>
   <?php } else { ?>
    <div class="show-me12" id="workbook_path_<?php echo $classid;?>" style="display:block;">
        <div class="form-group">
            <label for="sel1" class="cell-po">Path<span style="color:red;">*</span></label>
            <input type="text" value="<?php echo $workbook_name; ?>" name="<?php echo $classid . "[workbook_name]"; ?>" id="variablename-workbook_name1-<?php echo $classid ?>" style="width: 90%;" class="form-control variablename" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/>
            <select class="form-control appendVariable" style="width: 9%;" data-id="variablename-workbook_name1-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="workbook_name">
                <option value="">Select Variable</option>
            </select>
        </div>
    </div>
   <?php } ?>
   <?php if($worksheet_name==''){?>
    <div class="show-me12" id="worksheet_name_<?php echo $classid;?>" style="display:none;">
        <div class="form-group">
            <label for="sel1" class="cell-po">Sheet Name<span style="color:red;">*</span></label>
            <input type="text" value="<?php echo $worksheet_name; ?>" name="<?php echo $classid . "[worksheet_name]"; ?>" id="variablename-worksheet_name-<?php echo $classid ?>" style="width: 90%;" class="form-control variablename" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/>
            <select class="form-control appendVariable" style="width: 9%;" data-id="variablename-worksheet_name-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="worksheet_name">
                <option value="">Select Variable</option>
            </select>
        </div>
    </div>
   <?php } else { ?>
    <div class="show-me12" id="worksheet_name_<?php echo $classid;?>" style="display:block;">
        <div class="form-group">
            <label for="sel1" class="cell-po">Sheet Name<span style="color:red;">*</span></label>
            <input type="text" value="<?php echo $worksheet_name; ?>" name="<?php echo $classid . "[worksheet_name]"; ?>" id="variablename-worksheet_name-<?php echo $classid ?>" style="width: 90%;" class="form-control variablename" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"/>
            <select class="form-control appendVariable" style="width: 9%;" data-id="variablename-worksheet_name-<?php echo $classid ?>" attr_handler="workbook" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="worksheet_name">
                <option value="">Select Variable</option>
            </select>
        </div>
    </div>
   <?php } ?>
</div>
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
<!-- End Of Excel Actions in Excel Handler -->

