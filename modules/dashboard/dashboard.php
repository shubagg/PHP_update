<?php
$module->add("dashboard","dashboard module","dashboard",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("dashboard","core/functions.php"));
include_once(include_module_path("dashboard","interface/webservice_functions.php"));

function dashboard_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>