<?php

/* 
 * Add New Arithmetic Equation Handler in Arithmetic Opration
 */
$value = isset($data['data']['value']) ? $data['data']['value'] : '';
$old_value_array=isset($data['data']['old_value_array']) ? $data['data']['old_value_array'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Arithmetic Equation</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
        </div>
    </div>
    
    <div class="arithmeticequation" id="arithmeticequation_text_box_0_<?php echo $classid ?>">
        <div class="form-group">
            <label for="sel1">Text Box<span style="color:red;">*</span></label>
            <textarea rows="4" cols="50"  class="form-control mandatory_field" name="<?php echo $classid . "[value]"; ?>" id="variablename-value-<?php echo $classid ?>"   data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid ?>" form="form-list" readonly="readonly"><?php echo $value; ?></textarea>
        </div>
        <input type="hidden" name="<?php echo $classid . "[old_value_array]"; ?>" id="old_value_array_<?php echo $classid ?>" value="<?php echo $old_value_array; ?>">
        <input type="hidden" name="<?php echo $classid . "[old_value]"; ?>" id="old_value_data_<?php echo $classid ?>">
        <div class="show-me12" id="arithmeticequation_variable_box_0">
            <div class="form-group">
                <label for="sel1" class="cell-po">Variables</label>
                <input type="text" name="<?php echo $classid . "[variables]"; ?>" id="variables-<?php echo $classid ?>" style="width: 90%;" class="form-control varadd" onkeydown="add_var(this,'<?php echo $classid ?>');"/>
                <select class="form-control appendVariable1" style="width: 9%;" data-id="variablename-value-<?php echo $classid ?>" id="select-calculator-<?php echo $classid ?>" data-val="<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                </select>
            </div>
        </div>
        
        
        <div class="show-me12" id="calculator-box-0-<?php echo $classid ?>">
            <button type="button" onclick="calculator('+','<?php echo $classid ?>')"style="width:10%;" class="form-control cal-<?php echo $classid ?>" value="+" >+</button>
            <button type="button" onclick="calculator('-','<?php echo $classid ?>')"style="width:10%;" class="form-control cal-<?php echo $classid ?>" value="-" >-</button>
            <button type="button" onclick="calculator('*','<?php echo $classid ?>')"style="width:10%;" class="form-control cal-<?php echo $classid ?>" value="*" >*</button>
            <button type="button" onclick="calculator('/','<?php echo $classid ?>')"style="width:10%;" class="form-control cal-<?php echo $classid ?>" value="/" >/</button>
            <button type="button" onclick="calculator('^','<?php echo $classid ?>')"style="width:10%;" class="form-control cal-<?php echo $classid ?>" value="^" >^</button>
            <button type="button" onclick="calculator('%','<?php echo $classid ?>')"style="width:10%;" class="form-control cal-<?php echo $classid ?>" value="%" >%</button>
            <button type="button" onclick="calculator('(','<?php echo $classid ?>')"style="width:10%;" class="form-control bracket-<?php echo $classid ?> openbraket-<?php echo $classid ?>" value="(" >(</button>
            <button type="button" onclick="calculator(')','<?php echo $classid ?>')"style="width:10%;" class="form-control bracket-<?php echo $classid ?> closebraket-<?php echo $classid ?>" value=")">)</button>
            <button type="button" onclick="delete_cal('<?php echo $classid ?>')"style="width:10%;" class="form-control">DEL</button>
        </div>
        <?php if (!isset($validationjsonArr['arithmetic_operation'][$type]) || !empty($validationjsonArr['arithmetic_operation'][$type]['output'])) { ?>
        <?php include('output.php'); ?>
        <?php } ?>
        <?php include('failure.php'); ?>
        <?php include('advance.php'); ?>
        <button type="button" class="btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
        <div class="demo82 collapse-content collapse">
        <div class="collapse-container">
            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
        </div>
        </div>
    </div>
</div>

