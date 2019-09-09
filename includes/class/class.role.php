<?php 
class role {

	public $role;

	 function __construct(){
	 	$this->role = array();
	 }

	 function set_role($role)
	 {
	 	array_push($this->role,$role);
	 }

	 function get_role()
	 {
	 	return $this->role;
	 }
}

?>