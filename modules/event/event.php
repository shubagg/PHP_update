<?php
$module->add("event","event module","event",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("event","core/functions.php"));
include_once(include_module_path("event","interface/webservice_functions.php"));

function event_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>