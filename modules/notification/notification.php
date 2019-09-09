<?php
$module->add("notification","notification module","notification",array('all','view'));
//$role->set_role("recorder");
include_once(include_module_path("notification","core/ntfc/class/auto_mail.php"));
include_once(include_module_path("notification","core/json.php"));
$json_obj=new Json();
include_once(include_module_path("notification","core/functions.php"));
include_once(include_module_path("notification","interface/webservice_functions.php"));

function notification_init()
{
	//echo "module_initilise";
	//user_extend(array('test_field1','test_field2'));
}

?>