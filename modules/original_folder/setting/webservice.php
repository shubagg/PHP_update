<?php
	$app->post('/manage_setting','setting_webservice_manage_setting');
    $app->post('/get_setting_by_mid','setting_webservice_get_setting_by_mid');
    $app->post('/delete_setting','setting_webservice_delete_setting');

    $app->post('/manage_user_setting','setting_webservice_manage_user_setting');
    $app->post('/get_user_setting','setting_webservice_get_user_setting');

    $app->post('/manage_module_setting','setting_webservice_manage_module_setting');
    $app->post('/manage_submodule_setting','setting_webservice_manage_submodule_setting');
    $app->post('/get_module_json','setting_webservice_get_module_json');
    $app->post('/get_module_setting_by_mid','setting_webservice_get_module_setting_by_mid');
    $app->post('/get_module_permission','setting_webservice_get_module_permission');
    $app->post('/get_submodule_id','setting_webservice_get_submodule_id');
    $app->post('/get_module_name','setting_webservice_get_module_name');
    $app->post('/get_submodule_name','setting_webservice_get_submodule_name');
    $app->post('/change_module_status','setting_webservice_change_module_status');
    $app->post('/manage_email','setting_webservice_manage_email');
    $app->post('/get_email_by_id','setting_webservice_get_email_by_id');
    $app->post('/delete_email','setting_webservice_delete_email'); 
    $app->post('/update_email_status','setting_webservice_update_email'); 
    
    $app->post('/get_roles_details','setting_webservice_get_roles'); 
?>