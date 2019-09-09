<?php 
is_user_logged_in();
get_admin_header();
get_admin_header_menu($language); 
get_admin_left_sidebar($language); 

?> 
<div id="main">
    <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<script>
var site_url="<?php echo site_url(); ?>";
var media_url = "<?php echo media_url(); ?>";
var defaultimage=site_url+"/assets/admin/img/addg.png";
var extensions_ui_url= site_url+'/extensions/events_and_venues/ui/admin/';

var counter=1;
function checkalldata() { }
</script>
      <div id="content">
        <div class="row">
                <div class="button_holder">
                  <div class="popover-area-hover align-lg-right">
                    <?php 
										  $condition=array();
										
										  $box2=array('name'=>'Manage Hotel Tax','icon'=>'glyphicon glyphicon-user','attr'=>'data-toggle="modal" data-target="#warehousevenuePopup" onclick="$(\'#venueproductIds\').removeAttr(\'disabled\');"',"class"=>"custom_button btn_cu btn btn-default");
										  array_push($condition,$box2);
										
										include_admin_template_params("resources","box",$condition); 
                                  ?>

                  </div>
               </div>
                
           <section class="panel top-gap">
              <header class="panel-heading">
                  <div class="row">
                    <div class="col-md-4 margn_tp_7"><h3><strong>Tax Hotel</strong> List</h3>
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
                                  $column_head=array('Hotel','Action');  
                                  $show_fields=array('hotelName','action');
                                  $All_data=array("head"=>$column_head);
                                  $table_data=array("table_id"=>"data_table_2","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_ui_url()."/events_and_venues/ui/admin/ajax/datatable_ajaxtax.php"); 
                                    
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


<div class="modal fade in" id="warehousevenuePopup" role="dialog" data-backdrop="static" data-width="900" data-keyboard="false">
    <div class="modal-header">
            <button type="button" class="close warehousevenue" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tax Rate</h4>
    </div>
    <div class="modal-body new_panel">
          <form id="taxvenueSubmit" method="post" enctype="multipart/form-data">
         
         <div class="form-group ">
              <label class="control-label remove_bg">Hotel *</label>
              <div class="">
                <?php 
					$get_user = curl_post("/get_hotel_user",array('id'=>$_SESSION['user']['user_id']));
					//print_r($get_user);
					
                 ?>
                      <select  class="form-control required_field taxvenueSubmit" id="venueproductIds" name="hotelUserId" data-check-valid="blank" data-error-show-in="eoptionserror" data-error-setting="2" data-error-text="Please select Event">
                            <option value="">Select Hotel</option>
                <?php    foreach ($get_user['data'] as $provalue) { ?>
                            <option value="<?php echo $provalue['id']; ?>"><?php echo $provalue['name']; ?></option>  
                <?php }
                ?>
				
				
				
                     </select>
                 <input type="hidden" id="venueid" name="id" value="0">
                 <input type="hidden" id="typevenue" name="type" value="venue">
                   <span id="eoptionserror" class="error"></span>
                </div>
          </div>
        
        
        <div class="form-group ">
        <div class="">
		<button style="display: none;" onclick="addtablerow('2','');" class="btn btn-theme-inverse pull-right" type="button">(+) Price</button>
		<div class="clearfix"></div>
              <table class="table">
              <tr>
                <th>Min Range</th>
				<th>Max Range</th>
                <th>Tax Rate</th> 
                
              </tr>
              <tbody id="appendPrice2">
              <tr>
                  <td><input type="text" name="minRange[]" value=""  id="minraange1title" data-check-valid="blank" data-error-show-in="minRange1error" data-error-setting="2" data-error-text="Please enter min range" class="form-control required_field taxvenueSubmit"><span id="minRange1error" class="error"></span></td>
				  
				  <td><input type="text" name="maxRange[]" value=""  id="maxraange1title" data-check-valid="blank" data-error-show-in="maxRange1error" data-error-setting="2" data-error-text="Please enter max range" class="form-control required_field taxvenueSubmit"><span id="maxRange1error" class="error"></span></td>
				  
                  <td><input type="text" name="taxRate[]" id="t1rate" data-check-valid="blank,numeric" data-error-show-in="tax1error" data-error-setting="2" data-valid-numeric-error="Please enter only numeric value" data-error-text="Please enter tax rate" class="form-control required_field taxvenueSubmit"><span id="tax1error" class="error"></span></td>
				  
                  
              </tr>
			  
			  <tr>
                  <td><input type="text" name="minRange[]" value=""  id="minraange2title" data-check-valid="blank" data-error-show-in="minRange2error" data-error-setting="2" data-error-text="Please enter min range" class="form-control required_field taxvenueSubmit"><span id="minRange2error" class="error"></span></td>
				  
				  <td><input type="text" name="maxRange[]" value=""  id="maxraange2title" data-check-valid="blank" data-error-show-in="maxRange2error" data-error-setting="2" data-error-text="Please enter max range" class="form-control required_field taxvenueSubmit"><span id="maxRange2error" class="error"></span></td>
				  
                  <td><input type="text" name="taxRate[]" id="t2rate" data-check-valid="blank,numeric" data-error-show-in="tax2error" data-error-setting="2" data-valid-numeric-error="Please enter only numeric value" data-error-text="Please enter tax rate" class="form-control required_field taxvenueSubmit"><span id="tax2error" class="error"></span></td>
				  
                  
              </tr>
			  
			  
			  
			  <tr>
                  <td><input type="text" name="minRange[]" value=""  id="minraange3title" data-check-valid="blank" data-error-show-in="minRange3error" data-error-setting="2" data-error-text="Please enter min range" class="form-control required_field taxvenueSubmit"><span id="minRange3error" class="error"></span></td>
				  
				  <td><input type="text" name="maxRange[]" value=""  id="maxraange3title" data-check-valid="blank" data-error-show-in="maxRange3error" data-error-setting="2" data-error-text="Please enter max range" class="form-control required_field taxvenueSubmit"><span id="maxRange3error" class="error"></span></td>
				  
                  <td><input type="text" name="taxRate[]" id="t3rate" data-check-valid="blank,numeric" data-error-show-in="tax3error" data-error-setting="2" data-valid-numeric-error="Please enter only numeric value" data-error-text="Please enter tax rate" class="form-control required_field taxvenueSubmit"><span id="tax3error" class="error"></span></td>
				  
                  
              </tr>
			  
			  <tr>
                  <td><input type="text" name="minRange[]" value=""  id="minraange4title" data-check-valid="blank" data-error-show-in="minRange4error" data-error-setting="2" data-error-text="Please enter min range" class="form-control required_field taxvenueSubmit"><span id="minRange4error" class="error"></span></td>
				  
				  <td><input type="text" name="maxRange[]" value=""  id="maxraange4title" data-check-valid="blank" data-error-show-in="maxRange4error" data-error-setting="2" data-error-text="Please enter max range" class="form-control required_field taxvenueSubmit"><span id="maxRange4error" class="error"></span></td>
				  
                  <td><input type="text" name="taxRate[]" id="t4rate" data-check-valid="blank,numeric" data-error-show-in="tax4error" data-error-setting="2" data-valid-numeric-error="Please enter only numeric value" data-error-text="Please enter tax rate" class="form-control required_field taxvenueSubmit"><span id="tax4error" class="error"></span></td>
				  
                  
              </tr>
        
              </tbody>
              </table>
        </div></div>
       
    </div>
    
    <div class="modal-footer">
            <button type="button" class="btn btn-default"  onclick="return validation('taxvenueSubmit');">Submit</button>
    </div>
    </form>
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
<script type="text/javascript" src="<?php echo extensions_ui_url(); ?>/events_and_venues/ui/admin/js/warehouse.js"></script>
<script type="text/javascript" src="<?php echo assets_url(); ?>js/checkbox_multiple_datatable.js"></script>

 <?php get_admin_footer(); ?> 
<script type="text/javascript">
            $(function () {

              $("#datetimepicker5").datetimepicker({
                  autoclose: true
                  });

                $("#datetimepicker6").datetimepicker({
                  autoclose: true
                  });
            });
</script>