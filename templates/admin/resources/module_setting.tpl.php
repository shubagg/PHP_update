<div id="main">
  <ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Module Settings</a></li>
  </ol>
  <div id="content">
   <!-- <div class="display_block" onclick="window.location='<?php echo admin_ui_url(); ?>product/manage_product_category.php'">
      <div class="custom_button btn btn-default" data-toggle="popover" data-placement="bottom" data-content="" data-original-title="">
        <i class="glyphicon glyphicon-user"></i><br> <span>Add</span>
      </div>
  </div>-->
    <div class="row"> 

      <section class="panel">
      
      <header class="panel-heading">
					<div class="row">
					
						<div class="col-md-4 margn_tp_7">
						<h3><strong>Modules</strong> Settings </h3>
								
						
						</div>

					</div>
					</header>
        <div class="panel-body panel_bg_d">
          <div class="table-responsive">
            <?php 
            $modules=get_all_modules();          
            //print_r($modules); 
          
            ?>

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover" data-provide="data-table" id="productCategoryTable">
              <thead>
                <tr>
                  <!--<th></th>-->
                  <th>Status <input type="checkbox" name="checklist" id="checklist" value=""  onclick="checkall()"></th>
                  <th>Modules Name</th>
                  <th>Module Id</th>
                </tr>
              </thead>
              <tbody align="center">
                <?php  foreach($modules['data'] as $categories){ ?>
                <tr class="odd gradeX" id="tr_<?php echo $categories['id']; ?>">
                  
                  <td><input type="checkbox" onclick="checkBoxChecked(this.id);" class="check_box" name="status" id="<?php echo $categories['mid']; ?>" value="<?php echo $categories['status']; ?>" <?php if($categories['status']){echo 'checked="checked"';} ?>></td>
                  <td><?php echo $categories['title']; ?></td>
                  <td ><?php echo $categories['mid']; ?></td>
    
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
      
      
      <!-- //Role popup ends-->
      
      <div id="error_message" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
        <div class="modal-header">
          <button  type="button" class="close"></button>
          <h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign"></i> <span id="error_head"></span></h4>
        </div>
        <!-- //modal-header-->
        <div class="modal-body text_alignment">
          <div class="button_holder">
            <p><strong id="error_body"></strong></p>
          </div>
        </div>
        <!-- //modal-body--> 
      </div>
    </div>
    <!-- //content > row--> 
  </div>
  <!-- //content--> 
</div>

<!-- //main-->
<?php echo success_fail_message_popup();?> 
<?php echo delete_confirmation_popup();?> 

        <div id="sure_to_delete" class="modal fade" data-backdrop="static" data-keyboard="false" data-width="300" >
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
                    <h4 class="modal-title"> Are you sure?</h4>
                    </div>
                    <!-- //modal-header-->
                    <form class="form-horizontal" data-collabel="2" data-label="color" id="deleteData">
                    <div class="modal-body text-center">
                    
                    <button type="button" data-dismiss="modal" class="btn btn-theme-inverse"> Ok</button>
                    				    
                    				</div>
                    </form>                
				<!-- //modal-body-->
		    </div>
</div>