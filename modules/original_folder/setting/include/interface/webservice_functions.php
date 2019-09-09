<?php

    function setting_webservice_manage_setting()
	{
		$postvar = get_post_data();        
        $result = manage_setting($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
    
    function setting_webservice_get_setting_by_mid()
	{
		$postvar = get_post_data();     
        $result = get_setting_by_mid($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

    
    function setting_webservice_delete_setting()
	{
		$postvar = get_post_data();        
        $result = delete_setting($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_manage_user_setting()
	{
		$postvar = get_post_data();        
        $result = manage_user_setting($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_get_user_setting()
	{
		$postvar = get_post_data();        
        $result = get_user_setting($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
    
    function setting_webservice_manage_module_setting()
	{
		$postvar = get_post_data();        
        $result = manage_module_setting($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_manage_submodule_setting()
	{
		$postvar = get_post_data();        
        $result = manage_submodule_setting($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_get_module_json()
	{
		$postvar = get_post_data();        
        $result = get_module_json($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_get_module_setting_by_mid()
	{
            $postvar = get_post_data();        
            $result = get_module_setting_by_mid($postvar);
            rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_get_module_permission()
	{
            $postvar = get_post_data();        
            $result = get_module_permission($postvar);
            rs($result['data'],$result['error_code'],$result['success'],"18");
	}
        
        function setting_webservice_get_roles() {
            $postvar = get_post_data();
            $result = get_module_roles($postvar);
            rs($result['data'],$result['error_code'],$result['success'],"18");
        }
        
	function setting_webservice_get_submodule_id()
	{
		$postvar = get_post_data();        
        $result = get_submodule_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
	function setting_webservice_get_module_name()
	{
		$postvar = get_post_data();        
        $result = get_module_name($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_get_submodule_name()
	{
		$postvar = get_post_data();        
        $result = get_submodule_name($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}

	function setting_webservice_change_module_status()
	{
		$postvar = get_post_data();        
        $result = change_module_status($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
	function setting_webservice_manage_email()
	{
		$postvar = get_post_data();        
        $result = manage_email($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
	function setting_webservice_get_email_by_id()
	{
		$postvar = get_post_data();        
        $result = get_email_by_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
	function setting_webservice_delete_email()
	{
		$postvar = get_post_data();        
        $result = delete_emails($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
	function setting_webservice_update_email()
	{
		$postvar = get_post_data();        
        $result = update_email($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"18");
	}
?>