<?php  
$html='<div class="form-group">
		<label class="control-label">'.$label.'</label>
		<div>
				<div class="row">
						<div class="input-group date chart_form_datetime col-lg-6" data-picker-position="bottom-left"  data-date-format="yy-mm-dd" >
								<input type="text" class="form-control" name='.$name.' value='.$val.'>
								<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
								<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
						</div>
				</div>
		</div>
		</div>  
	';
?>