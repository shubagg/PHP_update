<div id="main">
  <script>
function checkalldata(){}
</script>
  <div id="content">
    <div class="row">
      <section class="panel top-gap">
        <header class="panel-heading">
          <h3>
            <strong>
              <?php echo $ui_string['announcement'];?>
            </strong> 
          </h3>
        </header>
        <div class="panel-body panel_bg_d">
          <form name="frm" class="form-horizontal" data-collabel="3" data-label="color" parsley-validate>	
            <input type="hidden" name="customerId" id="customerId" value="43">
            <input type="hidden" name="mid" id="mid" value="36">
            <input type="hidden" name="smid" id="smid" value="1">
            <input type="hidden" name="eid" id="eid" value="116">
            <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
            <div class="form-group">
              <label class="control-label remove_bg">
                <?php echo $ui_string['action'];?>
                <font color='red'>*
                </font> 
              </label>
              <div>
                <div class="row">
                  <div class="col-sm-12">
                    <select class="form-control" id="type" onchange="hideRestBDiv(this.value);">
                      <option value="">--
                        <?php echo $ui_string['selectaction'];?>--
                      </option>
                      <option value="email" <?php if($infoData['type']=='email'){echo 'selected="selected"';}?>>
                        <?php echo $ui_string['email'];?>
                      </option>
                      <option value="push" <?php if($infoData['type']=='push'){echo 'selected="selected"';}?>>
                        <?php echo $ui_string['push'];?>
                      </option>
                    </select>
                    <span id="valid_types" class="error">
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label remove_bg">
                <?php echo $ui_string['announcementTitle'];?>
                <font color='red'>*
                </font> 
              </label>
              <div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="text" name="title" id="title" data-check-valid="blank" data-error-show-in="etitle" data-error-setting="2" data-error-text="Please enter announcement title" class="form-control  error1" value="<?php echo isset($infoData['title'])?$infoData['title']:'';?>"/>
                    <span id="etitle" class="error">
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group" id="ckeditor" <?php echo $style1;?>>
              <label class="control-label remove_bg"><?php echo $ui_string['announcementDesc'];?><font color='red'>*</font></label>
              <div>
                <div class="row">
                  <div class="col-sm-12">          
                      <textarea class="form-control ckeditor" id="pg_content" name="msg" rows="5" ><?php echo isset($infoData['txt'])?$infoData['txt']:'';?></textarea>
                      <span id="valid_msg" class="error">
                      </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group" id="textboxeditor" <?php echo $style;?>>
              <label class="control-label remove_bg">
                <?php echo $ui_string['announcementDesc'];?>
                <font color='red'>*
                </font>
              </label>
              <div>
                <div class="row">
                  <div class="col-sm-12">
                    <textarea class="form-control" id="pg_content1" name="msg1" rows="5" ><?php echo isset($infoData['txt'])?$infoData['txt']:'';?></textarea>
                    <span id="valid_msg1" class="error">
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group hidden">
              <label class="control-label remove_bg">
                <?php echo $ui_string['date'];?>
                <font color='red'>*
                </font> 
              </label>
              <div>
                <div class="row">
                  <div class="col-sm-12">
                    <input readonly="readonly" type="text" name="date" id="date" data-check-valid="blank" data-error-show-in="edate" data-error-setting="2" data-error-text="Please select date" class="form-control error1 form_datetime" />
                    <span id="edate" class="error"></span>
                    
                  
                </div>
              </div>
            </div>
            </div>
            
            <header class="panel-heading bottom-gap" id="toDiv">
              <div class="row">
                <div class="col-md-6">
                  <label>
                    <?php echo $ui_string['to'];?> 
                    <font color='red'>*
                    </font>
                  </label>
                </div>
                <div class="col-md-4">
                  <div class="bootstrap-tagsinput" id="usertaginput">
                    <!--				<span class="tag label label-default">5216</span> 
<span class="tag label label-default">5216</span> -->
                  </div>
                </div>
                <div class="col-md-2">
                  <div id="togrp">
                    <div class="form-group" id="ctggrp">
                      <button type="button" class="btn btn-theme-inverse col-md-12"  onclick="$('#enroll-user').modal();">
                        <?php echo $ui_string['select'];?>
                      </button>
                      <span id="valid_ctg_id" class="error">
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </header>
            <div class="col-md-12">
              <div class="text-right">
                <button type="button" class="btn btn-theme-inverse" data-toggle="modal" data-target="" onclick="broadcast()">
                  <?php echo $ui_string['send'];?>
                </button>
                
              </div>
              </form>
            </div>
          </section>
        </div>
    </div>
  </div>
  <?php 

get_enroll_users_popup('',$all_cats,'enroll-user','2',array('mid'=>'36','smid'=>'1'),true);?>   
  <div id="confirm-click-1" class="modal fade" data-backdrop="static" data-keyboard="false" data-header-color="#736086" >
    <div class="modal-header">
      <h4 class="modal-title"> 
        <i class="glyphicon glyphicon-ok-circle ">
        </i>
        <?php echo $ui_string['confirm'];?> 
      </h4>
    </div>
    <div class="modal-body text_alignment" >
      <div class="confirmation_successful">
        <i class="glyphicon glyphicon-ok-circle icon_size">
        </i>
        <br>
        <?php echo $ui_string['notificationsuccess'];?> 
      </div>
    </div>
  </div>
