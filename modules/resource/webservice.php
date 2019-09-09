<?php
    $app->post('/get_category','resource_webservice_get_category');  // logger done
    $app->post('/manage_category','resource_webservice_manage_category');  // logger done
    $app->post('/delete_category','resource_webservice_delete_category');  // logger done
    $app->post('/get_user_category','resource_webservice_get_user_category');  // logger done
    $app->post('/get_category_users','resource_webservice_get_category_users');  // logger done
    $app->post('/update_category_child','resource_webservice_update_category_child');  // logger done
    $app->post('/get_user_category_manager','resource_webservice_get_user_category_manager');  // 
    $app->post('/get_category_managers','resource_webservice_get_category_managers');  // logger done
    $app->post('/get_tree','resource_webservice_get_tree');  // logger done
    $app->post('/get_all_parent_category','resource_webservice_get_all_parent_category');  // logger done
    $app->post('/get_all_users','resource_webservice_get_all_users');  // logger done
    $app->post('/get_user_hirarchy','resource_webservice_get_user_hirarchy');  // logger done
    

    $app->post('/get_category_tree','resource_webservice_get_category_tree'); 
    $app->post('/get_user_categories','resource_webservice_get_user_categories'); 

    $app->post('/manage_social_users','resource_webservice_manage_social_users');
    $app->post('/user_login','resource_webservice_user_login');
    $app->post('/get_users','resource_webservice_get_users');  // logger done
    $app->post('/get_resource_by_id','resource_webservice_get_resource_by_id');   // logger done
    $app->post('/manage_user','resource_webservice_manage_user');  // logger done
    $app->post('/delete_user','resource_webservice_delete_user');  // logger done
    
    $app->post('/add_manager','resource_webservice_add_manager');  // logger done
    $app->post('/get_user_manager','resource_webservice_get_user_manager');  // logger done


    $app->post('/get_roles','resource_webservice_get_role');  // logger done
    $app->post('/manage_roles','resource_webservice_manage_roles');  // logger done
    $app->post('/delete_role','resource_webservice_delete_role');  // logger done



    $app->post('/manage_modules','resource_webservice_manage_modules');
    $app->post('/get_module','resource_webservice_get_module');
    
    $app->post('/manage_permission','resource_webservice_manage_permission');
    $app->post('/get_permission','resource_webservice_get_permission');


    $app->post('/enroll','resource_webservice_enroll');
    $app->post('/get_enrolled','resource_webservice_get_enrolled');
    $app->post('/get_all_users_enrolled_to_item','resource_webservice_get_all_users_enrolled_to_item');
    $app->post('/delete_category_enrolled_to_item','resource_webservice_delete_category_enrolled_to_item');
    $app->post('/get_items_enrolled','resource_webservice_get_items_enrolled');
    $app->post('/get_users_by_enroll_itemid', 'resource_webservice_users_by_enroll_itemid');
    
    //impliment by vipin start//
     $app->post('/get_difference_user_after_change_setting','resource_webservice_get_difference_user_after_change_setting');
    //impliment by vipin end//

    $app->post('/check_device_id','resource_webservice_check_device_id');
    $app->post('/get_user_info_by_id','resource_webservice_get_user_info_by_id');
    $app->post('/get_user_associate_item_list','resource_webservice_get_user_associate_item_list');

    $app->post('/manage_login_attempt_logs','resource_webservice_manage_login_attempt_logs');  // logger done
    $app->post('/get_login_attempt_logs','resource_webservice_get_login_attempt_logs');  // logger done
    $app->post('/delete_login_attempt_logs','resource_webservice_delete_login_attempt_logs');  // logger done
    $app->post('/manage_login_details','resource_webservice_manage_login_details');  // logger done
    $app->post('/get_login_details','resource_webservice_get_login_details');  // logger done
    $app->post('/get_failed_login_data','resource_webservice_get_failed_login_data');  // logger done
    $app->post('/delete_failed_login_data','resource_webservice_delete_failed_login_data');  // logger done
    $app->post('/insert_failed_login_data','resource_webservice_insert_failed_login_data');  // logger done
    $app->post('/get_urgency_data','resource_webservice_get_urgency_data');  // logger done
    
    
    //Nilesh Sahu
    $app->post('/manage_common_used_personnel','resource_webservice_manage_common_used_personnel');
    $app->post('/delete_common_used_personnel','resource_webservice_delete_common_used_personnel');
    $app->post('/get_common_used_personnel_by_id','resource_webservice_get_common_used_personnel_by_id');
    //Nilesh Sahu

    $app->post('/get_min_max_data','resource_webservice_get_min_max_data');  // logger done
    $app->post('/register_confirmation','resource_webservice_register_confirmation');
    $app->post('/forgot_password_confirmation','resource_webservice_forgot_password_confirmation');
    $app->post('/forgot_password_recovery','resource_webservice_forgot_password_recovery');
    $app->post('/update_urgency_data','resource_webservice_update_urgency_data');

    $app->post('/manage_languages','resource_webservice_manage_languages');  // logger done
    $app->post('/get_languages','resource_webservice_get_languages');  // logger done
    $app->post('/delete_languages','resource_webservice_delete_languages');  // logger done

    $app->post('/manage_google_sso','resource_webservice_manage_google_sso');  // logger done
    $app->post('/google_sso_login','resource_webservice_google_sso_login');  // logger done
    $app->post('/get_id_by_google_sso','resource_webservice_get_id_by_google_sso');  // logger done
    $app->post('/user_logout','resource_webservice_user_logout');  // logger done
    $app->post('/check_parent_category_code_fields','resource_webservice_check_parent_category_code_fields');  // logger done
    $app->post('/get_logs_string','resource_webservice_get_logs_string');  // logger done

$app->post('/manage_adv_save_query','resource_webservice_adv_save_query');  // vipin add new function for save query 
$app->post('/get_saved_queries','resource_webservice_get_saved_queries');
$app->post('/social_login','resource_webservice_social_login');
$app->post('/signout_robot','resource_webservice_signout_robot');
    
?>
