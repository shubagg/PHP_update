<?php
    function add_chatroom_webservice()
	{
		$postvar = get_post_data();
		$return=add_chatroom($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  


	}

	function add_chatroom_user_webservice()
	{
		$postvar = get_post_data();
		$return=add_chatroom_user($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
	}
    
    
    function adduserinchat_webservice()
	{
		$postvar = get_post_data();
		$return=adduserinchat($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
	}
    function getuserinchat_webservice()
	{
		$postvar = get_post_data();
		$return=getuserinchat($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
	}
    function deleteuserinchat_webservice()
	{
		$postvar = get_post_data();
		$return=deleteuserinchat($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
	}


	function chat_webservice_manage_user_chat_activity()
	{
		$postvar=get_post_data();
        $return=manage_user_chat_activity($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
	}

	function chat_webservice_get_all_chat_user()
	{
		$postvar=get_post_data();
        $return=get_all_chat_user($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
	}
    

    function resource_webservice_get_friend_data_by_id()
    {
        $postvar=get_post_data();
        $return=get_friend_data_by_id($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
    }

    function resource_webservice_manage_chat_user()
    {
        $postvar=get_post_data();
        $return=manage_chat_user($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
    }

    function resource_webservice_delete_chat_user_data()
    {
        $postvar=get_post_data();
        $return=delete_chat_user_data($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"35");  
    }
    
?>