<div id="main" class="dashboard">
<?php 
        
  $advanced_search = false;//$this->get_advance_search(); 
    if($advanced_search){
?>
<span class="top-advance-search"><button class="btn btn-default adv_srch" style="background: transparent; border: none;" ><?php echo $ui_string['advance'].' '.$ui_string['search'];?><i class="fa fa-plus-circle" aria-hidden="true"></i></button></span>
<?php 
  include_once(include_admin_template("common_templates/master","advanced_search"));  
}                  
?><ol class="breadcrumb">
    <li><?php echo $ui_string['dashboard'].' - '.$ui_string['allinvigilator1'];?></li></ol>
    <div id="content">
    <style>
  .sorting_1 img{
    cursor: pointer
}
.show1{
    z-index: 999;
    display: none;
}
.show1 .overlay{
    width: 100%;
    height: 145%;
    background: rgba(0,0,0,.66);
    position: absolute;
    top: 53px;
    left: 0;
}
.show1 .img-show{
    width: 600px;
    height: 400px;
    background: #FFF;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    overflow: hidden
}
.img-show span{
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 99;
    cursor: pointer;
}
.img-show img{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
</style>
        <div class="row">
            <section class="panel" style="">
            <div class="panel-heading panel-updated">
            <h3><?php echo $ui_string['all'];?> Images</h3>       
            </div>
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
            <div class="show1">
              <div class="overlay"></div>
                <div class="img-show">
                  <span>X</span>
                  <img src="">
              </div>
          </div>
        </div>
    </div>
</div>