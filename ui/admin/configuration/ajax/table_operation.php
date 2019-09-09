<?php
$table_type = isset($data['data']['type']) ? $data['data']['type'] : '';
$fetch_type = isset($data['data']['fetch_type']) ? $data['data']['fetch_type'] : '';
$row = isset($data['data']['fetch_type']) ? $data['data']['row'] : '';
$column = isset($data['data']['fetch_type']) ? $data['data']['column'] : '';
$key = isset($data['data']['fetch_type']) ? $data['data']['key'] : '';
$value = isset($data['data']['fetch_type']) ? $data['data']['value'] : '';
if ($table_type == 'delete') {
    $position1 = isset($data['data']['position']) ? $data['data']['position'] : '';
} else {
    $position = isset($data['data']['position']) ? $data['data']['position'] : '';
}

if ($table_type == 'append') {
   $list = isset($data['data']['list']) ? $data['data']['list'] : '';
}
else if ($table_type == 'insert') {
   $list_insert = isset($data['data']['list']) ? $data['data']['list'] : '';
}
$data1 = isset($data['data']['data']) ? $data['data']['data'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$return_type = $data['on_success']['return_type'];
$variable_name = $data['on_success']['save'][0]['var'];
?>
<section class="tab-pane" id="<?php echo $classid ?>">
    <h3>Table Operations</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label><br>
            <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">  
        </div>
    </div>
    <br>

    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Type<span style="color:red;">*</span></label><br>
            <select class="form-control width-100 mandatory_field table_operations_dropdown_<?php echo $classid; ?>" name="<?php echo $classid . "[type]"; ?>" data-check="blank" data-error="This field is required" onchange="select_table_type(this.value,'<?php echo $classid; ?>')" data-createform-id="<?php echo $classid ?>">
                <option value="">Select Type</option>
                <option value="append" <?php echo $table_type == 'append' ? ' selected="selected"' : ''; ?>>Append</option>
                <option value="clear" <?php echo $table_type == 'clear' ? ' selected="selected"' : ''; ?>>Clear</option>
                <option value="insert" <?php echo $table_type == 'insert' ? ' selected="selected"' : ''; ?>>Insert</option>
                <option value="delete" <?php echo $table_type == 'delete' ? ' selected="selected"' : ''; ?>>Delete</option>
                <option value="size" <?php echo $table_type == 'size' ? ' selected="selected"' : ''; ?>>Size</option>
                <option value="fetch" <?php echo $table_type == 'fetch' ? ' selected="selected"' : ''; ?>>Fetch</option>
                <option value="transpose" <?php echo $table_type == 'transpose' ? ' selected="selected"' : ''; ?>>Transpose</option>
            </select>
        </div>
    </div>

    <div id="table_append_list_<?php echo $classid; ?>" style="display:none">
        <div  class="form-group add-select-variable-table_append_list_<?php echo $classid; ?>">
            
<?php
if (empty($list)) {
    ?>
                <div id="table_append_list-box-0_<?php echo $classid; ?>" class="list-st">
                <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_table_append_list('<?php echo $classid; ?>','<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                    <div class="form-group show-me12" id="table_append_list-value-box-0_<?php echo $classid; ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List<span style='color:red;'>*</span></label><br>
                        <input type='text' class='form-control table_append_list_append_<?php echo $classid; ?>' style='width:85%;' placeholder='List' name="<?php echo $classid . "[list][]"; ?>" value="<?php echo $list[0]; ?>" id="variablename-table-list-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="list" style='width: 5%;'  data-id="variablename-table-list-<?php echo $classid; ?>-0">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>
                </div>
                <div class="sortable section-table-append-list-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
    <?php
    $k = 0;
    $type = $list[0];
    ?>
    <div id="table_append_list-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                    <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_table_append_list('<?php echo $classid; ?>','<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="table_append_list-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List<span style='color:red;'>*</span></label><br>
                            <input type='text' class='form-control table_append_list_append_<?php echo $classid; ?>' style='width:85%;' placeholder='List' name="<?php echo $classid . "[list][]"; ?>" value="<?php echo $list[$k]; ?>" id="variablename-table_list-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="list" style='width: 5%;'  data-id="variablename-list-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
    </div>
    <div class="sortable section-table-append-list-action-<?php echo $classid ?>">
    <?php
    $k = 1;
    unset($list[0]);
    foreach ($list as $type) {
        $ans = $k;
        ?>
                    <div id="table_append_list-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                             <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="delete_table_append_list('<?php echo $k; ?>','<?php echo $classid; ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="table_append_list-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List<span style='color:red;'>*</span></label><br>
                            <input type='text' class='form-control table_append_list_append_<?php echo $classid; ?>' style='width:85%;' placeholder='List' name="<?php echo $classid . "[list][]"; ?>" value="<?php echo $list[$k]; ?>" id="variablename-table_list-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
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

    <div id="insert_table_list_<?php echo $classid; ?>" style="display:none" >
        <div class="form-group show-me12">
            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label><br>
            <input type='text' class='form-control insert_table_list_<?php echo $classid; ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position1]"; ?>" value="<?php echo $position; ?>" id="variablename-position1-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
            <select class='form-control appendVariable' attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="position" style='width: 5%;' data-id="variablename-position1-<?php echo $classid; ?>-0">
                <option value=''>Select Variable</option>
            </select>
        </div>
        <div  class="form-group add-select-variable-insert_table_list_<?php echo $classid; ?>">
            
<?php
if (empty($list_insert)) {
    ?>
                <div id="insert_table_list-box-0_<?php echo $classid; ?>" class="list-st">
                <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_insert_table_list('<?php echo $classid; ?>','<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                    <div class="form-group show-me12" id="insert_table_list-value-box-0_<?php echo $classid; ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List<span style='color:red;'>*</span></label><br>
                        <input type='text' class='form-control insert_table_list' style='width:85%;' placeholder='List' name="<?php echo $classid . "[list][]"; ?>" value="<?php echo $list_insert[0]; ?>" id="variablename-list2-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' attr_handler='variable' attr_handler_event="<?php echo $type; ?>" attr_handler_event_type='list' style='width: 5%;'  data-id="variablename-list2-<?php echo $classid; ?>-0">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>
                </div>
                <div class="sortable section-insert-table-list-action-<?php echo $classid ?>"></div>
<?php } else { ?>
    <?php
    $k = 0;
    $type_insert = $list_insert[0];
    ?>
                <div id="insert_table_list-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                    <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_insert_table_list('<?php echo $classid; ?>','<?php echo $type ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="insert_table_list-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List<span style='color:red;'>*</span></label><br>
                            <input type='text' class='form-control insert_table_list_<?php echo $classid; ?>' style='width:85%;' placeholder='List' name="<?php echo $classid . "[list][]"; ?>" value="<?php echo $list_insert[$k]; ?>" id="variablename-list2-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler='variable' attr_handler_event="<?php echo $type; ?>" attr_handler_event_type='list' style='width: 5%;'  data-id="variablename-list2-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>
                        </div>
                    </div>
                    <div class="sortable section-insert-table-list-action-<?php echo $classid ?>">
    <?php
    $k = 1;
    unset($list_insert[0]);
    foreach ($list_insert as $type_insert) {
        $ans = $k;
        ?>
                    <div id="insert_table_list-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                            <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="delete_table_insert_list('<?php echo $k; ?>','<?php echo $classid; ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="insert_table_list-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>List<span style='color:red;'>*</span></label><br>
                            <input type='text' class='form-control insert_table_list_<?php echo $classid; ?>' style='width:85%;' placeholder='List' name="<?php echo $classid . "[list][]"; ?>" value="<?php echo $list_insert[$k]; ?>" id="variablename-list2-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler='variable' attr_handler_event="<?php echo $type; ?>" attr_handler_event_type='list' style='width: 5%;'  data-id="variablename-list2-<?php echo $classid; ?>-<?php echo $k; ?>">
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

    <div id="table_delete_position_<?php echo $classid; ?>" style="display:none">
        <div  class="form-group add-select-variable-table_delete_position_<?php echo $classid; ?>">
            
            <?php
            if (empty($position1)) {
                ?>
                <div id="table_delete_position-box-0_<?php echo $classid; ?>" class="list-st">
                <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_table_delete_position('<?php echo $classid; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                    <div class="form-group show-me12" id="table_delete_position-value-box-0_<?php echo $classid; ?>">
                        <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label><br>
                        <input type='text' class='form-control table_delete_position_<?php echo $classid; ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position][]"; ?>" value="<?php echo $position1[0]; ?>" id="variablename-position2-<?php echo $classid; ?>-0"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                        <select class='form-control appendVariable' attr_handler='variable' attr_handler_event="<?php echo $type; ?>" attr_handler_event_type='position' style='width: 5%;'  data-id="variablename-position2-<?php echo $classid; ?>-0">
                            <option value=''>Select Variable</option>
                        </select>
                    </div>

                </div>
                <div class="sortable section-table-delete-position-action-<?php echo $classid ?>"></div>
<?php } else { ?>
    <?php
    $k = 0;
    $type = $position1[0];
    ?>
    <div id="table_delete_position-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                    <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="add_table_delete_position('<?php echo $classid; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="table_delete_position-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label><br>
                            <input type='text' class='form-control table_delete_position_<?php echo $classid; ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position][]"; ?>" value="<?php echo $position1[$k]; ?>" id="variablename-position2-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler='variable' attr_handler_event="<?php echo $type; ?>" attr_handler_event_type='position' style='width: 5%;'  data-id="variablename-position2-<?php echo $classid; ?>-<?php echo $k; ?>">
                                <option value=''>Select Variable</option>
                            </select>

                        </div>

    </div>
    <div class="sortable section-table-delete-position-action-<?php echo $classid ?>">
    <?php 
    $k = 1;
    unset($position1[0]);
    foreach ($position1 as $type) {
        $ans = $k;
        ?>
                    <div id="table_delete_position-box-<?php echo $k; ?>_<?php echo $classid; ?>" class="list-st">
                            <div style="position: absolute;right: 11px;z-index: 99;"><span class="pull-right" onclick="delete_table_delete_position('<?php echo $k; ?>','<?php echo $classid; ?>')"><i class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group show-me12" id="table_delete_position-value-box-<?php echo $k; ?>_<?php echo $classid; ?>">
                            <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Position<span style='color:red;'>*</span></label><br>
                            <input type='text' class='form-control table_delete_position_<?php echo $classid; ?>' style='width:85%;' placeholder='Position' name="<?php echo $classid . "[position][]"; ?>" value="<?php echo $position1[$k]; ?>" id="variablename-position2-<?php echo $classid; ?>-<?php echo $k; ?>"  data-check='blank' data-error='This field is required' data-createform-id='<?php echo $classid; ?>'>
                            <select class='form-control appendVariable' attr_handler='variable' attr_handler_event="<?php echo $type; ?>" attr_handler_event_type='position' style='width: 5%;'  data-id="variablename-position2-<?php echo $classid; ?>-<?php echo $k; ?>">
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
        <label>Table<span style="color:red;">*</span></label><br>
        <input type="text" value="<?php echo $data1; ?>" name="<?php echo $classid . "[data]"; ?>" id="variablename-data-<?php echo $classid ?>-0" style="width: 75%;" class="form-control mandatory_field variablename" placeholder="Table" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
        <select class="form-control appendVariable" attr_handler='variable' attr_handler_event="<?php echo $type; ?>" attr_handler_event_type='table' style="width: 18%;" data-id="variablename-data-<?php echo $classid ?>-0">
            <option value="">Select Variable</option>
        </select>
    </div> 

    <div class="show-me12" id="fetchDropdown_<?php echo $classid ?>" style="display:none;">
        
        <div class="add-fetch-dropdown-div-<?php echo $classid ?>">
            <?php if(empty($fetch_type)){ ?>
            <div class="list-st">
            <div style="position: absolute;right: 11px;z-index: 99;">
            <span class="pull-right">
                <i  onclick="add_fetch_dropdown('<?php echo $classid ?>','<?php echo $type; ?>')" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i>
            </span>
        </div>
                <div class="" id="fetch-drop-box-0-<?php echo $classid ?>">
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Fetch<span style="color:red;">*</span></label><br>
                        <select class="form-control width-100 fetchDropdown_<?php echo $classid ?>" name="<?php echo $classid . "[fetch_type][]"; ?>" data-check="blank" data-error="This field is required" onchange="select_table_fetch_type('<?php echo $classid; ?>', 0, this.value,'<?php echo $type; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="">Select Type</option>
                            <option value="row" <?php echo $fetch_type == 'row' ? ' selected="selected"' : ''; ?>>Row</option>
                            <option value="column" <?php echo $fetch_type == 'column' ? ' selected="selected"' : ''; ?>>Column</option>
                            <option value="element" <?php echo $fetch_type == 'element' ? ' selected="selected"' : ''; ?>>Element</option>
                        </select>
                    </div>
                    <div class="" id="fetchRow_0_<?php echo $classid ?>"></div>
                    <div class="" id="fetchColumn_0_<?php echo $classid ?>"></div>
                    <div class="" id="fetchKey_0_<?php echo $classid ?>"></div>
                    <div class="" id="fetchValue_0_<?php echo $classid ?>"></div>
                </div>   
            </div>
            <div class="sortable section-add-fetch-dropdown-action-<?php echo $classid ?>"></div>
            <?php } else {
            $k = 0;
            $r=0; 
            $c=0;  
            $key_val=0;
            $fetch=$fetch_type[0];
            ?>
            <div class="list-st">
            <div style="position: absolute;right: 11px;z-index: 99;">
            <span class="pull-right">
                <i  onclick="add_fetch_dropdown('<?php echo $classid ?>','<?php echo $type; ?>')" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i>
            </span>
            </div>
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Fetch<span style="color:red;">*</span></label><br>
                        <select class="form-control width-100 fetchDropdown_<?php echo $classid ?>" name="<?php echo $classid . "[fetch_type][]"; ?>" data-check="blank" data-error="This field is required" onchange="select_table_fetch_type('<?php echo $classid; ?>','<?php echo $k; ?>', this.value,'<?php echo $type; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="">Select Type</option>
                            <option value="row" <?php echo $fetch == 'row' ? ' selected="selected"' : ''; ?>>Row</option>
                            <option value="column" <?php echo $fetch == 'column' ? ' selected="selected"' : ''; ?>>Column</option>
                            <option value="element" <?php echo $fetch == 'element' ? ' selected="selected"' : ''; ?>>Element</option>
                        </select>
                    </div>
                    <?php  if($fetch == 'row'){?>
                    <div class="form-group" id="fetchRow_<?php echo $r; ?>_<?php echo $classid ?>">
                        <label>Row<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $row[$r]; ?>" name="<?php echo $classid . "[row][]"; ?>" id="variablename-row-<?php echo $classid ?>-<?php echo $r; ?>" style="width: 75%;" class="form-control" placeholder="Row" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-row-<?php echo $classid ?>-<?php echo $r; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div> 
                    <?php $r++; }  else if($fetch == 'column') { ?>
                     <div class="form-group" id="fetchColumn_<?php echo $c; ?>_<?php echo $classid ?>">
                        <label>Column<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $column[$c]; ?>" name="<?php echo $classid . "[column][]"; ?>" id="variablename-column-<?php echo $classid ?>-<?php echo $c; ?>" style="width: 75%;" class="form-control fetchColumn-<?php echo $classid ?> variablename" placeholder="Column" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="column" style="width: 18%;" data-id="variablename-column-<?php echo $classid ?>-<?php echo $c; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <?php $c++; } else { ?>
                    <div class="form-group" id="fetchKey_<?php echo $key_val; ?>_<?php echo $classid ?>">
                        <label>Row<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $key[$key_val]; ?>" name="<?php echo $classid . "[key][]"; ?>" id="variablename-row-<?php echo $classid ?>-<?php echo $key_val; ?>" style="width: 75%;" class="form-control" placeholder="Row" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-row-<?php echo $classid ?>-<?php echo $key_val; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <div class="form-group" id="fetchValue_<?php echo $key_val; ?>_<?php echo $classid ?>">
                        <label>Column<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $value[$key_val]; ?>" name="<?php echo $classid . "[value][]"; ?>" id="variablename-column-<?php echo $classid ?>-<?php echo $key_val; ?>" style="width: 75%;" class="form-control fetchColumn-<?php echo $classid ?> variablename" placeholder="Column" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="column" style="width: 18%;" data-id="variablename-column-<?php echo $classid ?>-<?php echo $key_val; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <?php $key_val++; } ?>
                    <div class="" id="fetchRow_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                    <div class="" id="fetchColumn_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                    <div class="" id="fetchKey_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                    <div class="" id="fetchValue_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                </div>     
            <div class="sortable section-add-fetch-dropdown-action-<?php echo $classid ?>">
            <?php 
            $k = 1;
            $r=0; 
            $c=0;  
            $key_val=0;
            unset($fetch_type[0]);
            foreach ($fetch_type as $fetch) {
            ?> 
            <div class="list-st">
                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_fetch_drop('<?php echo $k; ?>', '<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="cell-po">Fetch<span style="color:red;">*</span></label><br>
                        <select class="form-control width-100 fetchDropdown_<?php echo $classid ?>" name="<?php echo $classid . "[fetch_type][]"; ?>" data-check="blank" data-error="This field is required" onchange="select_table_fetch_type('<?php echo $classid; ?>','<?php echo $k; ?>', this.value,'<?php echo $type; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="">Select Type</option>
                            <option value="row" <?php echo $fetch == 'row' ? ' selected="selected"' : ''; ?>>Row</option>
                            <option value="column" <?php echo $fetch == 'column' ? ' selected="selected"' : ''; ?>>Column</option>
                            <option value="element" <?php echo $fetch == 'element' ? ' selected="selected"' : ''; ?>>Element</option>
                        </select>
                    </div>
                    <?php  if($fetch == 'row'){?>
                    <div class="form-group" id="fetchRow_<?php echo $r; ?>_<?php echo $classid ?>">
                        <label>Row<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $row[$r]; ?>" name="<?php echo $classid . "[row][]"; ?>" id="variablename-row-<?php echo $classid ?>-<?php echo $r; ?>" style="width: 75%;" class="form-control" placeholder="Row" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-row-<?php echo $classid ?>-<?php echo $r; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div> 
                    <?php $r++; }  else if($fetch == 'column') { ?>
                     <div class="form-group" id="fetchColumn_<?php echo $c; ?>_<?php echo $classid ?>">
                        <label>Column<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $column[$c]; ?>" name="<?php echo $classid . "[column][]"; ?>" id="variablename-column-<?php echo $classid ?>-<?php echo $c; ?>" style="width: 75%;" class="form-control fetchColumn-<?php echo $classid ?> variablename" placeholder="Column" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="column" style="width: 18%;" data-id="variablename-column-<?php echo $classid ?>-<?php echo $c; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <?php $c++; } else { ?>
                    <div class="form-group" id="fetchKey_<?php echo $key_val; ?>_<?php echo $classid ?>">
                        <label>Row<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $key[$key_val]; ?>" name="<?php echo $classid . "[key][]"; ?>" id="variablename-row-<?php echo $classid ?>-<?php echo $key_val; ?>" style="width: 75%;" class="form-control" placeholder="Row" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="row" style="width: 18%;" data-id="variablename-row-<?php echo $classid ?>-<?php echo $key_val; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <div class="form-group" id="fetchValue_<?php echo $key_val; ?>_<?php echo $classid ?>">
                        <label>Column<span style="color:red;">*</span></label><br>
                        <input type="text" value="<?php echo $value[$key_val]; ?>" name="<?php echo $classid . "[value][]"; ?>" id="variablename-column-<?php echo $classid ?>-<?php echo $key_val; ?>" style="width: 75%;" class="form-control fetchColumn-<?php echo $classid ?> variablename" placeholder="Column" data-check="blank"   data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                        <select class="form-control appendVariable" attr_handler="variable_handler" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="column" style="width: 18%;" data-id="variablename-column-<?php echo $classid ?>-<?php echo $key_val; ?>">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    <?php $key_val++; } ?>
                    <div class="" id="fetchRow_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                    <div class="" id="fetchColumn_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                    <div class="" id="fetchKey_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                    <div class="" id="fetchValue_<?php echo $k; ?>_<?php echo $classid ?>"></div>
                </div>     
            </div>
            <?php  $k++; } ?>
            </div>
            <?php } ?>
        </div>
        </div>
                <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
                <?php include('output.php'); ?>
                <?php } ?> 
                <?php include('failure.php'); ?>
    <?php include('advance.php'); ?>
    <button type="button" class="btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
    <div class="demo82 collapse-content">
    <div class="collapse-container">
        <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
    </div>
    </div>

</section>