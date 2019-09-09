<div id="main" class="dashboard">
  <?php get_breadcrumb(); ?>
  <div id="content">
    
   
      <section class="panel">
  <header class="panel-heading">
  <div class="row"> 
         <div class="col-md-6">  <h3 class="title">All Product Categories</h3></div>
         <?php if(check_user_permission("product","product1","all")==1  || check_user_permission("product","product1","add_category")==1){?>
          <div class="col-md-6"><div class="pull-right title2"><a href="<?php echo site_url(); ?>admin/product_categories/manage_category"><button type="button" class="btn btn-theme-inverse"><i class="fa fa-plus-circle"></i> Add Category</button></a></div></div>
         </div>
         <?php } ?>
      </header>
 
        <div class="panel-body">
          <div class="table-responsive">
            <?php 
            $parentId='0';
             $_GET['p']=isset($_GET['p'])?$_GET['p']:'';
            if($_GET['p']){$parentId=base64_decode($_GET['p']);}
            $productCategories=get_product_category(array('parentId'=>$parentId)); 
            
            ?>

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable" data-provide="data-table" id="productCategoryTable">
              <thead>
                <tr>
                <!--<th><input type="checkbox" name="optionsRadios" id="optionsRadios3" value="option3" ></th>-->
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody align="center">
                <?php  
		$c = 1;
		if(isset($_GET['c']))
		{
			$c = $_GET['c'] +1;
		}
		$displaynone = '';
		if($c == 3)
		{
			$displaynone = 'style="display:none"';
		}
		foreach($productCategories['data'] as $categories){ ?>
                <tr class="odd gradeX" id="tr_<?php echo $categories['id']; ?>">
                  <!--<td><input type="checkbox" name="optionsRadios" id="optionsRadios3" value="option3" ></td>-->
                  <td><?php echo $categories['no']; ?></td>
                  <td ><?php echo $categories['title']; ?></td>
                  <td style="width:15%">
                    <span class="tooltip-area">
                    <?php if(check_user_permission("product","product1","all")==1  || check_user_permission("product","product1","add_category")==1){ ?>
                    <a href="<?php echo site_url();?>admin/product_categories/manage_category?i=<?php echo base64_encode($categories['id']) ?><?php if($_GET['p']){ echo "&p=".$_GET['p']; } ?>" data-original-title="Edit" class="btn btn-default btn-sm" title=""><i class="fa fa-pencil"></i></a>&nbsp;
                    <a data-original-title="Delete" onclick="delete_category_temp('<?php echo $categories['id']; ?>');" class="btn btn-default btn-sm" title="Delete"><i class="fa fa-trash-o"></i></a>&nbsp;
                    <?php if(INVENTORY_MODULE =='1') {?>
                    <a <?php echo $displaynone;?> href="<?php echo site_url();?>admin/product_categories/manage_category?p=<?php echo base64_encode($categories['id']) ?>" data-original-title="Add Sub Category" class="btn btn-default btn-sm" title=""><i class="fa fa-plus-square"></i></a>
                    <?php } }?>
                    <?php if(check_user_permission("product","product1","all")==1  || check_user_permission("product","product1","view_category")==1){ 
                          if(INVENTORY_MODULE =='1') {?>
                    <a <?php echo $displaynone;?> href="<?php echo site_url();?>admin/product_categories?p=<?php echo base64_encode($categories['id']) ?>&c=<?php echo $c;?>" data-original-title="View Sub Category" class="btn btn-default btn-sm" title=""><i class="fa fa-list"></i></a>
                    <?php } } ?>

                  </span>
                    
                  </td>
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
  
    <!-- //content > row--> 
  </div>
  <!-- //content--> 
</div>

<!-- //main-->
<?php echo success_fail_message_popup();?> 
<?php echo delete_confirmation_popup();?> 
