<?php
	$scid=0;
	function getSubCompanyStatus(){
		if(!isset($sub_Company_access))
			return 0;
		global $sub_Company_access;
		return $sub_Company_access;
	}
	function getSubCompanyId(){
		global $scid;
		return $scid;
	}
?>