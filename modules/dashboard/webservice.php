<?php
	$app->post('/get_vehicle_status','dashboard_webservice_get_vehicle_status');
    $app->post('/get_vehicle_data','dashboard_webservice_get_vehicle_data');
    $app->post('/get_vhTracking_data','dashboard_webservice_get_vhTracking_data');
    $app->post('/get_vhPath_data','dashboard_webservice_get_vhPath_data');
    $app->post('/get_dashboard_pdf_data','dashboard_webservice_get_dashboard_pdf_data');
    
    ///////////////////////////////    CUSTOM DASHBOARD     /////////////////////////

    $app->post('/create_dashboard','dashboard_webservice_create_dashboard');
    $app->post('/get_dashboard','dashboard_webservice_get_dashboard');
    $app->post('/create_widget_association','dashboard_webservice_create_widget_association');
    $app->post('/get_dashboard_widget','dashboard_webservice_get_dashboard_widget');
    $app->post('/get_widget_detail','dashboard_webservice_get_widget_detail');
    $app->post('/get_basic_widget','dashboard_webservice_get_basic_widget');
    $app->post('/create_basic_widget','dashboard_webservice_create_basic_widget');
    $app->post('/create_widget_detail','dashboard_webservice_create_widget_detail');
    $app->post('/update_widget_detail','dashboard_webservice_update_widget_detail');
    $app->post('/delete_widget','dashboard_webservice_delete_widget');
    $app->post('/get_basic_widget_detail','dashboard_webservice_get_basic_widget_detail');

    $app->post('/delete_dashboard','dashboard_webservice_delete_dashboard');
     $app->post('/get_module_count','dashboard_webservice_get_module_count');
    $app->post('/async_update','dashboard_webservice_async_update');

    
?>