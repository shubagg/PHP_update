

<div id="main" class="dashboard">
<?php get_breadcrumb();
              
?>

  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal-scrollable"><div id="myModal-4" class="modal fade">
		   <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			  <i class="fa fa-times"></i>
			  </button>
			  <h4 class="modal-title" id="model_head">Run</h4>
		   </div>
		   <!-- //modal-header-->
		   <div class="modal-body text_alignment">
			  <form class="form-horizontal labelcustomize">
           
            <div class="form-group ">
	<label class="control-label remove_bg col-md-4 col-md-2"><span class="color">Select<font class="color">*</font></span></label>
	<div class="col-md-8 col-md-10">
	<select class="form-control">
		<option>select</option>
		<option>http://192.168.1.165</option>
		<option>http://192.168.1.119:8081</option>
	</select>
	    <span id="ecategoryname" class="error"></span>
    </div>
	</div>    <div class="col-md-12 text-right margn-btm-20">
               <span id="groupbut">
               	<button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" onclick="submitdata();">Confirm</button>
               </span>
               <span><button type="button" class="btn btn-inverse bottom-gap" pd-popup-close="popupNew1">
Cancel</button></span>
            </div>
            <br>
         </form>
		   </div>
		   <!-- //modal-body-->
		</div></div>


    <div id="content">
      <div class="row">
        <section class="panel">
          <header class="panel-heading panel-updated">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3><strong><?php //echo $ui_string['BusinessProcess'];?> Control Tower</strong></h3>
              </div>
  
             
            </div>
          </header>
          <div class="panel-body">

    <section class="panel"> 
      <div class="panel-body">
      
            <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
            
                <li role="presentation" onclick="load_page('viewlist','view')" class="active"><a id="tab_view" href="#view" aria-controls="home" role="tab" data-toggle="tab"><?php echo $ui_string['viewlist'];?></a></li>
                <li role="presentation" onclick="load_page('draftlist','draft')" ><a id="tab_draft" href="#draft" aria-controls="home" role="tab" data-toggle="tab"><?php echo $ui_string['templatelist'];?></a></li>             
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
               
                <div role="tabpanel" class="tab-pane active" id="view"></div>
                 <div role="tabpanel" class="tab-pane" id="draft"></div>
              </div>
              
            </div>
                </section>

<strong>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!--popup-->
<div class="popup" pd-popup="popupNew25" id="popupNew25">
    <div class="popup-inner">
        <div class="model-headeer">
            <h4 class="modal-title"> Title
            </h4>
            <a class="popup-close" pd-popup-close="popupNew25" href="#"> </a>
        </div>
        <div class="modal-body ">
            <form class="form-horizontal labelcustomize">

                <div class="form-group ">
                    <label class="control-label remove_bg col-md-4"><span class="color">Title<font class="color">*</font></span></label>
                    <div class="col-md-8">
                        <input type="hidden" id="robot_id" name="robot_id" class="form-control">
                        <input type="text" id="categoryname" name="categoryname" class="form-control" value="">
                        <span id="ecategoryname1" class="err" style="color:red;"></span>
                    </div>
                </div>    <div class="col-md-12 text-right margn-btm-20">
                    <span id="groupbut">
                        <button type="button" class="btn btn-theme-inverse btn_width right bottom-gap" onclick="copydata();">Confirm</button>
                    </span>
                    <span><button type="button" class="btn btn-inverse bottom-gap" pd-popup-close="popupNew25">Cancel</button></span>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
<div class="popup" pd-popup="popupNew">
    <div class="popup-inner">
        <div class="model-headeer">
            <h4 class="modal-title" id="model_head">
                <i class="glyphicon glyphicon-ok-circle"></i> Confirmation
            </h4>
            <a class="popup-close" pd-popup-close="popupNew" href="#"> </a>
        </div>
        <div class="modal-body text_alignment">
            <div class="confirmation_successful">
                <i class="glyphicon glyphicon-ok-circle icon_size"></i><br>
                <span id="model_des">Confirmation Successful</span>
            </div>
        </div>
    </div>
</div>
          <?php /* for user modal of dashboard donutt chart */ ?>
        <div id="md-full-user" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" id ="dismiss" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['user_list']; ?></h4>
            </div>
            <div class="modal-body">
                <div id="orderproduct">
                    <form id="formUser"  method="post" action="" enctype="multipart/form-data">
                        <div id="user_table">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="">
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Checkbox</th>
                                                        <th>user</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($return['success']) && ($return['success'] == 'true')) {
                                                        foreach ($return['data'] as $value) {
                                                            ?>
                                                            <tr>
                                                                <td><input type="checkbox" onclick="check_box_user(this.id)" name="checked_userid[]" id="<?php echo $value['id'] ?>" class="sel_checkbox" value="<?php echo $value['id'] ?>" <?php
                                                                    if (isset($userChecked) && !empty($userChecked)) {
                                                                        if (in_array($value['id'], $userChecked)) {
                                                                            echo "checked";
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                    ?>></td>
                                                                <td><?php echo $value['name'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan='2'>Sorry no records found</td>
                                                        </tr>

                                                    <?php }
                                                    ?>
                                                </tbody></table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="custom_button btn_cu btn btn-default" onclick="pie_chart_data()">Submit</button>
                    <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                </div>
            </div>
        </div>

        <?php /* for user modal of dashboard scheduler chart */ ?>
        <div id="md_full_user_scheduler_1" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-header">
                <button type="button" id ="dismiss_scheduler" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title"><?php echo $ui_string['user_list']; ?></h4>
            </div>
            <div class="modal-body">
                <div id="orderproduct">
                    <form id="form_user_scheduler"  method="post" action="" enctype="multipart/form-data">
                        <div id="user_table_scheduler">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="">
                                         <input type="hidden" name="template_id" id="template_id">
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Checkbox</th>
                                                        <th>user</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
 <?php
$getUsers = select_mongo('user', array('$and' => array(array("user_type" => array('$ne' => 'super admin')), array("user_type" => array('$ne' => 'license manager'))), 'status' => array('$ne' => '10')), array('name', 'email', 'status'));
$getUsers = add_id($getUsers);
                                                    if (isset($getUsers) && (!empty($getUsers))) {
                                                        foreach ($getUsers as $value) {
                                                            ?>
                                                            <tr>
                                                                <td><input type="checkbox" onclick="check_box_user_template(this.id)" name="checked_userid_template[]" id="<?php echo $value['id'] ?>" class="sel_checkbox_template" value="<?php echo $value['id'] ?>" <?php
                                                                    if (isset($user_checked_scheduler) && !empty($user_checked_scheduler)) {
                                                                        if (in_array($value['id'], $user_checked_scheduler)) {
                                                                            echo "checked";
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                    ?>></td>
                                                                <td><?php echo $value['name'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan='2'>Sorry no records found</td>
                                                        </tr>

                                                    <?php }
                                                    ?>
                                                </tbody></table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="custom_button btn_cu btn btn-default" onclick="template_popup_data()">Submit</button>
                    <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                </div>
            </div>
        </div>
        <?php /* for calendar modal of dashboard donutt chart */ ?>
  <?php echo delete_confirmation_popup(); ?> 
  <?php get_admin_left_sidebar($language); ?>

