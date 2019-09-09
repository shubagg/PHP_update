 <div id="main" class="dashboard">
<div id="content">
  
    <!--<div id="mapSearch">
						<form id="geocoding_form">
								<div class="input-group"> 
										<input type="text" class="form-control" id="addressPoint" name="addressPoint">
										<span class="input-group-btn">
												<button class="btn btn-theme" type="submit">SEARCH</button>
										</span>	
										<span class="input-group-btn">
												<button class="btn btn-inverse getLocate" type="button" title="Get current location"><i class="fa fa-crosshairs"></i></button>
										</span>	
								</div>
						</form>
				</div>-->
    <div id="mapSetting1" >
						<button data-toggle="modal" onclick="save_all_data()"; class="btn btn-theme-inverse mapTools pull-right" type="button">
                        Save</button>
						
				</div>
                  <div style="width:100%;margin-top:100px" id="Gmap"></div>
    
    <!-- //mapControl-->
  </div>
  </div>
		<!-- //main-->
 <div id="md-poi" class="modal fade" tabindex="-1" data-width="500">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
      <h4 class="modal-title"><i class="fa fa-bell-o"></i> POI List</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body" style="padding:0">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Creation Date</th>
              <th>Area</th>
              <th>Tolerance</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody align="center">
            <tr>
              <td>1</td>
              <td>22 Sept, 2015</td>
              <td>Jankpuri west</td>
              <td>20 Meters</td>
              <td>Edit</td>
            </tr>
            <tr>
              <td>2</td>
              <td>22 Sept, 2015</td>
              <td>Jankpuri west</td>
              <td>20 Meters</td>
              <td>Edit</td>
            </tr>
            <tr>
              <td>3</td>
              <td>22 Sept, 2015</td>
              <td>Jankpuri west</td>
              <td>20 Meters</td>
              <td>Edit</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- //modal-body-->
  </div>

            
        
        
        <?php 
        /*$field='
        <div class="form-group">
                      <label class="control-label no_padding remove_bg">'.$resourse["select_category"].'<font color="red">*</font></label>
                      <div>
                        <select id="pcategory" class="form-control" name="pcategory">
                            <option value="0">'.$resourse["parent_category"].'</option>
                            '.$dat=get_category_tree($all_cats,0).
                            show_category_accordians($dat,"-",0,1).'
                        </select> 
                      </div>
                    </div>
        ';
        
        $field1='
        
        ';*/
        
       // echo show_popup('add_category1','addCategory1',$resourse['close'],$field);
        
        
        ?>

<!--Vipin Changes Start 14 oct 2016-->
<div class="modal-body" style="padding:0">
      <div class="table-responsive">
        <table class="table" id="dttable1">
          <thead>
            <tr>
              <th>#</th>
              <th>Creation Date</th>
              <th>Area</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody align="center" id="poiDataTable">
            
          </tbody>
        </table>
      </div>
    </div>
<!--Vipin Changes done -->
<div id="add_category" class="modal fade" data-backdrop="static" data-keyboard="false"  data-header-color="#736086" id="close_group">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-times"></i></button>
              <h4 class="modal-title"><span id="cathead"></span></h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
              <form class="form-horizontal" data-collabel="2" data-label="color" id="addCategory">
              
                    <div class="form-group">
                      <label class="control-label no_padding remove_bg"><?php echo $resourse['select_category'];?><font color="red">*</font></label>
                      <div>
                        <select id="pcategory" class="form-control" name="pcategory">
                            <option value="0"><?php echo $resourse['parent_category'];?></option>
                            
                            
                             <?php show_category_accordians($dat,'-',0,1,'');?>
                        </select> 
                      </div>
                    </div>
              
                   
                   	<input type="hidden" name="cat_add" value="cat_add"/>
                   	<input type="hidden" name="cat_id" id="cat_id" value="0"/>
                     
                    	<input type="hidden" name="category_code" value="profile"/>
                    <?php  echo get_data_field('text',$resourse['name'],'categoryname','categoryname','required_field addCategory updateCategory','data-check-valid="blank,no_special" data-valid-nospecial-error="Please enter valid category name" data-error-show-in="ecategoryname" data-error-setting="2" data-error-text="Please enter category name"','','',''); ?>
                   
                   
                  
                   <?php  //echo get_data_field('text',$resourse['code'],'category_code','category_code','required_field addCategory updateCategory','data-check-valid="blank,no_special" data-valid-nospecial-error="Please enter valid category code" data-error-show-in="ecategory_code" data-error-setting="2" data-error-text="Please enter category code"','','','','profile'); ?>
                
        	   
        	   	<button type="button" class="btn btn-inverse btn_width right bottom-gap"  data-dismiss="modal">
        		<i class="glyphicon glyphicon-remove-circle"></i> <?php echo $resourse['close'];?></button>
        		<span id="groupbut"></span>
              </form>
            </div>
            <!-- //modal-body-->
            
            
    </div>
	
        <!--------------------success,fail message popup---------------------------------------->
        
        
                 <?php echo success_fail_message_popup();?> 
                 
                    
        <!------------------------end----------------------------------------------------------->
        
        
        <!--------------------delete_confirmation popup---------------------------------------->
        
        
                 <?php echo delete_confirmation_popup();?> 
                 
                    
        <!------------------------end----------------------------------------------------------->
        
                    
                    
             
            
            <div id="basic_search" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-width="600" >
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="del1"><i class="fa fa-times"></i></button>
						<h3><i class="glyphicon glyphicon-search"></i> Search</h3>
				</div>
				<div class="modal-body text_alignment">
                <span class="searcherrorcat" style="color: red;" class="error"></span>
                       <form id="catsearchform"> 
                        
                        <table>
                       	<?php
                            
                            show_accordian($dat,'',0,1,'user_category',$category_data,$user_id);
                        ?>
                        </table>       
				        
					  <div class="clr"></div>
					  
					
					<button type="button" data-dismiss="modal" class="btn btn-inverse top-gap bottom-gap right left-gap">
					  <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
					  <button onclick="get_category_user()" type="button" class="btn btn-theme-inverse top-gap bottom-gap right" >
					  <i class="glyphicon glyphicon-search"></i> Search</button> 		
					 </form> 
				</div>
		  </div>
          
          
          <div id="Device-sim" class="modal fade" data-width="300">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<i class="glyphicon glyphicon-plus-sign"></i>Assign Driver
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
							<div class="form-group">
							 <label class="control-label">Driver List</label>
                  <select  class="selectpicker form-control">
                        <option value="Australia">Ramesh</option>
                        <option value="China">Suresh</option>
                        <option value="Japan">Mukesh</option>
                        <option value="Thailand">Mahesh</option>
                       
                     </select>
							</div>
							<div class="form-group">
							 <label class="control-label">Vehicle Type List</label>
                  <select  class="selectpicker form-control">
                        <option value="Australia">Bus</option>
                        <option value="China">Truck</option>
                        <option value="Japan">Car</option>
                        <option value="Thailand">Bike</option>
                       
                     </select>
							</div>
							
							
							
						</div>
						<div class="modal-footer">				
						
						<button type="submit" class="btn btn-theme">Save</button>
						</div>
						<!-- //modal-body-->
					</div>
                    
                    <div id="geo_fn" class="modal fade" data-width="300">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">
								<i class="fa fa-times"></i>
							</button>
							<h4 class="modal-title">
								<i class="glyphicon glyphicon-plus-sign"></i>Add POI
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
							
                            <div class="form-group">
                            <label class="control-label">Area</label>
                            <div class="row">
                            <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Latitude">
							</div>
                            <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Longitude">
							</div>
                            </div>
                            </div>
                            
							<div class="form-group">
							 <label class="control-label">Radius</label>
                  <input type="text" class="form-control">
							</div>
							
							
							
						</div>
						<div class="modal-footer">				
						
						<button type="submit" class="btn btn-theme">Save</button>
						</div>
						<!-- //modal-body-->
					</div>
	</div>
	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
