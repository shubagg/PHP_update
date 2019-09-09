<?php
$column_listing = array(array("column_heading"=>"id","column"=>"id","search"=>"1","sorting"=>"1"),array("column_heading"=>"title","column"=>"title","search"=>"1","sorting"=>"1"),array("column_heading"=>"date","column"=>"date","search"=>"1","sorting"=>"1"),array("column_heading"=>"creator","column"=>"creator","search"=>"1","sorting"=>"1"),array("column_heading"=>"category","column"=>"category","search"=>"1","sorting"=>"1"));

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search_key","limit"=>"length","offset"=>"start", "order_column"=>"order_column", "order_by"=>"order_by");
$response_params = array("data"=>"job_data","total_data"=>"total_count","total_filtered"=>"total_count");

$json_data = array(
	'default' => array(
            'template' => 'default',
            'language' => 'en',
            'page_heading' => 'list_page_heading',
            'advanced_search' => array('status' => '1', 'template' => 'default', 'api_action' => 'search_tickets','page_heading' => 'adv_page_title',
                'search_key' => array('adv_select','priority','title','description','severity'),
                'search_equivalent' => array('adv_blank','adv_is_equal_to','adv_is_not_equal_to','adv_is_blank','adv_is_not_blank'),
                'search_value' => array('adv_blank','adv_priority_p1','adv_priority_p2','adv_priority_p3','adv_priority_p4')),
            'listing_details' => array('status' => '1', 'template' => 'default', 'export_csv' => 1, 'api_action' => '', 'page_heading' => 'listing_details_title', 'columns' => array('#', 'title', 'description', 'severity', 'status')),
	),
	'pending_form_job' => array(
            'template' => 'default',
            'language' => 'en',
            'page_heading' => 'list_page_heading',
            'advanced_search' => array('status' => 'true', 'template' => 'default', 'api_action' => 'search_tickets','page_heading' => 'adv_page_title',
                'search_key' => array('adv_select','priority','title','description','severity'),
                'search_equivalent' => array('adv_is_equal_to','adv_is_not_equal_to','adv_is_greater_than','adv_is_less_than','adv_is_greater_than_equal_to','adv_is_less_than_equal_to'),
                'search_value' => array('adv_blank','adv_priority_p1','adv_priority_p2','adv_priority_p3','adv_priority_p4')),
            'listing_details' => array('status' => 'true', 'template' => 'default', 'export_csv' => 1, 'api_action' => 'get_pending_formjob', 'page_heading' => 'listing_details_title', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params)
	),

);
?>