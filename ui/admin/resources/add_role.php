<?php
include_once '../../../global.php';
if(isset($_REQUEST['role_add']))
{
	$role = $_REQUEST['role'];
	$permission = $_REQUEST['permission'];
	//create_role($role,$permission,"-1");
	curl_post($webservice_url."/add_roles",array('role'=>$role,'permission'=>$permission));
}
?>
<h1>Add Role</h2>
<?php

$roles = $module->get_roles();
foreach ($roles as $key => $value) {
	echo $key."<ul>";
	foreach ($value as $key1 => $value1)
	{
		echo "<li>{$value1}   - (".strtolower($key)."-".strtolower($value1).")</li>";
	}
	echo "</ul>";
}
?>
<hr>
<h2>Current Role</h2>
<pre>
<?php 
$role="Writer";
$permission='55d6be439c7684c407000001-view,55d6be439c7684c407000002-view,55d6be439c7684c407000003-view,55d6be439c7684c407000004-view,55d6be439c7684c407000005-view';


//update role
//$update_role=curl_post($webservice_url."/edit_role",array('role_id'=>'55d6c1989c7684b407000002','role'=>$role,'permission'=>$permission));

//delete role
$delete_role=curl_post($webservice_url."/delete_role",array('role_id'=>'55d727539c76848407000000'));


$role12 = curl_post($webservice_url."/get_roles",array("role_id"=>"55d727539c76848407000000"));
print_r($role12);

?>
</pre>
<hr>
<form>
Role : <input type="text" name="role" value="">
permissions : <input type="text" name="permission" value="">
<input type="submit" name="role_add">
</form>