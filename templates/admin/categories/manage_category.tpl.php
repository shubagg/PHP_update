<div id="main">
  <?php get_breadcrumb(); ?>
  <?php 
  $_GET['i']=isset($_GET['i'])?$_GET['i']:'';
  $_GET['p']=isset($_GET['p'])?$_GET['p']:'';
  if($_GET['i'])
  {
    $id=base64_decode($_GET['i']);
    $parentId=0;
    if($_GET['p']){$parentId=base64_decode($_GET['p']);}
    $productCategory=get_product_category(array('parentId'=>$parentId,'id'=>$id));
    $productData=$productCategory['data'][0];
  }
  ?>
  <div id="content" >
   
    <section class="panel">
     <header class="panel-heading">
      <h3 class="title"><strong>Product Category Basic Info</strong></h3>
     
     </header>
      <div class="panel-body" >
        <form id="manageCategory" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <?php $csrf = new CSRF_Protect(); $csrf->echoInputField();?>
          <input type="hidden" name="id" <?php  if($_GET['i']){ ?> value='<?php echo base64_decode($_GET['i']); ?>' <?php }else{ ?>value='0'<?php } ?>>
          <input type="hidden" name="parentId" <?php  if($_GET['p']){ ?> value='<?php echo base64_decode($_GET['p']); ?>' <?php }else{ ?>value='0'<?php } ?>>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label for="inputOne" class="biglable">English </label>
            </div>
            
              <div class="form-group">
                <label for="category_title">CATEGORY NAME </label><em>*</em>
                <input type="text" value="<?php echo isset($productData['title'])?$productData['title']:''; ?>" class="form-control required_field manageCategory" data-check-valid="blank" data-error-show-in="etitle" data-error-text="Please enter title" id="title" name="title">
                <span id="etitle" style="color:red"></span> </div>
            
              <div class="form-group">
                <label for="description">DESCRIPTION </label><em>*</em>
                <textarea class="form-control required_field manageCategory" data-check-valid="blank" data-error-show-in="edescription" data-error-text="Please enter description" name="description" id="description" rows="3"> <?php echo isset($productData['description'])?$productData['description']:''; ?></textarea>
                <span id="edescription" style="color:red"></span> </div>
            
            
              <div class="form-group text-right">
                <button  type="button"  onclick="return validation('manageCategory')" class="btn btn-theme-inverse"> Submit </button>
                <button type="reset" class="btn btn-inverse" onclick="location.href=site_url+'admin/product_categories';">Cancel</button>
              </div>
            
          </div>
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padleft">
           
          </div>
        </form>
      </div>
    </section>
  </div>
  
</div>

<?php //echo success_fail_message_popup();?> 
<?php //echo delete_confirmation_popup();?> 
</div>