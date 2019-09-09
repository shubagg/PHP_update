<div id="main">
  <?php get_breadcrumb(); ?>
  <div id="content">
    <div class="row"> 
      
      <section class="box">
             <h2 class="title">Add cms</h2>
 </section>
      <section class="panel">
        <div class="panel-body">
          <div class="table-responsive">
            <h2>About us</h2>
            <input type="text" size="52" style="margin-top:20px; margin-bottom:20px;" />
           <p> <h3>description</h3>
            <textarea rows="5" cols="50" style="margin-top:20px;">
            </textarea></p>
            <p><button type="submit" style="height:30px;width:80px; margin:20px 0 0 380px; ">Submit
            </button></p>
          </div>
        </div>
      </section>
      <div id="statuschange" class="modal fade" data-width="300">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"
								aria-hidden="true"> <i class="fa fa-times"></i> </button>
          <h4 class="modal-title"> <i class="glyphicon glyphicon-plus-sign"></i> <?php echo $ui_string['chnage_status'];?> </h4>
        </div>
        <!-- //modal-header-->
        <div class="modal-body center_button ">
          <div class="btn-group-vertical">
            <button type="button" class="btn btn-default"><?php echo $ui_string['active'];?></button>
            <button type="button" class="btn btn-default"><?php echo $ui_string['expire'];?></button>
            <button type="button" class="btn btn-default"><?php echo $ui_string['pospond'];?></button>
            <button type="button" class="btn btn-default"><?php echo $ui_string['deactivate'];?></button>
          </div>
        </div>
        <!-- //modal-body--> 
      </div>
      
      
      <!-- //Role popup ends-->
      
      
    </div>
    <!-- //content > row--> 
  </div>
  <!-- //content--> 
</div>

<?php echo success_fail_message_popup();?>

<?php echo delete_confirmation_popup();?> 
</div>
