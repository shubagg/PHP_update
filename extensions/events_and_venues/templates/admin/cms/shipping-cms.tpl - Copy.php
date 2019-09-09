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
            <p><label for="inputOne" class="biglable " dir="rtl" lang="ar" style="font-size:30px">Shipping Info</label></p>
            <input type="text" size="52" style="margin-top:20px; margin-bottom:20px; width:470px; height:30px" />
           <p> <label for="inputOne" class="biglable" dir="rtl" lang="ar">description</label></p>
            <p><textarea rows="6" cols="50" style="margin-top:10px; margin-bottom:20px">
            </textarea></p>
            <p><button type="button" class="hvr-bounce-to-bottom btn " data-toggle="modal" data-target="#add_category">Submit</button></p>
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
