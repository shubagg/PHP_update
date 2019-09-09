<?php
$failure_data = !empty($data['on_failure']['error_handle'][0]['do']['perform']) ? $data['on_failure']['error_handle'][0]['do']['perform'] : array();
$seleted_failure_details = array();
global $failure_next_value;
$failure_next_value = 0;
get_failure_options($failure_data, $seleted_failure_details);
function get_failure_options($failure_data, &$seleted_failure_details) {
    if(!empty($failure_data)) {
        global $failure_next_value;
        if($failure_data['type'] == 'next_action') {
            $failure_next_value = $failure_data['params']['value'];
        }
        $temp_data = array('type' => $failure_data['type'], 'value' => $failure_data['params']['value']);
        array_push($seleted_failure_details, $temp_data);
        if(!empty($failure_data['params']['perform'])) {
            get_failure_options($failure_data['params']['perform'], $seleted_failure_details);
        }
    }
}
?>
<div class="collapse-box mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</div>
<div class="demo85-we collapse collapse-content">
<div class="collapse-container">
    <div class="form-group">
        <label for="sel1" class="cell-po width-100" >Set value to variable<span class="pull-right"><i id="btn_add_failure_task" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label>
        <?php
        if(!empty($seleted_failure_details)) {
            foreach($seleted_failure_details as $val) {
                if($val['type'] != 'next_action') {
                    ?>
                    <div class="row margn-tp-10 section-failure">
                        <div class="col-sm-6">
                            <label for="sel1" class="cell-po">Select</label>                         
                            <select class="form-control width-100" name="<?php echo $classid . "[setvariablename][]"; ?>">
                                <?php
                                foreach($failure_returntype as $key => $failure_returnvalue) {
                                    if($key != "next_action") {
                                        $selected_val = "";
                                        if($val['type'] == $key) {
                                            $selected_val = "selected";
                                        }
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php echo $selected_val; ?>><?php echo $failure_returnvalue; ?></option>
                                    <?php    
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="sel1" class="cell-po" >Value</label>
                            <input type="text" class="form-control width-100" value="<?php echo $val['value']; ?>" placeholder="" name="<?php echo $classid . "[variablevalue][]"; ?>">
                        </div>
                        <div class="col-sm-1"><i class="fa fa-minus add-element-button transform-center btn_remove_failure_task"></i></div>
                    </div>
                    <?php
                }
            }
        } else {
            ?>
            <div class="row section-failure">
                <div class="col-sm-6">
                    <label for="sel1" class="cell-po">Select</label>                         
                    <select class="form-control width-100" name="<?php echo $classid . "[setvariablename][]"; ?>">
                        <?php
                        $default_val = "";
                        foreach($failure_returntype as $key => $failure_returnvalue) {
                            $selected = "";
                            if($key == "message_box" && $selected == "") {
                                $selected = "selected";
                                $default_val = "failure";
                            }
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $failure_returnvalue; ?></option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-5">
                    <label for="sel1" class="cell-po" >Value</label>
                    <input type="text" class="form-control width-100" value="<?php echo $default_val; ?>" placeholder="" name="<?php echo $classid . "[variablevalue][]"; ?>">
                </div>
                <div class="col-sm-1"><i class="fa fa-minus add-element-button transform-center btn_remove_failure_task"></i></div>
            </div>
            <?php
        }
        ?>
        <div class="row margn-tp-10 add-select-variable">
            <div class="col-sm-6">
                <label for="sel1" class="cell-po">Select</label>                         
                <select class="form-control width-100" name="<?php echo $classid . "[setvariablename][]"; ?>">
                    <?php
                    $default_val = '';
                    foreach($failure_returntype as $key => $failure_returnvalue) {
                        if($key == "next_action") {
                            $selected = "";
                            if($return_type == $key) {
                                $selected = "selected";
                            }
                            if($key == "next_action" && $selected == "") {
                                $default_val = "0";
                            }
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $failure_returnvalue; ?></option>
                        <?php    
                        }
                    } ?>
                </select>
            </div>
            <div class="col-sm-5">
                <label for="sel1" class="cell-po" >Value</label>
                <input type="text" class="form-control width-100" value="<?php echo $failure_next_value; ?>" placeholder="" name="<?php echo $classid . "[variablevalue][]"; ?>">
            </div>
            <!--<div class="col-sm-1"><i class="fa fa-minus add-element-button transform-center btn_remove_failure_task"></i></div>-->
        </div>
    </div>
</div>
</div>