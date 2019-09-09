<?php
$module->add("oauth","oauth module","oauth",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("oauth","core/functions.php"));
include_once(include_module_path("oauth","interface/webservice_functions.php"));

function oauth_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>