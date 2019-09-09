<?php
$column_listing = array(
	array("column_heading"=>"image","column"=>"image1","searching"=>"true","sorting"=>"true","adv_searching"=>"false"),
	array("column_heading"=>"image","column"=>"image","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"temprature_values","column"=>"model","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"features","column"=>"reading","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"date_time","column"=>"date_time","searching"=>"false","sorting"=>"false","adv_searching"=>"false")
	);

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search","limit"=>"limit","offset"=>"offset", "order_column"=>"order_column", "order_by"=>"order_by");

$request_url_params = array();

$api_params = array('action_view'=>'','tablename'=>'imageSearch','extra'=>"true",'createdOn'=>'1','smid'=>'1');


$adv_api_params = array();

$custom_buttons_setting = array(array());


$adv_search_col_listing = array();

$include_files = array();

$response_params = array("data"=>"data","total_data"=>"total_count","total_filtered"=>"total_count");

$json_data = array(
	'imagelist' => array(
            'template' => 'imagelist',
            'language' => 'en',
            'page_heading' => '',
            
            'advanced_search' => array('status' =>'false','adv_call_func'=>'','adv_callBack_func'=>'', 'template' => 'default', 'api_action' => 'getbytablename','query_type'=>'mongo','page_heading' => 'advanced_search','div_class'=>'row','div_id'=>'stadd','search_equivalent'=>array('$eq'),'adv_search_col_listing'=>$adv_search_col_listing,"api_params"=>$adv_api_params),

            'listing_details' => array('status' => 'true','sorting'=>'true','default_column_order'=>array(0,'desc'),'default_call_func'=>'','default_callBack_func'=>'','div_id'=>'employee-grid','column_setting'=>'true','file_includes'=>"true",'data_handle'=>'true', 'template' => 'default', 'export_csv' => 1,'custom_buttons'=>'true','export_csv_name'=>'invigilator roaster','custom_buttons_setting'=>$custom_buttons_setting, 'api_action' => 'getbytablename','searching'=>false,'serverSide'=>'false','processing'=>'true','page_heading' => 'form_wise_pending', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params,'request_url_params' => $request_url_params,"extra_columns"=>$extra_columns,"api_params"=>$api_params)
	),
);
?>