<?php
$module->add("report","report module","report",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("report","core/functions.php"));
include_once(include_module_path("report","interface/webservice_functions.php"));

function report_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>