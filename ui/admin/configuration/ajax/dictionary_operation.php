<?php
$dictionary_type = isset($data['data']['type']) ? $data['data']['type'] : '';
$fetch_list = isset($data['data']['fetch_list']) ? $data['data']['fetch_list'] : '';
$dictionary = isset($data['data']['dictionary']) ? $data['data']['dictionary'] : '';
$index = isset($data['data']['index']) ? $data['data']['index'] : '';
$keys = isset($data['data']['keys']) ? $data['data']['keys'] : '';
$path = isset($data['data']['path']) ? $data['data']['path'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$return_type = $data['on_success']['return_type'];
$variable_name = $data['on_success']['save'][0]['var'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>Dictionary Operations</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
        </div>
	</div>

    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Type<span style="color:red;">*</span></label>
            <select class="form-control width-100 mandatory_field dictionary_operations_dropdown_<?php echo $classid ?>" name="<?php echo $classid . "[type]"; ?>" data-check="blank" data-error="This field is required" onchange="select_dictionary_type(this.value, '<?php echo $classid ?>')" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Type</option>
                <option value="fetch" <?php echo $dictionary_type == 'fetch' ? ' selected="selected"' : ''; ?>>Fetch</option>
                <option value="append" <?php echo $dictionary_type == 'append' ? ' selected="selected"' : ''; ?>>Append</option>
                <option value="delete" <?php echo $dictionary_type == 'delete' ? ' selected="selected"' : ''; ?>>Delete</option>
            </select>
        </div>
    </div>

    <div id="fetchList_<?php echo $classid ?>" style="display:none">
        <div  class="form-group add-select-variable-fetchList_<?php echo $classid ?>">
            
            <?php
            if (empty($fetch_list)) {
                ?>
                <div id="fetchList-box-0_<?php echo $classid ?>" class="list-st">
                <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_fetch_list('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                    <div class="form-group show-me12" id="fetchList-value-box-0_<?php echo $classid ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Key<span style='color:red;'>*</span></label>
                        <input type='text' class='form-control fetchListAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Key' name="<?php echo $classid . "[fetch_list][]"; ?>" value="<?php echo $fetch_list[0]; ?>" id="variablename-list1-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="list" style='width: 5%;'  data-id="variablename-list1-<?php echo $classid; ?>-0">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>

                </div>
                <div class="sortable section-fetch-dictionary-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
                <?php
                $k = 0;
                $type = $fetch_list[0];
                ?>
                <div id="fetchList-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                    <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_fetch_list('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="fetchList-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Key<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control fetchListAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Key' name="<?php echo $classid . "[fetch_list][]"; ?>" value="<?php echo $fetch_list[$k]; ?>" id="variablename-list1-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="list" style='width: 5%;'  data-id="variablename-list-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                </div>
                <div class="sortable section-fetch-dictionary-action-<?php echo $classid ?>">
                <?php
                $k = 1;
                unset($fetch_list[0]);
                foreach ($fetch_list as $type) {
                    $ans = $k;
                    ?>
                    <div id="fetchList-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                            <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_fetch_list('<?php echo $k; ?>', '<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="fetchList-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Key<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control fetchListAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Key' name="<?php echo $classid . "[fetch_list][]"; ?>" value="<?php echo $fetch_list[$k]; ?>" id="variablename-list1-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="list" style='width: 5%;'  data-id="variablename-list-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php
                    $k++;
                }
                ?>
                </div>
            <?php } ?>

        </div>
    </div>

    <div id="appendDictionary_<?php echo $classid ?>" style="display:none">
        <div  class="form-group add-select-variable-appendDictionary_<?php echo $classid ?>">
            
            <?php
            if (empty($dictionary)) {
                ?>
                <div id="appendDictionary-box-0_<?php echo $classid ?>" class="list-st">
                <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_append_dictionary('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                    <div class="form-group show-me12" id="appendDictionary-value-box-0_<?php echo $classid ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Dictionary<span style='color:red;'>*</span></label>
                        <input type='text' class='form-control appendDictionaryAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Dictionary' name="<?php echo $classid . "[dictionary][]"; ?>" value="<?php echo $dictionary[0]; ?>" id="variablename-dictionary-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="dictionary" style='width: 5%;'  data-id="variablename-dictionary-<?php echo $classid; ?>-0">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>
                </div>
                <div class="sortable section-add-append-dictionary-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
                <?php
                $k = 0;
                $type = $dictionary[0];
                ?>
                <div id="appendDictionary-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                    <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_append_dictionary('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="appendDictionary-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Dictionary<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control appendDictionaryAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Dictionary' name="<?php echo $classid . "[dictionary][]"; ?>" value="<?php echo $dictionary[$k]; ?>" id="variablename-dictionary-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="dictionary" style='width: 5%;'  data-id="variablename-dictionary-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                    </div>
                 <div class="sortable section-add-append-dictionary-action-<?php echo $classid ?>">
                <?php 
                $k = 1;
                unset($dictionary[0]);
                foreach ($dictionary as $type) {
                    $ans = $k;
                    ?>
                    <div id="appendDictionary-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                            <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_append_dictionary('<?php echo $k; ?>', '<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="appendDictionary-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Dictionary<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control appendDictionaryAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Dictionary' name="<?php echo $classid . "[dictionary][]"; ?>" value="<?php echo $dictionary[$k]; ?>" id="variablename-dictionary-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="dictionary" style='width: 5%;'  data-id="variablename-dictionary-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>

                        </div>

                    </div>
                    <?php
                    $k++;
                }
                ?>
                 </div>
            <?php } ?>

        </div>
    </div>

    <div id="deleteKey_<?php echo $classid ?>" style="display:none">
        <div  class="form-group add-select-variable-deleteKey_<?php echo $classid ?>" >
            <div style="position: absolute;right: 11px;top:10px;z-index: 99;"><span class="pull-right" onclick="add_delete_keys('<?php echo $classid ?>', '<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
            <?php
            if (empty($keys)) {
                ?>
                <div id="deleteKey-box-0_<?php echo $classid ?>" class="list-st">
                    <div class="form-group show-me12" id="deleteKey-value-box-0_<?php echo $classid ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>keys<span style='color:red;'>*</span></label>
                        <input type='text' class='form-control deleteKeyAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Keys' name="<?php echo $classid . "[keys][]"; ?>" value="<?php echo $keys[0]; ?>" id="variablename-keys-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="key" style='width: 5%;'  data-id="variablename-keys-<?php echo $classid; ?>-0">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>
                </div>
                <div class="sortable section-add-delete-keys-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
                <?php
                $k = 0;
                $type = $keys[0];
                ?>
                <div id="deleteKey-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                        <div class="form-group show-me12" id="deleteKey-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Keys<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control deleteKeyAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Keys' name="<?php echo $classid . "[keys][]"; ?>" value="<?php echo $keys[$k]; ?>" id="variablename-keys-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="keys" style='width: 5%;'  data-id="variablename-keys-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                    </div>
                <div class="sortable section-add-delete-keys-action-<?php echo $classid ?>">
                <?php
                $k = 1;
                unset($keys[0]);
                foreach ($keys as $type) {
                    $ans = $k;
                    ?>
                    <div id="deleteKey-box-<?php echo $k; ?>_<?php echo $classid ?>" class="list-st">
                            <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="delete_delete_keys('<?php echo $k; ?>', '<?php echo $classid ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="deleteKey-value-box-<?php echo $k; ?>_<?php echo $classid ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Keys<span style='color:red;'>*</span></label>
                            <input type='text' class='form-control deleteKeyAppend_<?php echo $classid ?>' style='width:85%;' placeholder='Keys' name="<?php echo $classid . "[keys][]"; ?>" value="<?php echo $keys[$k]; ?>" id="variablename-keys-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="keys" style='width: 5%;'  data-id="variablename-keys-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <?php
                    $k++;
                }
                ?>
                </div>
            <?php } ?>

        </div>
    </div>

    <div class="form-group">
        <label>Path<span style="color:red;">*</span></label>
        <input type="text" value="<?php echo $path; ?>" name="<?php echo $classid . "[path]"; ?>" id="variablename-path-<?php echo $classid ?>-0" style="width: 75%;" class="form-control mandatory_field variablename" placeholder="Path" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path" style="width: 18%;" data-id="variablename-path-<?php echo $classid ?>-0">
            <option value="">Select Variable</option>
        </select>
    </div> 

    <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
    <?php include('output.php'); ?>
    <?php } ?> 
    <?php include('failure.php'); ?>
    <?php include('advance.php'); ?>
    <button type="button" class=" btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
    <div class="demo82 collapse collapse-content">
    <div class="collapse-container">
        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
    </div>
    </div>
</div>
