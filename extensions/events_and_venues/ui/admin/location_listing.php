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
                                      $box1=array('name'=>'Add State','icon'=>'glyphicon glyphicon-user','attr'=>'data-toggle="modal" data-target="#amenitiesPopup"',"class"=>"custom_button btn_cu btn btn-default");
                                      array_push($condition,$box1);
                                      include_admin_template_params("resources","box",$condition); 
                                  ?>

      						</div>
					     </div>
                
           <section class="panel top-gap">
    					<header class="panel-heading">
        					<div class="row">
        						<div class="col-md-4 margn_tp_7">
        								<h3><strong>State</strong> List</h3>
        						</div>
        						<div class="col-md-8">
          							<div class="text-right select_all tooltip-area btn-grp">
              		              
                  								 <button type="button" onclick="resetSearch()" data-toggle="tooltip" data-placement="top" title="Refresh" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></button>
            	          </div> 
        						</div>
        					</div>
    					</header>
					
    						<div class="panel-body panel_bg_d">
    							<div class="table-responsive">
                                <?php 
                                    
                                  $column_head=array('Title','Image','Action');  
                                  $show_fields=array('title','user_avatar','action');
                                	$All_data=array("head"=>$column_head);
                                	$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_ui_url()."/events_and_venues/ui/admin/ajax/datatable_ajax_location.php"); 
                                    
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
            <button type="button" class="close closestate" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">State</h4>
    </div>
    <div class="modal-body new_panel">
        <input type="hidden" name="bannersToUpload" id="bannersToUpload" value='0' />
          <form id="locationSubmit" class="form-horizontal" method="post" enctype="multipart/form-data">
         <div class="form-group ">
              <label class="control-label remove_bg col-md-2">Title *</label>
              <div class="col-md-10">
                 <input type="text" id="name" name="title" data-check-valid="blank" data-error-show-in="eTitles" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field locationSubmit" value="" placeholder="">
                 <input type="hidden" id="id" name="id" value="0">
                   <span id="eTitles" class="error"></span>
                </div>
          </div>
           <div class="form-group">
               <label class="control-label remove_bg col-md-2">Image</label>
               <div class="col-md-10">
                  <!-- hidden id of crop -->
                  <input type="hidden" id="hiddenCropData" name="hiddenCropData"> 
                  <input type="hidden" id="hiddenCropType" name="hiddenCropType">
                  <!-- hidden id of crop -->
                  <input type="file" style="display:none;" name="product_image" id="product_image" data-width="800" data-height="600" class="form-control cropimage" />
                  <span class="" onclick="$('#product_image').click();" id="showimage1" >
                  <img id="blah"  class="Cropthumbnail"  style="width:100px;height:100px;" src="<?php echo admin_assets_url();?>img/addg.png"/> 
                  </span> 
               </div>
            </div>
            <span id="eshowimage1" class="error crop_error"></span>
       <div style="clear:both;"></div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-default"  onclick="return validation('locationSubmit');">Submit</button>
    </div></form>
  </div>
</div>

<div class="modal fade in" id="cityaddPopup" role="dialog" data-backdrop="static" data-width="900" data-keyboard="false">
    <div class="modal-header">
            <button type="button" class="close closecity" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Location</h4>
    </div>
    <div class="modal-body new_panel">
          <form id="cityaddPopupSubmit" class="form-horizontal" method="post" enctype="multipart/form-data">
         <div class="form-group ">
              <label class="control-label remove_bg col-md-2">Title *</label>
              <div class="col-md-10">
                 <input type="text" id="cityname" name="title" data-check-valid="blank" data-error-show-in="eTitle" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field cityaddPopupSubmit" value="" placeholder="">
                 <input type="hidden" id="cityid" name="id" value="0">
                 <input type="hidden" id="stateId" name="stateId">
                   <span id="eTitle" class="error"></span>
                </div>
          </div>
       <div style="clear:both;"></div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-default"  onclick="return validation('cityaddPopupSubmit');">Submit</button>
    </div></form>
</div>
      <div id="append_city_data"> 
      </div>
                 <?php //echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
	</div>


<script type="text/javascript" src="<?php echo extensions_ui_url(); ?>/events_and_venues/ui/admin/js/location.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

 <?php get_admin_footer(); ?> 
