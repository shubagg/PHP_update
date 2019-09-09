<?php

/* 
 * Keyboard Handler
 * Keystroke
 */
$action = isset($data['data']['action']) ? $data['data']['action'] : '';
$value = isset($data['data']['value']) ? $data['data']['value'] : '';
$count = isset($data['data']['count']) ? $data['data']['count'] : '1';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$return_type = $data['on_success']['return_type'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Keystroke</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control no-var" name="<?php echo $classid . "[label]"; ?>">  
        </div>
    </div>
    <div class="keystrokehandler-<?php echo $classid ?>" id="keystrokehandler-<?php echo $classid ?>">
        <div class="ui-sortable">
            <div  class="form-group add-select-variable-Keystroke-<?php echo $classid ?>">
            <div style="position: absolute;z-index: 99;right: 13px;top: 11px;"><span class="pull-right" onclick="add_keyboard_keystroke('<?php echo $classid ?>','<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
            <?php
            if (empty($action)) {
            ?>
            <div id="keystroke-box-0-<?php echo $classid ?>" class="list-st">
                <div class="form-group show-me12">
                    <label for="sel1" class="cell-po">Action<span style="color:red;">*</span></label>
                    <select class="form-control no-var mandatory_field actiontype" style="width: 100%;" name="<?php echo $classid . "[action][]"; ?>" onchange="actionType('<?php echo $classid; ?>', 0, this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <option value="">Select Action Type</option>
                        <option value="type" <?php echo ($action == "type") ? 'selected' : ''; ?>>Type</option>
                        <option value="press" <?php echo ($action == "press") ? 'selected' : ''; ?>>Press</option>
                        <option value="command" <?php echo ($action == "command") ? 'selected' : ''; ?>>Command</option>
                    </select>
                </div>
                <div class="" id="keystroke-value-box-0-<?php echo $classid ?>">
                </div>
                <div class="" id="keystroke-count-box-0-<?php echo $classid ?>">
                </div>
            </div>
            <div class="sortable section-next-action-<?php echo $classid ?>"></div>
            <?php
            } else {
            $k = 0;
            $c=0;
            $type = $action[0];
            ?>
            <div id="keystroke-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
                <div class="form-group show-me12">
                <?php if ($k != '0') { ?>
                    <div style="position: absolute;right: 13px;top:11px;z-index: 99; "><span class="pull-right" onclick="delete_keyboard_keystroke('<?php echo $k; ?>', '<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                <?php } ?>
                    <label for="sel1" class="cell-po">Action<span style="color:red;">*</span></label>
                    <select class="form-control mandatory_field actiontype" style="width: 100%;" name="<?php echo $classid . "[action][]"; ?>" onchange="actionType('<?php echo $classid ?>', '<?php echo $k; ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <option value="">Select Action Type</option>
                        <option value="type" <?php echo ($type == "type") ? 'selected' : ''; ?>>Type</option>
                        <option value="press" <?php echo ($type == "press") ? 'selected' : ''; ?>>Press</option>
                        <option value="command" <?php echo ($type == "command") ? 'selected' : ''; ?>>Command</option>
                    </select>
                </div>
                <div class="form-group show-me12" id="keystroke-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
                    <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                    <input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo htmlspecialchars($value[$k]); ?>" id="variablename-value-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                    <select class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value-<?php echo $classid; ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                        <option value=''>Select Variable</option>
                    </select>
                </div>
                <?php if ($type == "press") { ?>
                    <div class="form-group show-me12" id="keystroke-count-box-<?php echo $k ?>-<?php echo $classid ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Number of Times[count]</label>
                        <input type='text' class='form-control' style='width:85%;' placeholder='Count' name="<?php echo $classid . "[count][]"; ?>" value="<?php echo $count[$c]; ?>" id="variablename-count-<?php echo $classid; ?>-<?php echo $c; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' style='width: 5%;'  data-id="variablename-count-<?php echo $classid; ?>-<?php echo $c; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="count">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>
                    <?php
                    $c++;
                }
                ?>
                <div class="" id="keystroke-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
                </div>
                <div class="" id="keystroke-count-box-<?php echo $k; ?>-<?php echo $classid ?>">
                </div>
            </div>
            <div class="sortable section-next-action-<?php echo $classid ?>">
                <?php
                $k = 1;
                unset($action[0]);
                foreach($action as $type) {
                    ?>
                    <div id="keystroke-box-<?php echo $k; ?>-<?php echo $classid ?>" class="list-st">
                        <div class="form-group show-me12">
                            <div style="position: absolute;right: 13px;top:11px;z-index: 99; "><span class="pull-right" onclick="delete_keyboard_keystroke('<?php echo $k; ?>', '<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                            <label for="sel1" class="cell-po">Action<span style="color:red;">*</span></label>
                            <select class="form-control mandatory_field actiontype" style="width: 100%;" name="<?php echo $classid . "[action][]"; ?>" onchange="actionType('<?php echo $classid ?>', '<?php echo $k; ?>', this.value,'<?php echo $type; ?>')" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                                <option value="">Select Action Type</option>
                                <option value="type" <?php echo ($type == "type") ? 'selected' : ''; ?>>Type</option>
                                <option value="press" <?php echo ($type == "press") ? 'selected' : ''; ?>>Press</option>
                                <option value="command" <?php echo ($type == "command") ? 'selected' : ''; ?>>Command</option>
                            </select>
                        </div>
                        <div class="form-group show-me12" id="keystroke-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control mandatory_field' style='width:85%;' placeholder='Value' name="<?php echo $classid . "[value][]"; ?>" value="<?php echo htmlspecialchars($value[$k]); ?>" id="variablename-value-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' style='width: 5%;'  data-id="variablename-value-<?php echo $classid; ?>-<?php echo $k; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                        <?php if ($type == "press") {
                        ?>
                        <div class="form-group show-me12" id="keystroke-count-box-<?php echo $k ?>-<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Number of Times[count]</label>
                            <input type='text' class='form-control' style='width:85%;' placeholder='Count' name="<?php echo $classid . "[count][]"; ?>" value="<?php echo $count[$c]; ?>" id="variablename-count-<?php echo $classid; ?>-<?php echo $c; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' style='width: 5%;'  data-id="variablename-count-<?php echo $classid; ?>-<?php echo $c; ?>" attr_handler="keyboard" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="count">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                        <?php
                        $c++;
                        }
                        ?>
                        <div class="" id="keystroke-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
                        </div>
                        <div class="" id="keystroke-count-box-<?php echo $k; ?>-<?php echo $classid ?>">
                        </div>
                    </div>
                    <?php
                    $k++;
                }
                ?>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
    <?php if (!isset($validationjsonArr['keyboard'][$type]) || !empty($validationjsonArr['keyboard'][$type]['output'])) { ?>
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

