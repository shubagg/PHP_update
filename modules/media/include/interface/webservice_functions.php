<?php
    function media_webservice_manage_media()
	{
		$postvar = get_post_data();
		$result = manage_media($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
	}
    
    function media_webservice_get_media_by_amid()
	{
		$postvar = get_post_data();
		$result = get_media_by_amid($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
	}
    
    function media_webservice_get_media_by_smid()
	{
		$postvar = get_post_data();
		$result = get_media_by_smid($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
	}
    
    function media_webservice_get_media_by_id()
	{
		$postvar = get_post_data();
		$result = get_media_by_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
	}
    
    function media_webservice_get_media_by_date()
	{
		$postvar = get_post_data();
		$result = get_media_by_date($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
	}
    
    function media_webservice_delete_media()
	{
		$postvar = get_post_data();
		$result = delete_media($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
	}

    function media_webservice_get_media_by_type()
    {
        $postvar = get_post_data();
		$result = get_media_by_type($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
    }
    

?>