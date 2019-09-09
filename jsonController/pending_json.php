<?php
$column_listing = array(array("column_heading"=>"id","column"=>"id","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),array("column_heading"=>"title","column"=>"title","searching"=>"true","sorting"=>"true","adv_searching"=>"true"),array("column_heading"=>"description","column"=>"description","searching"=>"true","sorting"=>"true","adv_searching"=>"true"),array("column_heading"=>"user","column"=>"creator","searching"=>"true","sorting"=>"true","adv_searching"=>"true"),array("column_heading"=>"date","column"=>"date","searching"=>"true","sorting"=>"true","adv_searching"=>"true"));

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search_key","limit"=>"limit","offset"=>"offset", "order_column"=>"order_column", "order_by"=>"order_by");

$request_url_params = array("userid"=>"userid");

$custom_buttons_setting = array(array("name"=>"export","title"=>"Export","class"=>"btn","id"=>"export","type"=>"button","value"=>"Export","callback_function"=>"export_data","on_event"=>"onclick","lable_name"=>"Export"),
	array("name"=>"setting","title"=>"Setting","class"=>"btn","id"=>"setting","type"=>"button","value"=>"setting","callback_function"=>"manage_table_header","on_event"=>"onclick","lable_name"=>"Export")
	);

$include_files = array();

$response_params = array("data"=>"data","total_data"=>"total_count","total_filtered"=>"total_count");

$json_data = array(
	'default' => array(
            'template' => 'default',
            'language' => 'en',
            'page_heading' => 'list_page_heading',
            'advanced_search' => array('status' => 'true', 'template' => 'default', 'api_action' => 'search_tickets','page_heading' => 'advanced_search',
                'search_key' => array('adv_select','priority','title','description','severity'),
                'search_equivalent' => array('adv_blank','adv_is_equal_to','adv_is_not_equal_to','adv_is_blank','adv_is_not_blank'),
                'search_value' => array('adv_blank','adv_priority_p1','adv_priority_p2','adv_priority_p3','adv_priority_p4')),
            'listing_details' => array('status' => 'true', 'template' => 'default', 'export_csv' => 1, 'api_action' => '', 'page_heading' => 'listing_details_title', 'columns' => array('#', 'title', 'description', 'severity', 'status')),
	),
	'pending_form_job' => array(
            'template' => 'default',
            'language' => 'en',
            'page_heading' => 'list_page_heading',
            
            'advanced_search' => array('status' => 'true', 'template' => 'default', 'api_action' => 'get_pending_formjob_testing','page_heading' => 'advanced_search','div_id'=>'stadd','search_equivalent'=>array('=','>','<','>=','<=','!=','like')),

            'listing_details' => array('status' => '1','div_id'=>'employee-grid','column_setting'=>'true','file_includes'=>"true",'data_handle'=>'true', 'template' => 'default', 'export_csv' => 1,'custom_buttons'=>'true','custom_buttons_setting'=>$custom_buttons_setting, 'api_action' => 'get_pending_formjob_testing','searching'=>'false','serverSide'=>'true','processing'=>'true','page_heading' => 'form_wise_pending', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params,'request_url_params' => $request_url_params)
	),

);
?>