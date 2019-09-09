<?php
$userId=is_user_logged_in();
$column_listing = array(
	array("column_heading"=>"itemName","column"=>"productTitle","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"category","column"=>"productCategory","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"quantity","column"=>"quantityAvailable","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"date","column"=>"createdOn","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"action","column"=>"action","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	);

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search_key","limit"=>"nor","offset"=>"index", "order_column"=>"order_column", "order_by"=>"order_by");

$request_url_params = array();

$api_params = array('userId'=>$userId,'object'=>'true');

$adv_api_params = array('userId'=>$userId,'object'=>'true');
$custom_buttons_setting = array();
/*

array("name"=>"export","title"=>"Export","class"=>"btn btn-theme-inverse","id"=>"export","type"=>"button","value"=>"Export","callback_function"=>"export_data","on_event"=>"onclick","lable_name"=>"Export"),
*/
$button = '<button type="button" class="btn btn-theme-inverse" onclick="request_inventory(\'<?php echo $column["_id"] ?>\')"> Request </button>';

$button = urlencode($button);
$extra_columns = array("action"=>array($button),"sno"=>"index");

$adv_search_col_listing = array(
	array("column_heading"=>"item","column"=>"productId","type"=>"text",'search_equivalent'=>array('$eq'),'class'=>'form-control','id'=>'abc1','function'=>'','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'PRODUCT_LIST','data-params-fields'=>'title')),
	array("column_heading"=>"quantityAvailable","column"=>"quantityAvailable","type"=>"text",'search_equivalent'=>array('$lt','$gt'),'class'=>'form-control','id'=>'abc2','function'=>'','div_class'=>array('col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12','col-md-3 col-xs-12'),'class'=>array('form-control','form-control','form-control'),'div_params'=>array('data-type'=>'TEXTBOX'))
	);

$include_files = array();

$response_params = array("data"=>"data","total_data"=>"total_count","total_filtered"=>"total_count");

$json_data = array(
	'getStoreInventory' => array(
            'template' => 'inventory_requested_stock',
            'language' => 'en',
            'page_heading' => 'warehouse',
            
            'advanced_search' => array('status' => 'true','adv_call_func'=>'','adv_callBack_func'=>'', 'template' => 'default', 'api_action' => 'get_store_inventory','query_type'=>'mongo','page_heading' => 'advanced_search','div_class'=>'row','div_id'=>'stadd','search_equivalent'=>array('$eq','$gt'),'adv_search_col_listing'=>$adv_search_col_listing,"api_params"=>$adv_api_params),

            'listing_details' => array('status' => 'true','default_call_func'=>'','default_callBack_func'=>'','div_id'=>'employee-grid','column_setting'=>'true','file_includes'=>"true",'data_handle'=>'true', 'template' => 'default', 'export_csv' => 1,'custom_buttons'=>'true','custom_buttons_setting'=>$custom_buttons_setting, 'api_action' => 'get_store_inventory','searching'=>true,'serverSide'=>'false','processing'=>'true','page_heading' => 'form_wise_pending', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params,'request_url_params' => $request_url_params,"extra_columns"=>$extra_columns,"api_params"=>$api_params)
	),

);
?>