<?php 
is_user_logged_in();
get_admin_header();
get_admin_header_menu($language); 
get_admin_left_sidebar($language); 
get_crop_popup(array("id"=>'1'));
?> 
<div id="main">
<script>
var site_url="<?php echo site_url(); ?>";
var media_url = "<?php echo media_url(); ?>";
var defaultimage=site_url+"/assets/admin/img/addg.png";
var extensions_ui_url= site_url+'/extensions/events_and_venues/ui/admin/';

function checkalldata() {}
</script>
			<div id="content">
				<div class="row">
                <div class="button_holder">
      						<div class="popover-area-hover align-lg-right">
      							<?php 
                                      $condition=array();
                                      $box1=array('name'=>'Add Category','icon'=>'glyphicon glyphicon-user','attr'=>'data-toggle="modal" data-target="#amenitiesPopup"',"class"=>"custom_button btn_cu btn btn-default");
                                      array_push($condition,$box1);
                                      include_admin_template_params("resources","box",$condition); 
                                  ?>

      						</div>
					     </div>
                
           <section class="panel top-gap">
    					<header class="panel-heading">
        					<div class="row">
        						<div class="col-md-4 margn_tp_7">
        								<h3><strong>Category</strong> List</h3>
        						</div>
        						<div class="col-md-8">
          							<div class="text-right select_all tooltip-area btn-grp">
              		              <!--<span class="checkbox slect_aal_btn" data-color="red" >
              									   <input type="checkbox" id="check11" onclick="checkall();" class="all_check" />
              										<a href="javascript:;"><strong><label for="check11" style="font-size:14px; font-weight:600; color:#AAA;"><?php echo $ui_string['select_all'];?></label></strong></a>
              								  </span>
                  								 <button type="button" onclick="delete_data_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                  								 <button onclick="export_users()" type="button" data-toggle="tooltip" data-placement="top" title="Export" class="btn btn-default"> <i class="glyphicon glyphicon-export"></i></button>
                  								 -->
                  								 <button type="button" onclick="resetSearch()" data-toggle="tooltip" data-placement="top" title="Refresh" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></button>
            	          </div> 
        						</div>
        					</div>
    					</header>
					
    						<div class="panel-body panel_bg_d">
    							<div class="table-responsive">
                                <?php 
                                    //$column_head=array($ui_string['checkbox'],$ui_string['name'],$ui_string['email'],$ui_string['profile'],$ui_string['area'],$ui_string['manager'],$ui_string['profile_image'],$ui_string['status'],$ui_string['action']);  
                                  $column_head=array('Title','Image','Action');  
                                  $show_fields=array('title','user_avatar','action');
                                	$All_data=array("head"=>$column_head);
                                	$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_ui_url()."/events_and_venues/ui/admin/ajax/datatable_ajax_attributes.php?groupId=587f04eca32974a8103c9869"); 
                                    
                               ?>    
    							</div>
    						</div>
					</section>
                  <div>
          
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


<div class="modal fade in" id="amenitiesPopup" role="dialog" data-backdrop="static" data-width="900" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Category</h4>
    </div>
    <div class="modal-body new_panel">
        <input type="hidden" name="bannersToUpload" id="bannersToUpload" value='0' />
          <form id="categorySubmit" class="form-horizontal" method="post" enctype="multipart/form-data">
         <div class="form-group ">
              <label class="control-label remove_bg col-md-2">Title *</label>
              <div class="col-md-10">
                 <input type="text" id="name" name="title" data-check-valid="blank" data-error-show-in="eTitle" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field categorySubmit" value="" placeholder="">
                 <input type="hidden"  id="id" name="id" value="0">
                   <span id="eTitle" class="error"></span>
                </div>
          </div>
       
        <div class="form-group ">
              <label class="control-label remove_bg col-md-2">Description *</label>
              <div class="col-md-10">
                <textarea id="desc" name="description" data-check-valid="blank" data-error-show-in="eDescription" data-error-setting="2" data-error-text="Please enter description" class="form-control required_field categorySubmit" value="" placeholder=""> </textarea>
                   <span id="eDescription" class="error"></span>
                </div>
        </div>
        <div class="form-group">
               <?php  
                  // $getImage=get_association_data('16','10','1',$product['id']);
                  //$logo=$getImage['media'][1][$product['id']][0]['mediaName'];
                  ?>
               <label class="control-label remove_bg col-md-2">Image *</label>
               <div class="col-md-10">
                  <!-- hidden id of crop -->
                  <input type="hidden" id="hiddenCropData" name="hiddenCropData"> 
                  <input type="hidden" id="hiddenCropType" name="hiddenCropType">
                  <!-- hidden id of crop -->
                  <input type="file" style="display:none;" name="product_image" id="product_image" data-width="800" data-height="600" class="form-control cropimage" />
                  <span class="" onclick="$('#product_image').click();" id="showimage1" >
                  <?php if($logo){ ?>  
                  <img id="blah"   class="Cropthumbnail" style="width:100px;height:100px;" src="<?php echo media_url()."images/".$logo; ?>"/> 

                  <?php }else{ ?> 
                  <img id="blah"  class="Cropthumbnail"  style="width:100px;height:100px;" src="<?php echo admin_assets_url();?>img/addg.png"/> 
                  
                  <?php } ?>
                  </span> 
               </div>
            </div>
            <span id="eshowimage1" class="error crop_error"></span>
       <div style="clear:both;"></div>
       <div style="clear:both;"></div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-default"  onclick="return validation('categorySubmit');">Submit</button>
    </div>
  </div>
</div>
       
                 <?php //echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
	</div>


<script type="text/javascript" src="<?php echo extensions_ui_url(); ?>/events_and_venues/ui/admin/js/category.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

 <?php get_admin_footer(); ?> 
