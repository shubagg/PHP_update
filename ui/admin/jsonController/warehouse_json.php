<?php
$column_listing = array(
	array("column_heading"=>"title","column"=>"title","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"location","column"=>"address","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"action","column"=>"action","searching"=>"false","sorting"=>"false","adv_searching"=>"false")
	);

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search_key","limit"=>"limit","offset"=>"offset", "order_column"=>"order_column", "order_by"=>"order_by");

$request_url_params = array();

$api_params = array();


$adv_api_params = array();

$custom_buttons_setting = array(
	array("name"=>"add_warehouse","title"=>"add_warehouse","class"=>"btn btn-theme-inverse manage_warehouse_button","id"=>"setting","type"=>"button","value"=>"Add Warehouse","callback_function"=>"open_warehouse_popup","on_event"=>"onclick","lable_name"=>"Export")
	);

include_once(framework_doc_path() . 'internalApi/role/role_mgmt_lib.php');
$roles_details = get_roles_by_mid(array('mid' => '41', 'smid' => '1'));

$button = '<a data-original-title="Edit" onclick="edit_warehouse_temp(\'<?php echo $column["id"] ?>\')" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>';

foreach($roles_details['data'] as $roles){
	$button.= '<a data-original-title="'.$roles['title'].'" onclick="openGenericUsersPopup(\'<?php echo $column["id"] ?>\',\''.$roles['id'].'\')" class="btn btn-default btn-sm" title="'.ucfirst($roles['title']).'"><i class="fa fa-file-text"></i></a>';
}

$button = urlencode($button);
$extra_columns = array("action"=>array($button),"sno"=>"index");

$adv_search_col_listing = array();

$include_files = array();

$response_params = array("data"=>"data","total_data"=>"total_count","total_filtered"=>"total_count");

$json_data = array(
	'warehouse' => array(
            'template' => 'warehouse',
            'language' => 'en',
            'page_heading' => 'warehouse',
            
            'advanced_search' => array('status' => 'false','adv_call_func'=>'','adv_callBack_func'=>'', 'template' => 'default', 'api_action' => 'get_warehouse_by_id','query_type'=>'mongo','page_heading' => 'advanced_search','div_class'=>'row','div_id'=>'stadd','search_equivalent'=>array('$eq','$gt','<','>=','<=','!=','like'),'adv_search_col_listing'=>$adv_search_col_listing,"api_params"=>$adv_api_params),

            'listing_details' => array('status' => 'true','default_call_func'=>'','default_callBack_func'=>'','div_id'=>'employee-grid','column_setting'=>'true','file_includes'=>"true",'data_handle'=>'true', 'template' => 'default', 'export_csv' => 1,'custom_buttons'=>'true','custom_buttons_setting'=>$custom_buttons_setting, 'api_action' => 'get_warehouse_by_id','searching'=>false,'serverSide'=>'false','processing'=>'true','page_heading' => 'form_wise_pending', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params,'request_url_params' => $request_url_params,"extra_columns"=>$extra_columns,"api_params"=>$api_params)
	),

);
?>