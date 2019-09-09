<?php include_once("../../../global.php");
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
                                     /* $condition=array();
                                      $box1=array('name'=>'Add Amenities','icon'=>'glyphicon glyphicon-user','attr'=>'data-toggle="modal" data-target="#amenitiesPopup"',"class"=>"custom_button btn_cu btn btn-default");
                                      array_push($condition,$box1);
                                      include_admin_template_params("resources","box",$condition); 
                                      */
                                  ?>
      						</div>
					     </div>
           <section class="panel top-gap">
    					<header class="panel-heading">
        					<div class="row">
        						<div class="col-md-4 margn_tp_7">
        								<h3><strong>Partner With BK</strong> List</h3>
        						</div>
        						<div class="col-md-8">
          							<div class="text-right select_all tooltip-area btn-grp">
              		              
                  								 <button type="button" onclick="get_dataajax_data_partner()" data-toggle="tooltip" data-placement="top" title="Refresh" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></button>
            	          </div> 
        						</div>
        					</div>
    					</header>
					
    						<div class="panel-body panel_bg_d">
    							<div class="table-responsive">
                                <?php 
                                    //$column_head=array($ui_string['checkbox'],$ui_string['name'],$ui_string['email'],$ui_string['profile'],$ui_string['area'],$ui_string['manager'],$ui_string['profile_image'],$ui_string['status'],$ui_string['action']);  
                                  $column_head=array('Type Of Hotel','Contact Name','Contact No.','Description','Locaiton','Email','Action');  
                                  $show_fields=array('venuetype','name','mobile','message','location','email','action');
                                	$All_data=array("head"=>$column_head);
                                	$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_url()."events_and_venues/ui/admin/cms/ajax/datatable_ajax_partner.php");
                                    
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

       
                 <?php //echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
	</div>
<script type="text/javascript" src="<?php echo extensions_url(); ?>events_and_venues/ui/admin/cms/js/cms.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

 <?php get_admin_footer(); ?> 
