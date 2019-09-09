<?php

    function resource_webservice_manage_category()
	{
		$postvar=get_post_data();
        $return=manage_category($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
	}
    function resource_webservice_get_user_associate_item_list()
    {
        $postvar=get_post_data();
        $return=get_user_associate_item_list($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }
    
    function resource_webservice_delete_category()
    {
        $postvar=get_post_data();
        $return=delete_category($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_difference_user_after_change_setting()
    {
       // $return['data'] = get_post_data();
        //$return['error_code'] = '200';
        //$return['success'] = '100';
        $postvar=  get_post_data();
        $return=set_notification_location($postvar);

        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function resource_webservice_get_user_category()
    {
        $postvar=get_post_data();
        $return=get_user_category($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_user_categories()
    {
        $postvar=get_post_data();
        $return=get_user_categories($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_category_users()
    {
        $postvar=get_post_data();
        $return=get_category_users($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_category()
	{
	    $postvar=get_post_data();
        $return=get_category($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
	}

    function resource_webservice_get_category_tree()
    {
        $postvar=get_post_data();
        $return=get_tree($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
        
    function resource_webservice_get_resource_by_id()
    {
        $postvar=get_post_data();
        $return=get_resource_by_id($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function resource_webservice_get_users()
    {
        $postvar=get_post_data();
        $return=get_users($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function resource_webservice_manage_user()
	{
		$postvar=get_post_data();
        $return=manage_user($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
	}
    
    function resource_webservice_delete_user()
    {
        $postvar = get_post_data();
        $return=delete_user($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_role()
	{
	    $postvar = get_post_data();
        $return=get_roles($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
	}
    
    
    function resource_webservice_manage_roles()
	{
	    $postvar = get_post_data();
        $return=manage_role($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
	}
    
    function resource_webservice_delete_role()
	{
	    $postvar = get_post_data();
        $return=delete_role($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
	}
    
    function resource_webservice_manage_modules()
    {
        $postvar = get_post_data();
        $return=manage_module($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_module()
    {
        $postvar = get_post_data();
        $return=get_modules($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_manage_social_users()
    {
        $postvar = get_post_data();
        $return=manage_social_users($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_user_login()
    {
        $postvar = get_post_data();
        $return=user_login($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    
    function resource_webservice_manage_permission()
    {
        $postvar = get_post_data();
        $return=manage_permission($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_permission()
    {
        $postvar = get_post_data();
        $return=get_permission($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
     function resource_webservice_add_manager()
    {
        $postvar = get_post_data();
        $return=manage_manager($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_get_user_manager()
    {
        $postvar = get_post_data();
        $return=get_user_manager($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_enroll()
    {
        $postvar = get_post_data();
        $return=enroll($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_enrolled()
    {
        $postvar = get_post_data();
        $return=get_enrolled($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_all_users_enrolled_to_item()
    {
        $postvar = get_post_data();
        $return=get_all_users_enrolled_to_item($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_users_by_enroll_itemid() {
        $postvar = get_post_data();
        $return=get_all_users_by_enrollment($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_delete_category_enrolled_to_item()
    {
        $postvar = get_post_data();
        $return=delete_category_enrolled_to_item($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_items_enrolled()
    {
        $postvar = get_post_data();
        $return=get_items_enrolled($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_update_category_child()
    {
        $postvar=get_post_data();
        $return=update_category_child($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }

    function resource_webservice_get_user_category_manager()
    {
        $postvar=get_post_data();
        $return=get_user_category_manager($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function resource_webservice_get_category_managers()
    {
        $postvar=get_post_data();
        $return=get_category_managers($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function resource_webservice_check_device_id()
    {
        $postvar=get_post_data();
        $return=check_device_id($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_user_info_by_id()
    {
        $postvar=get_post_data();
        $return=get_user_info_by_id($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_tree()
    {
        $postvar=get_post_data();
        $return=get_tree($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_all_parent_category()
    {
        $postvar=get_post_data();
        $return=get_all_parent_category($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_all_users()
    {
        $postvar=get_post_data();
        $return=get_all_users($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_manage_login_attempt_logs()
    {
        $postvar=get_post_data();
        $return=manage_login_attempt_logs($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_login_attempt_logs()
    {
        $postvar=get_post_data();
        $return=get_login_attempt_logs($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_delete_login_attempt_logs()
    {
        $postvar=get_post_data();
        $return=delete_login_attempt_logs($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_manage_login_details()
    {
        $postvar=get_post_data();
        $return=manage_login_details($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_login_details()
    {
        $postvar=get_post_data();
        $return=get_login_details($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_failed_login_data()
    {
        $postvar=get_post_data();
        $return=get_failed_login_data($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_delete_failed_login_data()
    {
        $postvar=get_post_data();
        $return=delete_failed_login_data($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_insert_failed_login_data()
    {
        $postvar=get_post_data();
        $return=insert_failed_login_data($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_urgency_data()
    {
        $postvar=get_post_data();
        $return=get_urgency_data($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    //Nilesh Sahu
    function resource_webservice_manage_common_used_personnel()
    {
        $postvar = get_post_data();
        $result = manage_common_used_personnel($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"7");
    }

    function resource_webservice_delete_common_used_personnel()
    {
        $postvar = get_post_data();
        $result = delete_common_used_personnel($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"7");
    }


    function resource_webservice_get_common_used_personnel_by_id()
    {
        $postvar = get_post_data();
        $result = get_common_used_personnel_by_id($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"7");
    }
    //Nilesh Sahu
    

    function resource_webservice_get_min_max_data()
    {
        $postvar = get_post_data();
        $result = get_min_max_data($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"7");
    }

    function resource_webservice_register_confirmation()
    {
        $postvar=get_post_data();
        $return=register_confirmation($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }


    function resource_webservice_forgot_password_confirmation()
    {
        $postvar=get_post_data();
        $return=forgot_password_confirmation($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }


    function resource_webservice_forgot_password_recovery()
    {
        $postvar=get_post_data();
        $return=forgot_password_recovery($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_update_urgency_data()
    {
        $postvar=get_post_data();
        $return=update_urgency_data($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_manage_languages()
    {
        $postvar=get_post_data();
        $return=manage_languages($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_languages()
    {
        $postvar=get_post_data();
        $return=get_languages($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_delete_languages()
    {
        $postvar=get_post_data();
        $return=delete_languages($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }


    function resource_webservice_manage_google_sso()
    {
        $postvar=get_post_data();
        $return=manage_google_sso($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_google_sso_login()
    {
        $postvar=get_post_data();
        $return=google_sso_login($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_get_id_by_google_sso()
    {
        $postvar=get_post_data();
        $return=get_id_by_google_sso($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_user_logout()
    {
        $postvar=get_post_data();
        $return=user_logout($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function resource_webservice_check_parent_category_code_fields()
    {
        $postvar=get_post_data();
        $return=check_parent_category_code_fields($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function export_webservice_check_image_exists()
    {
        $postvar=get_post_data();
        $return=check_image_exists($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }
    function resource_webservice_get_user_hirarchy()
    {
        $postvar=get_post_data();
        $return=get_user_hirarchy($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }

    function resource_webservice_get_logs_string()
    {
        $postvar=get_post_data();
        $return=get_logs_string($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }
    function resource_webservice_adv_save_query()
    {
        $postvar=get_post_data();
        $return=manage_adv_save_query($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }
    function resource_webservice_get_saved_queries()
    {
        $postvar=get_post_data();
        $return=get_saved_queries($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }

    function resource_webservice_social_login()
    {
        $postvar=get_post_data();
        $return=social_login($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }

    function resource_webservice_signout_robot()
    {
        $postvar=get_post_data();
        $return=signout_robot($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1");  
    }
   
    
    
?>
