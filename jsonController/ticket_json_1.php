<?php
$json_data = array(
	'default' => array(
            'template' => 'default',
            'language' => 'en',
            'advanced_search' => array('status' => '1', 'call_api' => 'search_tickets',
                'search_key' => array('select','priority','title','description','severity'),
                'search_equivalent' => array('is_equal_to','is_not_equal_to','is_blank','is_not_blank'),
                'search_value' => array('priority_p1','priority_p2','priority_p3','priority_p4')),
            'listing_details' => array('status' => '1', 'settings' => array('#', 'title', 'description', 'severity', 'assignee', 'status')),
	),
	'ticket_listing' => array(
            'template' => 'default',
            'language' => 'en',
            'page_heading' => 'list_page_heading',
            'advanced_search' => array('status' => '1', 'api_action' => 'search_tickets','page_heading' => 'adv_page_title',
                'search_key' => array('adv_select','adv_priority','adv_title','adv_description','adv_severity'),
                'search_equivalent' => array('adv_blank','adv_is_equal_to','adv_is_not_equal_to','adv_is_blank','adv_is_not_blank'),
                'search_value' => array('adv_blank','adv_priority_p1','adv_priority_p2','adv_priority_p3','adv_priority_p4')),
            'common_search' => array('status' => '1', 'call_api' => 'search_tickets','page_heading' => 'Filter Details'),
            'listing_details' => array('status' => '1', 'export_csv' => 1, 'api_action' => '', 'page_heading' => 'listing_details_title', 'settings' => array('#', 'title', 'description', 'severity')),
	),
);
?>