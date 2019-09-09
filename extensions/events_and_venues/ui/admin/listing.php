<?php 
is_user_logged_in();
get_admin_header();
get_admin_header_menu($language); 
get_admin_left_sidebar($language); 

?> 
<div id="main">
<script>
var site_url="<?php echo site_url(); ?>";
var media_url = "<?php echo media_url(); ?>";
var extensions_ui_url= site_url+'/extensions/events_and_venues/ui/admin/';

function checkalldata() { 
document.getElementById('check11').checked=false;
         var ccc=document.getElementsByName("numbers[]");
         var chkChecked=[];
         var chkNew=[];
         for(i=0;i<ccc.length;i++)
            {
                chkChecked.push(ccc[i].id);
            }
            
         setTimeout(function(){ 
            
            for(i=0;i<ccc.length;i++)
            {
                if(allCheckedArray.inArray(ccc[i].id)){ccc[i].checked=true;
                   chkNew.push(ccc[i].id);}
            }
            
            if(ccc.length==chkNew.length){
                document.getElementById('check11').checked=true;
            }
         },5);
}
</script>
			<div id="content">
				<div class="row">
                <div class="button_holder">
      						<div class="popover-area-hover align-lg-right">
      							<?php 
                                      $condition=array();
                                      $box1=array('name'=>'Add Hotel','icon'=>'glyphicon glyphicon-user','attr'=>'href="hotel/manage_venue"',"class"=>"custom_button btn_cu btn btn-default");
                                      array_push($condition,$box1);

                                      $box2=array('name'=>'Add Event','icon'=>'glyphicon glyphicon-user','attr'=>'href="events_venues?action=manage_event"',"class"=>"custom_button btn_cu btn btn-default");
                                     // array_push($condition,$box2);
                                      include_admin_template_params("resources","box",$condition); 
                                  ?>

      						</div>
					     </div>
                
           <section class="panel top-gap">
    					<header class="panel-heading">
        					<div class="row">
        						<div class="col-md-8 margn_tp_7">
        								<h3><strong>Hotel</strong> List</h3>
        						</div>
        						<div class="col-md-4">
          							<div class="text-right select_all tooltip-area btn-grp">
                        <div class="input-group">
                                            <!-- <select class="form-control" onchange="get_dataajax_data('type='+this.value,'data_table_1')">
                                      <option value=0>All</option>
                                      <option value="event">Events</option>
                                      <option value="venue">Venues</option>
                                  </select>-->
                                            <div class="input-group-btn">
                                               <button type="button" onclick="resetSearch()" data-toggle="tooltip" data-placement="top" title="Refresh" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></button>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                 
                		              
                                  <span class="checkbox slect_aal_btn" data-color="red" style="display:none">
                									   <input  type="checkbox" id="check11" onclick="checkall();" class="all_check" />
                										<a href="javascript:;"><strong><label for="check11" style="font-size:14px; font-weight:600; color:#AAA;"><?php echo $ui_string['select_all'];?></label></strong></a>
                								  </span>
                  								 <!--<button type="button" onclick="delete_data_temp()" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                  								 <button onclick="export_users()" type="button" data-toggle="tooltip" data-placement="top" title="Export" class="btn btn-default"> <i class="glyphicon glyphicon-export"></i></button> -->
                  								 
            	          </div> 
        						</div>
        					</div>
    					</header>
					
    						<div class="panel-body panel_bg_d">
    							<div class="table-responsive">
                                <?php 
                                    //$column_head=array($ui_string['checkbox'],$ui_string['name'],$ui_string['email'],$ui_string['profile'],$ui_string['area'],$ui_string['manager'],$ui_string['profile_image'],$ui_string['status'],$ui_string['action']);  
                                  $column_head=array('Title','Category','Type','Address','Image','Status','Action');  
                                  $show_fields=array('title','category','type','address','user_avatar','status','action');
                                	$All_data=array("head"=>$column_head);
                                	$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_ui_url()."/events_and_venues/ui/admin/ajax/datatable_ajax.php"); 
                                    
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
                 <?php echo success_fail_message_popup();?> 
        
                 <?php echo delete_confirmation_popup(); ?> 
	</div>


<script type="text/javascript" src="<?php echo extensions_ui_url(); ?>/events_and_venues/ui/admin/js/event_venue.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

 <?php get_admin_footer(); ?> 
