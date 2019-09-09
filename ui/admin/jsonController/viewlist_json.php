 <?php
$get_user_login_data = get_resource_by_id(array('id' => $_SESSION['user']['user_id'], 'fields' => 'user_type,name,role'));

if ($get_user_login_data['success'] == 'true') {
    $get_user_login = $get_user_login_data['data'][0];
    $user_role = get_roles(array('id'=>$get_user_login['role']));
    $login_user_roles = $user_role['data'][0]['title'];
}
$column_listing = array(
    array("column_heading"=>"checkbox","column"=>"checkboxcolumn","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"name","column"=>"name","searching"=>"true","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"description","column"=>"description","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"ip_address","column"=>"ip_address","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"created_by","column"=>"created_by","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"machine","column"=>"machine","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"status","column"=>"status","searching"=>"false","sorting"=>"false","adv_searching"=>"false"),
	array("column_heading"=>"action","column"=>"action","searching"=>"false","sorting"=>"false","adv_searching"=>"false")
	);

$request_params = array("select_columns"=>"select_columns","search_on_like"=>"search_on_like","search_key"=>"search","limit"=>"limit","offset"=>"offset", "order_column"=>"order_column", "order_by"=>"order_by");

$request_url_params = array();
$api_params = array('userId'=>$_SESSION['user']['user_id']);

/*if($_SESSION['user']['user_type']!="super admin"){
	$api_params = array('assignto'=>array($_SESSION['user']['user_id']));	
}*/

$adv_api_params = array();
$custom_buttons_setting = array();
/*Check User Permission*/
if(check_user_permission('rpa', 'configuration', 'all') == '1' || check_user_permission('rpa', 'configuration', 'view') == '1') {
$custom_buttons_setting = array(
    array("name"=>"Create a New Robot","class"=>"btn btn-theme-inverse fa fa-play","id"=>"setting","type"=>"button","value"=>"Run","callback_function"=>"multi_robot_run","on_event"=>"onclick","lable_name"=>"Run"),
	array("name"=>"Create a New Robot","class"=>"btn btn-theme-inverse manage_warehouse_button","id"=>"setting","type"=>"button","value"=>"Create a New Robot","callback_function"=>"open_configuration","on_event"=>"onclick","lable_name"=>"Export")
	);
}



include_once(framework_doc_path() . 'internalApi/role/role_mgmt_lib.php');
if($_SESSION['user']['user_type'] !="super admin")
{
    $button = '<a data-original-title="Edit" onclick="configuration_temp(\'<?php echo $column["asid"] ?>\',\'<?php echo $column["id"] ?>\',\'<?php echo $column["count"] ?>\')" id="highlight-<?php echo $column["asid"] ?>" class="btn btn-default btn-sm" title="Run"><i class="fa fa-play"></i></a>';
}   
if(check_user_permission("rpa","allprocess","view")==1 || check_user_permission("rpa","allprocess","all")==1){
	if($login_user_roles!='user')
	{
$button .= '<a data-original-title="Assign Robot" onclick="assign_robot(\'<?php echo $column["asid"] ?>\',\'<?php echo $column["id"] ?>\')" class="btn btn-default btn-sm" title="Assign Robot"><i class="fa fa-tasks"></i></a>';
	}

$button .= '<a data-original-title="Delete Robot" onclick="delete_robot(\'<?php echo $column["asid"] ?>\',\'<?php echo $column["id"] ?>\')" class="btn btn-default btn-sm" title="Delete Robot"><i class="fa fa-trash"></i></a>';
if($login_user_roles!='user')
	{
$button .= '<a data-original-title="Edit Robot" onclick="edit_robot(\'<?php echo $column["asid"] ?>\',\'<?php echo $column["id"] ?>\')" class="btn btn-default btn-sm" title="Edit Robot"><i class="fa fa-pencil-square"></i></a>';
}
if($login_user_roles!='user')
	{
$button .= '<a data-original-title="Copy Robot" onclick="copy_robot(\'<?php echo $column["asid"] ?>\')" class="btn btn-default btn-sm" title="Copy Robot" style="color: #4f6d87;"><i class="fa fa-clipboard"></i></a>';
}
}
$button = urlencode($button);
$extra_columns = array("action"=>array($button),"sno"=>"index");

$adv_search_col_listing = array();

$include_files = array();

$response_params = array("data"=>"data","total_data"=>"total_count","total_filtered"=>"total_count");
$adv_search_v2_option = array(
    array('search_name' => 'top_used', 'search_type' => 'top_used', 'input-type' => 'button'),
    array('search_name' => 'recent_robot', 'search_type' => 'recent_robot', 'input-type' => 'button'),
);

$json_data = array(
	'viewlist' => array(
            'template' => 'view',
            'language' => 'en',
            'page_heading' => 'viewlist',
             'advanced_search_v2' => array('status' => 'true', 'adv_data' => $adv_search_v2_option),
            
            'advanced_search' => array('status' => 'false','adv_call_func'=>'','adv_callBack_func'=>'', 'template' => 'default', 'api_action' => 'getrobotdata','query_type'=>'mongo','page_heading' => 'advanced_search','div_class'=>'row','div_id'=>'stadd','search_equivalent'=>array('$eq','$gt','<','>=','<=','!=','like'),'adv_search_col_listing'=>$adv_search_col_listing,"api_params"=>$adv_api_params),

            'listing_details' => array('status' => 'true','default_call_func'=>'','default_callBack_func'=>'','div_id'=>'employee-grid','column_setting'=>'true','file_includes'=>"true",'data_handle'=>'true', 'template' => 'default', 'export_csv' => 1,'custom_buttons'=>'true','custom_buttons_setting'=>$custom_buttons_setting, 'api_action' => 'getrobotdata','searching'=>true,'serverSide'=>'false','processing'=>'true','page_heading' => 'form_wise_pending', 'columns_listing' => $column_listing,'request_params' => $request_params,"response_params"=>$response_params,'request_url_params' => $request_url_params,"extra_columns"=>$extra_columns,"api_params"=>$api_params)
	),

);
?>