<?php
include_once '../../../../global.php';
if(isset($_REQUEST['cat_add']))
{
    $cat_id=$_REQUEST['cat_id'];
    $parent = $_REQUEST['pcategory'];
    $name = trim(strtolower($_REQUEST['categoryname']));
    $code = trim(strtolower($_REQUEST['category_code']));
    $name1 = trim($_REQUEST['categoryname']);
    $code1 = trim($_REQUEST['category_code']);
    $root_parent_id = trim($_REQUEST['root_parent_id']);

    if($cat_id!='0' && $root_parent_id=='0')
    {
        if($parent==0)
        {

            $check=check_parent_category_code_fields(array('id'=>$cat_id,'code'=>$code,'parent_id'=>$parent));
            if($check['success']=='true')
            {
                $output = manage_category(array('id'=>$cat_id,'title'=>$name,'title1'=>$name1,'code'=>$code,'code1'=>$code1,'parent_id'=>$parent));
                echo json_encode($output);
            }
            else
            {
                echo json_encode(array("data"=>"","error_code"=>"117","success"=>"false"));
            }
        }
        else
        {
            $check=get_category(array('id'=>$parent));
            if($check['data'][0]['parent_id']=='0')
            {
                $output = manage_category(array('id'=>$cat_id,'title'=>$name,'title1'=>$name1,'code'=>$code,'code1'=>$code1,'parent_id'=>$parent));
                echo json_encode($output);
            }
            else
            {
                echo json_encode(array("data"=>"","error_code"=>"118","success"=>"false"));
            }
             
        }

    }
    else
    {
        if($parent==0)
        {
            
            if($cat_id!='0')
            {
                $check=check_parent_category_code_fields(array('id'=>$cat_id,'code'=>$code,'parent_id'=>$parent));
                if($check['success']=='true')
                {
                    $output =manage_category(array('id'=>$cat_id,'title'=>$name,'title1'=>$name1,'code'=>$code,'code1'=>$code1,'parent_id'=>$parent));
                    echo json_encode($output);
                }
                else
                {
                    echo json_encode(array("data"=>"","error_code"=>"117","success"=>"false"));
                }
                
            }
            else
            {

                $checkData=array('table'=>'category','field'=>'code','value'=>$code,'id'=>$cat_id);
                $checkUnique=check_unique_field($checkData); 
                if($checkUnique['success']=='true')
                {
                    $output =manage_category(array('parent_id'=>$parent,'title'=>$name,'title1'=>$name1,'code'=>$code,'code1'=>$code1,'id'=>'0'));
                   
                    echo json_encode($output);
                }
                else
                {
                     echo json_encode($checkUnique);
                }
            }
        }
        else
        {
            if($cat_id!='0'){
                $output = manage_category(array('id'=>$cat_id,'title'=>$name,'title1'=>$name1,'code'=>$code,'code1'=>$code1,'parent_id'=>$parent));
                echo json_encode($output);
                }
                else{
                    $output =manage_category(array('parent_id'=>$parent,'title'=>$name,'title1'=>$name1,'code'=>$code,'code1'=>$code1,'id'=>'0'));
                    echo json_encode($output);
                }

        }
    }   
}

if(isset($_REQUEST['catid']))
{
	$category_id = $_REQUEST['catid'];
	$single_cat =get_category(array("id"=>$category_id));
    echo json_encode($single_cat);
    
}

if(isset($_REQUEST['cat_data_id']))
{
    $output=update_category_child(array("id"=>$_REQUEST['cat_data_id']));
    echo json_encode($output);
}

if(isset($_POST['pcaid']))
{
     $output=get_category(array("id"=>$_POST['pcaid']));
    echo json_encode($output);

}


?>
