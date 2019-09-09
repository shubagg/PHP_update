<?php
    function oauth_webservice_get_oauth_token()
	{
		$postvar = get_post_data();
		$arr = get_oauth_token($postvar);
		rs($arr['data'],$arr['error_code'],$arr['success'],"8");
	}
    function oauth_webservice_verify_token()
	{
		$postvar = get_post_data();
		$arr = verify_token($postvar);
		rs($arr['data'],$arr['error_code'],$arr['success'],"8");
	}
	function oauth_webservice_refresh_token()
	{
		$postvar = get_post_data();
		$arr = refresh_token($postvar);
		rs($arr['data'],$arr['error_code'],$arr['success'],"8");
	}

	function oauth_webservice_get_hexa_permissions()
	{
		$postvar = get_post_data();
		$arr = get_hexa_permissions($postvar);
		rs($arr['data'],$arr['error_code'],$arr['success'],"8");
	}

	function oauth_webservice_check_hexa_permission()
	{
		$postvar = get_post_data();
		$arr = check_hexa_permission($postvar);
		rs($arr['data'],$arr['error_code'],$arr['success'],"8");
	}


?>