<?php
//echo "<pre>"; print_r($_REQUEST); die;
include_once '../../global.php';
//echo "ss"; die;
$request_post_data = json_decode($_REQUEST['columns_listing'],true);
$columns_array = $request_post_data['columns_listing'];
$requestData= $_REQUEST;
$columns = array();
$all_columns = array();
$select_columns = array();
$serverSide = isset($request_post_data['serverSide']) ? $request_post_data['serverSide']:false;
$api_params = isset($request_post_data['api_params']) ? $request_post_data['api_params']:'';
$extra_columns = isset($request_post_data['extra_columns']) ? $request_post_data['extra_columns']:array();
$search_like_on  = array();
if(is_array($columns_array) && count($columns_array))
{   $col_count = '';
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
        if(!isset($extra_columns[$columns_array[$i]['column']]))
        {   
            array_push($select_columns, $columns_array[$i]['column']);    
        }
        array_push($all_columns, $columns_array[$i]['column']);
    }
}



//echo "<pre>"; print_r($_REQUEST); die;
//echo "<pre>"; print_r($request_post_data); die;
$result['success'] = false;
$start = 0;
$length = 10;
if(isset($_REQUEST['order'][0]['column']) && count($_REQUEST['order'][0]['column']))
{
    $ord_col =  $select_columns[$_REQUEST['order'][0]['column']]  . '  ';   
    $ord_by =  $_REQUEST['order'][0]['dir']; 
}
else
{
    $ord_col =  $columns[$col_count] . '  ';   
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
$query_data[$request_post_data['request_params']['offset']] = $start;
$query_data[$request_post_data['request_params']['limit']] = $length;
$query_data['data_handle'] = $request_post_data['data_handle'];

    //echo "<pre>"; print_r($request_post_data['request_url_params']); die('test');

foreach ($request_post_data['request_url_params'] as $key => $value) {
    $query_data[$key] = $value;
}
//echo "<pre>"; print_r($api_params); die;
if(isset($api_params))
{
    foreach ($api_params as $key => $value) {
      
       $query_data[$key] = $value;
    }
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
    $countIndex = 1;
    if($request_post_data['data_handle']=='true')
    {   //    echo "ssss" ; die;
        foreach ($row_data as $key => $column) 
        {
            
            $nestedData=array(); 
            foreach ($all_columns as $key => $value) {
                if(!isset($column[$value]) && isset($extra_columns[$value]))
                {
                    if($extra_columns[$value]=='index')
                    {
                        $nestedData[] = $countIndex;
                    }
                    else
                    {
                        $url = urldecode($extra_columns[$value][0]); //die;
                        ob_start();
                        $url = eval("?> $url <?php ");
                        $url = ob_get_contents();
                        $nestedData[] = $url;
                        ob_end_clean();

                    }
                    
                }
                else
                {
                    $nestedData[] = $column[$value];
                }
                
                    
            }
           // echo "<pre>"; print_r($nestedData); die;
            $data[] = $nestedData;
            $countIndex++;
        }
    }
    else
    {
        $data = $row_data;
    }
}

//echo "<pre>"; print_r($data); die;
$json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );

echo json_encode($json_data);  // send data as json format 


?>

