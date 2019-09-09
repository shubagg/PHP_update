<?php

/* 
 * Mail Handler
 * Receive Mail Handler
 */
$user_id = isset($data['data']['user_id']) ? $data['data']['user_id'] : '';
$password = isset($data['data']['password']) ? $data['data']['password'] : '';
$to = isset($data['data']['imap_url']) ? $data['data']['imap_url'] : '';
$data_path = isset($data['data']['path']) ? $data['data']['path'] : '';
$message = isset($data['data']['message']) ? $data['data']['message'] : '';
$mail_menu = isset($data['data']['menu']) ? $data['data']['menu'] : '';
$attachment_path = isset($data['data']['attachment_path']) ? $data['data']['attachment_path'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
$intendsdata = isset($data['data']['intends']) ? $data['data']['intends'] : '';
$search_criteria = isset($data['data']['search_criteria']) ? $data['data']['search_criteria'] : '';
$intends_callbackdata = isset($data['data']['intends_callback']) ? $data['data']['intends_callback'] : '';
$check_attach = isset($data['data']['check_attach']) ? $data['data']['check_attach'] : 'false';
$check_callback = isset($data['data']['check_callback']) ? $data['data']['check_callback'] : 'false';
$download_attach = isset($data['data']['download_attach']) ? $data['data']['download_attach'] : '';
$file_name = isset($data['data']['file_name']) ? $data['data']['file_name'] : '';
?>
<section class="tab-pane" id="<?php echo $classid ?>">
    <h3>Receive Mail</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
           <div class="row">
			   <div class="col-md-12"> <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>"> 
			   </div>   
        </div>
        </div>
    </div>
    <div class="form-group width-600">
        <label for="email">Email ID<span class="red">*</span></label>
        <div class="row">
			<div class="col-md-6">
				<input type="text" id="user_id-<?php echo $classid ?>"  name="<?php echo $classid . "[user_id]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $user_id; ?>" data-createform-id="<?php echo $classid ?>" placeholder="User Name" />
			</div>
        <div class="col-md-6">
            <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="email_id"  data-id="user_id-<?php echo $classid ?>">
                <option value="">Select Variable</option>
            </select>
        </div>
        </div>
    </div>
    <div class="form-group width-600">
        <label for="email">Password<span class="red">*</span></label>
        <div class="row">
			<div class="col-md-6"><input type="password" id="password-<?php echo $classid ?>" name="<?php echo $classid . "[password]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $password; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Password" />
			</div>
        <div class="col-md-6">
            <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="password"  data-id="password-<?php echo $classid ?>">
                <option value="">Select Variable</option>
            </select>
        </div>
        </div>
    </div>
    <div class="form-group width-600">
        <label for="email">IMAP Server/Host<span class="red">*</span></label>
        <div class="row">
			<div class="col-md-6">
				<input type="text" id="imap_url-<?php echo $classid ?>" name="<?php echo $classid . "[imap_url]"; ?>" class="form-control mandatory_field" data-check="blank" data-error="This field is required" value="<?php echo $to; ?>" data-createform-id="<?php echo $classid ?>" placeholder="imap.gmail.com"/>
			</div>
        <div class="col-md-6">
            <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="imap_server"  data-id="imap_url-<?php echo $classid ?>">
                <option value="">Select Variable</option>
            </select>
        </div>
        </div>
    </div>
    <hr>
    <div class="form-group width-600">
        <label for="email">Search Criteria<span class="red"></span></label>
    </div>
            <?php
            if (empty($search_criteria)) { ?>
                <div id="receive_list-box-0-<?php echo $classid; ?>" class="list-st">
            <div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="add_receive_list('<?php echo $classid; ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span>
		</div>
                <div class="form-group" id="receive_list-value-box-0-<?php echo $classid; ?>">
                    <label for="sel1" class="cell-po">Action</label>
                    <div class="row">
		    <div class="col-md-12">                                                
                        <select class="form-control mandatory_field receive_mail_dropdown" name="<?php echo $classid . "[type][]"; ?>" data-check="blank" data-error="This field is required" onchange="select_receive_mail(0, this.value,'<?php echo $type; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="">Select Type</option>
                            <option value="from">From</option>
                            <option value="subject">Subject</option>
                            <option value="since">Since</option>
                            <option value="before">Before</option>
                            <option value="unseen">Unseen</option>
                            <option value="new">New</option>
                        </select>
                    </div>
					</div>
                </div>
                <div class="receive_list-box-0" id="receive_list-value-box-from-0">
                    <div class="form-group">
                        <div id="search_criteria_lable-<?php echo $c . '-' . $classid; ?>">
                             <label for='sel1' class='cell-po' style='margin-top:0px !important;'>Value<span style='color:red;'>*</span></label>
                        </div>
                        <div id="search_criteria_lable-<?php echo $c . '-' . $classid; ?>">
                        <div id="search_criteria-0-<?php echo $classid; ?>">
                            <div class="row"><div class="col-md-6"><input id="variablename-from-0-<?php echo $classid; ?>" type="text" class='form-control mandatory_field no-var receive_list_append clockpicker search-data' placeholder="Key" name="<?php echo $classid . "[from][]"; ?>" value=""  data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid; ?>"></div>
                            <div class="col-md-6">
                                <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"   data-id="variablename-from-0-<?php echo $classid; ?>">
                                    <option value="">Select Variable</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
            <div class="sortable section-receivemail-action-<?php echo $classid ?>"></div>
            <?php } else {
                $c = 0;
                $search = $search_criteria[0]; 
                ?>
                            <div id="receive_list-box-<?php echo $c . '-' . $classid; ?>" class="list-st">
            <div style="position: absolute;right:11px;z-index: 99;"><span class="pull-right" onclick="add_receive_list('<?php echo $classid; ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span>
		</div>
                <div class="form-group">
                    <div class="row">
						<div class="col-md-12" id="receive_list-value-box-<?php echo $c . '-' . $classid; ?>">
                        <label for="sel1" class="cell-po">Action</label>
                        <select class="form-control mandatory_field receive_mail_dropdown" name="<?php echo $classid . "[type][]"; ?>" data-check="blank" data-error="This field is required" onchange="select_receive_mail(<?php echo $c; ?>, this.value,'<?php echo $type; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="">Select Type</option>
                            <option value="from" <?php
                            if ($data['data']['type'][$c] == 'from') {
                                echo 'selected="selected"';
                            }
                            ?>>From</option>
                            <option value="subject" <?php
                            if ($data['data']['type'][$c] == 'subject') {
                                echo 'selected="selected"';
                            }
                            ?>>Subject</option>
                            <option value="since" <?php
                            if ($data['data']['type'][$c] == 'since') {
                                echo 'selected="selected"';
                            }
                            ?>>Since</option>
                            <option value="before" <?php
                            if ($data['data']['type'][$c] == 'before') {
                                echo 'selected="selected"';
                            }
                            ?>>Before</option>
                                            <option value="unseen" <?php
                            if ($data['data']['type'][$c] == 'unseen') {
                                echo 'selected="selected"';
                            }
                            ?>>Unseen</option>
                            <option value="new" <?php
                            if ($data['data']['type'][$c] == 'new') {
                                echo 'selected="selected"';
                            }
                            ?>>New</option>
                        </select>
                    </div>
                    </div>
                </div>
                <?php if($data['data']['type'][$c] == 'unseen' || $data['data']['type'][$c] == 'new'){?>
                    <div class=" receive_list-box-<?php echo $c; ?>" id="receive_list-value-box-from-<?php echo $c; ?>" style="display:none">
                <?php } else { ?>
                    <div class=" receive_list-box-<?php echo $c; ?>" id="receive_list-value-box-from-<?php echo $c; ?>"></div>
                <?php } ?>
                        <div class="form-group">
                            <div id="search_criteria_lable-<?php echo $c . '-' . $classid; ?>">
                                <label for='sel1' class='cell-po'>Value<span style='color:red;'>*</span></label>
                            </div>
                            <div id="search_criteria-<?php echo $c . '-' . $classid; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="variablename-from-<?php echo $c . '-' . $classid; ?>" type="text" class='form-control mandatory_field no-var receive_list_append clockpicker search-data' placeholder="Key" name="<?php echo $classid . "[from][]"; ?>" value="<?php echo $data['data']['from'][$c]; ?>"  data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"   data-id="variablename-from-<?php echo $c . '-' . $classid; ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
            </div>
            
            <div class="sortable section-receivemail-action-<?php echo $classid ?>">
            <?php
            $c = 1;
            unset($search_criteria[0]); 
            foreach ($search_criteria as $search) {
            ?>
            <div id="receive_list-box-<?php echo $c . '-' . $classid; ?>" class="list-st">
                <div style="position: absolute;right: 0;z-index: 99;"><span class="spull-right" onclick="delete_receive_list(<?php echo $c; ?>)"><i class="add-element-button fa fa-minus" dat=""></i></span></div>
                <div class="form-group">
                    <div class="row">
						<div class="col-md-12" id="receive_list-value-box-<?php echo $c . '-' . $classid; ?>">
                        <label for="sel1" class="cell-po">Action</label>
                        <select class="form-control mandatory_field receive_mail_dropdown" name="<?php echo $classid . "[type][]"; ?>" data-check="blank" data-error="This field is required" onchange="select_receive_mail(<?php echo $c; ?>, this.value,'<?php echo $type; ?>')" data-createform-id="<?php echo $classid ?>">
                            <option value="">Select Type</option>
                            <option value="from" <?php
                            if ($data['data']['type'][$c] == 'from') {
                                echo 'selected="selected"';
                            }
                            ?>>From</option>
                            <option value="subject" <?php
                            if ($data['data']['type'][$c] == 'subject') {
                                echo 'selected="selected"';
                            }
                            ?>>Subject</option>
                            <option value="since" <?php
                            if ($data['data']['type'][$c] == 'since') {
                                echo 'selected="selected"';
                            }
                            ?>>Since</option>
                            <option value="before" <?php
                            if ($data['data']['type'][$c] == 'before') {
                                echo 'selected="selected"';
                            }
                            ?>>Before</option>
                                            <option value="unseen" <?php
                            if ($data['data']['type'][$c] == 'unseen') {
                                echo 'selected="selected"';
                            }
                            ?>>Unseen</option>
                            <option value="new" <?php
                            if ($data['data']['type'][$c] == 'new') {
                                echo 'selected="selected"';
                            }
                            ?>>New</option>
                        </select>
                    </div>
                    </div>
                </div>
                <?php if($data['data']['type'][$c] == 'unseen' || $data['data']['type'][$c] == 'new'){?>
                    <div class=" receive_list-box-<?php echo $c; ?>" id="receive_list-value-box-from-<?php echo $c; ?>" style="display:none">
                <?php } else { ?>
                    <div class=" receive_list-box-<?php echo $c; ?>" id="receive_list-value-box-from-<?php echo $c; ?>"></div>
                <?php } ?>
                        <div class="form-group">
                            <div id="search_criteria_lable-<?php echo $c . '-' . $classid; ?>">
                                <label for='sel1' class='cell-po'>Value<span style='color:red;'>*</span></label>
                            </div>
                            <div id="search_criteria-<?php echo $c . '-' . $classid; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="variablename-from-<?php echo $c . '-' . $classid; ?>" type="text" class='form-control mandatory_field no-var receive_list_append clockpicker search-data' placeholder="Key" name="<?php echo $classid . "[from][]"; ?>" value="<?php echo $data['data']['from'][$c]; ?>"  data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="value"   data-id="variablename-from-<?php echo $c . '-' . $classid; ?>">
                                            <option value="">Select Variable</option>
                                        </select>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
            <?php
            $c++;
            }?>
            </div>
        <?php } ?>    
    
    <hr>
    <div class="form-group width-600">
        <label for="email">Path</label>
        <div class="row">
			<div class="col-md-6"><input type="text" id="path-<?php echo $classid ?>" name="<?php echo $classid . "[path]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $data_path; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Path" /></div>
        <div class="col-md-6">
            <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="path"  data-id="path-<?php echo $classid ?>">
                <option value="">Select Variable</option>
            </select>
        </div>
        </div>
    </div>
     <div class="form-group width-600">
        <label for="email">File Name</label>
        <div class="row">
            <div class="col-md-6"><input type="text" id="file_name-<?php echo $classid ?>"  name="<?php echo $classid . "[file_name]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $file_name; ?>" data-createform-id="<?php echo $classid ?>" placeholder="File Name" />
            </div>
            <div class="col-md-6">
                <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="file_name"  data-id="file_name-<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group width-600">
        <div class="row">
        <div class="col-md-6">
            <label for="email">Check Attachment</label>
            <input type="checkbox" name="<?php echo $classid . "[check_attach]"; ?>" <?php echo $checkbox_checked; ?> id="attachment_received-<?php echo $classid ?>" onchange="checkAttachment('<?php echo $classid ?>')"  value="<?php echo $check_attach; ?>" <?php
            if ($check_attach == 'true') {
                echo 'checked="checked"';
            }
            ?> style="box-shadow:none; width:50px;"/>
        </div>
        <div class="col-md-6">
            <label for="email">Check CallBack</label>
            <input type="checkbox" name="<?php echo $classid . "[check_callback]"; ?>"  id="check_callback_received-<?php echo $classid ?>" onchange="checkCallBack('<?php echo $classid ?>')"  value="<?php echo $check_callback; ?>" <?php
            if ($check_callback == 'true') {
            echo 'checked="checked"';
            }
            ?> style="box-shadow:none; width:50px;"/>
        </div>
        </div>
    </div>
    <?php if($check_attach=="true"){ ?>
    <div id="attachment_received-checkbox-box-<?php echo $classid; ?>" style="display:block">
    <?php } else{ ?>
    <div id="attachment_received-checkbox-box-<?php echo $classid; ?>" style="display:none">
    <?php } ?> 
        <div class="form-group width-600">
        
        <label for="email">Intends<span class="red"></span></label>
    </div>
    <div class="form-group width-600 intends-<?php echo $classid; ?>">
        <?php
        if (empty($intendsdata)) { ?>
            <div class="list-st">
            <div id="intends-box-0-<?php echo $classid ?>" style="width:94%; float:left;">
                <input type="text" id="intends-0-<?php echo $classid ?>" style="width:49% !important;"  name="<?php echo $classid . "[intends][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $intends; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Intends" />
                <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="intends"  data-id="intends-0-<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div style="position: absolute;right: 0;z-index: 99; margin-top: 4px;margin-right: 10px;"><span class="pull-right" onclick="add_intends('<?php echo $classid; ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
            </div>
            <div class="sortable section-add-intends-action-<?php echo $classid ?>"></div>
   <?php } else {
                $c = 0;
                $search = $intendsdata[0];
                ?>
                <div id="intends-box-<?php echo $c . '-' . $classid ?>" class="list-st">
                <div  style="width:94%; float:left;">
                    <input type="text"  style="width:49% !important;" id="intends-<?php echo $c . '-' . $classid ?>"  name="<?php echo $classid . "[intends][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $search; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Intends" />
                    <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="intends"  data-id="intends-0-<?php echo $classid ?>">
                        <option value="">Select Variable</option>
                    </select>
                
                </div>
                    <div style="position: absolute;right: 0;z-index: 99; margin-top: 4px;"><span class="pull-right" onclick="add_intends('<?php echo $classid; ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></div>
                </div>
                <div class="sortable section-add-intends-action-<?php echo $classid ?>">
                <?php 
                $c = 1;
                unset($intendsdata[0]);
        foreach ($intendsdata as $search) {
                ?>    
             <div id="intends-box-<?php echo $c . '-' . $classid ?>" class="list-st">
                <div  style="width:94%; float:left;">
                    <input type="text"  style="width:49% !important;" id="intends-<?php echo $c . '-' . $classid ?>"  name="<?php echo $classid . "[intends][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $search; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Intends" />
                    <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="intends"  data-id="intends-0-<?php echo $classid ?>">
                        <option value="">Select Variable</option>
                    </select>
                
                </div>
                        <div class="pull-right" style="margin-top: 4px;"><span class="pull-right" onclick="delete_intends_list('<?php echo $c; ?>','<?php echo $classid; ?>')"><i class="add-element-button fa fa-minus" dat=""></i></span></div>
                </div>
    <?php
    $c++;
    }?>
    </div>
    <?php } ?>
    </div>

    <div class="form-group width-600" style="width:94%;">
        <label for="email">Download Attachment</label>
        <input type="text" id="download_attach-<?php echo $classid ?>"  style="width:49% !important;"  name="<?php echo $classid . "[download_attach]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $download_attach; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Download Attachment" />
        <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="download_attachment"  data-id="download_attach-<?php echo $classid ?>">
            <option value="">Select Variable</option>
        </select>
    </div> 
    </div>
    <?php if($check_callback=="true"){ ?>
    <div id="intends_callback-checkbox-box-<?php echo $classid; ?>" style="display:block">
    <?php } else { ?>
    <div id="intends_callback-checkbox-box-<?php echo $classid; ?>" style="display:none">    
    <?php } ?>
        <div class="form-group width-600">
       
        <label for="email">Intends Callback<span class="red"></span></label>
    </div>
    <div class="form-group width-600 intends_callback-<?php echo $classid; ?>">
    <?php
    if (empty($intends_callbackdata)) {?>
  <div class="list-st">
            <div id="intends_callback-box-0-<?php echo $classid ?>" style="width:94%; float:left;">
                <input type="text" name="<?php echo $classid . "[intends_callback_key][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="" data-createform-id="<?php echo $classid ?>" placeholder="Key" style="width: 100%;"/>
                <input type="text" id="intends_callback-0-<?php echo $classid ?>"  style="width:49% !important;"  name="<?php echo $classid . "[intends_callback_value][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="" data-createform-id="<?php echo $classid ?>" placeholder="Value" style="width: 47%;"/>
                <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="intends"  data-id="intends_callback-0-<?php echo $classid ?>">
                    <option value="">Select Variable</option>
                </select>
            </div>
            <div style="position: absolute;right: 0;z-index: 99; margin-top: 4px;margin-right: 10px;"><span class="pull-right" onclick="add_intends_callback('<?php echo $classid; ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span>
			</div>
            </div>
            <div class="sortable section-add-intends-callback-action-<?php echo $classid ?>"></div>
    <?php } else {
            $c = 0;
            $search = $intends_callbackdata[0];
            ?>
                <div id="intends_callback-box-<?php echo $c . '-' . $classid ?>">
        <div  style="width:94%; float:left;">
            <input type="text" name="<?php echo $classid . "[intends_callback_key][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $data['data']['intends_callback_key'][$c]; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Key" style="width: 100%;"/>
            <input type="text" id="intends_callback-<?php echo $c . '-' . $classid ?>"  style="width:49% !important;"  name="<?php echo $classid . "[intends_callback_value][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $data['data']['intends_callback_value'][$c]; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Value" style="width: 47%;"/>
            <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="intends"  data-id="intends_callback-<?php echo $c . '-' . $classid ?>">
                <option value="">Select Variable</option>
            </select>
            </div>
        <div class="pull-right" style="margin-top: 4px;"><span class="pull-right" onclick="add_intends_callback('<?php echo $classid; ?>', '<?php echo $type; ?>')"><i class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span>
            </div>
        </div>
            <div class="sortable section-add-intends-callback-action-<?php echo $classid ?>">
            <?php
            $c = 1;
            unset($intends_callbackdata[0]);
            foreach ($intends_callbackdata as $search) {
            ?>
    <div id="intends_callback-box-<?php echo $c . '-' . $classid ?>">
        <div  style="width:94%; float:left;">
            <input type="text" name="<?php echo $classid . "[intends_callback_key][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $data['data']['intends_callback_key'][$c]; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Key" style="width: 100%;"/>
            <input type="text" id="intends_callback-<?php echo $c . '-' . $classid ?>"  style="width:49% !important;"  name="<?php echo $classid . "[intends_callback_value][]"; ?>" class="form-control" data-check="blank" data-error="This field is required" value="<?php echo $data['data']['intends_callback_value'][$c]; ?>" data-createform-id="<?php echo $classid ?>" placeholder="Value" style="width: 47%;"/>
            <select class="form-control appendVariable" attr_handler="mail" attr_handler_event="<?php echo $type; ?>" attr_handler_event_type="intends"  data-id="intends_callback-<?php echo $c . '-' . $classid ?>">
                <option value="">Select Variable</option>
            </select>
            </div>
                <div class="pull-right" style="margin-top: 4px;">
                    <span class="pull-right" onclick="delete_intends_callback_list('<?php echo $c; ?>','<?php echo $classid; ?>')"><i class="add-element-button fa fa-minus" dat=""></i></span>
            </div>
        </div>
       
    <?php
    $c++;
    }?>
   </div>
    <?php } ?>
    </div> 
    </div>
</div>
     <?php if (!isset($validationjsonArr['variable'][$type]) || !empty($validationjsonArr['variable'][$type]['output'])) { ?>
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
</section>