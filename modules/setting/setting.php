<?php
$module->add("setting","setting module","setting",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("setting","core/functions.php"));
include_once(include_module_path("setting","interface/webservice_functions.php"));

function setting_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}
?>