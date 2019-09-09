<?php
$module->add("faq","faq module","faq",array('all','view'));
//$role->set_role("recorder");


include_once(include_module_path("faq","core/functions.php"));
include_once(include_module_path("faq","interface/webservice_functions.php"));

function faq_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>