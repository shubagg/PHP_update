<?php
    function webservice_get_feature_list_by_id()
    {
        $postvar = get_post_data();
        $result = get_feature_list_by_id($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_manage_venue_request()
    {
        $postvar = get_post_data();
        $postvar['type']='1';
        $postvar['productType']='venue';
        $postvar['smid']='2';
        $postvar['status']='Pending';
        $result = manage_product_order($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_manage_venue_request_update()
    {
        $postvar = get_post_data();
        $result = update_venue_request($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }


    function webservice_manage_add_to_event_book_request()
    {
        $postvar = get_post_data();
        $postvar['type']='1';
        $postvar['productType']='event';
        $postvar['smid']='2';
        $postvar['status']='Pending';
        $result = manage_product_order($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }


    function webservice_manage_get_booking_history()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $result = get_products_ordered($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    

    function webservice_get_banner()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $postvar['fields']='id';
        $postvar['orderBy']='-1';
        $postvar['by']='updatedOn';
        $postvar['index']='0';
        $postvar['nor']='6';
        //$result = get_product_listing($postvar);
        $result = get_banner($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_get_categories()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $postvar['groupId']='587f04eca32974a8103c9869';
        $result = get_categories($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_get_listing_by_category()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $result = get_product_listing($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_contactSetting()
    {
        $postvar = get_post_data();
        $result = contactSetting($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_get_product_data_by_id()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $result = get_product_listing($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    
    function webservice_get_events_listing()
    {
        $postvar = get_post_data();
        $postvar['type']='event';
        $postvar['smid']='2';
        $result = get_product_listing($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_get_venues_listing()
    {
        $postvar = get_post_data();
        $postvar['type']='venue';
        $postvar['smid']='2';
        $result = get_product_listing($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
   
   
   function webservice_search_suggestions_events_venues()
    {
        $postvar = get_post_data();
        $result = search_suggestions_events_venues($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_manage_option_inventory_warehouse()
    {
        $postvar = get_post_data();
        $result = manage_option_inventory_warehouse($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
   
    function webservice_manage_favourite()
    {
        $postvar = get_post_data();
        $postvar['type']='2';
        $postvar['smid']='2';
        $postvar['productType']='1';
        $result = manage_product_order($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_delete_favourite()
    {
        $postvar = get_post_data();
        $postvar['type']='2';
        $postvar['smid']='2';
        $postvar['productType']='1';
        $result = delete_order($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_get_favourite()
    {
        $postvar = get_post_data();
        $postvar['type']='2';
        $result = get_product_order($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_filter_by()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $result = get_product_listing($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_get_listing_by_stateId()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $result = get_product_listing($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_get_listing_by_cityId()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $result = get_product_listing($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    
    function webservice_get_filter()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $postvar['filter']=true;
        $result = get_filter($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_manage_filter()
    {
        $postvar = get_post_data();
        $postvar['smid']='2';
        $result = manage_filter($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_check_events_availability()
    {
        $postvar = get_post_data();
        $result = check_events_availability($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }


    function webservice_manage_booking()
    {
        $postvar = get_post_data();
        $result = manage_booking($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_bookingHistory()
    {
        $postvar = get_post_data();
        $result = bookingHistory($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_quick_view_info()
    {
        $postvar = get_post_data();
        $result = quick_view_info($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_checkVenueAvailable()
    {
        $postvar = get_post_data();
        $result = checkVenueAvailable($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_billingInvoice()
    {
        $postvar = get_post_data();
        $result = billingInvoice($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_gettotalcategory()
    {
        $postvar = get_post_data();
        $result = gettotalcategory($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_deleteEvent()
    {
        $postvar = get_post_data();
        $result = deleteEvent($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_deletewarehouse()
    {
        $postvar = get_post_data();
        $result = deletewarehouse($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_deleteCategory()
    {
        $postvar = get_post_data();
        $result = deleteCategory($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_locationfilter()
    {
        $postvar = get_post_data();
        $result = locationfilter($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_getVenueHistory()
    {
        $postvar = get_post_data();
        $result = getVenueHistory($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_make_paymentBk()
    {
        $postvar = get_post_data();
        $result = make_paymentBk($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_success_payment()
    {
        $postvar = get_post_data();
        $result = success_payment($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_getTxnDetails()
    {
        $postvar = get_post_data();
        $result = getTxnDetails($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }

    function webservice_get_benefit()
    {
        $postvar = get_post_data();
        $result = get_benefit($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
    function webservice_get_commentbenefit()
    {
        $postvar = get_post_data();
        $result = get_commentbenefit($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
	function webservice_updatestatus()
    {
        $postvar = get_post_data();
        $result = updatestatus($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
	function webservice_get_hotel_user()
    {
        $postvar = get_post_data();
        $result = get_hotel_user($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
	function webservice_deleteTax()
    {
        $postvar = get_post_data();
        $result = deleteTax($postvar);
        rs($result['data'],$result['error_code'],$result['success'],"11");
    }
	
	
	
    
?>