<?php

$module->add("location1","Location module","location1",array('all'));


include_once(include_module_path("location1","core/functions.php"));
include_once(include_module_path("location1","interface/webservice_functions.php"));


function location1_init()
{
	
}

//errorcode
//409=>lat long should be valid
//410=>Not Found
//411=>incorrect mode should be air or road
?>