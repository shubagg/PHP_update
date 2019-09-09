<?php 
	$classid=$_REQUEST['type'];
	$type=explode("-",$_REQUEST['type']);
	switch ($type[0]) 
	{  
				case 'launchapplication':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Launch Application</h3>
					
					<div class="form-group width-600">
					<label for="email">Exectable file or command</label>
					<input type="text" name="<?php echo $classid."[commend]"; ?>" class="form-control form-filepath" placeholder="Command" />
					</div>
					<div class="form-group width-600">
					<label for="email">Path</label><br>
					<input type="text" name="path" class="form-control width-100" placeholder="path" />
					</div>
					<div class="form-check-m">Autodetect Window <span><input type="checkbox" name="<?php echo $classid."[autodetect]"; ?>" class="form-check" /></span></div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
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
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100" name="<?php echo $classid."[setvariablename]"; ?>">
											<option>Select</option>
											<option value="waittime">Wait Time</option>
											<option value="retry">Retry</option>
											<option value="nextAction">Next Action</option>
											<option value="searchonwindows">Search On Windows</option>
											</select>
							
							</div>
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[variablevalue]"; ?>">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[nextAction]"; ?>"/></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target="#demo82">Comments</button>
					<div id="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'window':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Window</h3>
                    <button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo14">Mode</button>
                    <div class="demo14 collapse in">
                    <div class="radio-tabb">
                    <label class="radio-inline">
                    <input type="radio" class="watch-me17" name="<?php echo $classid."[mode]"; ?>">Select an open window
                    </label>
                    <label class="radio-inline">
                    <input type="radio" class="see-me17" name="<?php echo $classid."[mode]"; ?>">Enter window title or part of title
                    </label></div></div>
                    <button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo12">Options</button>
                    <div class="demo12 collapse in">
                    <div class="form-group width-600">
                    <div class="show-me17">
                    <label for="window">Select a window title from the list</label><br>
                    <select class="form-control" name="<?php echo $classid."[windowtitle]"; ?>"  style="width:70%;" id="windowtitlefirst">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                    <button type="button" class="btn btn-info" onclick="$('#windowtitlefirst').val('');">Refresh</button>
                    </div>
                    <div class="show-me-two17">
                    <label for="window">Window title or part of window title</label><br>
                    <input type="text" name=""class="form-control width-100" name="<?php echo $classid."[windowtitle]"; ?>" placeholder="Command" />
                    </div>
                    </div>
                    </div>
                    <button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo15">Output</button>
                    <div class="demo15 collapse in">
                    <div class="form-group width-600">
                    <label for="sel1">Put search result into variable</label><br>
                    <select class="form-control" name="<?php echo $classid."[putvariable]"; ?>"  style="width:70%;" id="windowtitlesecond">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                    <button type="button" class="btn btn-info" onclick="$('#windowtitlesecond').val('');">Refresh</button>
                    </div>
                    </div>
                    <button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo16">Timeout</button>
                    <div class="demo16 collapse in">
                    <div class="wait-poling">Switch window timeout <span><input type="text" name="<?php echo $classid."[timeout]"; ?>" class="ms-point" placeholder="0" /></span> Milliseconds</div>
                    </div>
                    <button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo12-1">Advanced</button>
                    <div class="demo12-1 collapse in">
                    <div class="wait-poling">Wait <span><input type="text" class="ms-point"  name="<?php echo $classid."[wait]"; ?>" placeholder="0" /></span> ms before performing this action</div>
                    </div>
                    <button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo13">Comments</button>
                    <div class="demo13 collapse in">
                    <textarea class="form-control width-100" rows="5" name="<?php echo $classid."[comment]"; ?>"></textarea>
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
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".#demo21">Put title into variable</button>
					<div class="demo21 collapse in">
					<div class="wait-poling">
					<label for="sel1">Variable name</label><br>
					<select class="form-control"  style="width:100%;" name="<?php echo $classid."[variablename]"; ?>">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					</select>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target="#demo82">Comments</button>
					<div id="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div></div> 
		<?php 
				break;
		?>
		<?php		
					case 'getwindowtitle':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Get Window Title</h3>
					</div> 
		<?php 
				break;
		?>
		<?php		
				case 'createworkbook':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
                    <h3>Create Workbook</h3>
					
					<div class="book1 collapse in">
					<div class="wait-poling">
					<label for="sel1">Workbook name</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Workbook name">
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					
					<div class="book1 collapse in">
					<div class="wait-poling">
					<label for="sel1">Worksheet name</label><br>
						<input type="text" name="name" class="form-control width-100" placeholder="Worksheet name">
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<div class="book1 collapse in">
					<div class="wait-poling">
					<label for="sel1">Workbook name</label><br>
						<input type="text" name="name" class="form-control width-100" placeholder="Workbook name">
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		<?php		
					case 'openspreadsheet':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Open Spreadsheet </h3>
					<div class="form-group">
					<label for="email">File Location</label>
					<input type="text" name="<?php echo $classid."[filelocation]"; ?>" class="form-control form-filepath" placeholder="File" />
					</div>
					<div class="form-check-m">Save File after Action <span><input type="checkbox" class="form-check"  name="<?php echo $classid."[saveafter]"; ?>"/></span></div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo9">Advanced</button>
					<div class="demo9 collapse in">
					<div class="wait-bottom-space">Wait <span><input type="text" class="ms-point" placeholder="0"  name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo8">Comments</button>
					<div class="demo8 collapse in">
					<textarea class="form-control width-100" rows="5"  name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div> 
		<?php 
				break;
		?>
		<?php 
				case 'savespreadsheet':
		?>
					 <div class="tab-pane" id="<?php echo $classid ?>">
			<h3>Save Spreadsheet </h3>
			<div class="radio-tabb">
				<label class="radio-inline">
				  <input class="watch-me9" type="radio" name="<?php echo $classid."[savefile]"; ?>">Save to the same file 
				</label>
				<label class="radio-inline">
				  <input class="see-me9" type="radio" name="<?php echo $classid."[savefile]"; ?>">Save as a new file
				</label>
			</div>
			<div class="show-me9">
			</div>
			<div class="show-me-two9" class="mrg-15">
						<div class="form-group width-600 mrg-15">
				<label for="window">Destination Folder</label><br>
				<input type="text" class="form-control form-filepath" name="<?php echo $classid."[filelocation]"; ?>" placeholder="New Folder">
				<!-- <div class="myLabel">
				<input type="file">
				<span>Select File</span>
			</div> -->
			  </div>
  <div class="form-group width-600 mrg-15">
    <label for="window">File Name</label><br>
    <input type="text" class="form-control form-filepath" placeholder="New File Name"  name="<?php echo $classid."[filename]"; ?>">
  </div>
			</div><button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo7">Advanced</button>
					<div class="demo7 collapse in">
					<div class="wait-bottom-space">Wait <span><input type="text" class="ms-point" placeholder="0"  name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo6">Comments</button>
					<div class="demo6 collapse in">
					<textarea class="form-control width-100" rows="5"  name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
	</div>
	
		<?php 
				break; 
		?>
		<?php 
				case 'switchtosheet':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">	
						<h3>Switch To Sheet  </h3>
							<div class="radio-tabb">
								<label class="radio-inline">
								  <input class="watch-me10" type="radio" name="<?php echo $classid."[savefile]"; ?>">Specify index
								</label>
								<label class="radio-inline">
								  <input class="see-me10" type="radio" name="<?php echo $classid."[savefile]"; ?>">Specify Name
								</label>
							</div>
						<div class="show-me10">
							<div class="mrg-15">
								Switch to the sheet Number <span><input type="text" class="ms-point"  placeholder="0"  name="<?php echo $classid."[switchsheet]"; ?>"/></span>
							</div>
						</div>
						
						<div class="show-me-two10" class="mrg-15">
							 <div class="form-group width-600 mrg-15">
								<label for="window">Sheet Name</label><br>
								<input type="text" class="form-control width-100" placeholder="sheet Name">
							  </div>
						</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo5">Advanced</button>
								<div class="demo5 collapse in">
								<div class="wait-bottom-space">Wait <span><input type="text" class="ms-point" placeholder="0"  name="<?php echo $classid."[wait]"; ?>"/></span> ms before performing this action</div>
								</div>
								<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo4">Comments</button>
								<div class="demo4 collapse in">
								<textarea class="form-control width-100" rows="5"  name="<?php echo $classid."[comment]"; ?>"></textarea>
								</div>
					</div>
	
		<?php 
				break; 
		?>
		<?php		
					case 'setactivecell':
		?>
				<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Set Active Cell </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:10px;" data-toggle="collapse" data-target=".demo">Advanced</button>
						  <div class="demo collapse in">
							<div class="radio-tabb" style="margin-top:0px;">
							<label class="radio-inline">
							  <input class="watch-me11" type="radio" name="<?php echo $classid."[cellcoordinate]"; ?>">Coordinates
							</label>
							<label class="radio-inline">
							  <input class="see-me11" type="radio" name="<?php echo $classid."[cellposition]"; ?>">Position
							</label>
						</div>
						<div class="show-me11">
							<div class="form-group">
								  <label for="sel1" class="cell-po">Cell Coordinates</label><br>
								  <input type="text" class="form-control width-100" placeholder=""  name="<?php echo $classid."[cellcoordinate]"; ?>">
								  </div>
						</div>
						<div class="show-me-two11" class="mrg-15">
							 <div class="form-group">
								  <label for="sel1" class="cell-po">Cell Position</label><br>
								  <select class="form-control width-100" name="<?php echo $classid."[cellposition]"; ?>">
									<option value="Start of Column">Start of Column</option>
									<option value="Start of row">Start of row</option>
									<option value="End of Column">End of Column</option>
									<option value="End of row">End of row</option>
								  </select>
								  </div>
						</div>
						  </div>
						 <button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
											  <label for="sel1" class="cell-po">Cell Name</label><br>
											  <input type="text" class="form-control width-100" placeholder="Cell Name">
											  </div>
									</div>
									  <div class="show-me12">
										<div class="form-group">
											  <label for="sel1" class="cell-po">Cell Value</label><br>
											  <input type="text" class="form-control width-100" placeholder="Cell Value">
											  </div>
									</div>
								
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
											  <label for="sel1" class="cell-po">Value</label><br>
											  <input type="text" class="form-control width-100" placeholder="Value">
											  </div>
									</div>
									  <div class="show-me12">
										<div class="form-group">
											  <label for="sel1" class="cell-po">Row</label><br>
											  <input type="text" class="form-control width-100" placeholder="row">
											  </div>
									</div>
									
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
											  <label for="sel1" class="cell-po">Value</label><br>
											  <input type="text" class="form-control width-100" placeholder="Value">
											  </div>
									</div>
									  <div class="show-me12">
										<div class="form-group">
											  <label for="sel1" class="cell-po">column</label><br>
											  <input type="text" class="form-control width-100" placeholder="colum">
											  </div>
									</div>
									
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
											  <label for="sel1" class="cell-po">Cell Name</label><br>
											  <input type="text" class="form-control width-100" placeholder="Cell Name">
											  </div>
											  </div>
				  
				<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'deletecell':
		?>
					
					<div class="tab-pane" id="<?php echo $classid ?>">
							<h3>Delete Cell </h3>
					  <div id="" class="">
					   <div class="radio-tabb" style="margin-top:0px;">
									<label class="radio-inline">
									  <input class="watch-me14" type="radio"  name="<?php echo $classid."[deletecoordinate]"; ?>">Coordinates
									</label>
									<label class="radio-inline">
									  <input class="see-me14" type="radio" name="<?php echo $classid."[deletecoordinate]"; ?>">Position
									</label>
								</div>
								<div class="show-me14">
										<div class="form-group">
										  <label for="sel1" class="cell-po">Cell Coordinates</label><br>
										  <input type="text" class="form-control width-100" placeholder="Cell Coordinates" name="<?php echo $classid."[cellcoordinate]"; ?>">
										  </div>
								</div>
								<div class="show-me-two14" class="mrg-15">
									 <div class="form-group">
									  <label for="sel1" class="cell-po">Cell Position</label>
									  <select class="form-control width-100" name="<?php echo $classid."[cellposition]"; ?>">
										<option value="Start of document">Start of document</option>
										<option value="Start of row">Start of row</option>
										<option value="End of Column">End of Column</option>
										<option value="End of row">End of row</option>
									  </select>
									  </div>
								</div>
					  </div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
									  <label for="sel1" class="cell-po">Row </label><br>
									  <input type="text" class="form-control width-100" placeholder="row" name="<?php echo $classid."[rownumber]"; ?>">
									  </div>
							</div>
				
				  </div>
				<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
								  <label for="sel1" class="cell-po">Column</label><br>
								  <input type="text" class="form-control width-100" name="<?php echo $classid."[rownumber]"; ?>" placeholder="Column">
								  </div>
						</div>
					
			  </div>
			 <button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<div class="demo37 collapse in">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="form-group">
					<label for="file">From cell</label>
					<input type="text" class="form-control form-filepath" name="<?php echo $classid."[fromcell]"; ?>" placeholder="">
					</div>
					<div class="form-group mrg-15">
					<label for="file">To cell</label>
					<input type="text" class="form-control form-filepath" name="<?php echo $classid."[tocell]"; ?>" placeholder="">
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div></div> 
		<?php 
				break;
		?>
		<?php		
				case 'setrange':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Set Range </h3>
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="form-group">
					<label for="file">From cell</label>
					<input type="text" class="form-control form-filepath" name="" placeholder="">
					</div>
					<div class="form-group mrg-15">
					<label for="file">To cell</label>
					<input type="text" class="form-control form-filepath" name="" placeholder="">
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo41" style="margin-bottom: 0px !important;">Input</button>
					<div class="demo41 collapse in">
					<div class="">
					<div class="form-group">
					<label for="sel1" class="cell-po">select table variable</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[tablevariable]"; ?>">
					<option value="Start of document">Start of document</option>
					<option value="Start of row">Start of row</option>
					<option value="End of Column">End of Column</option>
					<option value="End of row">End of row</option>
					</select></div></div></div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">Title</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Title">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">Style</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="style">
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">X axis</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="X axis">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">y axis</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y axis">
					</div>
					</div>
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column1 from </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column1 to </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					</div>
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column2 from </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column2 to </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">plot on </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">Title</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Title">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">Style</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="style">
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">X axis</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="X axis">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="wait-poling">
					<label for="sel1">y axis</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y axis">
					</div>
					</div>
					</div>
					
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column1 from </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column1 to </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					</div>
					<div class="">
					<!--<div class="select-sh">Select range in active sheet</div>-->
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column2 from </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">column2 to </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label for="file">plot on </label>
					<input type="text" class="form-control width-100" name="" placeholder="">
					</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
								  <label for="sel1" class="cell-po">Workbook Name</label><br>
								  <input type="text" class="form-control width-100" name="<?php echo $classid."[rownumber]"; ?>" placeholder="Workbook Name">
								  </div>
						</div>
					
			  </div>
			<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'exceptionhandling':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Exception Handling</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div></div> 
		<?php 
				break;
		?>
		<?php		
				case 'clipboard':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Clipboard</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div></div>
		<?php 
				break;
		?><?php		
				case 'wait':
		?>

					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Wait</h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label>Image Path </label><br>
							<input type="text" class="form-control form-filepath" name="" placeholder="File">
							<div class="myLabel">
							<input type="file">
							<span>Browse</span>
							</div>
							</div>
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label>Variable</label><br>
							<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
						
							</div>
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label>Variable</label><br>
							<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
						
							</div>
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">Command</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Command">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label>Path to Folder</label><br>
					<input type="text" class="form-control form-filepath" placeholder="File" name="<?php echo $classid."[filelocation]"; ?>">
					
				    </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div></div>
		<?php 
				break;
		?>
		
		<?php		
				case 'createfolder':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>   Create Folder </h3>
					<div class="" style="margin-bottom:20px;">
					<div class="form-group">
					<label>Path</label><br>
					<input type="text" class="form-control form-filepath" placeholder="File" name="<?php echo $classid."[filelocation]"; ?>">
					
				    </div>
					<div class="form-group">
					<label>Name</label><br>
					<input type="text" class="form-control form-filepath" placeholder="File" name="<?php echo $classid."[filelocation]"; ?>">
					
				    </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
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
					<label>Path</label><br>
					<input type="text" class="form-control form-filepath" placeholder="File" name="<?php echo $classid."[filelocation]"; ?>">
					
				    </div>
					<div class="form-group">
					<label>Name</label><br>
					<input type="text" class="form-control form-filepath" placeholder="File" name="<?php echo $classid."[filelocation]"; ?>">
					
				    </div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<div class="" style="margin-bottom:20px;">
					<div class="">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">mode</label><br>
					<select class="form-control width-100" name="">
					<option value="UTF-8">UTF-8</option>
					<option value="UTF-16">UTF-16</option>
					<option value="UTF-32">UTF-32</option>
					<option value="ASCII">ASCII</option>
					</select>
					</div>
					</div>
					</div>
					<div class="form-group">
					<label>Path</label><br>
					<input type="text" class="form-control width-100" placeholder="File" name="">
					
				    </div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'copyfilefolder':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>    Copy File/Folder </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo54">Input</button>
					<div class="demo54 collapse in" style="margin-bottom:20px;">
					<div class="">
					<div class="form-group">
					<label>Original to file or folder</label><br>
					<input type="text" class="form-control form-filepath" name="<?php echo $classid."[filelocation]"; ?>" placeholder="File">
					<div class="myLabel">
					<input type="file">
					<span>File</span>
					</div>
					<div class="myLabel">
					<input type="file">
					<span>Folder</span>
					</div>
					</div>
					<div class="form-group mrg-15" style="margin-top: 15px;">
					<label>Destination Path</label><br>
					<input type="text" class="form-control form-filepath" placeholder="File" name="<?php echo $classid."[destinationpath]"; ?>">
					<div class="myLabel">
					<input type="file">
					<span>File</span>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo55">Mode</button>
					<div class="demo55 collapse in" style="margin-bottom:20px;">
					<div class="">
					<div class="if-h"><h5>Choose action type</h5></div>
					<div class="">
					<div class="radio radio-space">
					<label><input type="radio" name="<?php echo $classid."[action]"; ?>" value="Copy">Copy</label>
					</div>
					<div class="radio">
					<label><input type="radio" name="<?php echo $classid."[action]"; ?>" value="Fail">Move </label>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo56">Options</button>
					<div class="demo56 collapse in" style="margin-bottom:20px;">
					<div class="">
					<div class="if-h"><h5>If file or folder already exists</h5></div>
					<div class="">
					<div class="radio">
					<label><input type="radio" name="<?php echo $classid."[fileexist]"; ?>" value="Overwrite">Overwrite</label>
					</div><br>
					<div class="radio">
					<label><input type="radio"name="<?php echo $classid."[fileexist]"; ?>"  value="Skip">Skip</label>
					</div><br>
					<div class="radio">
					<label><input type="radio" name="<?php echo $classid."[fileexist]"; ?>" value="Fail">Fail </label>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>					
		<?php 
				break;
		?>
		
		<?php		
				case 'getfoldercontents':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Get File/Folder  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo59">Input</button>
					<div class="demo59 collapse in" style="margin-bottom:20px;">
					<div class="form-group">
					<label>Path to Folder</label><br>
					<input type="text" class="form-control form-filepath"  name="<?php echo $classid."[filelocation]"; ?>"  placeholder="File">
					<!-- <div class="myLabel">
					<input type="file">
					<span>File</span>
					</div> -->
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo59-Options">Options</button>
					<div class="demo59-Options collapse in" style="margin-bottom:20px;">
					<div class="">
					<div class="if-h"><h5>Which contents to list</h5></div>
					<div class="">
					<div class="radio">
					<label><input type="radio" value="Files"  name="<?php echo $classid."[list]"; ?>" >Files</label>
					</div><br>
					<div class="radio">
					<label><input type="radio" value="Folder"  name="<?php echo $classid."[list]"; ?>" >Folder</label>
					</div><br>
					<div class="radio">
					<label><input type="radio" value="Files & Folder"  name="<?php echo $classid."[list]"; ?>" >Files & Folder </label>
					</div>
					</div>
					<div class="search-fo" style="">
					<div class="radio">
					<label><input type="checkbox" name="<?php echo $classid."[search]"; ?>" >Search in all sub folders</label>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo60">Filter</button>
					<div class="demo60 collapse in" style="margin-bottom:20px;">
					<div class="border-padd" style="">
					<div class="radio">
					<label><input type="checkbox" name="<?php echo $classid."[regexp]"; ?>"> Name (regexp) </label>
					</div>
					<div class="form-group">
					<input type="text" class="form-control width-100 mrg-15" name="<?php echo $classid."[namereg]"; ?>"  />
					</div>
					</div>
					<div class="col-sm-12 border-padd" style="">
					<div class="col-sm-12" style="padding:0px;">
					<div class="radio" style="margin-bottom:10px;">
					<label><input type="checkbox" name="<?php echo $classid."[kilobytes]"; ?>" > Size (Kilobytes) </label>
					</div>
					</div>
					<div class="col-sm-6" style="padding-left:0px;">
					<div class="form-group">
					<label>From</label>
					<input type="text" name="<?php echo $classid."[from]"; ?>" class="form-control width-100 mrg-15" />
					</div>
					</div>
					<div class="col-sm-6" style="padding-right:0px;">
					<div class="form-group">
					<label>To</label>
					<input type="text" name="<?php echo $classid."[to]"; ?>" class="form-control width-100 mrg-15" />
					</div>
					</div>
					</div>
					<div class="col-sm-12 border-padd" style="">
					<div class="col-sm-12" style="padding:0px;">
					<div class="radio" style="margin-bottom:10px;">
					<label><input type="checkbox" name="<?php echo $classid."[datemodify]"; ?>"> Date Modified </label>
					</div>
					</div>
					<div class="col-sm-12" style="padding:0px;margin-bottom:10px;">
					<div class="">
					<div id="form-id" class="radio ">
					<input class="watch-me" name="<?php echo $classid."[datemodify]"; ?>" type="radio"  checked />Fixed
					<input class="see-me" name="<?php echo $classid."[datemodify]"; ?>" type="radio" style="margin-left:15px;" /> Relative
					</div>
					</div>
					</div>
					<div class="show-me">
					<div class="col-sm-6" style="padding-left:0px;">
					<div class="form-group">
					<label>From</label>
					<input type="text" class="form-control width-100 mrg-15" name="<?php echo $classid."[from]"; ?>"/>
					</div>
					</div>
					<div class="col-sm-6" style="padding-right:0px;">
					<div class="form-group">
					<label>To</label>
					<input type="text" class="form-control width-100 mrg-15" name="<?php echo $classid."[to]"; ?>"/>
					</div>
					</div>
					</div>
					<div class="show-me-two" style="display:none;">
					<div class="col-sm-8" style="padding-left:0px;">
					<div class="form-group">
					<label>In Last</label>
					<input type="text" class="form-control mrg-15" name="<?php echo $classid."[inlast]"; ?>"/>
					</div>
					</div>
					<div class="col-sm-4" style="padding-right:0px;margin-top: 15px;">
					<div class="form-group" >
					<select class="form-control width-100" name="<?php echo $classid."[time]"; ?>">
					<option value="Minutes">Minutes</option>
					<option value="Days">Days</option>
					<option value="Hours">Hours</option>
					</select>
					</div>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo61">Output</button>
					<div class="demo61 collapse in" style="margin-bottom:20px;">
					<div class="">
					<div class="">
					<div class="form-group">
					<label for="sel1" class="cell-po">Save Result to List Variable</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[variablename]"; ?>">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div> 
		<?php 
				break;
		?><?php		
				case 'deletefile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Delete File</h3>
				
					<div class="">
					<div class="form-group" style="margin-bottom:15px;">
					<label>Path</label><br>
					<input type="text" class="form-control form-filepath" name="<?php echo $classid."[filelocation]"; ?>" placeholder="File">
					<div class="myLabel">
					<input type="file">
					<span>File</span>
					</div>
					</div>
					
					<div class="form-group" style="margin-bottom:15px;">
					<label>Name</label><br>
					<input type="text" class="form-control width-100" name="<?php echo $classid."[filelocation]"; ?>" placeholder="Name">
					
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?><?php		
				case 'readfile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>	Read File  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo67">Input</button>
					<div class="demo67 collapse in" style="margin-bottom:20px;">
					<div class="form-group">
					<label>Path to Folder</label><br>
					<input type="text" class="form-control form-filepath" name="<?php echo $classid."[filelocation]"; ?>" placeholder="File">
					<div class="myLabel">
					<input type="file">
					<span>File</span>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo68">Options</button>
					<div class="demo68 collapse in" style="margin-bottom:20px;">
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
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo70">Output</button>
					<div class="demo70 collapse in" style="margin-bottom:20px;">
					<div class="">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to List Variable</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[variablename]"; ?>">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div></div>
		<?php 
				break;
		?>
		<?php		
				case 'stop':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>	Stop  </h3>
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label>Time</label><br>
					<input type="text" class="form-control width-100" name="" placeholder="time">
				
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'mouseclick':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Mouse Click  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo96">Target</button>
					<div class="demo96 collapse in">
					<div id="web-id" class="radio mrg-bottom-15">
					<input class="watch-me4" type="radio" name="<?php echo $classid."[image]"; ?>"  checked />Image 
					<input class="see-me4" type="radio" name="<?php echo $classid."[image]"; ?>" style="margin-left:15px;" />Position
					<div class="show-me4">
					<div class="mrg-bottom-15">
					<div class="row image-s">
					<div class="col-sm-12">
					<div class="form-group" style="margin-bottom:15px;">
					<textarea class="form-control width-100" rows="2" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					<div class="col-sm-6">
					Capture new image
					</div>
					<div class="col-sm-6">
					<input type="file" class="custom-file-input" name="<?php echo $classid."[captureimage]"; ?>"> 
					</div>
					</div>
					</div>
					</div>
					</div>
					<div class="show-me-two4" style="display:none;">
					<div class="mrg-bottom-15">
					<div class="wait-poling mrg-15">X: <span><input type="text" class="ms-point" name="<?php echo $classid."[xaxis]"; ?>" style="margin-right:20px;" placeholder="0" /></span>   Y: <span><input type="text" name="<?php echo $classid."[yaxis]"; ?>" class="ms-point"  placeholder="0" /></span></div>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo99">Options</button>
					<div class="demo99 collapse in">
					<div class="form-group5" style="margin-bottom:15px;">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Button:</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[button]"; ?>">
					<option value="Left Button">Left Button</option>
					<option value="Right Button">Right Button</option>
					<option value="Middile Button">Middile Button</option>
					</select>
					</div>
					<div class="form-group" style="margin-bottom:15px;">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Type</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[type]"; ?>">
					<option value="Single Click">Single Click</option>
					<option value="Double Click">Double Click</option>
					<option value="Triple Click">Triple Click</option>
					<option value="Hold Down">Hold Down</option>
					<option value="Release">Release</option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'mousemove':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Mouse Move  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo91">Target</button>
					<div class="demo91 collapse in">
					<div id="web-id" class="radio mrg-bottom-15">
					<input class="watch-me3" type="radio" name="<?php echo $classid."[image]"; ?>"  checked />Image 
					<input class="see-me3" type="radio" name="<?php echo $classid."[image]"; ?>" style="margin-left:15px;" />Position
					<div class="show-me3">
					<div class="mrg-bottom-15">
					<div class="row image-s">
					<div class="col-sm-12">
					<div class="form-group" style="margin-bottom:15px;">
					<textarea class="form-control width-100" rows="2" name="<?php echo $classid."[comment]"; ?>" ></textarea>
					</div>
					<div class="col-sm-6">
					Capture new image
					</div>
					<div class="col-sm-6">
					<input type="file" class="custom-file-input" name="<?php echo $classid."[captureimage]"; ?>"> 
					</div>
					</div>
					</div>
					</div>
					</div>
					<div class="show-me-two3" style="display:none;">
					<div class="mrg-bottom-15">
					<div class="wait-poling mrg-15">X: <span><input type="text" name="<?php echo $classid."[xaxis]"; ?>" class="ms-point"  style="margin-right:20px;" placeholder="0" /></span>   Y: <span>
						<input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[yaxis]"; ?>"/></span></div>
					</div>
					</div>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">X location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="X location">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">y location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y location">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">X location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="X location">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">y location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y location">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label>Image Location </label><br>
							<input type="text" class="form-control form-filepath" name="" placeholder="File">
							<div class="myLabel">
							<input type="file">
							<span>Browse</span>
							</div>
							</div>
							
					<div class="wait-poling">
					<label for="sel1">X location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="X location">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">y location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y location">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label>Image Location </label><br>
							<input type="text" class="form-control form-filepath" name="" placeholder="File">
							<div class="myLabel">
							<input type="file">
							<span>Browse</span>
							</div>
							</div>
							
					<div class="wait-poling">
					<label for="sel1">X location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="X location">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">y location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y location">
					</div>
					<div class="wait-poling">
					<label for="sel1">Button</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">X location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="X location">
					</div>
					
					<div class="wait-poling">
					<label for="sel1">y location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y location">
					</div>
				
					<div class="wait-poling">
					<label for="sel1">Duration between scrolling</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="">
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<input  name="horizontal" type="radio"   />horizontal 
					<input  name="vertical" type="radio" style="margin-left:15px;" />vertical scroll
					</div>
					<div class="demo101 collapse in">
					<div class="wait-poling mrg-15">Scroll: <span><input type="text" name="<?php echo $classid."[scroll]"; ?>" class="ms-point" style="margin-right:20px;" placeholder="0"></span>   lines: <span>
					<select class="form-control" name="<?php echo $classid."[line]"; ?>">
					<option>Up</option>
					<option>Down</option>
					</select></span></div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label>Value</label><br>
					<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">Key</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1">Command</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="ctrl+c">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label>image location</label><br>
					<input type="text" class="form-control form-filepath" name="" placeholder="image location">
					<div class="myLabel">
					<input type="file">
					<span>File</span>
					</div>
					</div>
					
					<div class="wait-poling">
					<label for="sel1">x location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="x location">
					</div>
					<div class="wait-poling">
					<label for="sel1">y location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y location">
					</div>
					<div class="wait-poling">
					<label for="sel1">value</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					<div class="wait-poling">
					<label for="sel1">Button</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label>image location</label><br>
					<input type="text" class="form-control form-filepath" name="" placeholder="image location">
					<div class="myLabel">
					<input type="file">
					<span>File</span>
					</div>
					</div>
					
					<div class="wait-poling">
					<label for="sel1">x location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="x location">
					</div>
					<div class="wait-poling">
					<label for="sel1">y location</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="y location">
					</div>
					<div class="wait-poling">
					<label for="sel1">value</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					<div class="wait-poling">
					<label for="sel1">Button</label><br>
						<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'enterkeystrokes':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Enter Keystrokes  </h3>
					<div class="web-id" class="radio mrg-bottom-15">
					<input class="watch-me6" name="test" type="radio" name="<?php echo $classid."[keystrokes]"; ?>"  checked />Key combination 
					<input class="see-me6" name="test" type="radio" name="<?php echo $classid."[keystrokes]"; ?>" style="margin-left:15px;" />Type text
					<input class="new-me6" name="test" type="radio" name="<?php echo $classid."[keystrokes]"; ?>" style="margin-left:15px;" />Text from variable
					</div>
					<div class="show-me6">
					<button type="button" class="btn btn-info btn-collapse-custom" style="" data-toggle="collapse" data-target=".key1">Input</button>
					<div class="key1 collapse in">
					<div class="form-group" style="margin-bottom:15px;">
					<label>Key to press</label><br>
					<input type="text" class="form-control form-filepath" placeholder="File" name="<?php echo $classid."[keypress]"; ?>">
					<div class="myLabel">
					<input type="file">
					<span>File</span>
					</div>	
					</div>
					</div>	
					</div>
					<div class="show-me-two6" style="display:none;">
					<button type="button" class="btn btn-info btn-collapse-custom" style="" data-toggle="collapse" data-target=".key1">Input</button>
					<div class="key1 collapse in">
					<div class="form-group" style="margin-bottom:15px;">
					<label>Text to type</label><br>
					<textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>	
					</div>
					<div class="show-me-three6" style="display:none;">
					<div class="form-group mrg-15" style="margin-bottom:15px;">
					<label>variable to type text from</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[variablename]"; ?>">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div> 
		<?php 
				break;
		?><?php		
				case 'ifelse':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> If-else  </h3>
					<div class="wait-poling">
					<label for="sel1">Value1</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Value1">
					</div>
					<div class="wait-poling">
					<label for="sel1">Value2</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Value2">
					</div>
					
					<div class="">
					<div class="form-group" style="margin-bottom:20px;">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Perform the nested actions if: </label><br>
					<div class="col-sm-4">
					<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[performif]"; ?>">
					</div>
					<div class="col-sm-4">
					<select class="form-control width-100" name="<?php echo $classid."[condition]"; ?>">
					<option>equals (=) </option>
					<option>not equals (=)</option>
					<option>greater than (>)< /option>
					<option>greater than (>) or equals (>=) </option>
					<option>less than (<) </option>
					<option>less than or equals (<=)  </option>
					<option>contains  </option>
					<option>not contains  </option>
					<option> is empty  </option>
					<option> is not empty  </option>
					<option> matches regulae expression </option>
					<option> not matches regulae expression </option>
					</select>
					</div>
					<div class="col-sm-4">
					<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[value]"; ?>">
					</div>
					</div>
					</div>
					<div class="wait-poling">
					<label for="sel1">then</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="action number">
					</div>
					<div class="wait-poling">
					<label for="sel1">else</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="action number">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div> 
		<?php 
				break;
		?>
		<?php		
				case 'case':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Switch Case </h3>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'while':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> While </h3>
					<div class="wait-poling">
					<label for="sel1">Value1</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Value1">
					</div>
					<div class="wait-poling">
					<label for="sel1">Value2</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="Value2">
					</div>
					
					<div class="">
					<div class="form-group" style="margin-bottom:20px;">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Perform the nested actions if: </label><br>
					<div class="col-sm-4">
					<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[performif]"; ?>">
					</div>
					<div class="col-sm-4">
					<select class="form-control width-100" name="<?php echo $classid."[condition]"; ?>">
					<option>equals (=) </option>
					<option>not equals (=)</option>
					<option>greater than (>)< /option>
					<option>greater than (>) or equals (>=) </option>
					<option>less than (<) </option>
					<option>less than or equals (<=)  </option>
					<option>contains  </option>
					<option>not contains  </option>
					<option> is empty  </option>
					<option> is not empty  </option>
					<option> matches regulae expression </option>
					<option> not matches regulae expression </option>
					</select>
					</div>
					<div class="col-sm-4">
					<input type="text" class="form-control width-100" placeholder="" name="<?php echo $classid."[value]"; ?>">
					</div>
					</div>
					</div>
					<div class="wait-poling">
					<label for="sel1">then</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="action number">
					</div>
					<div class="wait-poling">
					<label for="sel1">else</label><br>
						<input type="text" name="path" class="form-control width-100" placeholder="action number">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'dowhile':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Do While  </h3>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'repeat':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Repeat  </h3>
					<div class="wait-poling mrg-15">Repeat the nested actions: <span><input type="text" class="ms-point"  placeholder="0" /></span> times</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'retry':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Retry  </h3>
					<div class="wait-poling mrg-15">Retry the nested actions: <span><input type="text" class="ms-point"  placeholder="0" /></span> times</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?><?php		
				case 'foreach':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> For Each  </h3>
					<div class="wait-poling width-600">Perform the nested actions for each: <span> <input type="text" class="form-control ms-point"  placeholder="element" /></span>  <span class="mrg-right-left">in</span>  <select class="form-control">
					<option>UTF-8</option>
					<option>UTF-16</option>
					<option>UTF-32</option>
					<option>ASCII</option>
					</select></div>
					<div class="form-group">
					<label>Filter:</label><br>
					<input type="text" class="form-control width-100" placeholder="">
					</div>  
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'group':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Groups  </h3>
					<div class="form-group" style="margin-bottom:20px;">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Group name </label><br>
					<input type="text" class="form-control width-100" placeholder="">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'openwebsite':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Open website  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".demo80">URL</button>
					<div class="demo80 collapse in">
					<div class="form-group">
					<label>Site URL</label><br>
					<input type="text" class="form-control width-100" placeholder="">
					</div>
					<div class="form-group mrg-15" style="margin-top: 15px;">
					<label>Browser</label><br>
					<select class="form-control width-100">
					<option>Firefox</option>
					<option>Chrome</option>
					<option>Internet Explorer</option>
					</select>
					</div>
					<div class="wait-poling mrg-15" style="margin-top: 15px;">wait up to <span><input type="text" class="ms-point" placeholder="0"></span> milliseconds </div>
					<div class="radio mrg-15" style="margin-bottom:20px;">
					<label><input type="checkbox" name="use">Use incognito mode</label>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Browser</label><br>
					<select class="form-control width-100">
					<option>Chrome</option>
					<option>Firefox</option>
					<option>Internet Explorer</option>
					</select>
					</div>
					
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Url</label><br>
					<input type="text" class="form-control width-100" placeholder="http://">
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					<input class="watch-me33" name="test" type="radio"  checked />Get Value 
					<input class="see-me33" name="test" type="radio" style="margin-left:15px;" /> Set Value
					<input class="new-me33" name="test" type="radio" style="margin-left:15px;" /> Click
					</div>
					<div class="show-me33">
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo84">Options</button>
					<div class="demo84 collapse in">
					<div class="form-group">
					<label>XPath of the element</label><br>
					<input type="text" class="form-control width-100" placeholder="">
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
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					
					
					</div>
					
					
					<div class="show-me-two33" style="display:none;">
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo86">Input</button>
					<div class="demo86 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Use value from variable</label><br>
					<select class="form-control width-100">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo87">Options</button>
					<div class="demo87 collapse in">
					<div class="form-group">
					<label>XPath of the element</label><br>
					<input type="text" class="form-control width-100" placeholder="">
					</div>
					
					</div>
					</div>
					
					
					<div class="show-me-three33" style="display:none;">
					
					<div class="form-group">
					<label>XPath of the element</label><br>
					<input type="text" class="form-control width-100" placeholder="">
					</div>
					
					<div class="form-group">
					<label>Button</label><br>
					<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
					</div>
						
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target="#demo82">Comments</button>
					<div id="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
					</div>
					
		<?php 
				break;
		?>
		
		<?php		
				case 'switchtobrowser':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3>Switch to browser </h3>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'randomvariable':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Random Value  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;"  data-toggle="collapse" data-target=".random1">Variable</button>
					<div class="random1 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select variable</label><br>
					<select class="form-control width-100">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'constantvalue':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Constant Value  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;"  data-toggle="collapse" data-target=".constant1">Variable</button>
					<div class="constant1 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select variable</label><br>
					<select class="form-control width-100">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom"   data-toggle="collapse" data-target=".constant2">Value</button>
					<div class="constant2 collapse in">
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'expression':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Expression  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;"  data-toggle="collapse" data-target=".expression1">Variable</button>
					<div class="expression1 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select variable</label><br>
					<select class="form-control width-100">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'numberformat':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'dateformat':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'stringcontains':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> String Contains  </h3>
			
			<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;"  data-toggle="collapse" data-target=".string1">Input</button>
			 <div class="string1 collapse in">
					<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Extract from:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
			 </div>
			
			
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".string2">Options</button>
		 <div class="string2 collapse in">
			<div class="form-group5" style="">
				<label for="sel1" class="cell-po" style="margin-top:0px !important;">Check Input variable</label><br>
				<div id="web-id" class="radio mrg-bottom-15" style="margin-bottom:15px;">
						<input name="test" type="radio" checked="">Text
						<input name="test" type="radio" style="margin-left:15px;">Regular expression
						
						</div>
				<input type="text" class="form-control width-100 mrg-15" placeholder="">
			</div>					  
		 </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".string3">Output</button>
		 <div class="string3 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'replacetext':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Replace Text  </h3>
			<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;"  data-toggle="collapse" data-target=".replace1">Input</button>
			 <div class="replace1 collapse in">
					<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Replace text in variable:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
			 </div>
			
			
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".replace2">Options</button>
		 <div class="replace2 collapse in">
			<div class="form-group5" style="margin-bottom:15px;">
				<label for="sel1" class="" style="margin-top:0px !important;">Text to find: </label><br>
				<input type="text" class="form-control width-100" placeholder="">
			</div>	
			<div class="form-group5" style="margin-bottom:15px;">
				<label for="sel1" class="" style="margin-top:0px !important;">Replace With: </label><br>
				<input type="text" class="form-control width-100" placeholder="">
			</div>	
			<div class="form-group5" style="">
				<div id="web-id" class="radio mrg-bottom-15">
						<input name="test" type="checkbox" checked="">Case sensitive<br>
						<input name="test" type="checkbox">Replace all
						</div>
			</div>
		 </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".replace3">Output</button>
		 <div class="replace3 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".replace4">Advanced</button>
		 <div class="replace4 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".replace5">Comments</button>
		  <div class="replace5 collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'substring':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Substring  </h3>
		
			<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;"  data-toggle="collapse" data-target=".substring1">Input</button>
			 <div class="substring1 collapse in">
					<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Extract from</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
			 </div>
			
			
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".substring2">Options</button>
		 <div class="substring2 collapse in">
			<div class="form-group5" style="margin-bottom:15px;">
				<label for="sel1" class="" style="margin-top:0px !important;">Start character position </label><br>
				<input type="text" class="form-control width-100" placeholder=""><br>
				<input name="test" type="checkbox" checked="" style="margin-top:15px;">Count from end
			</div>	
			<div class="form-group5" style="margin-bottom:15px;">
				<label for="sel1" class="" style="margin-top:0px !important;">End character position: </label><br>
				<input type="text" class="form-control width-100" placeholder=""><br>
				<input name="test" type="checkbox" style="margin-top:15px;">Count from end
			</div>	
		
		 </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".substring3">Output</button>
		 <div class="substring3 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".substring4">Advanced</button>
		 <div class="substring4 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".substring5">Comments</button>
		  <div class="substring5 collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'substringbetween':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Substring Between  </h3>
		
		<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;"  data-toggle="collapse" data-target=".substring-between1">Input</button>
			 <div class="substring-between1 collapse in">
					<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Extract from</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
			 </div>
			
			
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".substring-between2">Options</button>
		 <div class="substring-between2 collapse in">
			<div class="form-group5" style="margin-bottom:15px;">
				<label for="sel1" class="" style="margin-top:0px !important;">Extract text after:</label><br>
				<input type="text" class="form-control width-100" placeholder=""><br>
				
			</div>	
			<div class="form-group5" style="margin-bottom:15px;">
				<label for="sel1" class="" style="margin-top:0px !important;">Extract text before: </label><br>
				<input type="text" class="form-control width-100" placeholder=""><br>
				
			</div>	
		
		 </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".substring-between3">Output</button>
		 <div class="substring-between3 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
		
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".substring-between4">Advanced</button>
		 <div class="substring-between4 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".substring-between5">Comments</button>
		  <div class="substring-between5 collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'trimwhitespace':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Trim Whitespace  </h3>
		<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".trim1">Input</button>
		 <div class="trim1 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Trim text from:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
	
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".trim2">Output</button>
		 <div class="trim2 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".trim3">Advanced</button>
		 <div class="trim3 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".trim4">Comments</button>
		  <div class="trim4 collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
		
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'changecase':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Change Case  </h3>
		<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px !important;" data-toggle="collapse" data-target=".change-case1">Input</button>
		 <div class="change-case1 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Change text case in variable</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		  
		  <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".change-case2">Options:</button>
		 <div class="change-case2 collapse in">
		 <div class="form-group5">
			<label for="sel1" class="cell-po radio" style="margin-top:0px !important;">Specify how to change case:</label><br>
			<input name="test" type="radio" checked="">Uppercase<br>
			<input name="test" type="radio" >Lowercase<br>
			<input name="test" type="radio" >Sentence case<br>
			<input name="test" type="radio" >Capitalize Each Word<br>
			<input name="test" type="radio" >Toggle Case
		</div>
		</div>
	
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".change-case3">Output</button>
		 <div class="change-case3 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".change-case4">Advanced</button>
		 <div class="change-case4 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".change-case5">Comments</button>
		  <div class="change-case5 collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
		
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'joinstring':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
		<h3> Join Strings  </h3>
		<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px !important;" data-toggle="collapse" data-target=".join-string1">Input</button>
		 <div class="join-string1 collapse in">
			<div id="web-id" class="radio mrg-bottom-15 width-100">
			 
						<div id="">
						
							<div class="form-group">
							<label for="sel1" class="cell-po mrg-bottom-15" style="margin-bottom:15px;">Variable to join:</label>
								<textarea class="form-control width-100" style="margin-bottom:15px; margin-top:15px;" rows="5" id="comment"></textarea>
							</div>
							
							<div class="save-remove mrg-15">
								<button type="button" class="btn btn-info">Save</button>
								<button type="button" class="btn btn-info">Remove</button>
							</div>
							
						</div>
		</div>
		  </div>
		  
		  <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".join-string2">Options:</button>
		 <div class="join-string2 collapse in">
		 <div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Separate element with:</label><br>
									  <select class="form-control width-100">
										<option>Tab </option>
										<option>Comm(,)</option>
										<option>Semicolon(;)</option>
										<option>Window line break ( CR+LF )</option>
										<option>Linux / MacOS line Break ( LF )</option>
									  </select>
									  </div>
		</div>
	
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".join-string3">Output</button>
		 <div class="join-string3 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".join-string4">Advanced</button>
		 <div class="join-string4 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".join-string5">Comments</button>
		  <div class="join-string5 collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'splitstring':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Split Strings  </h3>
		<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px !important;" data-toggle="collapse" data-target=".split-string1">Input</button>
		 <div class="split-string1 collapse in">
			 <div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable to split:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		
		  </div>
		  
		  <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".split-string2">Options:</button>
		 <div class="split-string2 collapse in">
		 <div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Separate element with:</label><br>
									  <select class="form-control width-100">
										<option>Tab </option>
										<option>Comm(,)</option>
										<option>Semicolon(;)</option>
										<option>Window line break ( CR+LF )</option>
										<option>Linux / MacOS line Break ( LF )</option>
									  </select>
									  </div>
									  <input name="test" type="Checkbox" checked="" style="margin-top:10px;">Trim Whitespace<br>
		</div>
	
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".split-string3">Output</button>
		 <div class="split-string3 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".split-string4">Advanced</button>
		 <div class="split-string4 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".split-string5">Comments</button>
		  <div class="split-string5 collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
		
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'getlength':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> Get Length   </h3>
		
		<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px !important;" data-toggle="collapse" data-target=".get-length1">Input</button>
		 <div class="get-length1 collapse in">
			 <div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Get text length of variable:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		
		  </div>
		  
		
	
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".get-length2">Output</button>
		 <div class="get-length2 collapse in">
			<div class="form-group5" style="">
									  <label for="sel1" class="cell-po" style="margin-top:0px !important;">Save Result to:</label><br>
									  <select class="form-control width-100">
										<option> </option>
										<option></option>
										<option></option>
										<option></option>
									  </select>
									  </div>
		  </div>
		
	 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".get-length3">Advanced</button>
		 <div class="get-length3 collapse in">
			<div class="wait-poling">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
		  </div>
		  
		<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target="#get-length4">Comments</button>
		  <div id="get-length4" class="collapse in">
			<textarea class="form-control width-100" rows="5" id="comment"></textarea>
		  </div>
		
					</div>
		<?php 
				break;
		?>
				<?php		
				case 'ocr':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
					<h3> OCR  </h3>
					<button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".ocr0">Target Location</button>
					<div class="ocr0 collapse in">
					<div class="image-section">
					<div class="image-heading">Click on image to edit</div>

					<div class="row image-s">
					<div class="col-sm-12">
					<div class="form-group" style="margin-bottom:15px;">
					<textarea class="form-control width-100" rows="2" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
					<div class="col-sm-6">
					Capture new image
					</div>
					<div class="col-sm-6">
					<input type="file" class="custom-file-input"> 
					</div>
					</div>
					</div>
					</div><button type="button" class="btn btn-info btn-collapse-custom" style="margin-top:0px;" data-toggle="collapse" data-target=".ocr1">Put OCR result into variable</button>
					<div class="ocr1 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;"> Variable Name</label><br>
					<select class="form-control width-100" name="<?php echo $classid."[variablename]"; ?>">
					<option></option>
					<option></option>
					<option></option>
					<option></option>
					</select>
					</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".ocr2">Advanced</button>
					<div class="ocr2 collapse in">
					<div class="wait-poling mrg-15">wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".ocr3">Comments</button>
					<div class="ocr3 collapse in">
					<textarea class="form-control width-100" rows="5" name="<?php echo $classid."[comment]"; ?>"></textarea>
					</div>
					</div>
		<?php 
				break;
		?>
		<?php		
				case 'script':
		?>
					<div class="tab-pane" id="<?php echo $classid ?>">
		<h3> Scripts  </h3>
		
		<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;"> Name</label><br>
					<input type="text" name="" class="form-control width-100" placeholder="" name="<?php echo $classid."[name]"; ?>">
					
					<textarea class="form-control width-100 mrg-15" rows="15" name="<?php echo $classid."[script]"; ?>"></textarea>
					</div>
					<div class="mrg-15">
					<div class="pull-left">
						<a href="#" style="margin-right:10px;">Getting started</a><a href="#">API docs</a>
					</div>
					<div class="pull-right">
						<a href="#">Share script on communiity forum</a>
					</div>
					</div>
		
		 <button type="button" class="btn btn-info btn-collapse-custom"  data-toggle="collapse" data-target=".scripts1">Advanced</button>
		  <div class="scripts1 collapse in">
			<div class="wait-poling mrg-15">wait <span><input type="text" class="ms-point"  placeholder="0" name="<?php echo $classid."[wait]"; ?>" /></span> ms before performing this action</div>
		  </div>
		  
		  
		  <button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".scripts2">Comments</button>
		  <div class="scripts2 collapse in">
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
							<label for="sel1" class="width-100">List of element <span  class="pull-right"><i id="btn1" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-3">
							<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
							</div>
						</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label for="sel1" class="width-100">List of element <span  class="pull-right"><i id="btn1" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-3">
							<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
							</div>
						</div>
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label for="sel1">Value1</label><br>
							<input type="text" name="path" class="form-control width-100" placeholder="Value1">
						</div>
						<div class="wait-poling">
							<label for="sel1">Value2</label><br>
							<input type="text" name="path" class="form-control width-100" placeholder="Value2">
						</div>
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label for="sel1" class="width-100">List of element <span  class="pull-right"><i id="btn1" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-3">
							<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
							</div>
						</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label for="sel1">Value</label><br>
							<input type="text" name="path" class="form-control width-100" placeholder="Value">
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label for="sel1">Value</label><br>
							<input type="text" name="path" class="form-control width-100" placeholder="Value">
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label for="sel1">Value1</label><br>
							<input type="text" name="path" class="form-control width-100" placeholder="Value1">
						</div>
						
						<div class="wait-poling">
							<label for="sel1">Variable</label><br>
							<select class="form-control width-100">
							<option></option>
							<option></option>
							<option></option>
							<option></option>
							</select>
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
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
							<label for="sel1">Value1</label><br>
							<input type="text" name="path" class="form-control width-100" placeholder="Value1">
						</div>
						
						<div class="wait-poling">
							<label for="sel1">Value2</label><br>
							<input type="text" name="path" class="form-control width-100" placeholder="Value2">
						</div>
						
						<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85">Output</button>
					<div class="demo85 collapse in">
					<div class="form-group">
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Set value to variable</label><br>
							<div class="col-sm-6">		
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Return Type</label><br>							
							<select class="form-control width-100">
											<option>none</option>
											<option>int</option>
											<option>float</option>
											<option>string</option>
											<option>text</option>
											<option>byte text</option>
											<option>json</option>
											<option>table</option>
											
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Variable</label><br>
								<select class="form-control width-100">
											<option></option>
											<option></option>
											<option></option>
											<option></option>
											</select>
							</div>
					</div>
					</div>
					
					
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15" style="" data-toggle="collapse" data-target=".demo85-we">On Failure</button>
					<div class="demo85-we collapse in">
					<div class="form-group add-select-variable">
					<label for="sel1" class="cell-po width-100" style="margin-top:0px !important;">Set value to variable<span class="pull-right"><i id="btn2" class="add-element-button fa fa-plus"></i></span></label><br>
							<div class="col-sm-6">		
					<label for="sel1" class="cell-po" style="margin-top:0px !important;">Select</label><br>							
							<select class="form-control width-100">
											<option>Select</option>
											<option>Wait Time</option>
											<option>Retry</option>
											<option>Next Action</option>
											<option>Search On Windows</option>
											</select>
							
							</div>
							
							<div class="col-sm-6">
							<label for="sel1" class="cell-po" style="margin-top:0px !important;">Value</label><br>
								<input type="text" class="form-control width-100" placeholder="">
							</div>
					</div>
					</div>
					
					<button type="button" class="btn btn-info btn-collapse-custom mrg-15"  data-toggle="collapse" data-target=".demo81">Advanced</button>
					<div class="demo81 collapse in">
					<div class="wait-poling">Wait <span><input type="text" class="ms-point"  placeholder="0" /></span> ms before performing this action</div>
					<div class="wait-poling">Next action <span><input type="text" class="ms-point"  placeholder="0" /></span> </div>
					</div>
					<button type="button" class="btn btn-info btn-collapse-custom" data-toggle="collapse" data-target=".demo82">Comments</button>
					<div class="demo82 collapse in">
					<textarea class="form-control width-100" rows="5" id="comment"></textarea>
					</div>
					</div>
					
		<?php 
				break;
		?>
		
		<?php 
		
				default:
			
				break;
	}
?>
	
	
	