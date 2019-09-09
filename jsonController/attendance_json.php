<?php
$column_listing = array(array("column_heading"=>"name","column"=>"empname1","searching"=>"true","sorting"=>"false","adv_searching"=>"true"),array("column_heading"=>"total_days","column"=>"totalDays","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),array("column_heading"=>"work_days","column"=>"workingDays","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),array("column_heading"=>"presents","column"=>"presents","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),array("column_heading"=>"leaves","column"=>"leaves","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),array("column_heading"=>"action","column"=>"action","searching"=>"false","sorting"=>"false","adv_searching"=>"false"));

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search_key","limit"=>"limit","offset"=>"offset", "order_column"=>"order_column", "order_by"=>"order_by");

$request_url_params = array();

$api_params = array("mid"=>"22","smid"=>"1","fromDate"=>"2017-05-01","toDate"=>date('Y-m-d'));

$adv_api_params = array("mid"=>"22","smid"=>"1","fromDate"=>"2017-05-01","toDate"=>date('Y-m-d'));

$custom_buttons_setting = array(array("name"=>"export","title"=>"Export","class"=>"btn","id"=>"export","type"=>"button","value"=>"Export","callback_function"=>"export_data","on_event"=>"onclick","lable_name"=>"Export"),
	array("name"=>"setting","title"=>"Setting","class"=>"btn","id"=>"setting","type"=>"button","value"=>"setting","callback_function"=>"manage_table_header","on_event"=>"onclick","lable_name"=>"Export")
	);

$button = '<a name="edit" id="edit" href="http://localhost/Teamerge_in/Teamerge/controller/?type=attendanceview&id=<?php echo $column[userId]?>"><?php echo $ui_string[view] ?></a>';

$button = urlencode($button);
$extra_columns = array("action"=>array($button),"sno"=>"index");

$adv_search_col_listing = array(array("column_heading"=>"deviceId","column"=>"deviceId","type"=>"text"),array("column_heading"=>"date","column"=>"date","type"=>"date"));

$include_files = array();

$response_params = array("data"=>"data","total_data"=>"total_count","total_filtered"=>"total_count");

$json_data = array(
	'attendance' => array(
            'template' => 'attendance',
            'language' => 'en',
            'page_heading' => 'attendance_report',
            
            'advanced_search' => array('status' => 'true', 'template' => 'default', 'api_action' => 'get_pending_formjob_testing','page_heading' => 'advanced_search','div_id'=>'stadd','search_equivalent'=>array('=','>','<','>=','<=','!=','like'),'adv_search_col_listing'=>$adv_search_col_listing,"api_params"=>$adv_api_params),

            'listing_details' => array('status' => 'true','div_id'=>'employee-grid','column_setting'=>'true','file_includes'=>"true",'data_handle'=>'true', 'template' => 'default', 'export_csv' => 1,'custom_buttons'=>'true','custom_buttons_setting'=>$custom_buttons_setting, 'api_action' => 'get_users_attendance','searching'=>'false','serverSide'=>'false','processing'=>'true','page_heading' => 'form_wise_pending', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params,'request_url_params' => $request_url_params,"extra_columns"=>$extra_columns,"api_params"=>$adv_api_params)
	),

);
?>