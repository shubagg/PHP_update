<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
<script>

</script>
<div id="main">
<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li><a href="#">Library</a></li>
						<li class="active">Data</li>
				</ol>
			

			<div id="content" style="padding:15px;" >
    <section class="panel" style=" margin-bottom:10px;">
   		 <div class="panel-body" style="padding: 20px 10px 3px 10px;">
<?php if(sizeof($vehicle_list)!=0) { ?>
      <form id="reportrecord" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        
		
		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-left:0;">
				
    		    <select id="vehiclechoose" name="vehicle" class="form-control required_field addUser editUser">
				<option value="">Select vehicle</option>				
				<?php for($i=0;$i<count($vehicle_list);$i++)
				{?>
				  	
				  <option value="<?php echo $vehicle_list[$i]['vehicleId']; ?>"><?php echo $vehicle_list[$i]['title']; ?></option>
				  <?php } ?>
				</select>
				
			<span id="report1" style="color:red"></span>
				</div>
				
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 " style="padding-left:0;">
		            	
			<select id="report_data" name="report_data" onchange="select_report(this.value);" class="form-control required_field addUser editUser">

             <option value="">Select Report Format</option>
              <?php foreach (array_keys($report_type) as $key => $value) { ?>
					<option value="<?php echo $value;?>"><?php echo ucwords($value);?></option>
              <?php }?>
   
            </select>
					
			<span id="report2" style="color:red"></span>
				</div>
				
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 " style="padding-left:0;">
					
		            <select id="report_types" name="report_types" class="form-control required_field addUser editUser">
             
            </select>
<span id="report3" style="color:red"></span>				
	
				</div>
				
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 " style="padding:0;">
					
		            <select id="reporttime" name="time" class="form-control required_field addUser editUser">
		 <option value="minute">Minute</option>
              <option value="hour">Hour</option>		
		<option value="day">Day</option>
              <option value="month">Month</option>
            </select>
					
<span id="report4" style="color:red"></span>
				</div>
				
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
				
					<div class="form-group">
							
								<div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left" data-date-format="dd MM yyyy - HH:ii p">
								<input  type="text" name="fromdate" id="repfromdate" placeholder="From Date" class="form-control" readonly />

								<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
								<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
								</div>
<span id="report5" style="color:red"></span>
						</div>	
					
				</div>
																					
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
				
					<div class="form-group">
							
							<div class="col-md-12 col-lg-12">
								<div class="row">
								<div class="input-group date form_datetime col-lg-12" style="padding:0 !important;" data-picker-position="bottom-left" data-date-format="dd MM yyyy - HH:ii p">
								<input type="text" name="todate" id="reptodate" placeholder="To Date" class="form-control" readonly />
								<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
								<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
								</div>
								</div>
								</div>
	<span id="report6" style="color:red"></span>					
</div>
					
				</div>
				
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 " style="padding:0;">
				 <button  type="button" onclick="get_report_data();" class="btn btn-theme-inverse pull-right"> <i class="glyphicon glyphicon-ok"></i> Submit </button>
				 </div>

		</div>	
			
		
       
        
      </form>

<?php } else { echo "<h2>No Vehicle Assigned<h2>"; }?>
    </div>


	</section>
	<section class="panel">
												
			<div class="panel-body" id="reportdata" style="display:none">

<table id="reportdatatable" class="table table-bordered" data-provide="data-table" >
																<thead>
																		<tr>
																				<th>#</th>
																				<th>Vehicle No.</th>
																				<th>Vehicle Status</th>
																				<th>Start Time</th>
																				<th>End Time</th>
																				<th>Time Interval
																				<t>Start Location</th>
																		</tr>
																</thead>
																<tbody align="center">
																		
																		

																		
																		
																</tbody>
														</table>
	</div>

<div id="map" style="height: 450px" style="display:none">
                                                        
                                                        </div>
                                                        
                                                        
                                                        <script type="text/javascript">
                                                            var map;
                                                            function map_int()
                                                            {
                                                              map = new GMaps({
                                                        		el: '#map',
                                                                lat: 44.968046,
                                                        		lng: -94.420307,
                                                        		zoom:8,
                                                        		panControl: true,
                                                        		scrollwheel: true,
                                                        		zoomControl: true,
                                                        		mapTypeControl:true,
                                                        		mapTypeId: google.maps.MapTypeId.ROADMAP,
                                                        		zoom_changed: function(e) {
                                                        			$("#zoom").val(e.zoom);
                                                        		}
                                                              });
                                                        	}
                                                            $( document ).ready(function()
                                                            {
                                                                map_int();
                                                            });
                                                        </script>
                                                                                                                
</section>
    
		
    
  </div>
  
			<!-- //content-->



		</div>
	
		<!-- //main-->


            
        
        
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
	</div>
	<!-- //wrapper-->


	<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
