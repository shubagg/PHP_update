<?php
$module->add("mediaTemp","media module","media",array('all','view'));
//$role->set_role("recorder");
include_once(include_module_path("media","core/resize.php"));
include_once(include_module_path("media","core/getid3/getid3.php"));
include_once(include_module_path("mediaTemp","core/functions.php"));
include_once(include_module_path("mediaTemp","interface/webservice_functions.php"));

function mediaTemp()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>