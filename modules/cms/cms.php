<?php

$module->add("cms","csm module","cms",array('all'));


include_once(include_module_path("cms","core/functions.php"));
include_once(include_module_path("cms","exports/functions.php"));
include_once(include_module_path("cms","interface/webservice_functions.php"));


function cms_init()
{
	
}

//errorcode
//409=>lat long should be valid
//410=>Not Found
//411=>incorrect mode should be air or road
?>