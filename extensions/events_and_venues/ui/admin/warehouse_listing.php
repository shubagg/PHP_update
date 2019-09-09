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
                                      
										  $box2=array('name'=>'Manage Hotel Inventory','icon'=>'glyphicon glyphicon-user','attr'=>'data-toggle="modal" data-target="#warehousevenuePopup" onclick="$(\'#venueproductIds\').removeAttr(\'disabled\');"',"class"=>"custom_button btn_cu btn btn-default");
										  array_push($condition,$box2);
									  
                                      
                                      include_admin_template_params("resources","box",$condition); 
                                  ?>

                  </div>
               </div>
                
           <section class="panel top-gap">
              <header class="panel-heading">
                  <div class="row">
                    <div class="col-md-4 margn_tp_7"><h3><strong>Warehouse Hotel</strong> List</h3>
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
                                  $column_head=array('Venue','Date','Inventory','Action');  
                                  $show_fields=array('productid','customField.date','inventory','action');
                                  $All_data=array("head"=>$column_head);
                                  $table_data=array("table_id"=>"data_table_2","table_data"=>$All_data);
                                  get_ajax_datatable($table_data,$show_fields,extensions_ui_url()."/events_and_venues/ui/admin/ajax/datatable_ajaxwarehouse.php?type=venue"); 
                                    
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
            <h4 class="modal-title">Manage Hotel Invnetory</h4>
    </div>
    <div class="modal-body new_panel">
          <form id="warehousevenueSubmit" method="post" enctype="multipart/form-data">
         
         <div class="form-group ">
              <label class="control-label remove_bg">Hotel *</label>
              <div class="">
                <?php 
					$proCondData = array('type'=>'venue');
					$user_type = getUserType($_SESSION['user']['user_id']); //$_SESSION['user']['user_type'];
					if($user_type == 'hotel')
					{
						$proCondData['hotelUserId'] = $_SESSION['user']['user_id'];
					}
					// city id , category
									  
					
					$product=getHotels($proCondData);
                 ?>
                      <select disabled="disabled" class="form-control required_field warehousevenueSubmit" id="venueproductIds" name="productId" data-check-valid="blank" data-error-show-in="eoptionserror" data-error-setting="2" data-error-text="Please select Event">
                            <option value="">Select Hotel</option>
                <?php    foreach ($product['data'] as $provalue) { 
				
						$cityTitle = getCityTitle($provalue['cityId']);
						 $hotelCategory = getHotelCatName($provalue['category']);
						
				?>
                            <option value="<?php echo $provalue['id']; ?>"><?php echo $provalue['title'].' ['.$hotelCategory.'] ['.$cityTitle.']'; ?></option>  
                <?php }
                ?>
                     </select>
                 <input type="hidden" id="venueid" name="id" value="0">
                 <input type="hidden" id="typevenue" name="type" value="venue">
                   <span id="eoptionserror" class="error"></span>
                </div>
          </div>
        <div class="form-group ">
              <label class="control-label remove_bg">Date-Time *</label>
              <div class="">
                 <div class='input-group date' id='datetimepicker6'>
                    <input readonly type='text' id='venuedates' name="customField[date]" data-check-valid="blank" data-error-show-in="eDates" data-error-setting="2" data-error-text="Please enter date-time" class="form-control required_field warehousevenueSubmit" value="" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                   <span id="eDates" class="error"></span>
                </div>
        </div> 
        
        <div class="form-group "><label class="control-label remove_bg">Price *</label>
        <div class=""><button style="display: none;" onclick="addtablerow('2','');" class="btn btn-theme-inverse pull-right" type="button">(+) Price</button><div class="clearfix"></div>
              <table class="table">
              <tr>
                <th>Title</th>
                <th>Price</th> 
                <th style="display: none;">Description</th> 
                <th style="width: 100px;display: none;">Action</th>
              </tr>
              <tbody id="appendPrice2">
              <tr>
                  <td><input type="text" name="Pricetitle[]" value="Single-Bed-Room" readonly="readonly" id="p1title" data-check-valid="blank" data-error-show-in="price1error" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field warehousevenueSubmit"><span id="price1error" class="error"></span></td>
				  
                  <td><input type="text" name="Pricerate[]" id="p1rate" data-check-valid="blank,allow_na_numeric" data-error-show-in="rate1error" data-error-setting="2" data-valid-na-error="Please enter only numeric or N/A value" data-error-text="Please enter price" class="form-control required_field warehousevenueSubmit"><span id="rate1error" class="error"></span></td>
				  
                  <td style="display: none;"><input type="text" name="Pricedesc[]" class="form-control"></td>
                  <td style="display: none;"><input type="file" name="Priceimg[]" id="price0" style="display: none;"><span class="tooltip-area">               
<a data-original-title="Image upload"  class="" title="Image upload" onclick="$('#price0').click();">
                     <img id="blah" class="Cropthumbnail" src="<?php echo site_url(); ?>/ui/admin/blog/css/addg.png" alt="your image" width="30" height="30" style="
    margin-left: 5px;
"></a>
                      &nbsp;</span>
                  </td>
              </tr>
              <tr>
                  <td><input type="text" name="Pricetitle[]" value="Double-Bed-Room" readonly="readonly" id="p2title" data-check-valid="blank" data-error-show-in="price2error" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field warehousevenueSubmit"><span id="price2error" class="error"></span></td>
                  <td><input type="text" name="Pricerate[]" id="p2rate" data-check-valid="blank,allow_na_numeric" data-error-show-in="rate2error" data-error-setting="2" data-valid-na-error="Please enter only numeric or N/A value" data-error-text="Please enter price" class="form-control required_field warehousevenueSubmit"><span id="rate2error" class="error"></span></td>
                  <td style="display: none;"><input type="text" name="Pricedesc[]" class="form-control"></td>
                  <td style="display: none;"><input type="file" name="Priceimg[]" id="price0" style="display: none;"><span class="tooltip-area">               
<a data-original-title="Image upload"  class="" title="Image upload" onclick="$('#price0').click();">
                     <img id="blah" class="Cropthumbnail" src="<?php echo site_url(); ?>/ui/admin/blog/css/addg.png" alt="your image" width="30" height="30" style="
    margin-left: 5px;
"></a>
                      &nbsp;</span>
                  </td>
              </tr>
              <tr>
                  <td><input type="text" name="Pricetitle[]" value="Child" readonly="readonly" id="p3title" data-check-valid="blank" data-error-show-in="price3error" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field warehousevenueSubmit"><span id="price3error" class="error"></span></td>
                  
				  <td><input type="text" name="Pricerate[]" id="p3rate" data-check-valid="blank,allow_na_numeric" data-error-show-in="rate3error" data-error-setting="2" data-valid-na-error="Please enter only numeric or N/A value" data-error-text="Please enter price" class="form-control required_field warehousevenueSubmit"><span id="rate3error" class="error"></span></td>
                  <td style="display: none;"><input type="text" name="Pricedesc[]" class="form-control"></td>
                  <td style="display: none;"><input type="file" name="Priceimg[]" id="price0" style="display: none;"><span class="tooltip-area">               
<a data-original-title="Image upload"  class="" title="Image upload" onclick="$('#price0').click();">
                     <img id="blah" class="Cropthumbnail" src="<?php echo site_url(); ?>/ui/admin/blog/css/addg.png" alt="your image" width="30" height="30" style="
    margin-left: 5px;
"></a>
                      &nbsp;</span>
                  </td>
              </tr>
              <tr>
                  <td><input type="text" name="Pricetitle[]" value="Extra Guest" readonly="readonly" id="p4title" data-check-valid="blank" data-error-show-in="price4error" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field warehousevenueSubmit"><span id="price4error" class="error"></span></td>
                  <td><input type="text" name="Pricerate[]" id="p4rate" data-check-valid="blank,allow_na_numeric" data-error-show-in="rate4error" data-error-setting="2" data-valid-na-error="Please enter only numeric or N/A value" data-error-text="Please enter price" class="form-control required_field warehousevenueSubmit"><span id="rate4error" class="error"></span></td>
                  <td style="display: none;"><input type="text" name="Pricedesc[]" class="form-control"></td>
                  <td style="display: none;"><input type="file" name="Priceimg[]" id="price0" style="display: none;"><span class="tooltip-area">               
<a data-original-title="Image upload"  class="" title="Image upload" onclick="$('#price0').click();">
                     <img id="blah" class="Cropthumbnail" src="<?php echo site_url(); ?>/ui/admin/blog/css/addg.png" alt="your image" width="30" height="30" style="
    margin-left: 5px;
"></a>
                      &nbsp;</span>
                  </td>
              </tr>
              </tbody>
              </table>
			  <em>Please Enter 'N/A' if not available.</em>
        </div></div>
        <div class="form-group ">
              <label class="control-label remove_bg">Inventory *</label>
              <div class="">
                <input type="text" id="venueinventorys" name="inventory" data-check-valid="blank,numeric" data-error-show-in="einventorys" data-error-setting="2" data-valid-numeric-error="Please enter only numeric value" data-error-text="Please enter inventory" class="form-control required_field warehousevenueSubmit" value="" placeholder="">
                   <span id="einventorys" class="error"></span>
                </div>
        </div>
         <div class="form-group ">
              <label class="control-label remove_bg">Description *</label>
              <div class="">
                <textarea id="venuedescs" name="customField[description]" data-check-valid="blank" data-error-show-in="eDescriptions" data-error-setting="2" data-error-text="Please enter description" class="form-control required_field warehousevenueSubmit" value="" placeholder=""> </textarea>
                   <span id="eDescriptions" class="error"></span>
                </div>
        </div>
    </div>
    
    <div class="modal-footer">
            <button type="button" class="btn btn-default"  onclick="return validation('warehousevenueSubmit');">Submit</button>
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