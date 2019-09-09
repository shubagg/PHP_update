<?php
$font = '';
if (isset($manSymbol) && $manSymbol != '') {
    $font = '<font class="color">*</font>';
}
if (isset($heading) && $heading == 'no') {
    $html = '
		<input type="' . $type . '" id="' . $id . '" name="' . $name . '" ' . $attributes . ' class="form-control ' . $classes . '" value="' . $value . '"  placeholder="' . $placeholder . '"/>
	    <span id="e' . $id . '" class="error"></span>
    ';
} else {
    if ($type == 'password') {
        $html = '<div class="form-group ' . $class1 . '" ' . $condition . '>
	<label class="control-label remove_bg">' . $label . $font . '</label>
	<div>
		<input type="' . $type . '" id="' . $id . '" name="' . $name . '" ' . $attributes . ' class="form-control ' . $classes . '" value="' . $value . '"  placeholder="' . $placeholder . '"/>
		<span toggle="#' . $id . '" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	    <span id="e' . $id . '" class="error"></span>
    </div>
	</div>';
    } else {
        $html = '<div class="form-group ' . $class1 . '" ' . $condition . '>
	<label class="control-label remove_bg">' . $label . $font . '</label>
	<div>
		<input type="' . $type . '" id="' . $id . '" name="' . $name . '" ' . $attributes . ' class="form-control ' . $classes . '" value="' . $value . '"  placeholder="' . $placeholder . '"/>
	    <span id="e' . $id . '" class="error"></span>
    </div>
	</div>';
    }
}
?>