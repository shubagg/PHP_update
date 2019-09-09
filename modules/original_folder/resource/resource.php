<?php
$module->add("resource","Resource module","resource",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("resource","core/functions.php"));
include_once(include_module_path("resource","interface/webservice_functions.php"));

function resource_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>