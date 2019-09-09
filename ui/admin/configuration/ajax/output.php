<div class="collapse-box mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</div>
<div class="demo85 collapse collapse-content">
    <div class="collapse-container">
        <div class="form-group">
            <label for="sel1" class="cell-po" >Set value to variable</label>
            <div class="row">
                <div class="col-sm-12">      
                    <label for="sel1" class="cell-po" >Return Type</label>                            
                    <select class="form-control width-100 returntype_variable_opt" data-id="<?php echo $classid; ?>" name="<?php echo $classid . "[returntype]"; ?>">
                        <?php
                        foreach ($returntype as $key => $returnvalue) {
                            $selected = "";
                            if ($return_type == $key) {
                                $selected = "selected";
                            }
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo ucfirst($returnvalue); ?></option> 
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <?php
        if ($return_type == 'message_box') {
            $display_type = "display:none";
        } else {
            $display_type = "display:block";
        }
        if($return_type=='json')
        {
            $varname="Path";
        }
        else
        {
            $varname="Variable";
        }
        ?>
        <div class="form-group msg_box"  style="<?php echo $display_type; ?>">
            <label for="sel1" class="" id="returntype_variable_field_<?php echo $classid; ?>"><?php echo $varname; ?></label>
            <div id="returntype_variable_select_<?php echo $classid; ?>">
                <div class="row">
                    <div class="col-md-6"><input type="text" value="<?php echo $variable_name; ?>" name="<?php echo $classid . "[variablename]"; ?>" id="variablename-<?php echo $classid ?>"  class="form-control no-var variablename"/></div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable" data-id="variablename-<?php echo $classid ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
                            <?php
                    if (empty($path_to_key)) {
                        $display_type = "display:none";
                    } else {
                        $display_type = "display:block";
                    }
                    ?>
                    <div class="form-group returntype_variable_path_to_key" style="<?php echo $display_type; ?>;clear: both;">
                        <label for="sel1" id="returntype_variable_field_<?php echo $classid; ?>" class="cell-po returntype_variable" data-id="<?php echo $classid; ?>" >Path To Key</label>
                        <div id="returntype_variable_select_<?php echo $classid; ?>">
                            <div class="row"><div class="col-md-6"> <input type="text" value="<?php echo $path_to_key; ?>" name="<?php echo $classid . "[path_to_key]"; ?>" id="path-to-key-get-<?php echo $classid ?>"  class="form-control variablename no-var"/></div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable"  data-id="path-to-key-get-<?php echo $classid ?>">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</div>

           