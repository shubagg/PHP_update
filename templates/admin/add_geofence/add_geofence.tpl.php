  <div id="main" class="dashboard">
<div id="content">
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
      <button id="get_all_data" class="btn btn-theme-inverse" onclick="get_all_cordinates()" type="button" >
              Save
            </button>
        <input type="button" class="btn btn-danger" id="delete-button"  value="Delete Selected Shape"/>
        <input type="button" class="btn btn-danger" id="delete-button" onclick="old_all_delete()"  value="Delete All"/>
        <!--<input type="button" id="delete-edit-button" onclick="re_initialize()" value="Re_initialize"/>-->
        
        <span style="display:none;">
          <input type="checkbox" id="single" value="yes"/><span style="color:white;">Get Single Geofence Only</span>
          <input type="button" id="get_all_data" onclick="get_all_cordinates()" value="Get All Data"/>
        </span>
        
    </div>
           
            </div>

 
        <div id="total"></div>
         <div class="clear"></div>
         <div style="width:100%;margin-top:100px" id="Gmap"></div>
         <div id="right-panel" style="float:right;width:30%;height 100%"></div>
    <!-- //mapControl-->
  </div>
  </div>
  <div class="clearfix"></div>
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

            
        
	
        
        
                 <?php echo success_fail_message_popup();?> 
                 
        
      
        
        
                 <?php echo delete_confirmation_popup();?> 
                 
                    
        
                    
              
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
								<i class="glyphicon glyphicon-plus-sign"></i>Add Geofence
							</h4>
						</div>
						<!-- //modal-header-->
						<div class="modal-body">
                 <div class="form-group">
                       <label class="control-label">Name</label>
                          <input type="text" id="title" name="title" class="form-control">
                          <span id="etitle" class="error"></span>
                      </div>

                      <div class="form-group">
                       <label class="control-label">Description</label>
                          <input type="text" id="description" name="description" class="form-control">
                          <span id="edescription" class="error"></span>
                      </div>
                <div class="form-group">
                    <div class="row">
                     

                      <div class="col-md-2">
                          <label>Type:</label>
                      </div>
                      <div class="col-md-5">
                          <label for="inward">Inward</label>
                          <input type="checkbox" value="in" class="chbox" id="inward">
        							</div>
                      <div class="col-md-5">
                         <label for="outward">Outward</label>
                          <input type="checkbox" value="out" class="chbox" id="outward">
        							</div>
                    </div>
                    <span id="checktype" class="error"></span>
                </div>
                              
  							<div class="form-group">
  							 <label class="control-label">Tolerance</label>
                    <input type="text" id="tolerance" name="tolerance" class="form-control">
  							</div>
                <span id="etolerance" class="error"></span>
					</div>
						<div class="modal-footer">				
						
						<button type="button" onclick="save_fence_setting()" class="btn btn-theme">Save</button>
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
