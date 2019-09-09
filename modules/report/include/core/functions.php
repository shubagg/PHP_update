<?php
function get_report_uidata_by_midOld($data)
{
    logger("19",$data,"",5,"/get_report_uidata_by_midOld");
    $check = check_key_available($data,array('mid','smid'));
    if($check['success'] == 'true')
    {
        $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid']),array());
        $fetdata = add_id($getdata,"id");
        return array("success"=>"true","data"=>$fetdata,"error_code"=>"100");  
    }
    else
    {
        return $check;
    }
}

function get_report_uidata_by_mid($data)
{
    logger("19",$data,"",5,"/get_report_uidata_by_mid");
    $check = check_key_available($data,array('mid','smid','report_id'));
    if($check['success'] == 'true')
    {
        $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array());
        $fetdata = add_id($getdata,"id");
        return array("success"=>"true","data"=>$fetdata,"error_code"=>"100");  
    }
    else
    {
        return $check;
    }
}

function get_report_data($data)
{

    logger("19",$data,"",5,"/get_report_data");
    $check = check_key_available($data,array('mid','smid','jsonArr','userId','report_id'));
    if($check['success'] == 'true')
    {
        $result = array();
        Switch($data['mid'])
        {
            case "1":
                    Switch($data['report_id'])
                    {
                        case "1":
                        include('register_user.php');
                        $result = get_register_user_report($data);
                        break;
                    }
                    
            break;
            case "2":
                     Switch($data['report_id'])
                    {
                        case "6":
                        include('sample_test.php');
                        $result = get_sample_test_report($data);
                        break;
                        
                        case "7":

                        include('assigned_test.php');
                      
                            $jsonEncArr = json_decode($data['jsonArr'],true);
                            if($jsonEncArr['cTest']==-1)
                            {                            
                               
                                 $result = get_all_assigned_test_report($data);
                            }
                            else
                            {   
                                 $data['report_id'] = "8";
                                 $result = get_single_assigned_test_report($data);
                            }                       
                        break;

                        case "11":
                        include('course_report.php');
                        $result = get_course_wise_report($data);
                        break;

                        case "12":
                        include('course_test_report.php');
                        $result = get_course_test_wise_report($data);
                        break;

                        case "13":
                        include('test_status_user_report.php');
                        $result = get_test_status_wise_user_report($data);
                        break;

                        case "14":
                        include('test_status_user_report.php');
                        $result = get_test_status_wise_user_report($data);
                        break;
                        case "15":
                        include('course_report.php');
                        $result = get_course_wise_report($data);
                        break;

                        case "16":
                        include('course_test_report.php');
                        $result = get_course_test_wise_report($data);
                        break;

                        case "17":
                        include('survey_report.php');
                        $result = get_survey_report($data);
                        break;
                    }
            break;

            case "16":
                    Switch($data['report_id'])
                    {
                        case "1":
                        include('product_report.php');
                        $result = get_product_report($data);
                        break;
                        case "2":
                        include('product_order_report.php');
                        $result = get_product_order_report($data);
                        break;
                        case "4":
                        include('product_topviewed.php');
                        $result = get_product_topviewed_report($data);
                        break;
                        case "5":
                        include('product_topbrand.php');
                        $result = get_product_topbrand_report($data);
                        break;
                        case "6":
                        include('top_customers_sales_report.php');
                        $result = get_top_customers_according_sales_report($data);
                        break;
                        case "7":
                        include('cart_abandonment.php');
                        $result = get_cart_abandonment_report($data);
                        break;
                        case "8":
                        include('wish_list_report.php');
                        $result = get_wish_list_report($data);
                        break;
                        case "9":
                        include('specific_product_sale_report.php');
                        $result = get_specific_product_sale_report($data);
                        break;
                        case "15":
                        include('visitor_report.php');
                        $result = get_visitor_report($data);
                        break;
                    }
                    
            break;
            
        }
        return array("success"=>"true","data"=>$result,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function shortArrayByKey($SortArray,$shortBy)
{
    $sortArray = array(); 
    foreach($SortArray as $person)
    { 
        foreach($person as $key=>$value)
        { 
            if(!isset($sortArray[$key]))
            { 
                $sortArray[$key] = array(); 
            } 
            $sortArray[$key][] = $value; 
        } 
    } 
    $orderby = $shortBy; 
    array_multisort($sortArray[$orderby],SORT_ASC,$SortArray); 
    return $SortArray;
}



function get_blog_report($data)
{   logger("19",$data,"",5,"/get_blog_report");
    $filterFields = json_decode($data['jsonArr'],true);
    $getPageSetting = get_module_page_setting(array("userId"=>$data['userId'],"mid"=>$data['mid'],"smid"=>$data['smid']));

    $fields1 = array();
    if(count($getPageSetting['data']))
    {
        $fields1 = $getPageSetting['data'][0]['fields'];
    }
    else
    {

        $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid']),array('setting','fields'));
        $fetdata = add_id($getdata,"id");

        if($fetdata[0])
        {

            $fields1 = $fetdata[0]['setting']['defaultFields'];
        }
        else
        {
            $getdata = select_mongo("report_type",array('_id'=>new MongoId($filterFields['report'])),array('fields'));
            $fetdata = add_id($getdata,"id");
            $fields1 = $fetdata[0]['fields'];
        }
    }

    
    $fields = array();
    $fields = shortArrayByKey($fields1,'order');
    $thead = array();

    foreach ($fields as $fkey => $fvalue) 
    {
        array_push($thead,$fvalue['fieldName']);
    }

    
    $condition = array();

    $start = $end = '';

    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            case "category":
                $condition['ctgId'] = $value;
            break;
            case "fromDate":
                $dt = $value. " 00:00";
                $start = new MongoDate(strtotime($dt));
            break;
            case "toDate":
                $dt1 = $value. " 24:00";
                $end = new MongoDate(strtotime($dt1));
            break;
            case "date":
                $dt = $value. " 00:00";
                $start = new MongoDate(strtotime($dt));
                $dt1 = $value. " 24:00";
                $end = new MongoDate(strtotime($dt1));
            break;
        }
    }

    if($start !='')
    {
        $condition['createdOn'] = array('$gte'=>$start,'$lt'=>$end);
    }

    $condition['smid'] = $data['smid'];
    
    $getBlog = select_sort_mongo("blog",$condition,array(),array('lastUpdate'=>-1));
    $fetBlog = add_id($getBlog,"id");

    $blogArray = array();
    foreach ($fetBlog as $key1 => $value1) 
    {
        $row = array();
        foreach ($fields as $fkey => $fvalue) 
        {
            Switch($fvalue['fieldValue'])
            {
                case "username":
                    $getUsername = get_resource_by_id(array("id"=>$value1['userId']));
                    //$row['username'] = $getUsername['data'][0]['name'];
                    array_push($row,$getUsername['data'][0]['name']);
                break;
                case "category":
                    $getCategory = get_blog_category_by_id(array("id"=>$value1['ctgId']));
                    //$row['category'] = $getCategory['data'][0]['name'];
                    array_push($row,$getCategory['data'][0]['name']);
                break;
                case "featureimage":
                    $getmedianame = get_association_data("7","10","1",$value1['id']);
          
                    if(count($getmedianame['media']["1"][$value1['id']]))
                    {
                        global $site_url;
                        $mediaPath= '<img src='.$site_url."uploads/media/images/".$getmedianame["media"]["1"][$value1[id]][0]["mediaName"] .' height="100" width="100"  />';
                        //$row['featureimage'] = $mediaPath;
                        array_push($row,$mediaPath);
                    }
                break;
                case "updatedOn": 
                    //$row['updatedOn'] = $value1['lastUpdate']->sec;
                    array_push($row,$value1['lastUpdate']->sec);
                break;
                default: 
                    //$row['updatedOn'] = $value1['lastUpdate']->sec;
                    array_push($row,$value1[$fvalue['fieldValue']]);
                break;
            }
        } 
        array_push($blogArray,$row);
    }
    return array("thead"=>$thead,"tdata"=>$blogArray,"filterFields"=>$condition);
}


function get_job_report($data)
{
    logger("19",$data,"",5,"/get_job_report");
    $filterFields = json_decode($data['jsonArr'],true);
    
    $getPageSetting = get_module_page_setting(array("userId"=>$data['userId'],"mid"=>$data['mid'],"smid"=>$data['smid']));

    $fields1 = array();
    if(count($getPageSetting['data']))
    {
        $fields1 = $getPageSetting['data'][0]['fields'];
    }
    else
    {

        $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid']),array('setting','fields'));
        $fetdata = add_id($getdata,"id");

        if($fetdata[0])
        {

            $fields1 = $fetdata[0]['setting']['defaultFields'];
        }
        else
        {
            $getdata = select_mongo("report_type",array('_id'=>new MongoId($filterFields['report'])),array('fields'));
            $fetdata = add_id($getdata,"id");
            $fields1 = $fetdata[0]['fields'];
        }
    }
    
    $fields = array();
    $fields = shortArrayByKey($fields1,'order');
    $thead = array();

    foreach ($fields as $fkey => $fvalue) 
    {
        array_push($thead,$fvalue['fieldName']);
    }

    
    $condition = array();

    $start = $end = '';

    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            case "status":
                $condition['status'] = $value;
            break;
            case "fromDate":
                $dt = $value. " 00:00";
                $start = strtotime($dt);
            break;
            case "toDate":
                $dt1 = $value. " 24:00";
                $end = strtotime($dt1);
            break;
            case "date":
                $dt = $value. " 00:00";
                $start = strtotime($dt);
                $dt1 = $value. " 24:00";
                $end = strtotime($dt1);
            break;
        }
    }

    $condition['start_date'] = $start;
    $condition['end_date'] = $end;
    $condition['smid'] = $data['smid'];
    $condition['meta_fields'] = "true";
    $condition['id'] = "0";

    $getJob = get_job_by_id($condition);
    $fetJob = $getJob['data'];

    $jobArray = array();
    foreach ($fetJob as $key1 => $value1) 
    {
        $row = array();
        foreach ($fields as $fkey => $fvalue) 
        {
            Switch($fvalue['fieldValue'])
            {
                case "username":
                    $getUsername = get_resource_by_id(array("id"=>$value1['userId']));
                    //$row['username'] = $getUsername['data'][0]['name'];
                    array_push($row,$getUsername['data'][0]['name']);
                break;
                case "category":
                    $getCategory = get_blog_category_by_id(array("id"=>$value1['ctgId']));
                    //$row['category'] = $getCategory['data'][0]['name'];
                    array_push($row,$getCategory['data'][0]['name']);
                break;
                case "featureimage":
                    $getmedianame = get_association_data("7","10","1",$value1['id']);
          
                    if(count($getmedianame['media']["1"][$value1['id']]))
                    {
                        global $site_url;
                        $mediaPath= '<img src='.$site_url."uploads/media/images/".$getmedianame["media"]["1"][$value1[id]][0]["mediaName"] .' height="100" width="100"  />';
                        //$row['featureimage'] = $mediaPath;
                        array_push($row,$mediaPath);
                    }
                break;
                case "updatedOn": 
                    //$row['updatedOn'] = $value1['lastUpdate']->sec;
                    array_push($row,$value1['lastUpdate']->sec);
                break;
                default: 
                    //$row['updatedOn'] = $value1['lastUpdate']->sec;
                    array_push($row,$value1[$fvalue['fieldValue']]);
                break;
            }
        } 
        array_push($jobArray,$row);
    }
    return array("thead"=>$thead,"tdata"=>$jobArray,"filterFields"=>$condition);
}

function get_job_report_status($data)
{   logger("19",$data,"",5,"/get_job_report_status");
    $check = check_key_available($data,array('mid','smid'));
    if($check['success'] == 'true')
    {
        $getdata = select_mongo("subModuleSetting",array("mid"=>$data['mid'],"smid"=>$data['smid']),array("uiSetting"));
        $fetdata = add_id($getdata,"id");

        $status = $fetdata[0]['uiSetting']['status'];
     
        $statusId = $fetdata[0]['uiSetting']['statusId'];
        $statusArr = array();
        for($i=0;$i<sizeof($status);$i++) {
           array_push($statusArr,array("id"=>$statusId[$i],"name"=>$status[$i]));
        }
        return array("success"=>"true","data"=>$statusArr,"error_code"=>"100");  
    }
    else
    {
        return $check;
    }
}

function get_report_list($data)
{
        logger("19",$data,"",5,"/get_report_list");
        $getdata = select_mongo("reportSetting",array("status"=>$data['status']),array('mid','smid','reportName','report_id'));
        $fetdata = add_id($getdata,"id");
        $result = array();
        foreach($fetdata as $abc)
        {
            $result[$abc['mid'].'_'.$abc['smid']][] = array('report_id'=>$abc['report_id'],'report_name'=>$abc['reportName']);
            
        }        
        return array("success"=>"true","data"=>$result,"error_code"=>"100");  
}




function get_report_name($data)
{   logger("19",$data,"",5,"/get_report_name");
    $check = check_key_available($data,array('mid','smid','report_id'));
    if($check['success'] == 'true')
    {
        $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],'report_id'=>$data['report_id']),array("reportName"));
        $fetdata = add_id($getdata,"id");        
        $reportName = $fetdata[0]['reportName'];      
        return array("success"=>"true","data"=>$reportName,"error_code"=>"100");  
    }
    else
    {
        return $check;
    }   
}


function get_survey_test($data)
{
    global $companyId;
    logger("19",$data,"",5,"/get_survey_test");
    $check = check_key_available($data,array('course'));
    if($check['success'] == 'true')
    {
        $course = $data['course'];
        $table_name = 'material_'.$companyId."_".$course. ' where type="test"';
        $sel_field = 'id, name';
        $getResult = Select_All($sel_field,$table_name);
        $allData = array();
        while($fetRes=mysqli_fetch_assoc($getResult))
        {
            array_push($allData,$fetRes);
        } 
   
        return array("success"=>"true","data"=>$allData,"error_code"=>"100");  
    }
    else
    {
        return $check;
    } 
}








?>
