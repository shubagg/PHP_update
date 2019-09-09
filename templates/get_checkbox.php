<?php
$radioButtonResult=json_decode($checkBoxResult, true);
$html.='<div class="form-group '.$class.'">
   <label class="control-label remove_bg col-md-4"><span class="color"><span class="color">'.$label.'</span></span></label>
	<div class="margn-tp-10">';
	foreach($radioButtonResult as $radioButton) {
		$result=explode(':', $radioButton);
	$html.='<input type='.$type.' name='.$name.' value='.$result[1].' id='.$result[2].' > '.$result[0].'</input>';
}
	    
 ?>
