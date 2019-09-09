<div id="main" class="dashboard">
  <?php 

  $advanced_search = $this->get_advance_search(); 
  if($advanced_search){
    ?>
    <span class="top-advance-search"><button class="btn btn-default adv_srch" style="background: transparent; border: none;" ><?php echo $ui_string['advance_search'];?> <i class="fa fa-plus-circle" aria-hidden="true"></i></button></span>
    <?php 
    include_once(include_admin_template("common_templates/master","advanced_search"));  
  }                  
  ?><ol class="breadcrumb">
    <li><?php echo $ui_string['admin']?></li><li><?php echo $ui_string['schedule'];?></li></ol>
    <div id="content">
      <div class="row">
        <section class="panel" style="">
        <div class="panel-heading panel-updated"><h3><?php echo $ui_string['schedule'];?></h3> </div>           
          <div class="panel-body">
            <?php 
            $listing_data = $this->customise_listing_data();
            if(isset($listing_data['status']) && $listing_data['status']=='true')
            {
             include_once(include_admin_template("common_templates/master","listing1")); 
           }
           ?>
         </div>
       </section>
     </div>
   </div>
 </div>

            <div id="md-full-width1" class="modal fade" data-backdrop="static" data-keyboard="false">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                  <h4 class="modal-title"><?php echo $ui_string['schedulename'];?></h4>
              </div>
              <div class="modal-body">
              <div id="orderproduct">
                <form id="createschedule"  method="post" action="" enctype="multipart/form-data">
                <div id="scheduletable">
                  
                </div>
    
                </form>

              </div>
              <div class="modal-footer">
                <button type="button"  class="custom_button btn_cu btn btn-default" onclick="return validation('createschedule')">Submit</button>
                <button type="button"  class="custom_button btn_cu btn btn-default" data-dismiss="modal"
                aria-hidden="true">Cancel</button>
              </div>
            </div>
          </div>