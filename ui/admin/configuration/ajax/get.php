<?php

/* 
 * Api Handler
 * 1.Get Action
 */

$server_ip = isset($data['data']['server_ip']) ? $data['data']['server_ip'] : '';
$url = isset($data['data']['url']) ? $data['data']['url'] : '';
$url_key = isset($data['data']['url_key']) ? $data['data']['url_key'] : '';
$url_value = isset($data['data']['url_value']) ? $data['data']['url_value'] : '';
$header_key = isset($data['data']['header_key']) ? $data['data']['header_key'] : '';
$header_value = isset($data['data']['header_value']) ? $data['data']['header_value'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$variable_name = $data['on_success']['save'][0]['var'];
$path_to_key= $data['on_success']['save'][0]['path_to_key'];
$return_type = $data['on_success']['return_type'];
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3>GET</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
        </div>
    </div>  
    <!--ip address -->
    <!--- url -->
    <div class="form-group">
        <label>Enter URL <span style="color:red;">*</span></label>
        <input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid . "[url]"; ?>" value="<?php echo htmlspecialchars($url); ?>" placeholder="Enter Request URL Here" data-check="blank"  data-error="This field is required" data-createform-id="<?php echo $classid; ?>">
    </div>
    <hr>
    <!-- URL AND Header Button  -->
    <div id="get-request-button-<?php echo $classid ?>">
        <button onclick="return add_url_params_get_button('<?php echo $classid ?>',this.className);" id="btn9-<?php echo $classid ?>" class="btn"><i class="fa fa-pencil-square-o"></i>URL params
        </button>
        <button onclick="return add_headers_get_button('<?php echo $classid ?>',this.className);"  id="btn12-<?php echo $classid ?>" class="btn"><i class="fa fa-pencil-square-o"></i> Headers
        </button>
    </div>
    <!--- URL Params -->
    <div id="url-key-value-<?php echo $classid ?>" class="urlrequest-<?php echo $classid ?>" style="display:none;">
        <div class="form-group add-select-variable-url-<?php echo $classid ?>">
            <?php
            if (empty($url_key)) {
            ?>
            <div class="list-st col-md-12 url-key-value-row-<?php echo $classid ?>" id="key-value-box-0-<?php echo $classid ?>" style="margin-top:10px;">
            <div style="position: absolute;right: 10px;z-index: 99;"><span class="pull-right"><i  onclick="add_url_params_data_get('<?php echo $classid ?>','<?php echo $type; ?>')" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >URL Parameter Key</label>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="URL Parameter Key" name="<?php echo $classid . "[url_key][]"; ?>" value="<?php echo htmlspecialchars($url_key); ?>" id="variablename-url-key-<?php echo $classid ?>-0">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable no-var"   data-id="variablename-url-key-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url_key">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Value</label>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[url_value][]"; ?>" value="<?php echo htmlspecialchars($url_value); ?>" id="variablename-url-value-<?php echo $classid ?>-0">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-url-value-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url_value">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>
            </div>
            <div class="sortable section-url-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
            <?php
            $k = 0;
            $key = $url_key[0];
            ?>
            <div class="col-md-12 list-st url-key-value-row--<?php echo $classid ?>" id="key-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
            <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right"><i  onclick="add_url_params_data_get('<?php echo $classid ?>','<?php echo $type; ?>')" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >URL Parameter Key</label>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="URL Parameter Key" name="<?php echo $classid . "[url_key][]"; ?>" value="<?php echo htmlspecialchars($key); ?>" id="variablename-url-key-<?php echo $classid ?>-<?php echo $k; ?>">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-url-key-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url_key">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Value</label>
                   <div class="row">
					 <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[url_value][]"; ?>" value="<?php echo htmlspecialchars($url_value[$k]); ?>" id="variablename-url-value-<?php echo $k; ?>">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-url-value-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url_value">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>  
            </div>
            <div class="sortable section-url-action-<?php echo $classid ?>">
                <?php
                $k = 1;
                unset($url_key[0]);
                foreach($url_key as $key) {
                    ?>
                    <div class="col-md-12 list-st url-key-value-row--<?php echo $classid ?>" id="key-value-box-<?php echo $k; ?>-<?php echo $classid ?>">
                <div class="form-group">
                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_url_key_val('<?php echo $k; ?>','<?php echo $classid ?>')"><i  class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                    <label for="sel1" class="cell-po" >URL Parameter Key</label>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="URL Parameter Key" name="<?php echo $classid . "[url_key][]"; ?>" value="<?php echo htmlspecialchars($key); ?>" id="variablename-url-key-<?php echo $classid ?>-<?php echo $k; ?>">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-url-key-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url_key">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Value</label>
                   <div class="row">
					 <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[url_value][]"; ?>" value="<?php echo htmlspecialchars($url_value[$k]); ?>" id="variablename-url-value-<?php echo $k; ?>">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-url-value-<?php echo $classid ?>-<?php echo $k; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="url_value">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>  
            </div>
                    <?php
                    $k++;
                }
                ?>
            </div>
            <?php
            } ?>
        </div>
    </div>
    <!--  Header Key Value -->
    <div id="header-key-value-<?php echo $classid ?>" class="headerrequest-<?php echo $classid ?>" style="display:none;">
        
        <div class="form-group add-select-variable-header-<?php echo $classid ?>">
            <?php
            if (empty($header_key)) {
            ?>
            <div class="col-md-12 list-st header-key-value-row-<?php echo $classid ?>" id="header-value-box-0-<?php echo $classid ?>" style="margin-top:10px;">
            <div style="position: absolute;right: 10px;z-index: 99;"><span class="pull-right" onclick="add_header_data_get('<?php echo $classid ?>','<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Header</label>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="Header" name="<?php echo $classid . "[header_key][]"; ?>" value="<?php echo htmlspecialchars($header_key); ?>" id="variablename-header-key-<?php echo $classid ?>-0">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-header-key-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="header_key">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Value</label>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[header_value][]"; ?>" value="<?php echo htmlspecialchars($header_value); ?>" id="variablename-header-value-<?php echo $classid ?>-0">
                    </div>
                    <div class="col-md-6">
                    <select class="form-control appendVariable"   data-id="variablename-header-value-<?php echo $classid ?>-0" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="header_value">
                        <option value="">Select Variable</option>
                    </select>
                    </div>
                    </div>
                </div>
            </div>
            <div class="sortable section-header-action-<?php echo $classid ?>"></div>
            <?php } else { ?>
            <?php
            $i = 0;
            $key_header = $header_key[0];
            ?>
            <hr>
            <div class="col-md-12 list-st header-key-value-row-<?php echo $classid ?>" id="header-value-box-<?php echo $i; ?>-<?php echo $classid ?>">
            <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="add_header_data_get('<?php echo $classid ?>','<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div> 
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Header</label>
                   <div class="row">
					 <div class="col-md-6">
                        <input type="text" class="form-control no-var"   placeholder="Header" name="<?php echo $classid . "[header_key][]"; ?>" value="<?php echo htmlspecialchars($key_header); ?>" id="variablename-header-key-<?php echo $classid ?>-<?php echo $i; ?>">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-header-key-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="header_key">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Value</label> 
                    <div class="row">
                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[header_value][]"; ?>" value="<?php echo htmlspecialchars($header_value[$i]); ?>" id="variablename-header-value-<?php echo $i; ?>"></div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-header-value-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="header_value">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
                    </div>
                </div>
            </div>
            <div class="sortable section-header-action-<?php echo $classid ?>">
           <?php 
           $i = 1;
           unset($header_key[0]);
           foreach ($header_key as $key_header) {
            ?>
            <div class="col-md-12 list-st header-key-value-row-<?php echo $classid ?>" id="header-value-box-<?php echo $i; ?>-<?php echo $classid ?>">   
                <div class="form-group">
                    <div style="position: absolute;right: 0;z-index: 99;"><span class="pull-right" onclick="delete_header_key_val('<?php echo $i; ?>','<?php echo $classid ?>')"><i id="btn14" class="add-element-button fa fa-minus" data-type="<?php echo $classid; ?>"></i></span></div>
                    <label for="sel1" class="cell-po" >Header</label>
                   <div class="row">
					 <div class="col-md-6">
                        <input type="text" class="form-control no-var"   placeholder="Header" name="<?php echo $classid . "[header_key][]"; ?>" value="<?php echo htmlspecialchars($key_header); ?>" id="variablename-header-key-<?php echo $classid ?>-<?php echo $i; ?>">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-header-key-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="header_key">
                            <option value="">Select Variable</option>
                        </select>
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label for="sel1" class="cell-po" >Value</label> 
                    <div class="row">
                    <div class="col-md-6"><input type="text" class="form-control no-var"  placeholder="Value" name="<?php echo $classid . "[header_value][]"; ?>" value="<?php echo htmlspecialchars($header_value[$i]); ?>" id="variablename-header-value-<?php echo $i; ?>"></div>
                    <div class="col-md-6">
                        <select class="form-control appendVariable"   data-id="variablename-header-value-<?php echo $classid ?>-<?php echo $i; ?>" attr_handler="https" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="header_value">
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
    <?php if (!isset($validationjsonArr['https'][$type]) || !empty($validationjsonArr['https'][$type]['output'])) { ?>
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
