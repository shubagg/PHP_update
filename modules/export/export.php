<?php
$module->add("export","Export module","export",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("export","core/functions.php"));
include_once(include_module_path("export","interface/webservice_functions.php"));

function export_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>