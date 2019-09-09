<?php 
class module {

	public $module;
	public $role;
	 function __construct()
	 {
	 	$this->module = array();
	 	$this->role = array();
	 }
	 function add($name="",$description="",$path="",$role)
	 {
	 	array_push($this->module,array("name"=>$name,"desc"=>$description,"path"=>$path,"role"=>$role));
	 	foreach ($role as $val)
	 	{
	 		array_push($this->role,array("module"=>$name,"role"=>$val));
	 	}
	 }

	 function get_modules()
	 {
	 	return $this->module;
	 }

	 function get_module($name)
	 {
	 	foreach ($this->module as $val)
	 	{
	 		if($val[name]==$name)
	 			return $val;
	 	}
	 }

	 function get_roles()
	 {
	 	$tmp = array();
	 	foreach ($this->role as $key => $value) {
				if(!isset($tmp[$value['module']]))
				{
					$tmp[$value['module']]=array();
				}
				array_push($tmp[$value['module']],$value['role']);
			
				
		}
	 	return $tmp;
	 }

	 function get_roles_str()
	 {
	 	$arr = array();
	 	$roles = $this->get_roles();
		foreach ($roles as $key => $value) {
			foreach ($value as $key1 => $value1)
				array_push($arr,"{$key}-{$value1}");
		}
		return $arr;
	 }

}
$module = new module();

?>