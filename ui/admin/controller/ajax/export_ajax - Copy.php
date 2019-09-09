<?php

include_once('../../../../global.php');
//echo "ss"; die;
$request_post_data = json_decode($_REQUEST['columns_listing'],true);
$columns_array = $request_post_data['columns_listing'];
$requestData= $_REQUEST;
$columns = array();
$table_headers = array();
$select_columns = array();
$search_like_on  = array();
if(is_array($columns_array) && count($columns_array))
{
    $col_count = '';
    for($i=0; $i<count($columns_array); $i++)
    {
        if(isset($columns_array[$i]['sorting']) && ($columns_array[$i]['sorting']=='true'))
        {
          if($col_count=='')
          {
            $col_count=$i;   
          }
          $columns[$i] = $columns_array[$i]['column'];    
        }
        if(isset($columns_array[$i]['searching']) && ($columns_array[$i]['searching']=='true'))
        {
            $search_like_on[] =  $columns_array[$i]['column'];
        }
        array_push($select_columns, $columns_array[$i]['column']);
        array_push($table_headers, $ui_string[$columns_array[$i]['column_heading']]);

    }
}
$header_fields = $table_headers;
$show_data = array();


//echo "<pre>"; print_r($_REQUEST); die;
//echo "<pre>"; print_r($request_post_data); die;
$result['success'] = false;
$start = 0;
$length = 10;

if(isset($_REQUEST['order'][0]['column']) && count($_REQUEST['order'][0]['column']))
{
    $ord_col =  '`'.$select_columns[$_REQUEST['order'][0]['column']].'`'  . '  ';   
    $ord_by =  $_REQUEST['order'][0]['dir']; 
    echo "ttt"; die;
}
else
{
    $ord_col =  '`'.$columns[$col_count].'`'  . '  ';   
    $ord_by  =  'ASC'; 
    
}
if(isset($_REQUEST['start']) && !empty($_REQUEST['start']))
{
    $start = $_REQUEST['start'];
}
if(isset($_REQUEST['length']) && !empty($_REQUEST['length']))
{
        $length = $_REQUEST['length'];   
}
if(isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != '' && !empty($_REQUEST['search']['value']))
{
    $search_key = $_REQUEST['search']['value'];
}

$query_data = array();
if(isset($_REQUEST['query_str']) && !empty($_REQUEST['query_str']))
{
    $query_data['query_str']   = $_REQUEST['query_str'];
}
$query_data[$request_post_data['request_params']['select_columns']] = $select_columns;
$query_data[$request_post_data['request_params']['search_on_like']] = $search_like_on;
$query_data[$request_post_data['request_params']['search_key']] = $search_key;
$query_data[$request_post_data['request_params']['order_column']] = $ord_col;
$query_data[$request_post_data['request_params']['order_by']] = $ord_by;
//$query_data[$request_post_data['request_params']['offset']] = $start;
//$query_data[$request_post_data['request_params']['limit']] = $length;
$query_data['data_handle'] = $request_post_data['data_handle'];

    //echo "<pre>"; print_r($request_post_data['request_url_params']); die('test');

foreach ($request_post_data['request_url_params'] as $key => $value) {
    $query_data[$key] = $value;
}
    
//echo "<pre>"; print_r($query_data); die;
$result = $request_post_data['api_action']($query_data);
//echo "<pre>"; print_r($result); die;
    
$data = array();
$totalData = 0;
$totalFiltered = 0;
if($result['success'] == 'true')
{

        //echo "<pre>"; print_r($result); die;
        $zz=0;
        if(isset($result['data'][$request_post_data['response_params']['data']]))
        {
            $row_data = $result['data'][$request_post_data['response_params']['data']];
        }
        else
        {
            $row_data = $result['data'];   
        }    
        $totalData = $result['data'][$request_post_data['response_params']['total_data']];
        $totalFiltered = $result['data'][$request_post_data['response_params']['total_filtered']];
        
    if($request_post_data['data_handle']=='true')
    {   //    echo "ssss" ; die;
        foreach ($row_data as $key => $row) 
        {
           // echo "<pre>"; print_r($row); die;
            $nestedData=array(); 
            foreach ($select_columns as $key => $value) {
                
               $nestedData[$header_fields[$key]] = urlencode($row[$value]);    
            
            }
            $data[] = $nestedData;
            //echo "<pre>"; print_r($data); die;
        }
    }
    else
    {
        $data = $row_data;
    }
}
$abc =array("header_fields"=>$header_fields,"show_data"=>$data);
  // echo json_encode($abc); //die;
  //  echo "<pre>"; print_r($show_data); die;
$ex = curl_post("/export_xls",$abc);
echo json_encode($ex);


?>

