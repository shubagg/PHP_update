<?php
    function event_webservice_manage_event()
	{
		$postvar = get_post_data();
		$result = manage_event($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
	}
    
    function event_webservice_get_event_by_id()
	{
		$postvar = get_post_data();     
		$result = get_event_by_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
	}
    
    function event_webservice_delete_event()
    {
        $postvar = get_post_data();
		$result = delete_event($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
    }
	
	function event_webservice_manage_event_category()
	{
		$postvar = get_post_data();
		$result = manage_event_category($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
	}
    
    function event_webservice_get_event_category_by_id()
	{
		$postvar = get_post_data();     
		$result = get_event_category_by_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
	}
?>