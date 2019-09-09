<?php
class User{

	public $id;
	public $email;
	public $username;
	public $fullname;
	public $profile_pic;
	public $status;
	public $date_of_joining;

	function __construct() {
		$this->id=1;;
		$this->email="nav@nav.com";
		$this->username="nav-user";
		$this->fullname="nav-full";
		$this->profile_pic="http://webexperts.info/nav/webservice/assets/thumb.jpg";
		$this->status=1;
	}

	public function get_profile()
			{
				return array('ID'=>$this->id,'username'=>$this->username,'email'=>$this->email,'profile_pic'=>$this->profile_pic,'fullname'=>$this->fullname);
			}
	
	public function update_profile()
			{
				return array('ID'=>$this->id,'username'=>$this->username,'email'=>$this->email,'profile_pic'=>$this->profile_pic,'fullname'=>$this->fullname);
			}
}
?>