<?php
$userId = is_user_logged_in(); 
$column_listing = array(
	array("column_heading"=>"id","column"=>"app_id","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"module","column"=>"module","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"request_by","column"=>"request_by","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"request_to","column"=>"request_to","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"date","column"=>"request_by_ts","searching"=>"false","sorting"=>"false","adv_searching"=>"false")


	);

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search_key","limit"=>"limit","offset"=>"offset", "order_column"=>"order_column", "order_by"=>"order_by");

$request_url_params = array();

$api_params = array("userId"=>$userId);


$adv_api_params = array("userId"=>$userId);

$custom_buttons_setting = array(
	array("name"=>"setting","title"=>$ui_string['setting'],"class"=>"btn btn-theme-inverse","id"=>"setting","type"=>"button","value"=>$ui_string['setting'],"callback_function"=>"manage_table_header","on_event"=>"onclick","lable_name"=>"Export"),
        array("name"=>"export","title"=>$ui_string['export'],"class"=>"btn btn-theme-inverse","id"=>"export","type"=>"button","value"=>$ui_string['export'],"callback_function"=>"export_data","on_event"=>"onclick","lable_name"=>"Export")
	);
/*
array("name"=>"export","title"=>"Export","class"=>"btn btn-theme-inverse","id"=>"export","type"=>"button","value"=>"Export","callback_function"=>"export_data","on_event"=>"onclick","lable_name"=>"Export"),
*/
$button = '';

$button = urlencode($button);
$extra_columns = array("action"=>array($button),"sno"=>"index");

$adv_search_col_listing = array(
	array("column_heading"=>"project","column"=>"projectId","type"=>"text",'search_equivalent'=>array('=','>','<','>=','<=','!='),'div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'PROJECT_LIST','data-params-smid'=>'1','data-params-mid'=>'32')),

	array("column_heading"=>"assigne","column"=>"userid","type"=>"text",'search_equivalent'=>array('=','>','<','>=','<=','!='),'class'=>'form-control','id'=>'abc1','function'=>'','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'USER_LIST_HIERARCHY','data-params-smid'=>'1','data-params-mid'=>'1','data-params-object'=>'true','data-params-userId'=>$userId)),
        
	array("column_heading"=>"create_by","column"=>"creator","type"=>"text",'search_equivalent'=>array('=','>','<','>=','<=','!='),'class'=>'form-control','id'=>'abc1','function'=>'','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'USER_LIST_HIERARCHY','data-params-smid'=>'1','data-params-mid'=>'1','data-params-object'=>'true','data-params-userId'=>$userId)),

	array("column_heading"=>"priority","column"=>"priority",'search_equivalent'=>array('=','>','<','>=','<=','!='),'class'=>'form-control','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'UI_SETTING','data-params-smid'=>'2','data-params-mid'=>'5','data-params-request_type'=>'priority')),
	array("column_heading"=>"severity","column"=>"severity",'search_equivalent'=>array('=','>','<','>=','<=','!='),'class'=>'form-control','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'UI_SETTING','data-params-smid'=>'2','data-params-mid'=>'5','data-params-request_type'=>'severity')),
        array("column_heading"=>"status","column"=>"status",'search_equivalent'=>array('=','>','<','>=','<=','!='),'class'=>'form-control','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'UI_SETTING','data-params-smid'=>'2','data-params-mid'=>'5','data-params-request_type'=>'status')),
        array("column_heading"=>"type","column"=>"type",'search_equivalent'=>array('=','>','<','>=','<=','!='),'class'=>'form-control','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'UI_SETTING','data-params-smid'=>'2','data-params-mid'=>'5','data-params-request_type'=>'jobtype')),
	array("column_heading"=>"date","column"=>"date","type"=>"date",'class'=>array('form-control','form-control','form-control'),'div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'search_equivalent'=>array('=','>','<','>=','<=','!='),'div_params'=>array('data-type'=>'TEXTBOX','data-html-textbox_type'=>'text','data-html-placeholder'=>'yyyy-mm-dd')));

$include_files = array();

$response_params = array("data"=>"result","total_data"=>"total_count","total_filtered"=>"total_count");

$json_data = array(
	'rejectedApproval' => array(
            'template' => 'approval',
            'language' => 'en',
            'page_heading' => 'tickets',
            
            'advanced_search' => array('status' => 'false','adv_call_func'=>'','adv_callBack_func'=>'', 'template' => 'default', 'api_action' => 'get_adv_tickets','query_type'=>'mysql','page_heading' => 'advanced_search','div_class'=>'row','div_id'=>'stadd','search_equivalent'=>array('$eq','$gt','<','>=','<=','!=','like'),'adv_search_col_listing'=>$adv_search_col_listing,"api_params"=>$adv_api_params),

            'listing_details' => array('status' => 'true','sorting'=>true,'default_column_order'=>array(0,'desc'),'default_call_func'=>'','default_callBack_func'=>'','div_id'=>'employee-grid','column_setting'=>'true','file_includes'=>"true",'data_handle'=>'true', 'template' => 'default', 'export_csv' => 1,'custom_buttons'=>'true','custom_buttons_setting'=>$custom_buttons_setting, 'api_action' => 'get_all_rejected_approvals','searching'=>false,'serverSide'=>'false','processing'=>'true','page_heading' => 'form_wise_pending', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params,'request_url_params' => $request_url_params,"extra_columns"=>$extra_columns,"api_params"=>$api_params)
	),

);
?>