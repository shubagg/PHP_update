<?php
$module->add("comment","comment module","comment",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("comment","core/functions.php"));
include_once(include_module_path("comment","interface/webservice_functions.php"));

function comment_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>