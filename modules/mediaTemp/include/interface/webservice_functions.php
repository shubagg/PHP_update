<?php
    function media_webservice_manage_media_temp()
	{
		$postvar = get_post_data();
		$result = manage_media_temp($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"10");
	}
?>