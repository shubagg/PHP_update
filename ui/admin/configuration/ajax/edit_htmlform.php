<?php 
	include_once ('../../../../global.php');

	$classid=$_REQUEST['type'];
	$type=explode("-",$_REQUEST['type']);
	$type=str_replace("_","",$type[0]);
	$configId=$_POST['configId'];
	if($configId!=""){
		$robotlistData = select_mongo('robotlist',array('_id'=>new MongoId($configId)),array('robot'));
    	$robotlistInfo = add_id($robotlistData,"id");
    	$actionData=$robotlistInfo[0]['robot'][0]['tasklist'][0]['actionlist'];
		foreach ($actionData as $key => $actionDataval) {
			create_html($type,$actionDataval);
		}
	}
	function create_html($type,$data){

	switch ($type) 
	{  
				case 'launchapplication': 

				$path=$data['data']['path'];
				$path=$data['data']['path'];
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Launch Application</h3>
				
					<div class="form-group width-600">
					<label for="email">Path<span class="red">*</span></label><br>
					<input type="text" name="<?php echo $classid."[path]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
					data-error="This field is required" data-createform-id="<?php echo $classid ?>" placeholder="path" />
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
					<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
											<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
											</select>
							
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'getwindowname':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Get Window Name</h3>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename][]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>

					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
		<?php 
				break;
		?>			
					
		<?php		
				case 'maximizewindow':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Miximize Window</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
									<option value="none">none</option>
									<option value="int">int</option>
									<option value="float">float</option>
									<option value="string">string</option>
									<option value="text">text</option>
									<option value="byte_text">byte text</option>
									<option value="json">json</option>
									<option value="table">table</option>
								</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100"  name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'minimizewindow':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Minimize Window</h3>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'movewindowleft':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Move Window Left</h3>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'movewindowright':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Move Window Right</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'movewindowdown':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Move Window Down</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
					case 'closewindow':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Close Window </h3>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div></div> 
		<?php 
				break;
		?>
		<?php		
				case 'createworkbook':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Create Workbook</h3>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'createworksheet':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Create Worksheet</h3>
									
					<div class="form-group width-600">
					<label for="email">Worksheet name<span class="red">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" data-check="blank"
					data-error="This field is required" data-createform-id="<?php echo $classid ?>" placeholder="Worksheet name" name="<?php echo $classid."[worksheet_name]"; ?>">
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'saveworkbook':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Save Workbook</h3>
					<div class="form-group width-600">
					<label for="email">Workbook Path<span class="red">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" data-check="blank"
					data-error="This field is required" data-createform-id="<?php echo $classid ?>" placeholder="path\filename.xlsx" name="<?php echo $classid."[workbook_name]"; ?>">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'setcellvalue':
		?>
					
					
					<div class="tab-pane" id="<?php echo $classid ?>">
						<h3>Set Active Cell value</h3>
						
						  <div class="show-me12">
										<div class="form-group" style="margin-top:0px;">
											  <label for="sel1" class="cell-po">Cell Name<span style="color:red;">*</span></label><br>
											  <input type="text" class="form-control width-100 mandatory_field" placeholder="Cell Name" name="<?php echo $classid."[cell_name]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											  </div>
									</div>
									  <div class="show-me12">
										<div class="form-group">
											  <label for="sel1" class="cell-po">Set Cell Value By Variable<span style="color:red;">*</span></label><br>
											  <!-- <input type="text" class="form-control width-100 " placeholder="Cell Value" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
 -->										<select class="form-control width-100 appendVariable mandatory_field" data-check="blank"
 													data-error="This field is required" data-createform-id="<?php echo $classid ?>" name="<?php echo $classid."[value]"; ?>">
											<option value="">Select Variable</option>
											</select>
											  </div>
									</div>
						
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
							</div>
		<?php 
				break;
		?>
		
		<?php		
				case 'setrow':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Set row</h3>
					
					
						  <div class="show-me12">
										<div class="form-group" style="margin-top:0px;">
											  <label for="sel1" class="cell-po">Value<span style="color:red;">*</span></label><br>
											  <input type="text" class="form-control width-100 mandatory_field" placeholder="Value" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											  </div>
									</div>
									  <div class="show-me12">
										<div class="form-group">
											  <label for="sel1" class="cell-po">Row<span style="color:red;">*</span></label><br>
											  <input type="text" class="form-control width-100 mandatory_field" placeholder="row" name="<?php echo $classid."[row]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											  </div>
									</div>
					
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'setcolumn':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Set column</h3>
					
					<div class="show-me12">
										<div class="form-group" style="margin-top:0px;">
											  <label for="sel1" class="cell-po">Value<span style="color:red;">*</span></label><br>
											  <input type="text" class="form-control width-100 mandatory_field" placeholder="Value" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											  </div>
									</div>
									  <div class="show-me12">
										<div class="form-group">
											  <label for="sel1" class="cell-po">Column<span style="color:red;">*</span></label><br>
											  <input type="text" class="form-control width-100 mandatory_field" placeholder="column" name="<?php echo $classid."[column]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											  </div>
									</div>
									
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'getcellvalue':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>"> 
						<h3>Get Cell Value</h3>
				  <div class="show-me12">
										<div class="form-group" style="margin-top:0px;">
											  <label for="sel1" class="cell-po">Cell Name<span style="color:red;">*</span></label><br>
											  <input type="text" class="form-control width-100 mandatory_field" placeholder="Cell Name" name="<?php echo $classid."[cell_name]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											  </div>
											  </div>
				  
				<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
									<option value="">Select</option>
									<option value="wait_time">Wait Time</option>
									<option value="retry">Retry</option>
									<option value="next_action">Next Action</option>
									<option value="search_on_windows">Search On Windows</option>
								</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'getrow':
		?>	
					<div class="tab-pane" id="<?php echo $classid ?>">
						<h3>Get Row </h3>
							<div id="" class="">
				   
							<div class="show-me15">
									<div class="form-group" style="margin-top:0px;">
									  <label for="sel1" class="cell-po">Row<span style="color:red;">*</span> </label><br>
									  <input type="text" class="form-control width-100 mandatory_field" placeholder="row" name="<?php echo $classid."[rownumber]"; ?>"  data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
									  </div>
							</div>
				
				  </div>
				<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'getcolumn':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Get Column </h3>
							<div id="" class="">
			  
						<div class="show-me16">
								<div class="form-group" style="margin-top:0px;">
								  <label for="sel1" class="cell-po">Column<span style="color:red;">*</span></label><br>
								  <input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[value]"; ?>" placeholder="Column" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
								  </div>
						</div>
					
			  </div>
			 <button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
								
				</div>
				
		<?php 
				break;
		?>
		<?php		
				case 'getrange':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Get Range</h3>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo37" style="margin-top: 0px;">Options</button>
					<div class="demo37 collapse">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="form-group">
					<label for="file">From cell<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[from]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="form-group mrg-15">
					<label for="file">To cell<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[to]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div></div> 
		<?php 
				break;
		?>
		<?php		
				case 'setrange':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Set Range </h3>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo41" style="margin-bottom: 0px !important;">Input</button>
					<div class="demo41 collapse">
					<div class="">
					<div class="form-group">
					<label for="sel1" class="cell-po">select table variable<span style="color:red;">*</span></label><br>
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[tablevariable]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select></div></div></div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div> 
		<?php 
				break;
		?>
		
		<?php		
				case 'drawareachart':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Draw Area Chart</h3>
					
					<div class="wait-poling">
					<label for="sel1">Title<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[title]"; ?>" class="form-control width-100 mandatory_field" placeholder="Title" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">Style<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[style]"; ?>" class="form-control width-100 mandatory_field" placeholder="style" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">X axis<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[x_axis]"; ?>" class="form-control width-100 mandatory_field" placeholder="X axis" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">Y axis<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[y_axis]"; ?>" class="form-control width-100 mandatory_field" placeholder="y axis" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column1 from<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum1from]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column1 to<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum1to]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					</div>
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column2 from<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum2from]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column2 to<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum2to]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Plot on<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[plotno]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					</div>
					
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'drawareachart3d':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Draw Area Chart 3D</h3>
					
					<div class="wait-poling">
					<label for="sel1">Title<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[title]"; ?>" class="form-control width-100 mandatory_field" placeholder="Title" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">Style<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[style]"; ?>" class="form-control width-100 mandatory_field" placeholder="style" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">X axis<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[xaxis]"; ?>" class="form-control width-100 mandatory_field" placeholder="X axis" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">Y axis<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[yaxis]"; ?>" class="form-control width-100 mandatory_field" placeholder="y axis" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column1 from<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum1from]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column1 to<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum1to]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					</div>
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column2 from<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum2from]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Column2 to<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[colum2to]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">Plot on<span style="color:red;">*</span></label>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[plotno]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'openworkbook':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Open Workbook</h3>
					<div id="" class="">
			  
						<div class="show-me16">
								<div class="form-group" style="margin-top:0px;">
								  <label for="sel1" class="cell-po">Workbook Path<span style="color:red;">*</span></label><br>
								  <input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[workbook_name]"; ?>" placeholder="path\filename.xlsx" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
								  </div>
						</div>
					
			  </div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>" ></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'wait':
		?>

					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Wait</h3>
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Time<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[time]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?><?php		
				case 'waitforimage':
		?>
						<div class="tab-pane" id="<?php echo $classid ?>">
						<h3>Wait For Image</h3>
						<div class="form-group">
							<label>Image Path<span style="color:red;">*</span></label><br>
							<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[path]"; ?>" placeholder="File" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
							</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
						</div> 
		<?php 
				break;
		?>
		
		<?php		
				case 'copyfromvariable':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Copy From Variable</h3>
					<div class="form-group">
							<label>Variable<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
									<option value="">Select Variable</option>
							</select>

							</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>	

		<?php		
				case 'pastetovariable':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Paste to Variable</h3>
					<div class="form-group">
							<label>Variable<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
									<option value="">Select Variable</option>
							</select>
							</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>				
		
		<?php		
				case 'openterminal':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>    Open Terminal </h3>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'executecommand':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>    Execute Command </h3>
					<div class="wait-poling">
					<label for="sel1">Command<span style="color:red;">*</span></label><br>
						<input type="text"name="<?php echo $classid."[cmd]"; ?>" class="form-control width-100 mandatory_field" placeholder="Command" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'checkexistence':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>	Check Existence  </h3>
					<div class="" style="margin-bottom:20px;">
					<div class="form-group">
					<label>Path to Folder<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="File" name="<?php echo $classid."[path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">

					
				    </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div></div>
		<?php 
				break;
		?>
		
		<?php		
				case 'createfolder':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>   Create File </h3>
					<div class="" style="margin-bottom:20px;">
					<div class="form-group">
					<label>Path<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="File" name="<?php echo $classid."[path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
				    </div>
					<div class="form-group">
					<label>Name<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="File" name="<?php echo $classid."[name]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
				    </div>
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'writetofile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>	Write To File  </h3>
					<div class="">
					<div class="">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Mode<span style="color:red;">*</span></label><br>
					<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[mode]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="append">Append</option>
					<option value="overwrite">Overwrite</option>
					</select>
					</div>
					</div>
					</div>
					<div class="form-group">
					<label>Path<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="path" name="<?php echo $classid."[path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
				    </div>
					
					<div class="form-group">
					<label>File Name<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="File Name" name="<?php echo $classid."[name]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
				    </div>
					<div class="form-group">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Content<span style="color:red;">*</span></label><br>
								<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[content]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
									<option value="">Select</option>
									<option value="wait_time">Wait Time</option>
									<option value="retry">Retry</option>
									<option value="next_action">Next Action</option>
									<option value="search_on_windows">Search On Windows</option>
								</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'copyfile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>   Copy File </h3>
					<div class="row">
					<div class="col-sm-6 mrg-bottom-15">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Source Path<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[source_path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
							
					<div class="col-sm-6 mrg-bottom-15">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Source File Name<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[file_name]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="col-sm-6">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Destination Path<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[destination_path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
							
					<div class="col-sm-6">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Destination File Name<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[destination_filename]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'copyfolder':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>   Copy Folder </h3>
					<div class="row">
					<div class="col-sm-6 mrg-bottom-15">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Source Path<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[source_path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
							
					<div class="col-sm-6 mrg-bottom-15">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Source Folder Name<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[folder_name]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="col-sm-6">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Destination Path<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[destination_path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
							
					<div class="col-sm-6">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Destination Folder Name<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[destination_foldername]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0"name="<?php echo $classid."[nextAction]"; ?>" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'openfile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>   Open File </h3>
					<div class="row">
					<div class="col-sm-6">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Source Path</label><br>
						<input type="text" class="form-control width-100" name="<?php echo $classid."[path]"; ?>">
					</div>
							
					<div class="col-sm-6">
						<label for="sel1" class="cell-po" style="margin-top:0px !important;">Source Name</label><br>
						<input type="text" class="form-control width-100" name="<?php echo $classid."[name]"; ?>">
					</div>
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
		<?php 
				break;
		?>
		
		<?php		
				case 'deletecontents':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>   Delete Contents </h3>
					<div class="" style="margin-bottom:20px;">
					<div class="form-group">
					<label>Path<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="File" name="<?php echo $classid."[path]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
				    </div>
					<div class="form-group">
					<label>Name<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="File" name="<?php echo $classid."[name]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
				    </div>
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'deletefile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Delete File</h3>
				
					<div class="">
					<div class="form-group" style="margin-bottom:15px;">
					<label>Path<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[filelocation]"; ?>" placeholder="File" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">

					</div>
					
					<div class="form-group" style="margin-bottom:15px;">
					<label>Name<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[filelocation]"; ?>" placeholder="Name" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
					</div>
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>

		<?php		
				case 'readfile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>	Read File  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo67">Input</button>
					<div class="demo67 collapse" style="margin-bottom:20px;">
					<div class="form-group">
					<label>Path to Folder<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[path]"; ?>" placeholder="File" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo68">Options</button>
					<div class="demo68 collapse" style="margin-bottom:20px;">
					<div class="">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Character encoding</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[characterencode]"; ?>">
					<option>UTF-8</option>
					<option>UTF-16</option>
					<option>UTF-32</option>
					<option>ASCII</option>
					</select>
					</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div></div>
		<?php 
				break;
		?>
		<?php		
				case 'stop':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>	Stop  </h3>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'pause':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Pause  </h3>
					
					<div class="form-group">
					<label>Time<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="" placeholder="time" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
				
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		
		<?php		
				case 'clickposition':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>  Click Position </h3>
					
					<div class="wait-poling">
					<label for="sel1">X location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[x_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="X location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">y location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[y_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="y location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button<span style="color:red;">*</span></label><br>
						<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[button]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
							<option value="left">Left</option>
							<option value="middle">Middle</option>
							<option value="right">Right</option>
							
							</select>
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
									<option value="">Select</option>
									<option value="wait_time">Wait Time</option>
									<option value="retry">Retry</option>
									<option value="next_action">Next Action</option>
									<option value="search_on_windows">Search On Windows</option>
								</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		
		<?php		
				case 'doubleclickposition':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>  Double Click Position </h3>
					<div class="wait-poling">
					<label for="sel1">X location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[x_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="X location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">Y location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[y_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="y location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button<span style="color:red;">*</span></label><br>
						<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[button]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
							<option value="left">Left</option>
							<option value="right">Right</option>
							<option value="middle">Middle</option>
							
							</select>
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'clickimage':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>  Click Image </h3>
					<div class="form-group">
							<label>Image Location<span style="color:red;">*</span></label><br>
							<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[path]"; ?>" placeholder="File" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
							</div>
							
					<div class="wait-poling">
					<label for="sel1">X location<span style="color:red;">*</span></label><br>
						<input type="text"  name="<?php echo $classid."[x_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="X location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">Y location<span style="color:red;">*</span></label><br>
						<input type="text"  name="<?php echo $classid."[y_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="y location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button<span style="color:red;">*</span></label><br>
						<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[button]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
							<option value="left">Left</option>
							<option value="right">Right</option>
							<option value="middle">Middle</option>
							</select>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'doubleclickimage':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Double Click Image</h3>

					<div class="form-group">
					<label>Image Location<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[path]"; ?>" placeholder="File" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">

					</div>

					<div class="wait-poling">
					<label for="sel1">X location<span style="color:red;">*</span></label><br>
					<input type="text"  name="<?php echo $classid."[x_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="X location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>

					<div class="wait-poling">
					<label for="sel1">Y location<span style="color:red;">*</span></label><br>
					<input type="text"  name="<?php echo $classid."[y_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="y location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button<span style="color:red;">*</span></label><br>
					<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[button]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="left">Left</option>
					<option value="right">Right</option>
					<option value="middle">Middle</option>
					</select>
					</div>

					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
				<?php		
				case 'mousedrag':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>	Mouse Drag  </h3>
					<div class="wait-poling">
					<label for="sel1">X location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[x_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="X location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">Y location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[y_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="y location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
				
					<div class="wait-poling">
					<label for="sel1">Duration between scrolling<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[dragscroll]"; ?>" class="form-control width-100 mandatory_field" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'mousescroll':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Mouse Scroll  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo101">Options</button>
					<div id="web-id" class="radio mrg-bottom-15">
					<input  name="<?php echo $classid."[dir]"; ?>" type="radio"   />horizontal 
					<input  name="<?php echo $classid."[dir]"; ?>" type="radio" style="margin-left:15px;" />vertical scroll
					</div>
					<div class="demo101">
					<div class="wait-poling mrg-15">Scroll: <span><input type="text" name="<?php echo $classid."[scroll]"; ?>" class="ms-point" style="margin-right:20px;" placeholder="0"></span>   lines: <span>
					<select class="form-control" name="<?php echo $classid."[line]"; ?>">
					<option>Up</option>
					<option>Down</option>
					</select></span></div>
					</div>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
						<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
							<option value="">Select</option>
							<option value="wait_time">Wait Time</option>
							<option value="retry">Retry</option>
							<option value="next_action">Next Action</option>
							<option value="search_on_windows">Search On Windows</option>
						</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div></div>
		<?php 
				break;
		?>		
		<?php		
				case 'type':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Type</h3>
					<div class="form-group">
					<label>Value<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
									<option value="">Select</option>
									<option value="wait_time">Wait Time</option>
									<option value="retry">Retry</option>
									<option value="next_action">Next Action</option>
									<option value="search_on_windows">Search On Windows</option>
								</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'press':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Press</h3>
					<div class="wait-poling">
					<label for="sel1">Key<span style="color:red;">*</span></label><br>
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'command':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Command</h3>
					<div class="wait-poling">
					<label for="sel1">Command<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[value]"; ?>" placeholder="ctrl+c" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'typeonimageafterclick':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Type on Image After Click</h3>
					<div class="form-group" style="margin-bottom:15px;">
					<label>Image location<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[location]"; ?>" placeholder="image location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">X location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[x_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="x location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Y location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[y_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="y location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Value<span style="color:red;">*</span></label><br>
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select>
					</div>
					<div class="wait-poling">
					<label for="sel1">Button<span style="color:red;">*</span></label><br>
						<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[button]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
							<option value="left">Left</option>
							<option value="right">Right</option>
							<option value="middle">Middle</option>
						</select>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'typeonimageafterdoubleclick':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Type On Image After Double Click</h3>
					<div class="form-group" style="margin-bottom:15px;">
					<label>Image location<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" name="<?php echo $classid."[img_loc]"; ?>" placeholder="image location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					
					</div>
					
					<div class="wait-poling">
					<label for="sel1">X location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[x_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="x location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Y location<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[y_loc]"; ?>" class="form-control width-100 mandatory_field" placeholder="y location" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Value<span style="color:red;">*</span></label><br>
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select>
					</div>
					<div class="wait-poling">
					<label for="sel1">Button<span style="color:red;">*</span></label><br>
						<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[button]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
							<option value="left">Left</option>
							<option value="right">Right</option>
							<option value="middle">Middle</option>
						</select>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'ifelse':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> If-else  </h3>
					<!-- <div class="wait-poling">
					<label for="sel1">Value1<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[Value1]"; ?>" class="form-control width-100 mandatory_field" placeholder="Value1" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Value2<span style="color:red;">*</span></label><br>
						<input type="text" name="<?php echo $classid."[Value2]"; ?>" class="form-control width-100 mandatory_field" placeholder="Value2" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div> -->
					
					<div class="">
					<div class="form-group" style="margin-bottom:20px;">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Perform the nested actions if: <span style="color:red;">*</span></label><br>
					<div class="col-sm-4">
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select>
					</div>
					<div class="col-sm-4">
					<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[condition]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="==">equals (=) </option>
					<option value="!=">not equals (=)</option>
					<option value=">">greater than (>)< /option>
					<option value=">=">greater than (>) or equals (>=) </option>
					<option value="<">less than (<) </option>
					<option value="<=">less than or equals (<=)  </option>
					<option value="contains">contains  </option>
					<option value="not_contains">not contains  </option>
					<option value="is_empty"> is empty  </option>
					<option value="is_not_empty"> is not empty  </option>
					</select>
					</div>
					<div class="col-sm-4">
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select>
					</div>
					</div>
					</div>
					<div class="wait-poling">
					<label for="sel1">Then</label><br>
						<input type="text" class="form-control width-100" placeholder="action number" name="<?php echo $classid."[then]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Else<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" placeholder="action number" name="<?php echo $classid."[else]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100"  name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0"  name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0"  name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment"  name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div> 
		<?php 
				break;
		?>
		<?php		
				case 'while':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> While </h3>
					
					<div class="">
					<div class="form-group" style="margin-bottom:20px;">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Perform the nested actions if: <span style="color:red;">*</span></label><br>
					<div class="col-sm-4">
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select>
					</div>
					<div class="col-sm-4">
					<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[condition]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="==">equals (=) </option>
					<option value="!=">not equals (=)</option>
					<option value=">">greater than (>)< /option>
					<option value=">=">greater than (>) or equals (>=) </option>
					<option value="<">less than (<) </option>
					<option value="<=">less than or equals (<=)  </option>
					<option value="contains">contains  </option>
					<option value="not_contains">not contains  </option>
					<option value="is_empty"> is empty  </option>
					<option value="is_not_empty"> is not empty  </option>
					</select>
					</div>
					<div class="col-sm-4">
					<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="">Select Variable</option>
					</select>
					</div>
					</div>
					</div>
					<div class="wait-poling">
					<label for="sel1">Then</label><br>
						<input type="text" class="form-control width-100" placeholder="action number" name="<?php echo $classid."[then]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					<div class="wait-poling">
					<label for="sel1">Else<span style="color:red;">*</span></label><br>
						<input type="text" class="form-control width-100 mandatory_field" placeholder="action number" name="<?php echo $classid."[else]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
									<option value="">Select</option>
									<option value="wait_time">Wait Time</option>
									<option value="retry">Retry</option>
									<option value="next_action">Next Action</option>
									<option value="search_on_windows">Search On Windows</option>
								</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<!-- <div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div> -->
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'openbrowser':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Open Browser</h3>
					
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Browser<span style="color:red;">*</span></label><br>
					<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[browser]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					<option value="chrome">Chrome</option>
					<option value="firefox">Firefox</option>
					<option value="internetexplorer">Internet Explorer</option>
					</select>
					</div>
					
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Url<span style="color:red;">*</span></label><br>
					<input type="text" class="form-control width-100 mandatory_field" placeholder="http://" name="<?php echo $classid."[url]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
				<?php		
				case 'webelement':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Web element  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo83">Mode</button>
					<div class="web-id" class="radio mrg-bottom-15">
					<input class="watch-me33" name="<?php echo $classid."[mode]"; ?>" value="copy_xpath" type="radio"  checked />Get Value 
					<input class="see-me33" name="<?php echo $classid."[mode]"; ?>" value="set_value_xpath" type="radio" style="margin-left:15px;" /> Set Value
					<input class="new-me33" name="<?php echo $classid."[mode]"; ?>" value="click_xpath" type="radio" style="margin-left:15px;" /> Click
					</div>
					<div class="show-me33">
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo84">Options</button>
					<div class="demo84 collapse">
					<div class="form-group">
					<label>XPath of the element</label><br>
					<input type="text" class="form-control width-100" name="<?php echo $classid."[xpath_getvalue]"; ?>" placeholder="">
					</div>
					<div id="web-id" class="radio mrg-bottom-15 width-100">
					<div id="show-me-two33" style="display:none;">
					<div class="form-group">
					<input type="text" class="form-control width-100" placeholder="">
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					</div>
					<div class="show-me-two33" style="display:none;">
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo86">Input</button>
					<div class="demo86 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Use value from variable</label><br>
					<select class="form-control width-100 appendVariable" name="<?php echo $classid."[value]"; ?>">
						<option value="">Select Variable</option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo87">Options</button>
					<div class="demo87 collapse">
					<div class="form-group">
					<label>XPath of the element</label><br>
					<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[xpath_set_value]"; ?>">
					</div>
					
					</div>
					</div>
					
					
					<div class="show-me-three33" style="display:none;">
					
					<div class="form-group">
					<label>XPath of the element</label><br>
					<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[xpath_click]"; ?>">
					</div>
					
					<div class="form-group">
					<label>Button</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[button]"; ?>">
							<option value="left">Left</option>
							<option value="right">Right</option>
					</select>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target="#demo82">Comments</button>
					<div id="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'closebrowser':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Close Browser</h3>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'sum':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Sum</h3>
					<div class="wait-poling add-variable">
							<label for="sel1" class="width-100">List of element <span  class="pull-right"><i id="btn1" class="add-element-button fa fa-plus" data-sum-id="<?php echo $classid ?>"></i></span></label><br>
							<div class="col-sm-3">
							<select class="form-control width-100 appendVariable" name="<?php echo $classid."[sumvalue][]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
						</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'subtract':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Subtract</h3>
				
					<div class="wait-poling add-variable">
							<label for="sel1" class="width-100">List of element <span  class="pull-right"><i id="btn1" class="add-element-button fa fa-plus" data-sum-id="<?php echo $classid ?>"></i></span></label><br>
							<div class="col-sm-3">
							<select class="form-control width-100 appendVariable" name="<?php echo $classid."[sumvalue][]"; ?>">
								<option value="">Select Variable</option>
							</select>
							</div>
						</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'division':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> division</h3>
						<div class="wait-poling">
							<label for="sel1">Value1<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						<div class="wait-poling">
							<label for="sel1">Value2<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'multiplication':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> multiplication</h3>
					
					<div class="wait-poling add-variable">
							<label for="sel1" class="width-100">List of element <span  class="pull-right"><i id="btn1" class="add-element-button fa fa-plus" data-sum-id="<?php echo $classid ?>"></i></span></label><br>
							<div class="col-sm-3">
							<select class="form-control width-100 appendVariable" name="<?php echo $classid."[sumvalue][]"; ?>">
								<option value="">Select Variable</option>
							</select>
							</div>
						</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
									<option value="none">none</option>
									<option value="int">int</option>
									<option value="float">float</option>
									<option value="string">string</option>
									<option value="text">text</option>
									<option value="byte_text">byte text</option>
									<option value="json">json</option>
									<option value="table">table</option>
								</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
						  
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'increment':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> increment</h3>
					<div class="wait-poling">
							<label for="sel1">Value<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
									<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
								</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'decrement':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> decrement</h3>
					<div class="wait-poling">
							<label for="sel1">Value<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'assign':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Assign</h3>
						<div class="wait-poling">
							<label for="sel1">Value1<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						
						<div class="wait-poling">
							<label for="sel1">Variable<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'power':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Power</h3>
					<div class="wait-poling">
							<label for="sel1">Value1<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value1]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						
						<div class="wait-poling">
							<label for="sel1">Value2<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 appendVariable mandatory_field" name="<?php echo $classid."[value2]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Variable</option>
											</select>
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
				case 'readtextfromimage':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Read Text From Image</h3>
					<div class="wait-poling">
							<label for="sel1">Path<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[path]"; ?>" class="form-control width-100 mandatory_field" placeholder="Path" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						
						<div class="wait-poling">
							<label for="sel1">File Name<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[filename]"; ?>" class="form-control width-100 mandatory_field" placeholder="File Name" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						<div class="wait-poling">
							<label for="sel1">Block Distance<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[block_distance]"; ?>" class="form-control width-100 mandatory_field" placeholder="Block Distance" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>

						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
			<?php 
				break;
		?>		
		
		<?php		
				case 'readtextfrompdf':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Read Text From Pdf </h3>
					<div class="wait-poling">
							<label for="sel1">Path<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[path]"; ?>" class="form-control width-100 mandatory_field" placeholder="Path" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						
						<div class="wait-poling">
							<label for="sel1">File Name<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[filename]"; ?>" class="form-control width-100 mandatory_field" placeholder="File Name" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						<div class="wait-poling">
							<label for="sel1">Block Distance<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[block_distance]"; ?>" class="form-control width-100 mandatory_field" placeholder="Block Distance" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
								<option value="none">none</option>
								<option value="int">int</option>
								<option value="float">float</option>
								<option value="string">string</option>
								<option value="text">text</option>
								<option value="byte_text">byte text</option>
								<option value="json">json</option>
								<option value="table">table</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable" name="<?php echo $classid."[variablename]"; ?>">
											<option value="">Select Variable</option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
			<?php 
				break;
		?>	
		
		<?php		
				case 'textconcatinate':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Text Concatenate </h3>
					<div class="wait-poling">
							<label for="sel1">String 1<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string1]"; ?>" class="form-control width-100 mandatory_field" placeholder="String 1" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						
						<div class="wait-poling">
							<label for="sel1">String 2<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string2]"; ?>" class="form-control width-100 mandatory_field" placeholder="String 2" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
			<?php 
				break;
		?>	
		<?php		
				case 'textlength':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Text Length </h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>	
		<?php		
				case 'convertcase':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Convert Case </h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div> 
					<div class="wait-poling">
							<label for="sel1">Case<span style="color:red;">*</span></label><br>
							<select class="form-control width-100 mandatory_field" name="<?php echo $classid."[case]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
											<option value="">Select Case</option>
											<option value="upper">UPPER</option>
											<option value="lower">lower</option>
											<option value="capitalize">Capitalize EachWord</option>
											<option value="sentence">Sentence case</option>
											<option value="toggle">ToGgLe</option>
							</select>
						</div>
						
						
						
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>	
		<?php		
				case 'textsplit':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Text Split </h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>
		<?php		
				case 'textslice':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Text Slice</h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">From Index<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[from_index]"; ?>" class="form-control width-100 mandatory_field" placeholder="From Index" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">To Index<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[to_index]"; ?>" class="form-control width-100 mandatory_field" placeholder="To Index" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
						
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>		
		<?php		
				case 'textremove':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Text Remove</h3>
					</div>
			<?php 
				break;
		?>
		<?php		
				case 'characterindex':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Character Index</h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">String To Be Searched<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[substring_to_be_searched]"; ?>" class="form-control width-100 mandatory_field" placeholder="String To Be Searched" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					
						
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>	
		<?php		
				case 'substring':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Substring</h3>
					</div>
			<?php 
				break;
		?>
		<?php		
				case 'replacesubstringintext':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Replace Substring in Text</h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">String To Be Replaced<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[substring_to_be_replaced]"; ?>" class="form-control width-100 mandatory_field" placeholder="String To Be Replaced" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					
						<div class="wait-poling">
							<label for="sel1">Replaced By<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[replaced_by]"; ?>" class="form-control width-100 mandatory_field" placeholder="Replaced By" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>
		<?php		
				case 'findtext':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Find Text</h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">String To Be Searched<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[substring_to_be_searched]"; ?>" class="form-control width-100 mandatory_field" placeholder="String To Be Searched" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>	
		<?php		
				case 'texttrim':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Text Trim</h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">String To Be Trimed<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string_to_be_trimed]"; ?>" class="form-control width-100 mandatory_field" placeholder="String To Be Trimed" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>	
		<?php		
				case 'textbetweentext':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Text Between Text</h3>
					<div class="wait-poling">
							<label for="sel1">String<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string]"; ?>" class="form-control width-100 mandatory_field" placeholder="String" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">String after<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string_after]"; ?>" class="form-control width-100 mandatory_field" placeholder="String after" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<div class="wait-poling">
							<label for="sel1">String before<span style="color:red;">*</span></label><br>
							<input type="text" name="<?php echo $classid."[string_before]"; ?>" class="form-control width-100 mandatory_field" placeholder="String before" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
						</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[returntype]"; ?>">
											<option value="none">none</option>
											<option value="int">int</option>
											<option value="float">float</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="byte_text">byte text</option>
											<option value="json">json</option>
											<option value="table">table</option>
							</select>
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100 appendVariable"  name="<?php echo $classid."[variablename]"; ?>">
									<option value="">Select Variable</option>
								</select>
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
			<?php 
				break;
		?>
		<?php		
				case 'tasklist':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<input type="hidden" name="<?php echo $classid."[tasklist]"; ?>" value="<?php echo $type[1]; ?>">
					
			<?php 
				break;
		?>		

		<?php		
				case 'generatedataset':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Generate Dataset </h3>
					<div class="form-group width-600">
					<label for="email">Path<span class="red">*</span></label><br>
					<input type="text" name="<?php echo $classid."[path]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
					data-error="This field is required" data-createform-id="<?php echo $classid ?>" placeholder="path" />
					</div>
					<div class="form-group width-600">
					<label for="email">Name<span class="red">*</span></label><br>
					<input type="text" name="<?php echo $classid."[name]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
					data-error="This field is required" data-createform-id="<?php echo $classid ?>" placeholder="name" />
					</div>
					<div class="form-group width-600">
					<label for="email">No of images<span class="red">*</span></label><br>
					<input type="text" name="<?php echo $classid."[no_of_images]"; ?>" class="form-control width-100 mandatory_field" data-check="blank"
					data-error="This field is required" data-createform-id="<?php echo $classid ?>" placeholder="No of images" />
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
					<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
											<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
											</select>
							
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					
			<?php 
				break;
		?>		

		
		<?php		
				case 'starttraining':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Start Training</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
					<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
											<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
											</select>
							
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
			<?php 
				break;
		?>
		<?php		
				case 'startrecognizing':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Start Recognizing</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus" data-type="<?php echo $classid; ?>"></i></span></label><br>
					<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename][]"; ?>">
								<option value="">Select</option>
								<option value="wait_time">Wait Time</option>
								<option value="retry">Retry</option>
								<option value="next_action">Next Action</option>
								<option value="search_on_windows">Search On Windows</option>
							</select>
							
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[variablevalue][]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
					
			<?php 
				break;
		?>		
		<?php 
		
				default:
			
				break;
	}
}
?>
	
	
	