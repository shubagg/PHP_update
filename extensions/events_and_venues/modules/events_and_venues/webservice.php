<?php

$app->post('/get_feature_list_by_id','webservice_get_feature_list_by_id');

$app->post('/get_banner','webservice_get_banner');
$app->post('/get_categories','webservice_get_categories');
$app->post('/get_listing_by_category','webservice_get_listing_by_category');
$app->post('/get_product_data_by_id','webservice_get_product_data_by_id');


$app->post('/get_events_listing','webservice_get_events_listing');
$app->post('/get_venues_listing','webservice_get_venues_listing');

$app->post('/search_suggestions_events_venues','webservice_search_suggestions_events_venues');

$app->post('/manage_option_inventory_warehouse','webservice_manage_option_inventory_warehouse');
$app->post('/check_events_availability','webservice_check_events_availability');


$app->post('/manage_favourite','webservice_manage_favourite');
$app->post('/delete_favourite','webservice_delete_favourite');
$app->post('/get_favourite','webservice_get_favourite');

$app->post('/add_to_venue_request','webservice_manage_venue_request');
$app->post('/update_venue_request','webservice_manage_venue_request_update');

$app->post('/add_to_event_book_request','webservice_manage_add_to_event_book_request');

$app->post('/get_booking_history','webservice_manage_get_booking_history');
$app->post('/filter_by','webservice_filter_by');
$app->post('/get_listing_by_stateId','webservice_get_listing_by_stateId');
$app->post('/get_listing_by_cityId','webservice_get_listing_by_cityId');

$app->post('/get_filter','webservice_get_filter');
$app->post('/manage_filter','webservice_manage_filter');
$app->post('/manage_booking','webservice_manage_booking');
$app->post('/bookingHistory','webservice_bookingHistory');
$app->post('/quick_view_info','webservice_quick_view_info');
$app->post('/checkVenueAvailable','webservice_checkVenueAvailable');

$app->post('/contactSetting','webservice_contactSetting');
$app->post('/billingInvoice','webservice_billingInvoice');
$app->post('/gettotalcategory','webservice_gettotalcategory');

$app->post('/deleteEvent','webservice_deleteEvent');
$app->post('/deletewarehouse','webservice_deletewarehouse');
$app->post('/deleteCategory','webservice_deleteCategory');
$app->post('/deleteTax','webservice_deleteTax');
$app->post('/locationfilter','webservice_locationfilter');
$app->post('/getVenueHistory','webservice_getVenueHistory'); 

$app->post('/get_benefit','webservice_get_benefit');
$app->post('/get_commentbenefit','webservice_get_commentbenefit');

$app->post('/make_paymentBk','webservice_make_paymentBk'); 
$app->post('/success_payment','webservice_success_payment'); 
$app->post('/getTxnDetails','webservice_getTxnDetails');
$app->post('/updatestatus','webservice_updatestatus'); 
$app->post('/get_hotel_user','webservice_get_hotel_user'); 


?>