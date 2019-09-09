<?php
/*
 * API Handler
 * 1.Post Handler 
 */
$server_ip = isset($data['data']['server_ip']) ? $data['data']['server_ip'] : '';
$url = isset($data['data']['url']) ? $data['data']['url'] : '';
$url_key = isset($data['data']['url_key']) ? $data['data']['url_key'] : '';
$url_value = isset($data['data']['url_value']) ? $data['data']['url_value'] : '';
$header_key = isset($data['data']['header_key']) ? $data['data']['header_key'] : '';
$header_value = isset($data['data']['header_value']) ? $data['data']['header_value'] : '';
$form_key = isset($data['data']['form_key']) ? $data['data']['form_key'] : '';
$form_value = isset($data['data']['form_value']) ? $data['data']['form_value'] : '';
$form_type = isset($data['data']['type']) ? $data['data']['type'] : '';
$raw = isset($data['data']['raw']) ? $data['data']['raw'] : '';
$raw_text = isset($data['data']['rawtext']) ? $data['data']['rawtext'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$path_to_key = $data['on_success']['save'][0]['path_to_key'];
$return_type = $data['on_success']['return_type'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>POST </h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text" style="width:100%;" id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
        </div>
    </div>
    <div class="form-group">
        <label>Enter URL <span style="color:red;">*</span></label>
        <input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid . "[url]"; ?>" value="<?php echo htmlspecialchars($url); ?>" placeholder="Enter Request URL Here" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid ?>">
    </div>


    <hr>
    <div id="post-request-button-<?php echo $classid ?>">
        <button class="btn" onclick="return add_url_params_data_button('<?php echo $classid ?>', this.className);" id="btn18-<?php echo $classid ?>"><i class="fa fa-pencil-square-o"></i> URL params
        </button>
        <button class="btn" onclick="return add_headers_data_button('<?php echo $classid ?>', this.className);" id="btn24-<?php echo $classid ?>"><i class="fa fa-pencil-square-o"></i> Headers
        </button>
    </div>

    <!--URL params -->
    <div id="post-url-key-value-<?php echo $classid ?>" class="post-urlrequest-<?php echo $classid ?> " style="display:none;">
        
        <div class="form-group add-select-variable-url-post-<?php echo $classid ?>">
            <?php
            if (empty($url_key)) {
                ?>
                    <div class="col-md-12 list-st post-url-key-value-row-<?php echo $classid ?>" id="post-key-value-box-0-<?php echo $classid ?>" style="margin-top:10px;">
                    <div style="position: absolute;right: 10px;z-index: 99;"><span class="pull-right" onclick="add_url_params_data('<?php echo $classid ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group">
                            <label for="sel1" class="cell-po" >URL Parameter Key</label>
                            <div class="row">
                                <div class="col-md-6">

                                    <input type="text" class="form-control no-var"  placeholder="URL Parameter Key" name="<?php echo $classid . "[url_key][]"; ?>" value="<?php echo $url_key; ?>" id="variablename-post-url-key-<?php echo $classid ?>-0"></div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable"   data-id="variablename-post-url-key-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="urlkey">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sel1" class="cell-po" >Value</label>
                            <div class="row">
                                <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[url_value][]"; ?>" value="<?php echo $url_value; ?>" id="variablename-post-url-value-<?php echo $classid ?>-0"></div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable"   data-id="variablename-post-url-value-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="urlvalue">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="sortable section-post-url-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
                <?php
                $k = 0;
                $key = $url_key[0];
                ?>
                <div class="col-md-12 list-st post-url-key-value-row-<?php echo $classid ?>" id="post-key-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="add_url_params_data('<?php echo $classid ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >URL Parameter Key</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="URL Parameter Key" name="<?php echo $classid . "[url_key][]"; ?>" value="<?php echo htmlspecialchars($key); ?>" id="variablename-post-url-key-<?php echo $classid ?>-<?php echo $k; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-url-key-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="urlkey">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >Value</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[url_value][]"; ?>" value="<?php echo htmlspecialchars($url_value[$k]); ?>" id="variablename-post-url-value-<?php echo $k; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-url-value-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="urlvalue">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="sortable section-post-url-action-<?php echo $classid ?>">
                <?php
                $k = 1;
                unset($url_key[0]);
                foreach ($url_key as $key) {
                    $ans = $k;
                    ?>
                    <div class="col-md-12 list-st post-url-key-value-row-<?php echo $classid ?>" id="post-key-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
                            <div class="form-group">
                                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_post_url_key_val('<?php echo $k; ?>', '<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                <label for="sel1" class="cell-po" >URL Parameter Key</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="URL Parameter Key" name="<?php echo $classid . "[url_key][]"; ?>" value="<?php echo htmlspecialchars($key); ?>" id="variablename-post-url-key-<?php echo $classid ?>-<?php echo $k; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-url-key-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="urlkey">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >Value</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[url_value][]"; ?>" value="<?php echo htmlspecialchars($url_value[$k]); ?>" id="variablename-post-url-value-<?php echo $k; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-url-value-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="urlvalue">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    $k++;
                    } ?>
                </div>
               <?php } ?>
        </div>
    </div>
    <!---------- Header Key Value ------>
    <div id="post-header-key-value-<?php echo $classid ?>" class="postheaderrequest-<?php echo $classid ?>" style="display:none;">
        
        <div class="form-group add-select-variable-header-post-<?php echo $classid ?>">
            <?php
            if (empty($header_key)) {
                ?>
                    <div class="col-md-12 list-st post-header-key-value-row-<?php echo $classid ?>" id="post-header-value-box-0-<?php echo $classid ?>" style="margin-top:10px;">
                    <div style="position: absolute;right: 10px;z-index: 99;"><span class="pull-right" onclick="add_header_data('<?php echo $classid ?>', '<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                        <div class="form-group">
                            <label for="sel1" class="cell-po" >Header</label>
                            <div class="row">
                                <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Header" name="<?php echo $classid . "[header_key][]"; ?>" value="<?php echo $header_key; ?>" id="variablename-post-header-key-<?php echo $classid ?>-0"></div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable"   data-id="variablename-post-header-key-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="headerkey">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sel1" class="cell-po" >Value</label>
                            <div class="row">
                                <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[header_value][]"; ?>" value="<?php echo $header_value; ?>" id="variablename-post-header-value-<?php echo $classid ?>-0"></div>
                                <div class="col-md-6">
                                    <select class="form-control appendVariable"   data-id="variablename-post-header-value-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="headervalue">
                                        <option value="">Select Variable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="sortable section-post-header-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
                <?php
                $i = 0;
                $key_header = $header_key[0];
                ?>
                <div class="col-md-12 list-st post-header-key-value-row-<?php echo $classid ?>" id="post-header-value-box-<?php echo $i; ?>-<?php echo $classid ?>">
                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="add_header_data('<?php echo $classid ?>', '<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >Header</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"   placeholder="Header" name="<?php echo $classid . "[header_key][]"; ?>" value="<?php echo htmlspecialchars($key_header); ?>" id="variablename-post-header-key-<?php echo $classid ?>-<?php echo $i; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-header-key-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="headerkey">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >Value</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[header_value][]"; ?>" value="<?php echo htmlspecialchars($header_value[$i]); ?>" id="variablename-post-header-value-<?php echo $i; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-header-value-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="headervalue">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="sortable section-post-header-action-<?php echo $classid ?>">
                <?php 
                $i = 1;
                unset($header_key[0]);
                foreach ($header_key as $key_header) {
                    $ans = $i;
                    ?>
                <div class="col-md-12 list-st post-header-key-value-row-<?php echo $classid ?>" id="post-header-value-box-<?php echo $i; ?>-<?php echo $classid ?>">
                            <div class="form-group">
                                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_post_header_key_val('<?php echo $i; ?>', '<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                <label for="sel1" class="cell-po" >Header</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"   placeholder="Header" name="<?php echo $classid . "[header_key][]"; ?>" value="<?php echo htmlspecialchars($key_header); ?>" id="variablename-post-header-key-<?php echo $classid ?>-<?php echo $i; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-header-key-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="headerkey">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >Value</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[header_value][]"; ?>" value="<?php echo htmlspecialchars($header_value[$i]); ?>" id="variablename-post-header-value-<?php echo $i; ?>"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-post-header-value-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="headervalue">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    $i++;
                }
                ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <hr>
    <?php if (empty($form_type)) { ?>
        <div id="post-type-button-<?php echo $classid ?>">
            <button  class="btn" onclick="return add_form_data_type_button('<?php echo $classid ?>', this.className, 'form-data');" id="btn600-<?php echo $classid ?>">form-data
            </button>
            <button class="btn" onclick="return add_form_data_type_button('<?php echo $classid ?>', this.className, 'x-www-form-urlencoded');" id="btn601-<?php echo $classid ?>"> x-www-form-urlencoded
            </button>
            <button class="btn" onclick="return add_form_data_type_button('<?php echo $classid ?>', this.className, 'raw');" id="btn602-<?php echo $classid ?>">raw
            </button>
        </div>
    <?php
    } else {
        if ($form_type == 'form-data') {
            $form_data_class = 'class="btn btn-primary"';
        } else if ($form_type == 'x-www-form-urlencoded') {
            $x_www_form_urlencoded_class = 'class="btn btn-primary"';
        } else if ($form_type == 'raw') {
            $raw_class = 'class="btn btn-primary"';
        } else {
            $form_data_class = '';
            $x_www_form_urlencoded_class = '';
            $raw_class = '';
        }
        ?>
        <div id="post-type-button-<?php echo $classid ?>">
            <button class="btn" onclick="return add_form_data_type_button('<?php echo $classid ?>', this.className, 'form-data');" id="btn600-<?php echo $classid ?>" <?php echo $form_data_class; ?>>form-data
            </button>
            <button class="btn" onclick="return add_form_data_type_button('<?php echo $classid ?>', this.className, 'x-www-form-urlencoded');" id="btn601-<?php echo $classid ?>" <?php echo $x_www_form_urlencoded_class; ?>> x-www-form-urlencoded
            </button>
            <button class="btn" onclick="return add_form_data_type_button('<?php echo $classid ?>', this.className, 'raw');" id="btn602-<?php echo $classid ?>" <?php echo $raw_class; ?>>raw
            </button>
        </div>
        <?php } ?>
        <!-- Form-data -->
        <?php if (empty($form_key)) { ?>
        <div id="form-key-value-<?php echo $classid ?>" class="formrequest-<?php echo $classid ?>" style="display:none;">
        <?php } else { ?>
            <div id="form-key-value-<?php echo $classid ?>" class="formrequest-<?php echo $classid ?>" style="display:block;">
        <?php } ?>
            
            <div class="form-group add-select-variable-form-<?php echo $classid ?>">
        <?php if (empty($form_key)) { ?>
        <div class="col-md-12 list-st form-key-value-row-<?php echo $classid ?>" id="form-value-box-0-<?php echo $classid ?>" style="margin-top:10px;">
                    <div style="position: absolute;right: 10px;z-index: 99;"><span class="pull-right" onclick="add_form_data('<?php echo $classid ?>', '<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >Key</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Key" name="<?php echo $classid . "[form_key][]"; ?>" value="<?php echo htmlspecialchars($form_key); ?>" id="variablename-form-key-<?php echo $classid ?>-0"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"   data-id="variablename-form-key-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formkey">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sel1" class="cell-po" >Value</label>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[form_value][]"; ?>" value="<?php echo htmlspecialchars($form_value); ?>" id="variablename-form-value-<?php echo $classid ?>-0"></div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable"  attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formvalue"  data-id="variablename-form-value-<?php echo $classid ?>-0">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control"  name="<?php echo $classid . "[type]"; ?>" value="<?php echo $form_type; ?>" id="variablename-form-key-type-<?php echo $classid ?>">
                        </div>
                        <div class="sortable section-post-form-action-<?php echo $classid ?>"></div>
                    <?php
                    } else {
                        $l = 0;
                        $fkey = $form_key[0];
                        ?>
                        <div class="col-md-12 list-st form-key-value-row-<?php echo $classid ?>" id="form-value-box-<?php echo $l; ?>-<?php echo $classid ?>">
                            <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="add_form_data('<?php echo $classid ?>', '<?php echo $type; ?>')"><i  class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                                <div class="form-group">
                                    <label for="sel1" class="cell-po" >Key</label>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Key" name="<?php echo $classid . "[form_key][]"; ?>" value="<?php echo htmlspecialchars($fkey); ?>" id="variablename-form-key-<?php echo $classid ?>-<?php echo $l; ?>"></div>
                                        <div class="col-md-6">
                                            <select class="form-control appendVariable"   data-id="variablename-form-key-<?php echo $classid ?>-<?php echo $l; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formkey">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sel1" class="cell-po" >Value</label>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[form_value][]"; ?>" value="<?php echo htmlspecialchars($form_value[$l]); ?>" id="variablename-form-value-<?php echo $l; ?>"></div>
                                        <div class="col-md-6">
                                            <select class="form-control appendVariable"   data-id="variablename-form-value-<?php echo $classid ?>-<?php echo $l; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formvalue">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control"  name="<?php echo $classid . "[type]"; ?>" value="<?php echo $form_type; ?>" id="variablename-form-key-type-<?php echo $classid ?>">
                            </div>
                            <div class="sortable section-post-form-action-<?php echo $classid ?>">
                            <?php 
                            $l = 1;
                            unset($form_key[0]);
                            foreach ($form_key as $fkey) {
                            $ans = $l;
                            ?>
                            <div class="col-md-12 list-st form-key-value-row-<?php echo $classid ?>" id="form-value-box-<?php echo $l; ?>-<?php echo $classid ?>">
                                <div class="form-group">
                                        <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_form_key_val('<?php echo $l; ?>', '<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                                    <label for="sel1" class="cell-po" >Key</label>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Key" name="<?php echo $classid . "[form_key][]"; ?>" value="<?php echo htmlspecialchars($fkey); ?>" id="variablename-form-key-<?php echo $classid ?>-<?php echo $l; ?>"></div>
                                        <div class="col-md-6">
                                            <select class="form-control appendVariable"   data-id="variablename-form-key-<?php echo $classid ?>-<?php echo $l; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formkey">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sel1" class="cell-po" >Value</label>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[form_value][]"; ?>" value="<?php echo htmlspecialchars($form_value[$l]); ?>" id="variablename-form-value-<?php echo $l; ?>"></div>
                                        <div class="col-md-6">
                                            <select class="form-control appendVariable"   data-id="variablename-form-value-<?php echo $classid ?>-<?php echo $l; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="formvalue">
                                                <option value="">Select Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control"  name="<?php echo $classid . "[type]"; ?>" value="<?php echo $form_type; ?>" id="variablename-form-key-type-<?php echo $classid ?>">
                            </div>
                        <?php
                        $l++;
                        } ?>
                        </div>
                <?php }
                ?>
            </div>
        </div>
        <!---raw dropdown textarea -->
        <?php if (empty($raw_text)) { ?>
            <div id="raw-dropdown-textarea-<?php echo $classid; ?>">
            </div>
        <?php } else { ?>
            <div id="raw-dropdown-textarea-<?php echo $classid; ?>" style="display:block;">
                <textarea rows="6" cols="100" class="form-control" style="width: 100%;" name="<?php echo $classid . "[rawtext]"; ?>" id="raw-text-area-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>"><?php echo $raw_text; ?></textarea>
                <select class="form-control" style="width: 100%;"  name="<?php echo $classid . "[raw]"; ?>" id="raw-dropdown-<?php echo $classid ?>"  data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
                    <option value="text" <?php echo ($raw == "text") ? 'selected' : ''; ?>>Text</option>
                    <option value="json" <?php echo ($raw == "json") ? 'selected' : ''; ?>>JSON</option>
                    <option value="xml" <?php echo ($raw == "xml") ? 'selected' : ''; ?>>XML</option>
                    <option value="html" <?php echo ($raw == "html") ? 'selected' : ''; ?>>HTML</option>
                </select>
            </div>
        <?php } ?>
        <hr>
        <?php if (!isset($validationjsonArr['https'][$type]) || !empty($validationjsonArr['https'][$type]['output'])) { ?>
    <?php include('output.php'); ?>
    <?php } ?>
    <?php include('failure.php'); ?>
    <?php include('advance.php'); ?>
    <div class="collapse-box" data-toggle="collapse" data-target="#demo82">Comments</div>
    <div id="demo82" class="collapse collapse-content">
        <div class="collapse-container"> <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea></div>
    </div>
</div>

