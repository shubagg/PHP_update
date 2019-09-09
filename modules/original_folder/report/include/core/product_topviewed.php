<?php

/* Topviewed Product by Umesh*/
function get_top_viewed_product($data)
{
        logger("19",'',$data,5);   
        $condition=array();
        $dt = $data['start']. " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['end']. " 24:00";
        $end = new MongoDate(strtotime($dt1));
        
        $condition['dateOn'] = array('$gte'=>$start,'$lt'=>$end);
        $condition['activity'] = 'view';

        

        $getdata = select_mongo("activityHistory",$condition,array('itemId'));
        $fetdata = add_id($getdata,"id");

        $product_result = array();
        foreach($fetdata as $row)
        {
            $product_result[] = $row['itemId'];
            
        }
        $product_result = array_count_values($product_result);


        
        return array("success"=>"true","data"=>$product_result,"error_code"=>"100");  
}

function get_product_topviewed_report($data)
{
    $filterFields = json_decode($data['jsonArr'],true);
    $getPageSetting = get_module_page_setting(array("userId"=>$data['userId'],"mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']));

    $defaultFields = array();
    $allFields = array();
    $reportName="";
    if(count($getPageSetting['data']))
    {
        $defaultFields = $getPageSetting['data'][0]['fields'];
        $allFields = $getPageSetting['data'][0]['fields'];
    }
    else
    {

        
        $getdata = select_mongo("reportSetting",array("mid"=>$data['mid'],"smid"=>$data['smid'],"report_id"=>$data['report_id']),array('setting','fields','reportName'));
        $fetdata = add_id($getdata,"id");       
        
        if($fetdata[0])
        {

            $defaultFields = $fetdata[0]['setting']['defaultFields'];
            $allFields = $fetdata[0]['setting']['allFields'];
            $reportName = $fetdata[0]['reportName'];
        }
        
    }

    
    
    $allFields = shortArrayByKey($allFields,'order');
    $defaultFields = shortArrayByKey($defaultFields,'order');

    $thead = array();
    $fieldArr = array();

    foreach ($allFields as $fkey => $fvalue) 
    {
        array_push($thead,$fvalue['fieldName']);
        
    }
    foreach ($defaultFields as $fkey1 => $fvalue1) 
    {
       
        array_push($fieldArr,$fvalue1['fieldName']);
    }

    $condition = array();
    $filterFieldsArr = array();
    foreach ($filterFields as $key => $value) 
    {
        Switch($key)
        {
            
            case "fromDate":
                $condition['start'] = $value;
                array_push($filterFieldsArr, $value);
            break;
            case "toDate":
                $condition['end'] = $value;
                array_push($filterFieldsArr, $value);
            break;
           
        }
    }
    
    $tmp = get_top_viewed_product($condition);

    //print_r($tmp);die;
    if(!empty($tmp['data']))
    {

        $blogArray = array();
        $chartArr=array();
        $headArr=array();
        $productIdArr=array();
        $newFieldArr=array();

        array_push($headArr, "Product");
        array_push($headArr, "View Count");
        $allFields = $fetdata[0]['setting']['allFields'];
        $chartType = $fetdata[0]['setting']['chart'];

        foreach ($tmp['data'] as $key=>$value) 
        {
            $productInfo = get_product_by_id(array('id'=>$key));
            $row = array();
            
            $rowchart = array();
            array_push($rowchart, $productInfo['data'][0]['title']);
            array_push($rowchart, $value);
            array_push($productIdArr, $key);
            $row1 = array();
            foreach ($allFields as $fkey => $fvalue) 
            {

                Switch($fvalue['fieldValue'])
                {
                    case "title":
                        array_push($row,$productInfo['data'][0]['title']);
                        $row1[] = $productInfo['data'][0]['title'];
                    break;
                    case "itemId":
    
                        array_push($row,$value);
                        $row1[] = $value;
                    break;
                    
                }
                
            } 
               array_push($blogArray,$row);
               array_push($chartArr, $rowchart);
              
               $newFieldArr[]=$row1;
            }

            
            array_unshift($chartArr, $headArr);
        
    }
    return array("thead"=>$thead,"defaultField"=>$fieldArr,"tdata"=>$blogArray,"filterFields"=>$filterFieldsArr,"chartData"=>$chartArr,'chartType'=>$chartType,'newFieldArr'=>$newFieldArr,'allFields'=>$allFields,'reportName'=>$reportName);
}



/* End  Topviewed Product */

?>