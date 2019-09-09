<?php
include_once '../../../../global.php';
if(isset($_REQUEST['cat_add']))
{
    $cat_id=$_REQUEST['cat_id'];
	$parent = $_REQUEST['pcategory'];
	$name = trim(strtolower($_REQUEST['categoryname']));
	$code = trim(strtolower($_REQUEST['category_code']));
    if($cat_id!='0'){
        $output = curl_post("/manage_category",array('id'=>$cat_id,'title'=>$name,'code'=>$code,'parent_id'=>$parent));
        echo json_encode($output);
    }
    else{
    	$output = curl_post("/manage_category",array('parent_id'=>$parent,'title'=>$name,'code'=>$code,'id'=>'0'));
        echo json_encode($output);
    }
}

if(isset($_REQUEST['catid']))
{
	$category_id = $_REQUEST['catid'];
	$single_cat = curl_post("/get_category",array("id"=>$category_id));
    echo json_encode($single_cat);
    
}

if(isset($_REQUEST['cat_data_id']))
{
    $output=curl_post("/delete_category",array("id"=>$_REQUEST['cat_data_id']));
    echo json_encode($output);
}




?>
