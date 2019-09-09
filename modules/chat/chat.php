<?php
$module->add("chat","chat module","chat",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("chat","core/functions.php"));
include_once(include_module_path("chat","interface/webservice_functions.php"));

function chat_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}



?>