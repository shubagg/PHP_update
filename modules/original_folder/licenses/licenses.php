<?php
$module->add("licenses","Licenses module","licenses",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("licenses","core/functions.php"));
include_once(include_module_path("licenses","interface/webservice_functions.php"));

function licenses_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>