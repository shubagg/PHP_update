<?php
    function dashboard_webservice_get_vehicle_status()
	{
		$postvar = get_post_data();
		$result = get_vehicle_status($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"19");
		
	}
    
    function dashboard_webservice_get_vehicle_data()
	{
		$postvar = get_post_data();
		$result = get_vehicle_data($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"19");
	}
	
	function dashboard_webservice_get_vhTracking_data()
	{
		$postvar = get_post_data();
		$result = get_vhTracking_data($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"19");
	}

	function dashboard_webservice_get_vhPath_data()
	{
		$postvar = get_post_data();
		$result = get_vhPath_data($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"19");
	}

	function dashboard_webservice_get_dashboard_pdf_data()
	{
		$postvar = get_post_data();
		$result = get_dashboard_pdf_data($postvar);
		rs($result['data'],$result['error_code'],$result['success'],"19");
	}

	///////////////////////////    CUSTOM DASHBOARD    /////////////////////////

	
    function dashboard_webservice_create_dashboard()
    {
        $postvar=get_post_data();
        $return=create_dashboard($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
   
    function dashboard_webservice_get_dashboard()
    {
        $postvar=get_post_data();
        $return=get_dashboard($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function dashboard_webservice_create_widget_association()
    {
        $postvar=get_post_data();
        $return=create_widget_association($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function dashboard_webservice_create_basic_widget()
    {
        $postvar=get_post_data();
        $return=create_basic_widget($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
    function dashboard_webservice_create_widget_detail()
    {
        $postvar=get_post_data();
        $return=create_widget_detail($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function dashboard_webservice_update_widget_detail()
    {
        $postvar=get_post_data();
        $return=update_widget_detail($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function dashboard_webservice_get_dashboard_widget()
    {
        $postvar=get_post_data();
        $return=get_dashboard_widget($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function dashboard_webservice_get_widget_detail()
    {
        $postvar=get_post_data();
        $return=get_widget_detail($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function dashboard_webservice_delete_widget()
    {
        $postvar=get_post_data();
        $return=delete_widget($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    function dashboard_webservice_get_basic_widget()
    {
        $postvar=get_post_data();
        $return=get_basic_widget($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

     function dashboard_webservice_get_basic_widget_detail()
    {
        $postvar=get_post_data();
        $return=get_basic_widget_detail($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }


    function dashboard_webservice_delete_dashboard()
    {
        $postvar=get_post_data();
        $return=delete_dashboard($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

     function dashboard_webservice_get_module_count()
    {
        $postvar=get_post_data();
        $return=get_module_count();
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }

    function dashboard_webservice_async_update()
    {
        $postvar=get_post_data();
        $return=async_update($postvar);
        rs($return['data'],$return['error_code'],$return['success'],"1"); 
    }
    
?>