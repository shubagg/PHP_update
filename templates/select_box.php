<?php  

if(isset($heading) && $heading=='no'){

	$html='
		
	    <select id="'.$id.'" name="'.$name.'" class="form-control '.$classes.'" '.$attributes.'>
        '.$option_result.'
        
        </select>
        <span id="e'.$id.'" class="error"></span>
    ';

}
else
{

	$html='<div class="form-group">
	<label class="control-label remove_bg">'.$label.'</label>
	<div>
		
	    <select id="'.$id.'" name="'.$name.'" class="form-control '.$classes.'" '.$attributes.'>
        '.$option_result.'
        
        </select>
        <span id="e'.$id.'" class="error"></span>
    </div>
	</div>';

}


?>