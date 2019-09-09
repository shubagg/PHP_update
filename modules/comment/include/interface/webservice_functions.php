<?php
    function comment_webservice_manage_like()
	{
		$postvar = get_post_data();
		$result = manage_like($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_get_count()
	{
		$postvar = get_post_data();
		$result = get_count($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_manage_rating()
	{
		$postvar = get_post_data();
		$result = manage_rating($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_get_user_rating()
	{
		$postvar = get_post_data();
		$result = get_user_rating($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_get_aiid_rating()
	{
		$postvar = get_post_data();
		$result = get_aiid_rating($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_manage_comment()
	{
		$postvar = get_post_data();
        $result = manage_comment($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_update_comment_status()
	{
		$postvar = get_post_data();
        $result = update_comment_status($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_delete_comment()
	{
		$postvar = get_post_data();
        $result = delete_comment($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_get_comment_by_id()
	{
		$postvar = get_post_data();
		$result = get_comment_by_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    function comment_webservice_get_comments()
	{
		$postvar = get_post_data();
		$result = get_comments($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}

    
    function comment_webservice_manage_comment_data()
	{
		$postvar = get_post_data();
		$result = manage_comment_data($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}

	function comment_webservice_get_comment_data()
	{
		$postvar = get_post_data();
		$result = get_comment_data($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"8");
	}
    
    

	
?>