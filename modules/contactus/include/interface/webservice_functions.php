<?php

function webservice_add_contactus()
	{
		$postvar = get_post_data();
		$result = add_contactus($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
	}
function webservice_get_contactus()
	{
		$postvar = get_post_data();     
		$result = get_contactus_by_id($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
	}
function webservice_delete_contactus()
    {
        $postvar = get_post_data();
		$result = delete_contactus($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"25");
    }	

?>